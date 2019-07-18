<?php
 if (env('APP_ENV') === 'local') {
     URL::forceScheme('https');
 } // XXX

use App\Http\Middleware;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// main routes
Route::get('/', function () {
    return view('index');
});
Route::get('głosuj', function () {
    return view('głosuj');
});
Route::get('historia', function () {
    return view('historia');
});
Route::get('FAQ', function () {
    return view('FAQ');
});
Route::get('o_nas', function () {
    return view('o_nas');
});

Auth::routes();

// facebook routes
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

// suggestions routes
Route::post('send', 'SuggestionController@store');
Route::get('głosuj', 'SuggestionController@show');

// history routes
Route::post('historia/date', 'HistoryController@searchDate');
Route::post('historia/name', 'HistoryController@searchName');

// voting routes
Route::post('upvote', 'VoteController@upvote');
Route::post('downvote', 'VoteController@downvote');

// User routes
Route::group(['middleware' => ['auth', 'user']], function(){
  Route::get('/panel', 'UserController@panel');
  Route::get('/statystyki', 'UserController@statistics');
  Route::get('/wiadomości', 'MessageController@view');
  Route::post('/wiadomości', 'MessageController@send');
});

// Administratior routes
Route::group(['middleware' => ['auth', 'admin']], function() {
  Route::get('/admin', 'Admin\AdministratorController@index');
  Route::get('archiwizuj', 'Admin\AdministratorController@showH');
  Route::post('archive', 'Admin\AdministratorController@archive');
  Route::post('addtoArchive', 'Admin\AdministratorController@addtoArchive');
  Route::get('akceptuj', 'Admin\AdministratorController@show');
  Route::post('accept', 'Admin\AdministratorController@accept');
  Route::post('discard', 'Admin\AdministratorController@discard');
  Route::get('/zarządzaj', 'Admin\AdministratorController@manage');
  Route::post('/zarządzaj/dodaj', 'Admin\AdministratorController@rightsManage');
  Route::post('/zarządzaj/update', 'Admin\AdministratorController@newsUpdate');
  Route::get('/admin/wiadomości', 'Admin\AdministratorController@messages');
  Route::post('/admin/wiadomości', 'Admin\AdministratorController@deleteMessage');
});
