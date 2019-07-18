@extends('layouts.master')
@section('title', 'Radiolka | Wiadomości')
@section('content')
    <div class="uk-card uk-card-default">
      <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle" uk-grid>
          <div class="uk-width-expand">
            <h3 class="uk-card-title uk-margin-remove-bottom">Wiadomości</h3>
          </div>
        </div>
      </div>
      <div class="uk-padding" >
        <div class="uk-child-width-1-1@m uk-text-center" uk-grid>
        @foreach($messages as $message)
        <div>
          <div class="uk-card-small uk-card-default uk-card-body">
          <ul uk-accordion>
            <li class="">
              <p class="uk-position-absolute uk-text-small uk-text-left">{{$message->created_at}}</p>
              <a class="uk-accordion-title uk-text-large uk-text-centere" style="margin-left: 33.6px;" href="#">{{$message->subject}}</a>
              <div class="uk-accordion-content uk-padding-small">
                <b><p class="uk-text-left" style="margin-left: 33.6px;">Nadawca: {{$message->name}}</p></b>
                {!! Form::open(['url' => '/admin/wiadomości', 'method' => 'POST', 'class' => 'uk-form-stacked','style' => 'font-size: 1.2em;', 'autocomplete' => 'off']) !!}
                  {{Form::hidden('id', $message->messages_id)}}
                  <div class="uk-margin">{{Form::button('<i class="fas fa-trash-alt fa-lg"></i>',['style' => 'cursor: pointer; margin: 0px 20px; margin-top: -45px;', 'class' => 'uk-align-right delete','type' => 'submit'])}}</div>
                {!! Form::close() !!}
                <p class="uk-padding-small">{{$message->message}}</p>
                <hr>
              </div>
            </li>
          </ul>
        </div>
      </div>
      @endforeach
  </div>
</div>
</div>
<div>
  @foreach ($errors->all() as $error)
    <script>UIkit.notification("{{$error}}", {pos: 'top-right'})</script>
  @endforeach
</div>
@endsection
