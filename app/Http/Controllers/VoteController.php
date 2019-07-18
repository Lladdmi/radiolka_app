<?php

namespace App\Http\Controllers;

use App\Vote;
use Illuminate\Http\Request;
use App\Suggestion;
use Auth;
use Redirect;
use DB;

class VoteController extends Controller
{
    public function upvote(Request $request){
      if (Auth::check()) {
      $result = Vote::where('sug_id', '=', $request->input('upvote'))
      ->where('user_id', '=', \Auth::user()->id)
      ->get();

      if($result->isEmpty()){
        $vote = new Vote;
        $vote->sug_id = $request->input('upvote');
        $vote->user_id = \Auth::user()->id;
        $vote->vote = '1';
        $vote->save();
      }else{
        return Redirect::back()->withErrors('Już oddałeś głos na tę propozycję');
      }
    }else{
      return Redirect::back()->withErrors(['Aby zagłosować musisz być zalogowany']);
      }
      return Redirect::back();
    }

    public function downvote(Request $request){
      if (Auth::check()) {
      $result = Vote::where('sug_id', '=', $request->input('downvote'))
      ->where('user_id', '=', \Auth::user()->id)
      ->get();
      if($result->isEmpty()){
        $vote = new Vote;
        $vote->sug_id = $request->input('downvote');
        $vote->user_id = \Auth::user()->id;
        $vote->vote = '-1';
        $vote->save();
      }else{
        return Redirect::back()->withErrors('Już oddałeś głos na tę propozycję');
      }
    }else{
      return Redirect::back()->withErrors(['Aby zagłosować musisz być zalogowany']);
      }
      return Redirect::back();
    }
  }
