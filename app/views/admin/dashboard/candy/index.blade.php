@extends('admin.dashboard._content')
@include('admin._alert')
@section('form')
  <div class="span7">
    @if (is_null(Session::get('input.id')))
        {{-- Store --}}
        <form style="display:none;" action="{{ route('admin.dashboard.candy.store') }}" class='form-horizontal' method='post'>
    @else
        {{-- Update --}}
        <form style="display:none;" action="{{ route('admin.dashboard.candy.update', Session::get('input.id')) }}" class='form-horizontal' method='post'>
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
  <div class="span4" style="display:none;">
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
      

  <!-- content -->
    <style type="text/css">
      #thumbnail-img {
        width: 150px;
        height: 150px;
        border-radius: 6px;
        float: right;
        margin-right: 30px;
      }
    </style>
    <div class="span4">
      <img id="thumbnail-img" src="">
    </div>
    <div class="span7">
      <div class="content mCustomScrollbar">
        <form action="{{{ route('admin.dashboard.candy.upload') }}}" method="post" class="dropzone" id="dropzone-form">
            <div class="fallback">
              <input name="file" type="file" multiple />
            </div>
        </form>
      </div>
    </div>
    <script type="text/javascript" src="/assets/admin/js/dropzone.js"></script>
    <script type="text/javascript" src="/assets/admin/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript">
    /**
     * Dropzone
     */
    $(document).ready(function() {
        var mydropzone = new Dropzone("#dropzone-form", {
            acceptedFiles: "image/*",
            dictDefaultMessage: '<i class="icon-4x icon-cloud-upload"></i><div style="font-size:12px; margin:0;">Drop files here to uplaod</div>',
            prependPreview: true,
            onPluginLoaded: function(plugin) {
              jQuery.ajax('{{{ route('admin.dashboard.candy.upload.fetchUploads', array(0, 20)) }}}')
              .done(function(data) {
                var entries = JSON.parse(data);
                entries.forEach(function(e, i) {
                  var mockFile = {
                    name: e.name, 
                    size: e.size,
                    url: e.url,
                    width: 100,
                    heigth: 100
                  };
                  plugin.options.addedfile.call(plugin, mockFile, true);
                  var thumbnail = plugin.createThumbnailFromUrl(mockFile, e.url);
                  plugin.options.thumbnail.call(plugin, mockFile, thumbnail);
                  $(mockFile.previewElement).on('click', function() {
                    $('#thumbnail-img').attr('src', thumbnail);
                  })
                  plugin.files.push(mockFile);
                });
              });
            },
            addRemoveLinks: true,
            removedfile: function(f) {
              if(f.status === 'error') return (_ref = f.previewElement) != null ? _ref.parentNode.removeChild(f.previewElement) : void 0;
              jQuery.ajax('{{{ route('admin.dashboard.candy.upload.deleteByName', '') }}}/' + f.name)
              .done(function(data) {
                if(data.indexOf('ok') !== -1) {
                  return (_ref = f.previewElement) != null ? _ref.parentNode.removeChild(f.previewElement) : void 0;
                }
              });
            },
            dictRemoveFile: '✘',
            dictCancelUpload: '✘',
            dictCancelUploadConfirmation: 'Sure?'
        });
        mydropzone
        .on('success', function(f) {
          if(f.previewElement) {
            var src = $(f.previewElement).find('img').first().attr('src');
            setThumbnail();
            $(f.previewElement).on('click', function() {
               setThumbnail();
            })
            function setThumbnail() {
              $('#thumbnail-img').attr('src', src);
            }
          }
        })
        .on('removedfile', function(f) {
          if(f.status === 'error') return;
          var th = $('#thumbnail-img'), tsrc = th.attr('src');
          if(f.url) {
            console.log('hi');
            if(f.url == tsrc) {
              clearThumbnail();
            }
          }
          else if(f.previewElement) {
            var fsrc = $(f.previewElement).find('img').first().attr('src');
            if(fsrc == tsrc) {
              clearThumbnail();
            }
          }
              console.log(f.url, tsrc);
          function clearThumbnail() {
            th.attr('src', '');
          }
        })

        $('.content').mCustomScrollbar({
            axis:"y",
            setHeight: '250px',
            scrollEasing: 'none',
            contentTouchScroll: 25
        });
    });
    </script>

  <script>
  </script>
  </div>
@stop