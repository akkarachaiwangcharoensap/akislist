<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name') }}</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/message.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/modals/report-modal.css') }}">

	<script type="text/javascript" src="{{ asset('js/profile/message.js') }}"></script>

	@include('templates.google.google-analytics')
</head>
<body>
	@include('templates.navigation')

	@if (Session::has('success'))
		<div class="alert alert-primary alert-dismissible fade show" role="alert">
			<p>{{ Session::get('success') }}</p>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
	<div class="container-fluid">
		<div class="row">

			@include('templates.profile.navigation')

			<div class="col-lg-9 col-md-9 col-sm-9 offset-lg-3 offset-md-3 offset-sm-3 messages section">
				<h1>Messages From {{ $to->name }}</h1>
				<div class="content">
					<div class="message-board">
						@foreach ($conversation as $message)
							@if ($message->active)
								<div class="message">
									<div class="author">
										<b>{{ $message->user->name }}</b>
									</div><!-- .author -->
									<div class="description">
										<p>{{ $message->message }}</p>
									</div><!-- .description -->

									@php
										$date = date('F j, Y', strtotime($message->created_at));
									@endphp
									<div class="date">
										<p>{{ $date }}</p>
									</div><!-- .date -->

									@if ($message->user->id == Auth::user()->id)
										{{ Form::open(array('url' => route('profile.messages.message.delete'), 'method' => 'DELETE', 'class' => 'delete-form')) }}
											<button type="submit">
												<span class="fas fa-times"></span>
											</button>
											{{ Form::hidden('message_id', $message->id) }}
										{{ Form::close() }}
									@endif
								</div><!-- .message -->
							@endif
						@endforeach
					</div><!-- .message-board -->
					<div class="reply">
						<h4>Reply</h4>
						{{ Form::open(array('url' => route('profile.messages.message.send'), 'class' => 'form-group')) }}
							{{ Form::textarea('message', '', array('class' => 'form-control', 'placeholder' => 'message')) }}
							<a href="#" class="small button red float-left report my-3">Report</a>
							{{ Form::hidden('to', $to->unique_string) }}
							{{ Form::submit('Send', array('class' => 'small button green float-right my-3')) }}
						{{ Form::close() }}
					</div><!-- reply-->
				</div><!-- .content -->
			</div><!-- .messages.section -->
		</div><!-- .row -->
	</div><!-- .container -->
	@include('modals.report-modal', array('reportReasons' => $reportReasons, 'action' => route('profile.report', array('uniqueString' => $to->unique_string))))
</body>
</html>





