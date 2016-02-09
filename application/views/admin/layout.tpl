<html>
<head>
	<title>{block "title"}Adminsysteem{/block} - RTV Slogo</title>

	<link rel="icon" type="imge/png" href="{site_url()}resources/icon.png">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=RobotoDraft:400,500,700,400italic" rel="stylesheet" type="text/css">
	<link href="{site_url()}resources/admin_style.css" rel="stylesheet" type="text/css">
	{block "header"}{/block}
</head>
<body>

<div id="left-nav">
	<ul class="nav-list">
		<a href="{site_url()}admin/dashboard"><li>Dashboard</li></a>
		<a href="{site_url()}admin/programmering"><li>Programmering</li></a>
		<a href="{site_url()}admin/teksttv"><li>Tekst TV</li></a>
		<a href="{site_url()}admin/music"><li>Muziek</li></a>
		<a href="{site_url()}admin/templates"><li>Templates</li></a>
		<a href="{site_url()}admin/sources"><li>Sources</li></a>
		<a href="{site_url()}admin/ads"><li>Reclames</li></a>
		{* <br>
		<a href="{site_url()}admin/scheduling"><li>Scheduling</li></a>
		<a href="{site_url()}admin/programmes"><li>Programmes</li></a> *}
	</ul>
</div>
<div id="top-bar">
	<div id="top-bar-left-nav">
		<span class="image"></span>
	</div>
	<a href="{site_url()}logout"><div id="logout">
		Log uit
	</div></a>
</div>

<div id="content">
{block "content"}{/block}
</div>

</body>
</html>