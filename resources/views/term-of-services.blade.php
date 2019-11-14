<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/term-of-services.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/term-of-services.js') }}"></script>

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
			{{-- <div class="col-lg-12 col-md-12 col-sm-12 description section">
				<h1>Term Of Services</h1>
				<hr>
				<h3>
					Definition
				</h3>
				<table class="table">
					<thead>
						<tr>
							<th>Term</th>
							<th>Definition</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>We</td>
							<td>means us, our service (akislist.com)</td>
						</tr>
						<tr>
							<td>Items <small>(Used Items)</small></td>
							<td>means used stuff, it could be books, furnitures, computers, cars, and/or anything that you bought. No drugs, weapons, R18+, or anything illegal in your country or your provice/state.</td>
						</tr>
					</tbody>
				</table>
				<h3 class="success">
					Do's
				</h3>
				<p>
					<ul>
						<li>
							<span class="success">Do</span> use our service to help your life easiler to buy or sell used items safely.
						</li>
						<li>
							<span class="success">Do</span> use our service as a way to get rid of used items. Please be sure that the items you are selling should be working properly. If not, you are liable for a fraud, scam, and/or crime. Do not sell any half broken used items that concern someone else safety.
						</li>
						<li>
							<span class="success">Do</span> use our service to give away your used items for charity or donation.
						</li>
						<li>
							<span class="success">Do</span> be caution when using our service. We try our best to make sure that you have the safest experience when you are using our service. When you are buying or selling your used items to strangers. Please have a family member or friends to come with you. Also, if possible, please do meet up in a public place where there are people around. If you feel any threats from buyer/seller. Please contact your local law enforcement as soon as possible to ensure your safety.
						</li>
						<li>
							<span class="success">Do</span> be aware of the items you are buying, please be sure that you have talked to the seller and have the confident to say that it is working. Please do a bit of research of the product before making the purchase.
						</li>
						<li>
							<span class="success">Do</span> use our service in a good faith.
						</li>
					</ul>
				</p>
				<h3 class="warning">Don'ts</h3>
				<p>
					<ul>
						<li>
							<span class="warning">Do not</span> use our service to cheat, scam, lie to anyone. By doing so, you are liable for criminal crimes.
						</li>
						<li>
							<span class="warning">Do not</span> use our service to sell and/or promote illegal, illegitimate, pornography, and/or anything that is considered adult or R18+. To learn more, please visit your local government to learn more on what is considered as R18+ and illegal. Also, if you live in the US. You are not allowed to sell your guns to anyone.
						</li>
						<li>
							<span class="warning">Do not</span> use our service to promote pornography, terrorism, and/or hate speech. By doing so, we have the right to ban your account and lock you out of our service. We do not tolerate these actions. We also have the right to call for counter-terrorism agency for any action you take regarding terrorism. We do take a strong action on this matter.
						</li>
						<li>
							<span class="warning">Do not</span> use our service to sell half broken items, such items can be very dangerous. For an example, a UPS (uninterrupted power supply), computer power supplies, or any electronics that have high voltage capacity. Please take the responsibility and dispose those items.
						</li>
						<li>
							<span class="warning">Do not</span> attempt to exploit our system by hacking, botting, ddosing, or anything that could interrupt our service. If found by doing so, we have the right to track you, block you from our service and you will be liable to cyber crime charges. If you have found any vulnerability in our system. We recommend you to <a href="{{ route('contact') }}">contact us</a> and help us resolve the issue.
						</li>
						<li>
							<span class="warning">Do not</span> use our service to do any ill to anyone, either it is physically or psychologically harm. We do not tolerate any of these actions.
						</li>
						<li>
							<span class="warning">Do not</span> use our service in a bad faith.
						</li>
					</ul>
				</p>

				<h3>Our Rights</h3>
				<p>
					We have the rights:
					<ul>
						<li>
							To report any cyber crimes, or crimes to the authority.
						</li>
						<li>
							To ban / lock you out of service due to the violation of our service
						</li>
						<li>
							To investigate your communication / messaging on our service, only when you were reported by other users. We do take extensive care and serious about your privacy. However, if you are doing harm to someone else. You do not have the privilege.
						</li>
						<li>
							To monitor your activity, if your activity becomes suspicious. Usually when you violate our term of services or exploits our system.
						</li>
					</ul>
				</p>

				<p>
					We hope that you will use our service in a professional manner. Please be polite when negotiating with the seller/buyer, and stay safe once the negotiation has been made. If you have any question, please feel free to <a href="{{ route('contact') }}">contact us</a>. If your safety is in concern, please call your local law enforcement as soon as possible.
				</p>

				<p class="warning">
					If you do not agree with our term of services. Do not use our services or, else, you may be liable for criminal crime, and many others as what we mention in the "Don'ts" section.
				</p>


				<span class="date float-right mt-4">
					Edited: September 1, 2018
				</span>
			</div><!-- .description.section --> --}}
		</div><!-- .row -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 report section">
				<h1>Report Criminal Crimes</h1>
				<hr>
				
				<h3>Canada</h3>
				<p>
					<ul>
						<li>
							<a href="https://www.publicsafety.gc.ca/cnt/ntnl-scrt/cbr-scrt/rprt-en.aspx">Cyber Security Incidents</a>
						</li>
						<li>
							<a href="https://www.canada.ca/en/services/defence/nationalsecurity/counterterrorism.html">Counter Terrorism</a>
						</li>
						<li>
							Call 9-1-1 or local law enforcement for any threats you feel from buyer/seller to ensure your own safety.
						</li>
					</ul>
				</p>

				<h3>USA (United States Of America)</h3>
				<p>
					<ul>
						<li>
							<a href="https://www.ic3.gov/default.aspx">Cyber Security Incidents</a>
						</li>
						<li>
							<a href="https://www.fbi.gov/contact-us">Counter Terrorism / FBI</a>
						</li>
						<li>
							Call 9-1-1 or local law enforcement for any threats you feel from buyer/seller to ensure your own safety.
						</li>
					</ul>
				</p>

				<h3>Europe</h3>
				<p>
					<ul>
						<li>
							<a href="https://www.europol.europa.eu/report-a-crime/report-cybercrime-online">Report Cyber Crimes</a>
						</li>
						<li>
							<a href="https://ec.europa.eu/anti-fraud/contacts/fraud-reporting-form_en">Report Frauds</a>
						</li>
						<li>
							Call 1-1-2 or local law enforcement for any threats you feel from the buyer/seller to ensure your own safety.
						</li>
					</ul>
				</p>

				<h3>Others</h3>
				<p>
					For any country outside of these listed counties, please do researches on how to prevent/avoid these crimes by visiting your local government websites. Be sure you are aware your emergency services, do not use our service if you are not confident enough to protect yourself.
				</p>
			</div><!-- .description.section -->
		</div><!-- .row -->
	</div><!-- .container -->

	@include('templates.footer')
</body>
</html>





