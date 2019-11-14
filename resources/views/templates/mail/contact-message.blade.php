<!DOCTYPE html>
<html>
<head>
	<title>{{ $contact->reason->name }}</title>
	<meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
</head>
<body>
	<table class="content">
		<tbody>
			<tr>
				<td>
					<h1 class="title">{{ $contact->reason->name }}</h1>	
				</td>	
			</tr>
			<tr>
				<td>
					<p>
						{!! nl2br($contact->message) !!}
					</p>
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
</style>
</html>



