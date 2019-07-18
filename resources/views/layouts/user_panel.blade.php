<div class="uk-grid-collapse uk-child-width-expand@s uk-text-center" uk-grid>
  <div class="uk-grid-collapse uk-flex-center" uk-grid>
    <div>
      <button class="uk-button uk-button-default" style="background-color: White" type="button"><span uk-icon="icon: triangle-down; ratio: 0.75" class="icon"></span>Witaj, {{ Auth::user()->name }}</button>
        <div uk-dropdown="pos: bottom-justify">
          <ul class="uk-nav uk-dropdown-nav">
            <li class="uk-nav-header">Zarządzaj</li>
            <li class="uk-nav-divider"></li>
            <li><a href="{{url('/panel')}}"><span uk-icon="icon: user; ratio: 1.0" class="icon"></span>Panel użytkownika</a></li>
            <li><a href="{{url('/statystyki')}}"><span uk-icon="icon: hashtag; ratio: 1.0" class="icon"></span></i>Statystyki</a></li>
            <li><a href="{{url('/wiadomości')}}"><span uk-icon="icon: mail; ratio: 1.0" class="icon"></span>Wiadomości</a></li>
          </ul>
        </div>
      </div>
        <div>
          <button class="uk-button uk-button-default" style="background-color: White" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            Wyloguj
            <i class="fas fa-power-off icon"></i>
          </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </div>
      <div>
        <div class="user-panel" style="background-color: ">
          <h2 class="uk-text-small uk-text-uppercase uk-light uk-margin-remove">Aktualności: </br></h2>
          <a class="news uk-light">none</a>
        </div>
      </div>
    <div class="logout-box">
      <div class="">
    </div>
  </div>
</div>
