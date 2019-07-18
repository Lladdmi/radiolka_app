<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
  </head>
  <body>
    <div id="wrapper">
      <div class="banner">
        @guest
        <div class="fb-button">
          <a href="{{url('/redirect')}}" class="fb-text">Login with Facebook</a>
        </div>
        @else
        <div class="username-box">
              <a class="" href="#">Witaj,</br> {{ Auth::user()->name }} </a>
        </div>
              <div class="logout-box">
                  <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
    @endguest
      </div>
      <div id="main_wrapper">
        <header>
          <h1 onclick="location.href = '{{url('/')}}';" style="cursor: default;" >Radiolka ZS3</h1>
        </header>
        <nav>
          <ul class="nav-ul">
            <li> <a href="{{url('głosuj')}}">Głosuj</a> </li>
            <li> <a href="{{url('historia')}}">Historia</a> </li>
            <li> <a href="{{url('/')}}">Strona główna</a> </li>
            <li> <a href="{{url('o_nas')}}">O nas</a> </li>
            <li> <a href="{{url('FAQ')}}">FAQ</a> </li>
          </ul>
        </nav>
        <div class="content">
          @yield('content')
        </div>
        </div>
      <footer>
        Copyright (c) 2018 by /**/. All Rights Reserved.
      </footer>
    </div>
  </body>
</html>
