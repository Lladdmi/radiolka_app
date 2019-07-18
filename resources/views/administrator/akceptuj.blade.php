@extends('layouts.master')
@section('title', 'Radiolka | Akceptuj')
@section('content')
<h1 class="uk-heading-divider uk-light uk-padding-small uk-align-center uk-text-center" style="font-size: 2em">Akceptuj propozycje</h1>
  <table class="uk-table uk-table-small">
    <thead>
      <tr class="uk-text-middle thead-center">
        <th>Tyttuł</th>
        <th>Zaproponował</th>
        <th>Adnotacja</th>
        <th>Data</th>
        <th>Akceptuj</th>
        <th>Odrzuć</th>
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
            @endif
          </td>
          <td>{{$suggestion->description}}</td>
          <td>{{$suggestion->created_at}}</td>
          <td>
            {{Form::open(['action' => 'Admin\AdministratorController@accept'])}}
              {{Form::hidden('accept', $suggestion->sug_id)}}
                <div class="uk-flex uk-flex-center">
                {{Form::submit('Akceptuj', ['class' => 'uk-button-primary uk-button-small'])}}
              </div>
            {!! Form::close() !!}
          </td>
          <td>
            {{Form::open(['action' => 'Admin\AdministratorController@discard'])}}
              {{Form::hidden('discard', $suggestion->sug_id)}}
                <div class="uk-flex uk-flex-center">
                {{Form::submit('Odrzuć', ['class' => 'uk-button-danger uk-button-small uk-text-center'])}}
              </div>
           {!! Form::close() !!}
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
@endsection
