@extends('admin.dashboard._content')
@include('admin._alert')
@section('form')
	@if (is_null(Session::get('input.id')))
		{{-- Store --}}
		<form action="{{ route('admin.dashboard.page.store') }}" class='form-horizontal' method='post'>
	@else
		{{-- Update --}}
		<form action="{{ route('admin.dashboard.page.update', Session::get('input.id')) }}" class='form-horizontal' method='post' autocomplete="off">
	@endif
		@yield('error')
		@yield('warning')
		@yield('success')
		@yield('info')
		<fieldset>
			<div class='control-group'>
				
				<!-- Title -->
				<label class='control-label' for='name'>Titel</label>
				<div class='controls'>
					<input class='span9' id='name' name='name' type='text' value='{{ Session::get('input.name') }}' autofocus tabindex="0" required>
				</div><br/>

				<!-- Post -->
				<label class='control-label' for='content'>Inhoud</label>
				<div class='controls clearfix'>
				   <div class="span9" style="margin-left: 0px;">
							<textarea tabindex="1" class='ckeditor' cols='58' id='content' name='content' rows='10' style=' margin: 0px; width: 576px; height: 204px; overflow: hidden;'>{{ Session::get('input.content') }}</textarea>  
					</div>
					</div><br/>

				<label class='control-label' for='language'>Taal</label>
				<div class='controls'>
						<select id="language" name="language_id" required>
						@foreach (Language::where('deleted_at', '=', null)->get()->toArray() as $language)
							<option value="{{ $language['id'] }}" tabindex="2">
								{{{ $language['language'] }}}
							</option>
						@endforeach
						</select>
					</div><!-- /controls -->
				</div><!-- /control-group -->
				
				<fieldset>
					<legend>Beveiliging</legend>
					<label class='control-label' for='password' tabindex="3">Wachtwoord</label>
					<div class='controls'>
						<input class='span9' id='password' name='password' type='password' value=''>
					</div><br/>

					<label class='control-label' for='password' tabindex="3">Geen wachtwoord</label>
					<div class='controls'>
						<button type="button" id="password-switch" class="btn btn-md btn-block btn-warning"><i class="icon-lock"> </i><span> Turn off</span></button>
						<script>
						$('#password-switch').toggle(
							function() {
								$('#password').attr('disabled', '');
								$(this).find('span').text('Turn on');
							},
							function() {
								$('#password').removeAttr('disabled');
								$(this).find('span').text('Turn off');
							});
					</script>
					</div><br/>
				</fieldset>

			</div>
		</fieldset>

		<!-- Controls -->
		<div class='form-actions'>
			<button class='btn btn-primary' type='submit' tabindex="4">Bevestigen</button>
			<button class='btn' type='reset'>Reset</button>
		</div>
	</form>
@stop