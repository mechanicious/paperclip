@section('table')
	<?php
		$modelName 	= $title; 
		$model 		= $modelName::where('deleted_at', '=', null);
		$paginate 	= $model->paginate(10);
		if(!empty($paginate->all()))
			$table = Tablezator::make($paginate, route('admin.dashboard.'.strtolower($title).'.edit'), route('admin.dashboard.'.strtolower($title).'.delete'));
	?>
	@if(!empty($paginate->all()))
		{{-- expr --}}
	
			<div class="widget">
		    <div class="widget-content">
		        <div class="tabbable">
		            <div class="tab-content">
		            		<div class="container">
								{{ $table }}
							<div class="pagination-container small">
								{{ $paginate->links() }}
							</div>
		            </div>
		        </div>
		    </div>
		</div>
		</div>
	@endif
@stop

