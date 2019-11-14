<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/privacy-policy.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/privacy-policy.js') }}"></script>

	@include('templates.google.google-analytics')
</head>
<body>

	@include('templates.navigation')

	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 description section">
				<h1>{{ $page->title }}</h1>
				{!! clean($page->content) !!}
				<span class="date float-right mt-4">
					Edited: {{ date('F j, Y', strtotime($page->updated_at)) }}
				</span>
			</div>
{{-- 			<div class="col-lg-12 col-md-12 col-sm-12 description section">
				<h1>Privacy Policy</h1>
				<hr>
				<h3>
					What information do we collect?
				</h3>
				<p>
					We collect your information such as your browser, your ip address, and others. 
				</p>
				<h3>
					Why are you collecting my information?
				</h3>
				<p>
					We collect your information only to improve our service. We DO NOT collect your information to sell it to the advertisers or anyone else. Your information help us grow and become a better service for everyone.
				</p>
				<h3>
					What do you use my information for?
				</h3>
				<p>
					Again, we collect your information only to help us improve our service. As the service grows, we want to be able to have a guideline of how can we improve our service by looking at our analytic data. To be more specifically, we use Google Analytics to monitor the usage of our service. If you have any question regarding the Google's privacy policy. Please visit their <a href="https://privacy.google.com/">privacy policy</a> page for more information.
				</p>
				<h3>
					Do you use web cookies?
				</h3>
				<p>Currently, we do not use any cookies. However, in near future, it is possible for us to implement the functionality to improve our service. By then, we will update the time of this page.</p>
				<h3>
					Do you guys sell my information?
				</h3>
				<p>
					Again, no, we DO NOT sell any data to any advertisers or anyone. In fact, we strongly believe that the practice is very unethical. If you have any questions or concerns regarding this issues. Please send us a message, and we will try to clarify it further.
				</p>
				<h3>
					Your Consent
				</h3>
				<p>
					By using our service, you should be aware of our privacy policy and term of services. Furthermore, you agree to our privacy policy and term of services. If you do not agree with our privacy policy or term of services. Please do not use our service. If you have any further question. Please feel free to contact us. We will try our best to answer your question.
				</p>
				<h3>
					Privacy Policy and Term of Services Adjustment
				</h3>
				<p>
					In the future, if we were to adjust our privacy policy or term of services. We will update the date of this page. In addition, if you were to have an account in our service. We will send you an email to notify the changes.
				</p>
				<span class="date float-right mt-4">
					Edited: September 1, 2018
				</span>
			</div><!-- .description.section --> --}}
		</div><!-- .row -->
	</div><!-- .container -->

	@include('templates.footer')
</body>
</html>





