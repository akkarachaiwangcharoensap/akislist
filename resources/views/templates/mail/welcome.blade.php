<!DOCTYPE html>
<html>
<head>
	<title>Welcome To {{ config('app.name') }}</title>
	<meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
</head>
<body>
	<table class="content">
		<tbody>
			<tr>
				<td>
					<h1 class="title">Welcome, {{ $user->name }}</h1>	
				</td>	
			</tr>
			<tr>
				<td>
					<p>
						You have successfully confirmed your account with <a href="{{ config('app.url') }}" class="link">Akislist.com</a>. We welcome you to our community.
						Please read our term of services and privacy policy carefully. We hope you enjoy your stay and the benefit of our service.
						If you have any question regarding our services. Please feel free to contact us.
					</p>
				</td>
			</tr>
			<tr>
				<td>Regards,</td>
			</tr>
			<tr>
				<td>AkisList.com</td>
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

	.link {
		color: #5588ff;
		text-decoration: none;
	}
</style>
</html>



