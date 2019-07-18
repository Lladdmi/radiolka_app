@extends('layouts.master')
@section('title', 'Radiolka')
@section('content')<?php // TODO: ajax validation ?>
<div class="uk-grid">
  <div class="uk-width-1-4@s"></div>
  <div class="uk-width-expand@m">
    <h1 class="uk-heading-divider uk-light uk-padding-small uk-align-center uk-text-center" style="font-size: 2em">
      Wyślij propozycję
      <span uk-icon="icon: info; ratio: 1.1" class="uk-align-right uk-margin-remove" style="color: White"></span>
        <div uk-drop="pos: right">
          <div class="uk-card uk-card-body uk-card-default" style="font-size: 0.5em">
            <span style="font-size: 1.2em">Jak wysyłać propozycje?</span><br>
            <div class="uk-margin-small">Wysyłając propozycję zwróć szczególną uwagę na wzór widoczny w oknie formularza<br>
              <b>Wykonawca - Nazwa Utworu</b>
            </div>
            <div class="uk-margin-small">Propozycje wysyłane niezdognie z formułą zostaną odrzucone</div>
          </div>
        </div>
      </h1>
    {!! Form::open(['action' => 'SuggestionController@store', 'method' => 'POST', 'class' => 'uk-form-stacked','style' => 'font-size: 1.2em;']) !!}
        <!-- {{Form::label('label', 'Wyślij porpozycje',['class' => 'uk-legend uk-light uk-heading-primary'])}} -->
        <div class="uk-margin">{{Form::text('name','',['placeholder' => 'Wykonawca - Nazwa Utworu', 'class' => 'uk-input uk-text-center'])}}</div>
        <div class="uk-margin">{{Form::text('description','',['placeholder' => 'Opcjonalny komentarz do utworu', 'class' => 'uk-input uk-text-center'])}}</div>
        <div class="uk-margin uk-text-left uk-text-muted uk-width-1-3" uk-tooltip="title: Twoja nazwa użytkownika zostanie anonimowa; pos: bottom">
          <i class="fas fa-user-secret"></i>
          {{Form::hidden('anon', '0')}}
          {{Form::label('anon','Wyślij anonimowo')}}
          {{Form::checkbox('anon')}}
        </div>
        <div class="uk-margin">
          {{Form::submit('Wyślij',['class' => 'uk-button uk-button-danger uk-button-light uk-button-larget'])}}
        </div>
        {!! Form::close() !!}
        @if ($errors->any())
        <div>
          @foreach ($errors->all() as $error)
            <script>UIkit.notification("{{$error}}", {pos: 'top-right'})</script>
          @endforeach
        </div>
    @endif
  </div>
  <div class="uk-width-1-4@s"></div>
</div>
@endsection
