<!DOCTYPE html>
<html>
<head>
	@include('templates.admin.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/left-navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/users/reported.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/admin/home.js') }}"></script>
</head>
<body>

	@include('templates.admin.navigation')

	@include('templates.admin.left-navigation')

	<div class="container-fluid">
		<div class="col-lg-9 col-md-9 col-sm-9 offset-lg-3 offset-md-3 offset-sm-3 reported-users section">
			
			<h1>Reported Users <small><a href="{{ route('admin.users.reported.details') }}">details</a></small></h1>
			
			<div class="users-list">
				<h4>Users List</h4>
				<table class="table">
					<tr>
						<th>Email</th>
						<th>Name</th>
						<th>Joined</th>
						<th>Reports</th>
						<th>Action</th>
					</tr>
					@foreach ($reports as $report)
						<tr>
							<td>
								{{ $report->receiver->email }}
							</td>
							<td>
								{{ $report->receiver->name }}
							</td>
							<td>
								{{ date('M j, Y', strtotime($report->receiver->created_at)) }}
							</td>
							<td>
								{{ count($report->receiver->reports) }}
							</td>
							<td>
								<a href="{{ route('admin.users.user', 
									array(
										'name' => str_slug($report->receiver->name), 
										'uniqueString' => $report->receiver->unique_string)
									) 
								}}" class="small blue button">
									Investigate
								</a>
							</td>
						</tr>
					@endforeach
				</table><!-- .table -->
			</div><!-- .monthly-statistics -->
		</div>	
	</div>
</body>
</html>





