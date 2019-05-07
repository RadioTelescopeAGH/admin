<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Admin</title>
</head>
<body>

<div id="container">
	<form action="account/login" method="post">
		Login:
		<input type="text" name="login">
		Password:
		<input type="text" name="password">
		<button>Log in</button>
	</form>
</div>
</body>
</html>