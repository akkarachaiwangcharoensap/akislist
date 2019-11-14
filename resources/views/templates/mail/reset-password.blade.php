<!DOCTYPE html>
<html>
<head>
	<title>Reset Password Request</title>
	<meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
</head>
<body>
	<table class="content">
		<tbody>
			<tr>
				<td>
					<h1 class="title">Reset Password</h1>	
				</td>	
			</tr>
			<tr>
				<td>
					<p>
						A password reset has been requested. Click the renew button to change your password.
					</p>
				</td>
			</tr>
			<tr>
				<td class="renew">
					<a href="{{ route('password.reset', array('token' => $token)) }}" class="button blue link">Renew</a>
				</td>
			</tr>
			<tr>
				<td>
					<p class="note">If you did not make the request, please ignore this email. However, if this keeps happening. Please contact us and let us know.</p>
				</td>
			</tr>
		</tbody>
	</table>
</body>
<style type="text/css">
	body, td, .title, .content {
		font-family: 'Helvetica', sans-serif;
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

	.note {
		color: #ff6868;
	}

	.renew {
		text-align: center;
	}

	.button {

		padding: 12px 36px;
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

	.button.blue {
		color: #5588ff;
		border-color: #5588ff;
	}

	.button.blue:hover{
		color: white;
		background: #5588ff;
	}
</style>
</html>



