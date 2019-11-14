<!-- Modal -->
<div class="modal fade" id="unauthorized-modal" tabindex="-1" role="dialog" aria-labelledby="unauthorized-modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
      		<div class="modal-header">
        		<h1 class="modal-title">Unauthorized</h1>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
    			</button>
      		</div><!-- .modal-header -->
      		<hr>
	      	<div class="modal-body">
  				<h2>You need to be a member. Please 
  					<a href="{{ route('login' )}}">
  						login 
  					</a>
  					or 
  					<a href="{{ route('register') }}">
  						join us
  					</a> 
  					to be a part of this community.</h2>
		    </div><!-- .modal-body -->
	      	<div class="modal-footer">
    		</div><!-- .modal-footer -->
		</div>
	</div>
</div>