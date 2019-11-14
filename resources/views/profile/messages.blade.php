<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/sale-item-gallery.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/modals/report-modal.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/messages.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/profile/messages/messages.js') }}"></script>

	@include('templates.google.google-analytics')
</head>
<body>

	@php
		$user = Auth::user();
	@endphp

	@include('templates.navigation')

	<div class="container-fluid">
		<div class="row">

			@include('templates.profile.navigation')

			<div class="col-lg-12 col-md-12 col-sm-12 messages section">
				<h1>Messages</h1>
				<div class="content" id="message-board">
					
					@php $index = 0; @endphp
					@foreach ($saleItems as $saleItem)
						{{-- Private conversation between the buyer and seller --}}
						@if ($saleItem->author->id != $user->id)
							<div class="item">
								@include('templates.store.sale-item', array(
									'saleItem' => $saleItem,
									'index' => $index
								))

								<div class="user-messages">
									<div class="user-message">
										<div class="sender">
											<span class="name">{{ $saleItem->author->name }}</span>
											<span class="total float-right">({{ count($saleItem->getPrivateConversation()) }})</span>
										</div><!-- .sender -->
										<div class="messages">
											@foreach ($saleItem->getPrivateConversation() as $message)											
												<div class="message">
													@if ($message->sender->id == $user->id)
														<b class="you">You</b>
														{{ Form::open(array('url' => route('profile.messages.message.delete'), 'method' => 'DELETE', 'class' => 'remove-message-form')) }}
															{{ Form::hidden('message_id', $message->id) }}
															<button type="submit" class="fas fa-times"></button>
														{{ Form::close() }}
													@else
														<b class="other">{{ $message->sender->name }}</b>
													@endif
													<p>
														{!! nl2br(e($message->message)) !!}
													</p>
												</div><!-- .message -->
											@endforeach
										</div><!-- .messages -->
										
										<div class="reply">
											{{ Form::open(array('url' => route('profile.messages.message.send'), 'class' => 'form-group')) }}
												<b>Reply</b>
												{{ Form::textarea('message', '', array('class' => 'form-control', 'placeholder' => 'message')) }}
												{{ Form::hidden('saleItem', $saleItem->unique_string) }}
												{{ Form::hidden('to', $saleItem->author->unique_string) }}
												{{ Form::submit('Send', array('class' => 'small blue button float-right my-3')) }}
											{{ Form::close() }}
										</div><!-- .reply -->
									</div>
									<hr>
								</div><!-- .user-messages -->
							</div><!-- .item -->
						@else
							{{-- Public conversation between multiple buyers and one seller --}}
							<div class="item owner">
								@include('templates.profile.sale-item', array(
									'saleItem' => $saleItem,
									'index' => $index
								))
								<div class="user-messages">
									@if ($saleItem->getMultipleConversations()->isEmpty())
										<h4>No New Messages</h4>
									@else
										@foreach ($saleItem->getMultipleConversations() as $conversations)
											<div class="user-message">
												<div class="sender">
													<span class="name">{{ $conversations[0]->sender->name }}</span>
													<span class="total float-right">({{ count($conversations) }})</span>
												</div><!-- .sender -->
												<div class="messages">
													@foreach ($conversations as $message)
														<div class="message">
															@if ($message->sender->id == $user->id)
																<b class="you">You</b>
																{{ Form::open(array('url' => route('profile.messages.message.delete'), 'method' => 'DELETE', 'class' => 'remove-message-form')) }}
																	{{ Form::hidden('message_id', $message->id) }}
																	<button type="submit" class="fas fa-times"></button>
																{{ Form::close() }}
															@else
																<b class="other">{{ $message->sender->name }}</b>
															@endif
															<p>
																{!! nl2br(e($message->message)) !!}
															</p>
														</div><!-- .message -->
													@endforeach
												</div><!-- .messages -->
												<div class="reply">
													{{ Form::open(array('url' => route('profile.messages.message.send'), 'class' => 'form-group')) }}
														<b>Reply</b>
														{{ Form::textarea('message', '', array('class' => 'form-control', 'placeholder' => 'message')) }}
														{{ Form::hidden('saleItem', $saleItem->unique_string) }}
														{{ Form::hidden('to', $conversations[0]->sender->unique_string) }}
														{{ Form::submit('Send', array('class' => 'small blue button float-right my-3')) }}
													{{ Form::close() }}
												</div><!-- .reply -->
											</div><!-- .user-message -->
											<hr>
										@endforeach
									@endif
								</div><!-- .user-messages -->
							</div><!-- .item -->
						@endif
						@php $index++ @endphp
					@endforeach
				</div><!-- .content -->
			</div><!-- .messages.section -->
		</div><!-- .row -->
	</div><!-- .container -->
	@include('modals.report-modal', array('reportReasons' => $reportReasons))
</body>
</html>





