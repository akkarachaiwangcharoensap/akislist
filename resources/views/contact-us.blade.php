<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/contact-us.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/contact-us.js') }}"></script>

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
	@elseif (empty($errors->all()) == false)
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			@foreach ($errors->all() as $message)
				<p>{{ $message }}</p>
			@endforeach
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 description section">
				<h1>Contact Us</h1>
				<p>
					Thank you for taking your time to reach us out. If you have any questions or concerns regarding our services. Feel free to contact us. We will try our best to answer your questions. In addition, if you believe that your questions will benefit others. Please use our FAQ questionnaire, so that your questions will be beneficial to our community.
				</p>
			</div><!-- .description.section -->
		</div><!-- .row -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 contact section">
				<h1>Form</h1>
				<hr>
				{{ Form::open(array('url' => route('contact-us.send'), 'class' => 'form-group')) }}
					<div class="form-section">
						<label>Reason</label>
						{{ Form::select('contact_reason', $contactReasons, 2, array('class' => 'form-control')) }}
					</div>
					<div class="form-section">
						<label>Email</label>
						{{ Form::email('email', '', array('class' => 'form-control', 'placeholder' => 'youraddress@example.com')) }}
						{{-- <input type="email" name="email" class="form-control" placeholder="youraddress@example.com">	 --}}
					</div><!-- .form-section -->

					<div class="form-section">
						<label>Message</label>
						{{ Form::textarea('message', '', array('class' => 'form-control', 'placeholder' => 'message', 'rows' => '15')) }}
						{{-- <textarea name="message" class="form-control" placeholder="message" rows="15"></textarea>	 --}}
					</div><!-- .form-section -->
						
					{{ Form::submit('Send', array('class' => 'blue button float-right mt-4')) }}
					{{-- <input type="submit" class="button blue float-right mt-4" name="contactSubmit" value="Send"> --}}
				{{ Form::close() }}
			</div><!-- .contact.section -->
		</div><!-- .row -->
	</div><!-- .container -->

	@include('templates.footer')
</body>
</html>





