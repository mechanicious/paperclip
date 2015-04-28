@extends('admin.dashboard._content')
@include('admin._alert')
@section('form')
  <div class="span7">
    @if (is_null(Session::get('input.id')))
        {{-- Store --}}
        <form action="{{ route('admin.dashboard.candy.store') }}" class='form-horizontal' method='post'>
    @else
        {{-- Update --}}
        <form action="{{ route('admin.dashboard.candy.update', Session::get('input.id')) }}" class='form-horizontal' method='post'>
    @endif
        @yield('error')
        @yield('warning')
        @yield('success')
        @yield('info')
        <fieldset>
            <div class='control-group'>
                <label class='control-label' for='name'>Titel</label>
                <div class='controls'>
                    <input class='span5' id='name' name='name' placeholder=
                    'e.g. Mont Everest, Eiffel Tower' type='text' maxlength="256" value="{{ Session::get('input.name') }}" autofocus required>
                </div><!-- /controls -->
            </div><!-- /control-group -->

            <div class='control-group'>
                <label class='control-label' for='url'>Link</label>
                <div class='controls'>
                    <input class='span5' id='url' name='url' placeholder=
                    'http://www...' type='url' maxlength="256" value="{{ Session::get('input.url') }}" required>
                </div><!-- /controls -->
            </div><!-- /control-group -->

            <div class='form-actions'>
                <button class='btn btn-primary' type='submit'>Submit</button>
                <button class='btn' type='reset'>Reset</button>
            </div><!-- /form-actions -->
        </fieldset>
    </form>
  </div>
  <div class="span4">
    <script>
      $(document).ready(function() {
        $('#validate').on('click', function(e) {
          var container = "#preview", button = $('#validate'), _this = $('input[name="url"]'), alert = function(message) {return '<div class="alert alert-danger animated  rubberBand"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> '+ message +' </div>'};
          spinnerAdd();
          function spinnerAdd() {return button.prepend('<i class="icon-spin icon-spinner"></i>')}
          function spinnerDel() {return (spin = button.find('.icon-spin.icon-spinner')) ? spin.remove() : false;}
          function get(){return $(container)}
          function exists(){return !$.isEmptyObject(get().find('img').get())}
          function create(){return get().append('<img>')}
          function sameUrl(){return $(_this).val() === get().attr('src')}
          function updateUrl(url){get().find('img').attr('src', url);}
          function removeAlert(){get().find('[class="alert"]').remove()}
          function addAlert(){get().parent().prepend(alert('The url format doesn\'t seem to be valid.'))}
          function validateUrl(url){if(typeof url === "string") {var ext = url.match(/\.\w+$/); if(ext === null) {addAlert();}}}
          function src(){return $(_this).val()}
          if(exists()) { updateUrl(src());} else {create(); updateUrl(src());}
          setTimeout(function(){spinnerDel();}, 350)
        })
      })
    </script>
    <style>#preview {position: relative; box-shadow: 0 0 8px 2px #CECECE;} #preview img {width: 100%; height: 100%;}</style>
    <button type="button" id="validate" style="width: 100%;"class="btn btn-large btn-block btn-default">Validate</button>
    <br>
    <div id="preview">
      <img src="">
    </div>
  </div>
@stop