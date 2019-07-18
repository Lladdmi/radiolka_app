@extends('layouts.master')
@section('title', 'Radiolka | FAQ')
@section('content')
<div>
<div class="uk-card uk-card-default">
  <div class="uk-card-header">
    <div class="uk-grid-small uk-flex-middle" uk-grid>
      <div class="uk-width-expand">
        <h3 class="uk-card-title uk-margin-remove-bottom">Często zadawane pytania</h3>
      </div>
    </div>
  </div>
  <div class="uk-padding">
    <div class="uk-grid-small uk-child-width-expand@s uk-text-center" uk-grid>
      <div>
        <div class="uk-card-small uk-card-default uk-card-body">
          <ul uk-accordion>
              <li class="">
                  <a class="uk-accordion-title uk-text-large" href="#">Kiedy dostanę moją propozycję?</a>
                  <div class="uk-accordion-content">
                      <p>Propozycje są przez nas wybierane wedug największej ilości głosów w rankingu <a href="{{url('głosuj')}}">tutuaj</a></p>
                  </div>
              </li>
          </ul>
          <hr class="uk-divider-small">
        </div>
      </div>
      <div>
        <div class="uk-card-small uk-card-default uk-card-body">
          <ul uk-accordion>
              <li class="">
                  <a class="uk-accordion-title uk-text-large" href="#">Jak moge uzyskać dedykację?</a>
                  <div class="uk-accordion-content">
                      <p>Dedykacje możesz podesłać wraz z utworem <a href="{{url('wiadomości')}}">tutaj</a><br>
                      Wiadomość wyślij minimum dzień przed zaplanowaną datą dedykacji</p>
                  </div>
              </li>
          </ul>
          <hr class="uk-divider-small">
        </div>
      </div>
    </div>
  </div>
  <div class="uk-padding">
    <div class="uk-grid-small uk-child-width-expand@s uk-text-center" uk-grid>
      <div>
        <div class="uk-card-small uk-card-default uk-card-body">
          <ul uk-accordion>
              <li class="">
                  <a class="uk-accordion-title uk-text-large" href="#">Dlaczego moja propozycja jest wciąż odrzucana?</a>
                  <div class="uk-accordion-content">
                      <p>Prawdopodobnie jest nieodpowiednia do zagrania na forum szkoły tzn. zawiera wulgaryzmy, jest remixem innych utworów..</p>
                  </div>
              </li>
          </ul>
          <hr class="uk-divider-small">
        </div>
      </div>
      <div>
        <div class="uk-card-small uk-card-default uk-card-body">
          <ul uk-accordion>
              <li class="">
                  <a class="uk-accordion-title uk-text-large" href="#">Dlaczego dziś nie było muzyki?</a>
                  <div class="uk-accordion-content">
                      <p>Widocznie mieliśmy bardzo ważny powód, aby zmienić nasz repertuar na 20 minut ciszy</p>
                  </div>
              </li>
          </ul>
          <hr class="uk-divider-small">
        </div>
      </div>
    </div>
  </div>
  <div class="uk-card-footer">
  </div>
</div>
</div>
@endsection
