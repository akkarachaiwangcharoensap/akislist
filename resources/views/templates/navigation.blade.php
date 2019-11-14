@php
	$user = Auth::user();
@endphp
<nav class="navbar navbar-expand-lg navbar-light sticky-top main-navigation">
	<a href="{{ route('home') }}" class="navbar-brand brand">{{ config('app.name') }}<small class="version">(beta)</small></a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse-items" aria-controls="collapse-items" aria-expanded="false" aria-label="Collapse Items Toggler">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="collapse navbar-collapse" id="collapse-items">
		<ul class="navbar-nav ml-auto items">
			@if ($user == false)
				<li class="nav-item ml-auto">
					<a href="{{ route('login') }}" class="nav-link">Login</a>
				</li>
			@else
				<li class="dropdown ml-auto">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						{{ $user->name }}
					</button>
					<div class="dropdown-menu ml-auto" aria-labelledby="dropdownMenuButton">
						<a href="{{ route('profile') }}" class="dropdown-item">Dashboard</a>
						<a href="{{ route('profile.store') }}" class="dropdown-item">My Store</a>
						<a href="{{ route('profile.messages') }}" class="dropdown-item">Messages {{ '('. Session::get('messages') .')' }}</a>
						<form method="POST" action="{{ route('logout') }}">
							@csrf
							<input class="dropdown-item" type="submit" name="logoutSubmit" value="Logut">
						</form>
					</div>
				</li>
			@endif
		</ul>
	</div>
</nav><!-- .navbar -->