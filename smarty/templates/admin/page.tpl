<!DOCTYPE html>
<html>
<head>
	
	<title>{block 'title'}Website Admin{/block}</title>
	<meta name="author" content="Burton Web Services - http://www.burtonws.co.uk" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style type="text/css" media="all">
		@import url("/css/admin/admin.css");
		@import url("/css/overcast/jquery-ui-1.10.3.custom.min.css");
    </style>
	{block 'css'}{/block}

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="/js/admin/ajax.js"></script>
    <script type="text/javascript" src="/js/admin/message.js"></script>
	<script type="text/javascript" src="/js/admin/hovertip.js"></script>
	{block 'js'}{/block}

</head>

<body>

<div id="wrapper">

	<div id="header"></div>

	{messages url=true}

    <div id="content">

		<div id="left_container">
			{include 'admin/menu.tpl'}
		</div>

        <div id="right_container">
			{block 'content'}{/block}
        </div>

    </div>

	<div id="footer"></div>

</div>
		
</body>
</html>