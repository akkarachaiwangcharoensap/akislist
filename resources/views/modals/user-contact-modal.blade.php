<!-- Modal -->
<div class="modal fade" id="user-contact-modal" tabindex="-1" role="dialog" aria-labelledby="user-contact-modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
      		<div class="modal-header">
        		<h1 class="modal-title">Contact</h1>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
    			</button>
      		</div><!-- .modal-header -->
      		<hr>
	      	<div class="modal-body">
	      		{{ Form::open(array('url' => route('profile.messages.message.send'), 'method' => 'POST', 'id' => 'user-contact-form')) }}
	        		<div class="owner">
	        			<h2>To:</h2>
	        			<div class="name">
	        				{{ $user->name }}
	        			</div>
	        		</div>
	        		<div class="message my-2">
	        			<h2>Message</h2>
		        		{{ Form::textarea('message', '', array('class' => 'form-control', 'placeholder' => 'message')) }}		
	        		</div>
	        		{{ Form::hidden('to', $user->unique_string) }}
	        		{{ Form::hidden('saleItem', $saleItem->unique_string) }}
	        	{{ Form::close() }}
	      	</div><!-- .modal-body -->
	      	<div class="modal-footer">

	       		<input type="submit" class="button blue" form="user-contact-form" value="Send">
    		</div><!-- .modal-footer -->
		</div>
	</div>
</div>