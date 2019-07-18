<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Redirect;
use Auth;

class MessageController extends Controller
{
  public function view(){
    return view('user.messages');
  }

  public function send(Request $request){
    $this->validate($request,[
      'subject' => 'required|max:255',
      'message' => 'required'
    ]);

    $data = array(
      'user_id' => \Auth::user()->id,
      'subject' => $request->subject,
      'message' => $request->message,
      'created_at' =>  \Carbon\Carbon::now(),
      'updated_at' => \Carbon\Carbon::now(),
    );

    Message::insert($data);

    // dd($data);
    return Redirect::back()->withErrors(['Wiadomość została wysłana!']);
    // dd($request);
  }
}
