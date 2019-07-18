@extends('layouts.master')
@section('title', 'Radiolka | Panel użytkownika')
@section('content')
<div class="uk-child-width-expand@s uk-text-center" uk-grid>
    <div>
    <div class="uk-card uk-card-default">
      <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle" uk-grid>
          <div class="uk-width-expand">
            <h3 class="uk-card-title uk-margin-remove-bottom">Dane użytkownika</h3>
          </div>
        </div>
      </div>
      <div class="uk-padding">
        <div class="uk-grid-small uk-child-width-expand@s uk-text-center" uk-grid>
          <div>
            <div class="uk-card-small uk-card-default uk-card-body">
              <p class="uk-text-large">Nazwa</p>
              {{$user->name}}
              <hr class="uk-divider-small">
            </div>
          </div>
          <div>
            <div class="uk-card-small uk-card-default uk-card-body">
              <p class="uk-text-large">Email</p>
              {{$user->email}}
              <hr class="uk-divider-small">
            </div>
          </div>
          <div class="uk-width-1-1@m">
            <div class="uk-card-small uk-card-default uk-card-body">
              <p class="uk-text-large">Data utworzenia</p>
               {{$user->created_at=date('Y-m-d')}}
              <hr class="uk-divider-small">
            </div>
          </div>
        </div>
        <div class="uk-flex uk-flex-inline uk-margin-small">
          <div class="uk-padding-small uk-padding-remove-bottom"><span class="uk-label">Zalogowano za pomocą facebooka</span></div>
        </div>
      </div>
      <div class="uk-card-footer">
      </div>
    </div>
  </div>
  <div>
  <div class="uk-card uk-card-default">
    <div class="uk-card-header">
      <div class="uk-grid-small uk-flex-middle" uk-grid>
        <div class="uk-width-expand">
          <h3 class="uk-card-title uk-margin-remove-bottom">Usuń konto</h3>
        </div>
      </div>
    </div>
    <div class="uk-padding">
      <div class="uk-grid-small uk-child-width-expand@s uk-text-center" uk-grid>
        <div>
          <div class="uk-card-small uk-card-default uk-card-body">
            Wkrótce..
          </div>
        </div>
    </div>
    <div class="uk-card-footer">
    </div>
  </div>
</div>
</div>
@endsection
