<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/getting-started.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">

	<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>

	@include('templates.google.google-analytics')
</head>
<body>

	@include('templates.navigation')

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 header section">
				<div class="content">
					<h1>
						Getting Started
					</h1>
				</div><!-- .content -->
			</div><!-- .header.section -->
		</div><!-- .row -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 getting-started section">
				<div class="content">
					<div class="buyer">
						<div class="workflow">
							<h2>Buyer</h2>

							<div class="slot">
								<div class="header">
									<h4>Search A Product</h4>
								</div><!-- .header -->
								
								<div class="description">
									<p>
										Go to the <a href="{{ route('store') }}">store</a> and search the product you are looking to buy.
									</p>
								</div><!-- .description -->

								<div class="next-arrow"></div>
							</div><!-- .slot -->

							<div class="slot">
								<div class="header">
									<h4>Contact The Seller</h4>
								</div><!-- .header -->

								<div class="description">
									<p>
										Contact the seller once you have made your decision to buy the product
									</p>
									<p class="recommendation">
										(We recommend you that you use our communication panel to communicate with the seller. This will increase the trust between you and the seller.)
									</p>
								</div><!-- .description -->

								<div class="next-arrow"></div>
							</div><!-- .slot -->

							<div class="slot">
								<div class="header">
									<h4>Meet And Purchase</h4>
								</div><!-- .header -->

								<div class="description">
									<p>
										Once the negotiation has been made. Meet locally and purchase the product using cash.
									</p>
									<p class="recommendation">
										(For your own safety, please notify your family members, friends, or anyone that you know to let them know of where you are going. It is better if you don't go alone. If possible, meet in a public area where there are other people around. If you have any feeling of threats from the seller. Please calmly stay away from the individual and report the seller. In the worst case, please call your local law enforcement to ensure your own safety)
									</p>
								</div><!-- .description -->
							</div><!-- .slot -->
							<a href="{{ route('register') }}" class="button green float-right my-4">
								Join Now
							</a>
						</div><!-- .workflow -->
					</div><!-- .buyer -->

					<div class="seller">
						<div class="workflow">
							<h2>Seller</h2>

							<div class="slot">
								<div class="header">
									<h4>Sell An Item</h4>
								</div><!-- .header -->
								
								<div class="description">
									<p>
										Sign in onto your account, navigate to "My Store". Start selling your legitimate items
									</p>
								</div><!-- .description -->

								<div class="next-arrow"></div>
							</div><!-- .slot -->

							<div class="slot">
								<div class="header">
									<h4>Wait For it</h4>
								</div><!-- .header -->

								<div class="description">
									<p>
										Once you have posted your product. It will take sometime for it to be shown up on the store.
									</p>
									<p class="recommendation">
										(Usually, it should take approximately maximum of 15 minutes for your items to show up on the main store page.)
									</p>
								</div><!-- .description -->

								<div class="next-arrow"></div>
							</div><!-- .slot -->

							<div class="slot">
								<div class="header">
									<h4>Meet And Sell</h4>
								</div><!-- .header -->

								<div class="description">
									<p>
										Meet locally and sell your legitimate items.
									</p>
									<p class="recommendation">
										(For your own safety, please notify your family members, friends, or anyone that you know to let them know of where you are going. It is better if you don't go alone. If possible, meet in a public area where there are other people around. If you have any feeling of threats from the buyer. Please calmly stay away from the individual and report the buyer. In the worst case, please call your local law enforcement to ensure your own safety)
									</p>
								</div><!-- .description -->
							</div><!-- .slot -->
	
							<a href="{{ route('register') }}" class="button green float-right my-4">
								Join Now
							</a>
						</div><!-- .workflow -->
					</div><!-- .seller -->
				</div><!-- .content -->
			</div><!-- .about.section -->
		</div><!-- .row -->
	</div>

	@include('templates.footer')
</body>
</html>





