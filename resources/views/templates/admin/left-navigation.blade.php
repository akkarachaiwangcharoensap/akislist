@php
	use App\Page;
@endphp

<div class="col-lg-3 col-md-3 col-sm-3 menu section active" id="admin-navigation">
	
	<a href="#" id="menu-navigation-toggler" class="active">
		<span class="fas fa-angle-left"></span>
	</a>

	<ul>
		<li class="main-list">
			<a href="{{ route('admin') }}" class="head">Dashboard</a>
		</li>
		<li class="main-list">
			<a href="{{ route('admin.pages') }}" class="head">
				Pages
			</a>
			<ul>
				<li>
					<a href="{{ route('admin.news') }}">News</a>
				</li>
				<li>
					<a href="{{ route('admin.pages.page', array('id' => Page::PRIVACY_POLICY)) }}">Privacy Policy</a>
				</li>
				<li>
					<a href="{{ route('admin.pages.page', array('id' => Page::TERM_OF_SERVICES)) }}">Term of Services</a>
				</li>
				<li>
					<a href="{{ route('admin.pages.page', array('id' => Page::CREDITS)) }}">Credits</a>
				</li>
			</ul>
		</li>
		<li class="main-list">
			<span class="head">Users</span>
			<ul>
				<li>
					<a href="{{ route('admin.users.reported') }}">Reported</a>
				</li>
			</ul>
		</li>
		<li class="main-list">
			<span class="head">Store</span>
			<ul>
				<li>
					<a href="{{ route('admin.store.reported') }}">Reported</a>
				</li>
			</ul>
		</li>
	</ul>
</div><!-- .menu.section -->