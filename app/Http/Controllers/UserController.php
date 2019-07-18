<?php
namespace App\Http\Controllers;

use App\User;
use App\Suggestion;
use Charts;
use Illuminate\Http\Request;
use DB;
use Auth;
use Socialite;
use App\Services\LastfmService;
use App\Services\StatisticsService;


class UserController extends Controller
{
  public function panel(){
    $user = User::find(Auth::user()->id);
    return view('user.panel', compact('user'));
  }

  public function statistics(StatisticsService $stats){

    /* queries */
    $userid =  \Auth::user()->id;
    DB::statement(DB::raw("SET @user = $userid"));

    $sug_count = Suggestion::select()
		->selectSub('select count(id) as count from suggestions where user_id = @user', 'user_count')
		->selectSub('select count(id) from suggestions', 'total_count')
    ->selectSub('select count(id) from suggestions where archive = 1 and user_id = @user','accept_count')
    ->selectSub('select count(id) from votes where user_id = @user and vote = 1','accepted')
    ->selectSub('select count(id) from votes where user_id = @user and vote = -1','rejected')
    ->limit(1)
    ->get();

    $genre = Suggestion::select('genre') // get flobar genres
    ->where('archive', '=','1')
    ->get();

    $userGenre = Suggestion::select('genre') //get user genres
    ->where('archive', '=','1')
    ->where('user_id', '=', $userid)
    ->get();
    /* end queries */

    $globalGenre = $stats->globalStatistics($genre); //request to StatisticsService
    $userGenre = $stats->userStatistics($userGenre);

    return view('user.statistics',  compact(['sug_count', 'userGenre','globalGenre']));
  }
}
