<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Administrator;
use App\Suggestion;
use App\History;
use App\Vote;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Redirect;
use App\User;
use App\Settings;
use App\Message;
use Carbon\Carbon;
use App\Services\LastfmService;

class AdministratorController extends Controller
{
  public function index() // redirect standard Auth routes to index page
  {
    if(Auth::check() && Auth::user()->rights()){
      return view('administrator.index');
    }else{
      return Redirect::back();
    }
  } // FIXME: check this

  public function show(){ // get all the necessary data to make a suggestions table with from to discard and accept results
    $suggestions = Suggestion::select('suggestions.*','suggestions.id as sug_id','users.id','users.name as user_name', 'suggestions.status as status')
      ->from('users')
      ->join('suggestions', function($join) {
        $join->on('users.id', '=', 'suggestions.user_id');
        })
      ->where('status', '=', '0')
      ->where('reject', '=', '0')
      ->where('archive', '=', '0')
      ->get();
    return view('administrator.akceptuj', [
      'suggestions' => $suggestions
    ]);
  }

  public function accept(Request $request){ //accept administrator.akceptuj post:accept
    Suggestion::where('id', $request->input('accept'))
    ->update(['status' => 1]);

    $vote = new Vote;
    $vote->sug_id = $request->input('accept');
    $vote->user_id = '2';
    $vote->vote = '0';
    $vote->save();

    return Redirect::back();
  }

  public function discard(Request $request){ //discard administrator.akceptuj post:discard
    Suggestion::where('id', $request->input('discard'))
    ->update(['reject' => 1]);
    return Redirect::back();
  }

  public function archive(Request $request){ //archivize music audiction history
    $sug_id = $request->input('check');
    $date = $request->input('date');
    $to_move = Suggestion::find($sug_id);
    foreach ($to_move as $key) {
      $user_id[] = $key->user_id;
    }

    $count = count($sug_id);
    for($i = 0; $i < $count; $i++){
        $data = array(
            'user_id' => $user_id[$i],
            'sug_id' => $sug_id[$i],
            'date' => $date,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );

        $result[] = $data;
    }
    History::insert($result);

    $test = Suggestion::whereIn('id', $sug_id)
    ->update(['archive' => 1,
              'status' => 0
  ]);
  return Redirect::back();
    // dd($sug_id,$user_id, $date, $to_move, $result);
  }

  public function showH(){ // get history table
    $suggestions = Suggestion::select('suggestions.*','suggestions.id as sug_id','users.id','users.name as user_name')
      ->from('users')
      ->join('suggestions', function($join) {
        $join->on('users.id', '=', 'suggestions.user_id');
        })
      ->where('suggestions.status', '=', '1')
      ->where('suggestions.archive', '=', '0')
      ->get();
    return view('administrator.historia', [
      'suggestions' => $suggestions
    ]);
  }

  public function addtoArchive(Request $request, LastfmService $lastfm)
  {
    $request->validate([  //validation
      'name' => 'required|regex:/^(.*?)\s+-\s+(.*?)$/',
    ]);
    if(empty($request->input('description'))){
      $description = "Brak";
    }else{
      $description = $request->input('description');
    };
    $title = explode(' - ',$request->input('name'));  //split result into artist and title
    $result = $lastfm->getTrackInfo($title[1],$title[0]); //get track info
    if (isset($result['toptags'])){
      for ($i=0; $i < count($result['toptags']); $i++) {  //get tags from array
          $genre[] = $result['toptags'][$i]['name']; //and save into new array
      }
      $string=''; //empty string
      if($result != false){ //if track is not found, set $genre_string to null
        foreach ($genre as $value => $key){ //put tags into empty string
            $string .=  $key.',';
        }
      $genre_string = str_replace(' ', '_', $string);  //replace spaces with underscores
      }else{
        $genre_string = 'null'; //set string to null
      }
    }else{
      $genre_string = 'null'; //set string to null
    }

    $suggestion = new Suggestion;
    $suggestion->name = ucwords($request->input('name'));
    $suggestion->description = $description;
    $suggestion->user_id = \Auth::user()->id;
    $suggestion->status = '1';
    $suggestion->archive = '0';
    $suggestion->anon = 2;
    $suggestion->genre = $genre_string;
    $suggestion->save();

    dd($genre_string);
  }

  public function manage(){
    $admins = User::select('name','created_at','email')
    ->from('users')
    ->where('rights', '=', '1')
    ->get();

    $users = User::select('name','created_at','email')
    ->from('users')
    ->get();

    $messages = Message::select('messages.*','messages.id as messages_id','users.id','users.name')
   ->from('messages')
   ->join('users', function($join) {
     $join->on('messages.user_id', '=', 'users.id');
     })
   ->where('deleted', '=' ,'1')
   ->orderBy('created_at', 'DESC')
   ->get();

    return view('administrator.zarządzaj', compact(['users','admins','messages']));
  }

  public function rightsManage(Request $request){
    $this->validate($request,[
      'email' => 'required'
    ]);
    $select = User::select('email','rights')
    ->get();
    $arr = $select->toArray();
      for ($i=0; $i <count($arr) ; $i++) {
        $count[] = array($arr[$i]['email'] => $arr[$i]['rights']);
      }
      for ($z=0; $z<count($count) ; $z++) {
        foreach ($count[$z] as $key => $value) {
            $emails[] = $key;
        }
      }
// dd($count,$emails[1],(array_column($count, 'test'))[0]);
  if( (in_array($request->email, $emails)) && ((array_column($count, $request->email))[0] == 0)){
     User::where('email', $request->email)
     ->update(['rights' => '1']);
        return Redirect::back()->withErrors(['Dodano administratora!']);
      }elseif( (in_array($request->email, $emails)) && ((array_column($count, $request->email))[0] == 1)){
        return Redirect::back()->withErrors(['Użytkownik posiada uprawnienia administratora!']);
      }else{
        return Redirect::back()->withErrors(['Podany adres email nie istnieje']);
     }
  }

   public function newsUpdate(Request $request){
     Settings::where('id', 1)
          ->update(['news' => $request->news, 'speed' => $request->speed]
        );
      return Redirect::back();
   }

   public function messages(){
     $messages = Message::select('messages.*','messages.id as messages_id','users.id','users.name')
		->from('messages')
		->join('users', function($join) {
			$join->on('messages.user_id', '=', 'users.id');
			})
    ->where('deleted', '=' ,'0')
    ->orderBy('created_at', 'DESC')
		->get();
       // dd($messages);
     return view('administrator.wiadomości',compact('messages'));
   }

   public function deleteMessage(Request $request){
     Message::where('id', $request->id)
     ->update(['deleted' => 1]);

     return Redirect::back()->withErrors(['Wiadomość usunięta!']);
     // dd($request);
   }
}
