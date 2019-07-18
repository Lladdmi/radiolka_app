@extends('layouts.master')
@section('title', 'Radiolka | Historia')
@section('content')

@if(isset($history_results)) <!-- if function found results perform..-->
  <table class="uk-table uk-table-small uk-light">
    <thead class="uk-text-middle thead-center">
      <tr>
        <th>Tytuł</th>
        <th>Zaproponował</th>
        <th>Adnotacja</th>
        <th>Data</th>
      </tr>
    </thead>
    <tbody style="font-size:1.3em">
        @foreach($history_results as $history)
        <tr>
          <td>{{$history->name}}</td>
          <td>
            @if($history->anon == 0)
              {{$history->user_name}}
            @elseif($history->anon == 1)
              {{'Anonim'}}
            @elseif($history->anon == 2)
              {{'Radiolka'}}
            @endif
          </td>
          <td>{{$history->description}}</td>
          <td>{{$history->date}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <a class="uk-button uk-button-danger" href="javascript:history.back()">Wróć</a>
@else <!-- else show searching form... -->
<h1 class="uk-heading-divider uk-light uk-padding-small uk-align-center uk-text-center" style="font-size: 2em">Sprawdź historię</h1>
<ul class="uk-align-center uk-padding-remove" uk-switcher="animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium">
    <button class="uk-button uk-button-primary uk-width-auto">Szukaj z datą</button>
    <button class="uk-button uk-button-primary uk-width-auto">Szukaj utworu</button>
</ul>
<ul class="uk-switcher uk-margin">
    <li>
      {!! Form::open(['action' => 'HistoryController@searchDate', 'method' => 'POST', 'class' => 'uk-form-stacked','style' => 'font-size: 1.2em;', 'autocomplete' => 'off']) !!}
        <div class="uk-margin">{{Form::date('date', \Carbon\Carbon::now()->format('Y-m-d'),['class' => 'uk-input uk-width-1-4 uk-align-center'])}}</div>
        <div class="uk-margin">{{Form::submit('Wyślij',['class' => 'uk-button uk-button-danger uk-button-light uk-button-larget'])}}</div>
      {!! Form::close() !!}
    </li>
    <li>
      {!! Form::open(['action' => 'HistoryController@searchName', 'method' => 'POST', 'class' => 'uk-form-stacked','style' => 'font-size: 1.2em;', 'autocomplete' => 'off']) !!}
        <div class="uk-margin">{{Form::text('name','',['placeholder' => 'Wykonawca / Tytuł utworu','class' => 'uk-input uk-width-1-4 uk-align-center'])}}</div>
        <div class="uk-margin">{{Form::submit('Wyślij',['class' => 'uk-button uk-button-danger uk-button-light uk-button-larget'])}}</div>
      {!! Form::close() !!}
    </li>
</ul>
@endif
@endsection
