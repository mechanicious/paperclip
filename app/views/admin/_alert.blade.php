@section('error')
	@foreach (Notifier::getErrorMessages() as $message)
		<div class="alert alert-danger animated shake">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			{{ $message }}
		</div>
	@endforeach
@stop

@section('success')
	@foreach (Notifier::getSuccessMessages() as $message)
		<div class="alert alert-success animated rubberBand">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			{{{ $message }}}
		</div>
	@endforeach
@stop

@section('warning')
	@foreach (Notifier::getWarningMessages() as $message)
		<div class="alert alert-warning animated shake">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			{{{ $message }}}
		</div>
	@endforeach
@stop

@section('info')
	@foreach (Notifier::getInfoMessages() as $message)
		<div class="alert alert-info animated pulse">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			{{ $message }}
		</div>
	@endforeach
@stop