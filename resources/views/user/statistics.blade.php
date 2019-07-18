@extends('layouts.master')
@section('title', 'Radiolka | Panel użytkownika')
@section('content')
<div class="uk-child-width-expand@s uk-text-center" uk-grid>
    <div>
    <div class="uk-card uk-card-default">
      <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle" uk-grid>
          <div class="uk-width-expand">
            <h3 class="uk-card-title uk-margin-remove-bottom">Statystyki</h3>
          </div>
        </div>
      </div>
      <div class="uk-padding">
        <div class="uk-grid-small uk-child-width-expand@s uk-text-center" uk-grid>
          <div>
            <div class="uk-card-small uk-card-default uk-card-body">
              <p class="uk-text-large">Wysłanych propozycji</p>
                  <p class="uk-countdown-number">{{$sug_count[0]['user_count']}}</p>
              <hr class="uk-divider-small">
            </div>
          </div>
          <div>
            <div class="uk-card-small uk-card-default uk-card-body">
              <p class="uk-text-large">Twoich zaakceptowanych propozycji</p>
              <p class="uk-countdown-number">{{$sug_count[0]['accept_count']}}</p>
              <hr class="uk-divider-small">
            </div>
          </div>
          <div>
            <div class="uk-card-small uk-card-default uk-card-body">
              <p class="uk-text-large">Wszystkich propozycji</p>
              <p class="uk-countdown-number">{{$sug_count[0]['total_count']}}</p>
              <hr class="uk-divider-small">
            </div>
          </div>
        </div>
        <div class="uk-grid-small uk-child-width-expand@s uk-text-center" uk-grid>
          <div>
            <div class="uk-card-small uk-card-default uk-card-body">
              <p class="uk-text-large">Zaakceptowałeś</p>
                  <p class="uk-countdown-number">{{$sug_count[0]['accepted']}}</p>
              <hr class="uk-divider-small">
            </div>
          </div>
          <div>
            <div class="uk-card-small uk-card-default uk-card-body">
              <p class="uk-text-large">Odrzuciłeś</p>
              <p class="uk-countdown-number">{{$sug_count[0]['rejected']}}</p>
              <hr class="uk-divider-small">
            </div>
          </div>
        </div>
      </div>
      <div class="uk-card-footer">
      </div>
    </div>
  </div>
  <div class="uk-width-1-1">
  <div class="uk-card uk-card-default">
    <div class="uk-card-header">
      <div class="uk-grid-small uk-flex-middle" uk-grid>
        <div class="uk-width-expand">
          <h3 class="uk-card-title uk-margin-remove-bottom">Wykresy</h3>
        </div>
      </div>
    </div>
    <div class="uk-padding">
      <div class="uk-grid-small uk-child-width-expand@s uk-text-center" uk-grid>
        <div>
          <div class="uk-card-small uk-card-default uk-card-body">
            <h3 class="uk-card-title">Ogólne statystyki</h3>
            <div class="">
              @include('charts.globalStatistics')
            </div>
          </div>
        </div>
      <div>
      <div class="uk-card-small uk-card-default uk-card-body">
        <h3 class="uk-card-title">Twoje statystyki</h3>
        <div class="">
          @include('charts.userStatistics')
        </div>
      </div>
    </div>
    </div>
  </div>
  <div class="uk-card-footer">
  </div>
</div>
</div>
</div>
@endsection
