﻿<!DOCTYPE html>
<html>

<?php
include("createTables.php");
?>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Messages</title>
<link rel=StyleSheet href="desktop.css" type="text/css" media=screen />
</head>

<body>
	<img class="logo" src="logo_1.png" alt="logo" />
	<div class="banner">
		Welcome User
		<!-- This will be top right -->
		<a class="ban" href="myAccount.html">My Account</a>
		<a class="ban" href="logOut.html">Logout</a>
	</div>
	<nav class="navbar">
		<!-- Links for admin, requests, Queue, etc. -->
		<a class="navbar" href="homeWriter.html" >Home</a>
	</nav>
	<p>This is where the user will be able to read, delete, and send messages to differnet users.</p>
	<?php
		createWriter();
	?>
</body>

</html>
