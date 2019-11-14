<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name') }}</title>

	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/left-navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/sale-item-thumbnail.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/sale-item-gallery.css') }}">
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/users/user.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/admin/user.js') }}"></script>
</head>
<body>

	@include('templates.admin.navigation')

	@if (Session::has('success'))
		<div class="alert alert-primary alert-dismissible fade show" role="alert">
			<p>{{ Session::get('success') }}</p>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	@include('templates.admin.left-navigation')

	@php
		$isCriminal = (empty($user->criminal) == false);
		$isBanned = !$user->active;
	@endphp
	<div class="container-fluid">
		<div class="col-lg-9 col-md-9 col-sm-9 offset-lg-3 offset-md-3 offset-sm-3 user section">
			<h1>User: <small>{{ $user->email }}</small></h1>
			<small class="status">[{{ (!$isBanned) ? 'active' : 'banned' }}]</small>
			@if (empty($isCriminal) == false)
				<small class="criminal">[Criminal]</small>
			@endif
			<div class="action">
				@if (!$isCriminal)
					{{ Form::open(array('url' => route('admin.users.user.criminalize', array(
							'name' => str_slug($user->name),
							'uniqueString' => $user->unique_string
						)))) 
					}}
						{{ Form::submit('Criminal', array('class' => 'purple button float-right ml-2')) }}
					{{ Form::close() }}
				@endif

				@if (!$isBanned)
					{{ 
						Form::open(array('url' => route('admin.users.user.deactivate', array(
								'name' => str_slug($user->name),
								'uniqueString' => $user->unique_string
							)
						))) 
					}}
						{{ Form::submit('Deactivate', array('class' => 'red button float-right')) }}
					{{ Form::close() }}
				@endif
			</div>
		</div><!-- .user -->
		<div class="col-lg-9 col-md-9 col-sm-9 offset-lg-3 offset-md-3 offset-sm-3 messages section" id="message-board">
			<div class="content">
				<h4>Messages</h4>
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
										<span class="total float-right">({{ count($saleItem->getPrivateConversationOf($user)) }})</span>
									</div><!-- .sender -->
									<div class="messages">
										@foreach ($saleItem->getPrivateConversationOf($user) as $message)
											<div class="message">
												@if ($message->sender->id == $user->id)
													<b class="you">{{ $message->sender->name }}</b>
												@else
													<b class="other">{{ $message->sender->name }}</b>
												@endif
												<p>
													{!! nl2br(e($message->message)) !!}			
												</p>
											</div><!-- .message -->
										@endforeach
									</div><!-- .messages -->
								</div>
								<hr>
							</div><!-- .user-messages -->
						</div><!-- .item -->
					@else
						{{-- Public conversation between multiple buyers and one seller --}}
						<div class="item owner">
							@include('templates.store.sale-item', array(
								'saleItem' => $saleItem,
								'index' => $index
							))


							<div class="user-messages">
								@if ($saleItem->messages->isEmpty())
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
															<b class="you">{{ $message->sender->name }}</b>
														@else
															<b class="other">{{ $message->sender->name }}</b>
														@endif
														<p>
															{!! nl2br(e($message->message)) !!}
														</p>
													</div><!-- .message -->
												@endforeach
											</div><!-- .messages -->
										</div><!-- .user-message -->
										<hr>
									@endforeach
								@endif
							</div><!-- .user-messages -->
						</div><!-- .item -->
					@endif
				@endforeach
			</div><!-- .content -->
		</div><!-- .messages -->

		<div class="col-lg-9 col-md-9 col-sm-9 offset-lg-3 offset-md-3 offset-sm-3 sale-items section">
			<div class="content">
				<h4>Sale Items</h4>
				@php
					$index = 0;
				@endphp
				<div class="row sale-items">
					@php $index = 0; @endphp
					@foreach ($user->saleItems as $saleItem)
						<div class="col-lg-6 col-md-6 col-sm-6">
							@include('templates.store.sale-item', array(
								'saleItem' => $saleItem,
								'index' => $index,
							))
						</div>
						@php $index++; @endphp
					@endforeach
				</div><!-- .sale-items -->
			</div><!-- .content -->
		</div><!-- .sale-items -->
	</div>
</body>
</html>





