@extends('layouts.master')
@section('title', 'Radiolka | Głosuj')
@section('content')

<div>
  <h1 class="uk-heading-divider uk-light uk-padding-small uk-align-center uk-text-center" style="font-size: 2em">
    Głosuj na swoją ulubioną muzykę
    <span uk-icon="icon: info; ratio: 1.1" class="uk-align-right uk-margin-remove" style="color: White"></span>
    <div uk-drop="pos: top">
      <div class="uk-card uk-card-body uk-card-default" style="font-size: 0.5em">
        <span style="font-size: 1.2em">Jak głosować?</span><br>
        <div class="uk-margin-small">
          Na każdą z propozycji możesz oddać tylko jeden głos<br>
        </div>
        <div class="uk-margin-small">
          Utwory z największą ilością głosów będą przez nas wybierane i emitowane w radiolce podczas trwania długiej przerwy<br>
        </div>
      </div>
    </div>
  </h1>
</div>
  <table class="uk-table uk-table-small uk-light uk-table-middle">
    <thead>
      <tr class="uk-text-middle thead-center">
        <th>#</th>
        <th>Tytuł</th>
        <th>Adnotacja</th>
        <th>Zaproponował</th>
        <th>Data</th>
        <th>Głosuj</th>
      </tr>
    </thead>
    <tbody style="font-size:1.3em;">
        @foreach($suggestions as $suggestion)
        <tr>
          <td>
            {{$loop->iteration}}
            <!-- {{$suggestion->users_votes}}|
            {{$suggestion->status_votes}} -->
          </td>
          <td>{{$suggestion->name}}</td>
          <td>{{$suggestion->description}}</td>
          <td>
            @if($suggestion->anon == 0)
              {{$suggestion->user_name}}
            @elseif($suggestion->anon == 1)
              {{'Anonim'}}
            @endif
          </td>
          <td>{{$suggestion->created_at}}</td>
          <td>
            <div class="uk-flex-center uk-flex uk-flex-inline">
              <div class="uk-flex-inline" style="margin-right: 5px;">
              <span class="uk-text-middle">
                {{$suggestion->upvotes}}
              </span>
                {!! Form::open(['action' => 'VoteController@upvote', 'method' => 'POST', 'autocomplete' => 'off']) !!}
                  @if(str_contains($suggestion->vote_status, 1) && (!str_contains($suggestion->vote_status, '-')))
                    {{Form::button('<i class="fas fa-volume-up fa-2x" style="color:#1e87f0"></i>',['type' => 'submit', 'class' => 'volume', 'style' => 'cursor: pointer'])}}
                  @elseif(str_contains($suggestion->status_votes, 0))
                    {{Form::button('<i class="fas fa-volume-up fa-2x" style="color:White"></i>',['type' => 'submit', 'class' => 'volume', 'style' => 'cursor: pointer'])}}
                  @endif
                  {{Form::hidden('upvote', $suggestion->suggestion_id)}}
                {!! Form::close() !!}
              </div>
              <div class="uk-flex-inline" style="margin-right: 5px;">
                {!! Form::open(['action' => 'VoteController@downvote', 'method' => 'POST', 'autocomplete' => 'off']) !!}
                  @if(str_contains($suggestion->users_votes, 1) && (str_contains($suggestion->vote_status, '-1')))
                    {{Form::button('<i class="fas fa-volume-down fa-2x" style="color:#ee395b"></i>',['type' => 'submit', 'class' => 'volume', 'style' => 'cursor: pointer'])}}
                  @else
                    {{Form::button('<i class="fas fa-volume-down fa-2x" style="color:White"></i>',['type' => 'submit', 'class' => 'volume', 'style' => 'cursor: pointer'])}}
                  @endif
                  {{Form::hidden('downvote', $suggestion->suggestion_id)}}
                {!! Form::close() !!}
                <span class="uk-text-middle">
                  {{$suggestion->downvotes}}
                </span>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  @foreach ($errors->all() as $error)
      <script>UIkit.notification("{{$error}}", {pos: 'top-right'})</script>
  @endforeach
@endsection
