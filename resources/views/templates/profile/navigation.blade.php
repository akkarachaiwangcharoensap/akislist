<div class="menu section" id="profile-navigation">
	
	<a href="#" id="menu-button-toggler">
		<span class="fas fa-angle-left"></span>
	</a>

	<ul>
		<li>
			<a href="{{ route('profile') }}">Dashboard</a>
		</li>
		<li>
			<a href="{{ route('store') }}">Buy</a>
		</li>
		<li>
			<a href="{{ route('profile.store') }}">Sell</a>
		</li>
		<li>
			<a href="{{ route('profile.messages') }}">Messages {{ '('. Session::get('messages') .')' }}</a>
		</li>
		<li>
			<a href="{{ route('profile.settings') }}">Settings</a>
		</li>
	</ul>
</div><!-- .menu.section -->

<div class="navigation-cover" id="navigation-cover">
	
</div><!-- .navigation-cover -->