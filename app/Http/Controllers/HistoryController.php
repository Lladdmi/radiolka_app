<?php

namespace App\Http\Controllers;

use Request;
use App\History;
use Redirect;
use DB;

class HistoryController extends Controller
{

  public function searchDate(){
    $date = Request::all('date');
    $date_a = $date['date'];
    $history_results = History::select('users.id','users.name as user_name','suggestions.*','history.*', 'history.date as date', 'suggestions.anon as anon')
		->from('history')
		->join('suggestions', function($join) {
			$join->on('history.sug_id', '=', 'suggestions.id');
			})
		->join('users', function($join) {
			$join->on('history.user_id', '=', 'users.id');
			})
		->having('date', '=', $date_a)
		->get();
    // dd($history_results, $date_a); //debug
    return view('historia', [
      'history_results' => $history_results,
    ]);

  }

  public function searchName(){
    $name = Request::all('name');
    $sug_name = '%'.$name['name'].'%';
    $history_results = History::select('users.id','users.name as user_name','suggestions.*','history.*', 'suggestions.name as sug_name', 'history.date as date', 'suggestions.anon as anon')
    ->from('history')
    ->join('suggestions', function($join) {
      $join->on('history.sug_id', '=', 'suggestions.id');
      })
    ->join('users', function($join) {
      $join->on('history.user_id', '=', 'users.id');
      })
    ->where('suggestions.name', 'like', $sug_name)
    ->get();
    // dd($history_results); //debug
    return view('historia', [
      'history_results' => $history_results,
    ]);

  }
// SELECT history.*, history.id as his_id, users.id, users.name as user_name
// from users join history on users.id = history.user_id, history.created_at as date
// having date = Y=m-d
//SQL query
}
