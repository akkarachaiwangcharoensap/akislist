<!DOCTYPE html>
<html>
<head>
	<title>Welcome to {{ config('app.name') }}.</title>
	<meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
</head>
<body>
	<table class="content">
		<tbody>
			<tr>
				<td>
					<h1 class="title">Welcome To {{ config('app.name') }}</h1>	
				</td>	
			</tr>
			<tr>
				<td>
					<p>
						You register an account with <a href="{{ config('app.url') }}" class="link">akislist.com</a>. Please confirm your registration by clicking the "verify" button below.
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<b>Email:</b> {{ $user->email }}
				</td>
			</tr>
			<tr>
				<td>
					<b>Name:</b> {{ $user->name }}
				</td>
			</tr>
			<tr>
				<td style="text-align: center">
					<a href="{{ $url }}" class="button green link">Verify</a>
				</td>
			</tr>
		</tbody>
	</table>
</body>
<style type="text/css">
	body, td, .title, .content {
		font-family: 'Helvetica', sans-serif;
		color: #4c4c4c;
	}

	.title {
		margin: 0;
		padding-bottom: 18px;
		border-bottom: 2px solid #efefef;

		font-family: 'Helvetica', sans-serif;
	}

	.content {
		width: 100%;

		margin: 0 auto;
		padding: 24px;

		border: 2px solid #efefef;
	}

	.or {
		padding: 0 24px;
	}

	.link {
		color: #5588ff;
		text-decoration: none;
	}

	.button {

		padding: 18px 48px;
		border: 2px solid black;
		border-radius: 6px;

		background: transparent;

		color: #4c4c4c;
		display: inline-block;

		transition: all 0.4s;
	}

	.button:hover {
		cursor: pointer;
		text-decoration: none;
	}

	.button.green {
		color: #2aa140;
		border-color: #2aa140;
	}

	.button.green:hover{
		color: white;
		background: #2aa140;
	}
</style>
</html>



