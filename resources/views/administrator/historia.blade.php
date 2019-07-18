@extends('layouts.master')
@section('title', 'Radiolka | Dodaj historię')
@section('content')
<h1 class="uk-heading-divider uk-light uk-padding-small uk-align-center uk-text-center" style="font-size: 2em">Archiwizuj</h1>
  <table class="uk-table uk-table-small">
    <thead>
      <tr class="thead-center">
        <th>Tyttuł</th>
        <th>Zaproponował</th>
        <th>Adnotacja</th>
        <th>Data</th>
        <th>Zaznacz</th>
      </tr>
    </thead>
    <tbody style="font-size: 1.3em;">
        @foreach($suggestions as $suggestion)
        <tr>
          <td>{{$suggestion->name}}</td>
          <td>
            @if($suggestion->anon == 0)
              {{$suggestion->user_name}}
            @elseif($suggestion->anon == 1)
            <a style="color: #a10404; font-weight: bold">[A] </a>
            {{$suggestion->user_name}}
              <!-- {{'Anonim'}} -->
            @elseif($suggestion->anon == 2)
            Radiolka
            @endif
          </td>
          <td>{{$suggestion->description}}</td>
          <td>{{$suggestion->created_at}}</td>
          <td>
            {{Form::open(['action' => 'Admin\AdministratorController@archive'])}}
              {{Form::checkbox('check[]', $suggestion->sug_id)}}
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <div class="uk-divider-icon"></div>
  <div class="uk-child-width-1-2@s uk-text-center" uk-grid>
  <div class="archive">
  <h1 class="uk-light uk-padding-small uk-margin-remove uk-align-center uk-text-center" style="font-size: 1.8em">Wybierz datę</h1>
  <div class="uk-margin">{{Form::date('date', \Carbon\Carbon::now()->format('Y-m-d'),['class' => 'uk-input uk-width-1-2 uk-align-center'])}}</div>
  <div class="uk-margin">{{Form::submit('Zarchiwizuj',['class' => 'uk-button uk-button-danger uk-button-light uk-button-larget'])}}</div>
  </div>
{!! Form::close() !!}
{!! Form::open(['action' => 'Admin\AdministratorController@addtoArchive', 'method' => 'POST', 'class' => 'uk-form-stacked', 'autocomplete' => 'off']) !!}
<h1 class="uk-light uk-padding-small uk-margin-remove uk-align-center uk-text-center" style="font-size: 1.8em">Dodaj do archiwum</h1>
  <div class="uk-margin">{{Form::text('name','',['placeholder' => 'Wykonawca - Nazwa Utworu', 'class' => 'uk-text-center uk-input uk-width-1-2 uk-align-center'])}}</div>
  <div class="uk-margin">{{Form::text('description','',['placeholder' => 'Opcjonalny komentarz do utworu', 'class' => 'uk-text-center uk-input uk-width-1-2 uk-align-center'])}}</div>
  <div class="uk-margin">{{Form::submit('Dodaj',['class' => 'uk-button uk-button-danger uk-button-light uk-button-larget'])}}</div>
{!! Form::close() !!}
</div>
@endsection
