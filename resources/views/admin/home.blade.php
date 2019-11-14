<!DOCTYPE html>
<html>
<head>
	@include('templates.admin.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/left-navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/home.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/admin/home.js') }}"></script>
</head>
<body>

	@include('templates.admin.navigation')

	@include('templates.admin.left-navigation')

	<div class="container-fluid">
		<div class="col-lg-9 col-md-9 col-sm-9 offset-lg-3 offset-md-3 offset-sm-3 dashboard section">
			<h1>Admin Dashboard</h1>

			<div class="monthly-statistics">
				<h4>Statistics (Monthly)</h4>
				<table class="table">
					<tr>
						<th></th>
						<th>Last Month</th>
						<th>This Month</th>
						<th>Growth</th>
					</tr>
					<tr>
						<td>
							Total New Users
						</td>
						<td>
							{{ count($monthly['previous']['users']) }}
						</td>
						<td>
							{{ count($monthly['current']['users']) }}
						</td>
						<td>
							{!! ($growth['users'] >= 0) ? '<span class="positive">'.'+ '.$growth['users'].'</span>' : '<span class="negative">'.'- '.$growth['users'].'</span>' !!}
						</td>
					</tr>
					<tr>
						<td>
							Total New Store Sale Items
						</td>
						<td>
							{{ count($monthly['previous']['saleItems']) }}
						</td>
						<td>
							{{ count($monthly['current']['saleItems']) }}
						</td>
						<td>
							{!! ($growth['saleItems'] >= 0) ? '<span class="positive">'.'+ '.$growth['saleItems'].'</span>' : '<span class="negative">'.'- '.$growth['saleItems'].'</span>' !!}
						</td>
					</tr>
					<tr>
						<td>
							Total Store Sale Items Deleted
						</td>
						<td>
							{{ count($monthly['previous']['saleItemsDeleted']) }}
						</td>
						<td>
							{{ count($monthly['current']['saleItemsDeleted']) }}
						</td>
						<td>
							{!! ($growth['saleItemsDeleted'] >= 0) ? '<span class="positive">'.'+ '.$growth['saleItemsDeleted'].'</span>' : '<span class="negative">'.'- '.$growth['saleItemsDeleted'].'</span>' !!}
						</td>
					</tr>
					<tr>
						<td>
							Total Store Sale Items Reported
						</td>
						<td>
							{{ count($monthly['previous']['saleItemReports']) }}
						</td>
						<td>
							{{ count($monthly['current']['saleItemReports']) }}
						</td>
						<td>
							{!! ($growth['saleItemReports'] >= 0) ? '<span class="positive">'.'+ '.$growth['saleItemReports'].'</span>' : '<span class="negative">'.'- '.$growth['saleItemReports'].'</span>' !!}
						</td>
					</tr>
					<tr>
						<td>
							Total Users Reported
						</td>
						<td>
							{{ count($monthly['previous']['userReports']) }}
						</td>
						<td>
							{{ count($monthly['current']['userReports']) }}
						</td>
						<td>
							{!! ($growth['userReports'] >= 0) ? '<span class="positive">'.'+ '.$growth['userReports'].'</span>' : '<span class="negative">'.'- '.$growth['userReports'].'</span>' !!}
						</td>
					</tr>
					<tr>
						<td>
							Total Deals Made
						</td>
						<td>
							{{ count($monthly['previous']['totalDealsMade']) }}
						</td>
						<td>
							{{ count($monthly['current']['totalDealsMade']) }}
						</td>
						<td>
							{!! ($growth['totalDealsMade'] >= 0) ? '<span class="positive">'.'+ '.$growth['totalDealsMade'].'</span>' : '<span class="negative">'.'- '.$growth['totalDealsMade'].'</span>' !!}
						</td>
					</tr>
				</table>
			</div><!-- .monthly-statistics -->

			<div class="daily-statistics">
				<table class="table">
					<h4>Statistics (Daily)</h4>
					<tr>
						<td>Total New User</td>
						<td>
							<span class="positive">
								+ {{ count($daily['users']) }}
							</span><!-- .positive -->
						</td>
					</tr>
					<tr>
						<td>Total New Store Sale Items</td>
						<td>
							<span class="positive">
								+ {{ count($daily['saleItems']) }}
							</span><!-- .positive -->
						</td>
					</tr>
					<tr>
						<td>Total New Store Sale Items Delete</td>
						<td>
							<span class="positive">
								+ {{ count($daily['saleItemsDeleted']) }}
							</span><!-- .positive -->
						</td>
					</tr>
					<tr>
						<td>Total New Store Sale Items Reported</td>
						<td>
							<span class="positive">
								+ {{ count($daily['saleItemReports']) }}
							</span><!-- .positive -->
						</td>
					</tr>
					<tr>
						<td>Total New Users Reported</td>
						<td>
							<span class="positive">
								+ {{ count($daily['userReports']) }}
							</span><!-- .positive -->
						</td>
					</tr>
					<tr>
						<td>Total New Deals Made</td>
						<td>
							<span class="positive">
								+ {{ count($daily['totalDealsMade']) }}
							</span><!-- .positive -->
						</td>
					</tr>
				</table>
			</div><!-- .daily-statistics -->
		</div>	
	</div>
</body>
</html>





