<!-- Modal -->
<div class="modal fade" id="report-modal" tabindex="-1" role="dialog" aria-labelledby="report-modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
      		<div class="modal-header">
        		<h1 class="modal-title">Report</h1>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
    			</button>
      		</div><!-- .modal-header -->
      		<hr>
	      	<div class="modal-body">
	      		{{ Form::open(array('url' => ((isset($action)) ? $action : '' ), 'method' => 'POST', 'id' => 'report-form')) }}
	        		<h2>Reason (s)</h2>
	        		<div class="reasons">
		        		@foreach ($reportReasons as $reason)
		        			<div class="reason">
		        				<div class="radio">
		        					{{ Form::radio('report_category_id', $reason->id) }}
		        				</div>
		        				<div class="description">
		        					{{ $reason->name }}
		        				</div>
		        			</div>
		        		@endforeach
	        		</div>
	        		<div class="details">
	        			<h2>Details</h2>
		        		{{ Form::textarea('message', '', array('class' => 'form-control', 'placeholder' => 'Please provide us in details of the reason you report this user. Please provide at least one of these: what happened, when did it happen, how did it happen, and where did it happen. This will help us a lot to catch the bad actor. Thanks for your cooperations.')) }}		
	        		</div>
	        	{{ Form::close() }}
	      	</div><!-- .modal-body -->
	      	<div class="modal-footer">

	       		<input type="submit" class="button red" form="report-form" value="Report">
    		</div><!-- .modal-footer -->
		</div>
	</div>
</div>