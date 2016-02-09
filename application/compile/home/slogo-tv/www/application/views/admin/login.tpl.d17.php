<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><html>
<head>

<title>Log in op het admin systeem van slogo</title>

<style>
#box {
	width: 350px;
	border: solid 1px #EEE;
	border-radius: 5px;
	margin: 200px auto 0 auto;
	box-shadow: 0 0 50px 10px #EEE;
	padding: 20px;
}
h1 {
	text-align: center;
}
.input {
	width: 100%;
	margin: 0;
	border: solid 1px #ccc;
	height: 35px;
	padding: 5px;
	box-sizing: border-box;
}
#top {
	border-top-right-radius: 5px;
	border-top-left-radius: 5px;
}
#bottom {
	border-bottom-right-radius: 5px;
	border-bottom-left-radius: 5px;
}
#login {
	width: 40%;
	display: block;
	margin: 15px auto 0 auto;
	padding: 15px;
	box-sizing: border-box;
	background: #EE9900;
	border: solid 2px #FC9723;
	border-radius: 3px;
	color: #FFF;
}
</style>

</head>



<body>

<div id="box">
<h1>Inloggen</h1>
<?php echo form_open();?>

<?php echo form_input('username', '', 'class="input" id="top" placeholder="Gebruikersnaam..."');?>

<?php echo form_password('password', '', 'class="input" id="bottom" placeholder="Wachtwoord..."');?>

<?php echo form_submit('submit', 'Log in!', 'id="login"');?>

<?php echo form_close();?>

</div>

</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>