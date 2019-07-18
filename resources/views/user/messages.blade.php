@extends('layouts.master')
@section('title', 'Radiolka | Panel użytkownika')
@section('content')
    <div class="uk-card uk-card-default">
      <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle" uk-grid>
          <div class="uk-width-expand">
            <h3 class="uk-card-title uk-margin-remove-bottom">Wyślij wiadomość</h3>
          </div>
        </div>
      </div>
      <div class="uk-padding">
      <div class="uk-child-width-expand@s uk-text-center" uk-grid>
        <div>
      {!! Form::open(['url' => '/wiadomości', 'method' => 'POST', 'class' => 'uk-form-stacked','style' => 'font-size: 1em;', 'autocomplete' => 'off']) !!}
        <div class="uk-margin">{{Form::text('subject','',['placeholder' => 'Tytuł', 'class' => 'uk-input uk-align-center'])}}</div>
        <div class="uk-margin">{{Form::textarea('message','',['placeholder' => 'Wiadomość', 'class' => 'uk-input uk-align-center','style' => 'min-height: 150px;;'])}}</div>
        <div class="uk-margin">{{Form::submit('Wyślij',['class' => 'uk-button uk-button-danger uk-button-light uk-button-larget'])}}</div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
</div>
<div>
  @foreach ($errors->all() as $error)
    <script>UIkit.notification("{{$error}}", {pos: 'top-right'})</script>
  @endforeach
</div>
@endsection
