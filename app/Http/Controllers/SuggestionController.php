<?php

namespace App\Http\Controllers;

use App\Suggestion;
use App\Vote;
use Illuminate\Http\Request;
use Auth;
use Redirect;
use DB;
use Response;
use App\Services\LastfmService;

class SuggestionController extends Controller
{
  public function store(Request $request, LastfmService $lastfm) // store new suggestions
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

      if (Auth::check()) { //if user is logged send to db
           $suggestion = new Suggestion;
           $suggestion->name = ucwords($request->input('name'));
           $suggestion->description = $description;
           $suggestion->user_id = \Auth::user()->id;
           $suggestion->status = '0';
           $suggestion->anon = $request->input('anon');
           $suggestion->genre = $genre_string;
           $suggestion->save();
         return redirect('/')->withErrors(['Propozycja została wysłana!']);
        }else{
           return Redirect::back()->withErrors(['Aby wysłać propozycję musisz być zalogowany']);
         }
    }

  public function show(){
    if(\Auth::check()){
      $userid =  \Auth::user()->id;
      DB::statement(DB::raw("SET @user = $userid"));
    }else{
      DB::statement(DB::raw("SET @user = 2"));
    }
    $suggestions =
        DB::select(
            DB::raw("SELECT t1.*, t2.*  from
    (select suggestions.*,suggestions.id as suggestion_id,users.id as users_user_id,users.name as user_name, sum(votes.vote) as suma,
    sum(case when votes.vote = 1 then 1 else 0 end) upvotes,
    sum(case when votes.vote = -1 then 1 else 0 end) downvotes,
    GROUP_CONCAT(votes.user_id) as users_votes,
    GROUP_CONCAT(votes.vote) as status_votes
    from users
    join suggestions on users.id = suggestions.user_id
    join votes on suggestions.id = votes.sug_id
    where suggestions.status = 1
    GROUP by suggestions.id
    ORDER by suma DESC) as t1
    left join
    (select votes.user_id, votes.vote as vote_status, suggestions.id as sug_id from votes
    join suggestions on suggestions.id = votes.sug_id where votes.user_id = @user  GROUP by sug_id) as t2 on t1.suggestion_id = t2.sug_id")
        );

        return view('głosuj', [
           'suggestions' => $suggestions
         ]);
        }
}

// SELECT t1.*, t2.*  from
// (select suggestions.*,suggestions.id as sug_id,users.id as users_user_id,users.name as user_name, sum(votes.vote) as suma,
// sum(case when votes.vote = 1 then 1 else 0 end) upvotes,
// sum(case when votes.vote = -1 then 1 else 0 end) downvotes,
// GROUP_CONCAT(votes.user_id) as users_votes,
// GROUP_CONCAT(votes.vote) as status_votes
// from users
// join suggestions on users.id = suggestions.user_id
// join votes on suggestions.id = votes.sug_id
// where suggestions.status = 1
// GROUP by suggestions.id
// ORDER by suma DESC) as t1
// left join
// (select votes.user_id, votes.vote as vote_status, suggestions.id as sug_id from votes
// join suggestions on suggestions.id = votes.sug_id where votes.user_id = @user  GROUP by sug_id) as t2 on t1.sug_id = t2.sug_id
