<div class="container-fluid footer">
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-3 pages">
			<h4>Pages</h4>
			<ul>
				<li>
					<a href="{{ route('home') }}">Home</a>
				</li>
				<li>
					<a href="{{ route('store') }}">Store</a>
				</li>
				<li>
					<a href="{{ route('news') }}">News</a>
				</li>
				<li>
					<a href="{{ route('credits') }}">Credits</a>
				</li>
				<li>
					<a href="{{ route('login') }}">Login</a>
				</li>
				<li>
					<a href="{{ route('register') }}">Register</a>
				</li>
			</ul>
		</div><!-- .pages -->

		<div class="col-lg-3 col-md-3 col-sm-3 follow">
			<h4>Follow</h4>
			<ul>
				<li>
					<a href="#">Facebook</a>
				</li>
				<li>
					<a href="#">Twitter</a>
				</li>
			</ul>
		</div><!-- .follow -->

		<div class="col-lg-3 col-md-3 col-sm-3 legal">
			<h4>Legal</h4>
			<ul>
				<li>
					<a href="{{ route('privacy-policy') }}">Privacy Policy</a>
				</li>
				<li>
					<a href="{{ route('term-of-services') }}">Term of Services</a>
				</li>
			</ul>
		</div><!-- .legal -->

		<div class="col-lg-3 col-md-3 col-sm-3 contact-us">
			<h4>Contact Us</h4>
			<ul>
				<li>
					<a href="{{ route('contact-us') }}">Contact</a>
				</li>
			</ul>
		</div><!-- .contact-us -->

		<div class="col-lg-3 col-md-3 col-sm-3 account">
			<h4>Account</h4>
			<ul>
				<li>
					<a href="{{ route('register') }}">Register</a>
				</li>
				<li>
					<a href="{{ route('login') }}">Login</a>
				</li>
			</ul>
		</div><!-- .contact-us -->
	</div><!-- .row -->
	<div class="row bottom">
		<p>&copy; Copyright {{ date('Y') }} AkisList.com</p>
	</div><!-- .row -->
</div><!-- .footer -->