<!DOCTYPE html>
<html>
<head>
	@include('templates.admin.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/left-navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/users/reported-details.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/admin/home.js') }}"></script>
</head>
<body>

	@include('templates.admin.navigation')

	@include('templates.admin.left-navigation')

	<div class="container-fluid">
		<div class="col-lg-9 col-md-9 col-sm-9 offset-lg-3 offset-md-3 offset-sm-3 reported-users-details section">
			
			<h1>Reported Users (details)</h1>
			
			<div class="users-list">
				<h4>Users</h4>
				@foreach ($reports as $report)
					<div class="user">
						<div class="info">
							<div class="name">
								{{ $report->receiver->name }}
							</div>
							<div class="reason">
								<b>Reason:</b>
								<p>{{ $report->category->name }}</p>
							</div>
							<div class="description">
								<b>Details:</b>
								<p>{{ $report->message }}</p>
							</div>
						</div><!-- .info -->
						<div class="action">
							<a href="{{ route('admin.users.user', 
								array(
									'name' => str_slug($report->receiver->name), 
									'uniqueString' => $report->receiver->unique_string)
								) 
							}}" class="small blue button">Investigate</a>
							
							{{ Form::open(array('url' => '')) }}
								{{ Form::submit('Deactivate', array('class' => 'small red button')) }}
							{{ Form::close() }}

							{{ Form::open(array('url' => '')) }}
								{{ Form::submit('Criminal', array('class' => 'small purple button')) }}
							{{ Form::close() }}
						</div>
					</div>
				@endforeach
			</div><!-- .monthly-statistics -->
		</div>	
	</div>
</body>
</html>





