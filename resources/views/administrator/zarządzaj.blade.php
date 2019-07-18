@extends('layouts.master')
@section('title', 'Radiolka | Zarządzaj')
@section('content')
<h1 class="uk-heading-divider uk-light uk-padding-small uk-align-center uk-text-center" style="font-size: 2em">Zarządzaj</h1>
<div class="uk-child-width-1-2@s uk-text-center" uk-grid>
  <div>
    <div class="uk-card uk-card-default uk-card-body">
      <h3 class="uk-card-title">Użytkownicy</h3>
        <div class="uk-height-max-large" style="overflow: scroll;">
          <table class="uk-table uk-table-striped">
          <thead>
              <tr>
                  <th>Użytkownik</th>
                  <th>Email</th>
                  <th>Utworzono</th>
              </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr class="uk-text-left">
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}
                    <span onclick="setClipboard('{{$user->email}}')" style="cursor: pointer;" uk-icon="icon: copy; ratio: 0.75;"></span>
                  </td>
                  <td>{{$user->created_at}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div>
    <div class="uk-card uk-card-default uk-card-body">
      <h3 class="uk-card-title">Dodaj administratora</h3>
      <div class="uk-height-max-large" style="overflow: scroll;">
        <table class="uk-table uk-table-striped">
          <caption class="uk-text-center">Aktualni administratorzy</caption>
          <thead>
              <tr>
                  <th>Użytkownik</th>
                  <th>Email</th>
                  <th>Utworzono</th>
              </tr>
          </thead>
          <tbody>
            @foreach($admins as $admin)
              <tr class="uk-text-left">
                  <td>{{$admin->name}}</td>
                  <td>{{$admin->email}}</td>
                  <td>{{$admin->created_at}}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      {!! Form::open(['url' => '/zarządzaj/dodaj', 'method' => 'POST', 'class' => 'uk-form-stacked','style' => 'font-size: 1.2em;', 'autocomplete' => 'off']) !!}
        <div class="uk-margin">{{Form::text('email','',['placeholder' => 'adres email', 'class' => 'uk-text-center uk-input uk-width-1-2 uk-align-center'])}}</div>
        <div class="uk-margin">{{Form::submit('Dodaj',['class' => 'uk-button uk-button-danger uk-button-light uk-button-larget'])}}</div>
      {!! Form::close() !!}
    </div>
  </div>
  <div>
    <div class="uk-card uk-card-default uk-card-body">
      <h3 class="uk-card-title">Aktualizuj aktualności</h3>
      {!! Form::open(['url' => '/zarządzaj/update', 'method' => 'POST', 'class' => 'uk-form-stacked','style' => 'font-size: 1.2em;', 'autocomplete' => 'off']) !!}
        <div class="uk-margin">{{Form::textarea('news','',['placeholder' => 'treść', 'class' => 'uk-text-center uk-input uk-width-1-2 uk-align-center'])}}</div>
        <div class="uk-margin">{{Form::number('speed','',['placeholder' => 'szybkość', 'class' => 'uk-text-center uk-input uk-width-1-2 uk-align-center'])}}</div>
        <div class="uk-margin">{{Form::submit('Aktualizuj',['class' => 'uk-button uk-button-danger uk-button-light uk-button-larget'])}}</div>
      {!! Form::close() !!}
    </div>
  </div>
  <div>
    <div class="uk-card uk-card-default uk-card-body">
      <h3 class="uk-card-title">Usunięte wiadomości</h3>
        <div class="uk-height-max-large" style="overflow: scroll;">
          <table class="uk-table uk-table-striped uk-table-middle">
          <thead>
              <tr>
                  <th>Użytkownik</th>
                  <th>Temat</th>
                  <th>Utworzono</th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
            @foreach($messages as $message)
              <tr class="uk-text-left">
                  <td>{{$message->name}}</td>
                  <td>{{$message->subject}}</td>
                  <td>{{$message->created_at}}</td>
                  <td>
                  <button class="uk-button uk-button-small uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #modal-example">Pokaż</button>
                  <div id="modal-example" uk-modal>
                      <div class="uk-modal-dialog uk-modal-body">
                          <h2 class="uk-modal-title">{{$message->subject}}</h2>
                          <p>{{$message->message}}</p>
                          <p class="uk-text-right">
                              <button class="uk-button uk-button-default uk-modal-close" type="button">Wróć</button>
                          </p>
                      </div>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table></div>
    </div>
  </div>
</div>
<div>
  @foreach ($errors->all() as $error)
    <script>UIkit.notification("{{$error}}", {pos: 'top-right'})</script>
  @endforeach
</div>
@endsection
