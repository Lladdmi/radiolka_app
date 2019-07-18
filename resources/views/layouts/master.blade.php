<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport: landscape" content="width=device-width, initial-scale=1">
        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css" />
        <!-- UIkit JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit-icons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
        <link href="{{ asset('css/uikit-fonts.css') }}" rel="stylesheet">
        <script defer src="{{asset('js/fontawesome-all.js')}}">
          FontAwesomeConfig = { searchPseudoElements: true };
        </script>
        <script src="{{asset('js/radiolka_app.js')}}"></script>
        {!! Charts::styles() !!}
        <style media="screen">
        .user-panel a{
            animation: floatText 10s infinite linear;
          }
        </style>
    <title>@yield('title')</title>
  </head>
  <body>
    <!-- <div class="uk-background-fixed uk-background-center-center uk-background-blend-screen" style="background-image: url('css/img/background.png');"> -->
    <div class="uk-background-secondary" uk-height-viewport="expand: true">
      <div class="uk-text-center uk-position-relative">
        @guest
        <a  href="{{url('/redirect')}}" class="uk-button uk-button-primary uk-light uk-inline" style="font-size: 1em;">
          <span uk-icon="icon: facebook; ratio: 1.2"></span>
          Zaloguj za pomocą facebooka
        </a>
        @else
          @include('layouts.user_panel')
    @endguest
      </div>
        <header class="uk-container uk-padding-small uk-light">
          <h1 onclick="location.href = '{{url('/')}}';" style="cursor: default; font-size:5.4em;" class="uk-heading-line uk-text-center"><span>Radiolka ZS3</span></h1>
        </header>
          @if(Auth::check() && Auth::user()->rights())
            @include('layouts.navbar-admin')
          @else
            @include('layouts.navbar')
          @endif
          <div class="uk-padding uk-center uk-grid">
            <div class="uk-width-1-8@s"></div>
            <div class="uk-text-center uk-width-expand@m">@yield('content')</div>
            <div class="uk-width-1-8@s"></div>
          </div>
    </div>
    <footer class="uk-section uk-section-secondary uk-light" style="padding: 7px;">
      Copyright <i></i> 2018 by Szymon Kaszkiel. All Rights Reserved.
    </footer>
  </body>
</html>
