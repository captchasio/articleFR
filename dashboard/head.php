<?php
$_head = apply_filters('admin_header', '
<head>
<meta charset="ISO-8859-1">
<title>ArticleFR - Dashboard</title>
<meta content=\'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\' name=\'viewport\'>

<link rel="shortcut icon" href="http://freereprintables.com/sandbox/dashboard/favicon.ico" />
		
<!-- bootstrap 3.0.2 -->
<link href="' . BASE_URL. 'dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="' . BASE_URL. 'dashboard/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="' . BASE_URL. 'dashboard/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="' . BASE_URL. 'dashboard/css/morris/morris.css" rel="stylesheet" type="text/css" />
<!-- jvectormap -->
<link href="' . BASE_URL. 'dashboard/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
	type="text/css" />
<!-- fullCalendar -->
<link href="' . BASE_URL. 'dashboard/css/fullcalendar/fullcalendar.css" rel="stylesheet"
	type="text/css" />
<!-- Daterange picker -->
<link href="' . BASE_URL. 'dashboard/css/daterangepicker/daterangepicker-bs3.css"
	rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="' . BASE_URL. 'dashboard/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"
	rel="stylesheet" type="text/css" />
<link href="//cdn.datatables.net/1.10.0/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />		
<!-- Theme style -->		
<link href="' . BASE_URL. 'dashboard/css/iCheck/minimal/blue.css" rel="stylesheet" type="text/css" />
<link href="' . BASE_URL. 'dashboard/css/iCheck/all.css" rel="stylesheet" type="text/css" />		
<link href="' . BASE_URL. 'dashboard/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
		
<link href="' . BASE_URL. 'dashboard/css/bootstrap-tagsinput.css" rel="stylesheet prefetch" />
				
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>		
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="' . BASE_URL. 'dashboard/js/ipmapper.min.js"></script>		
		
<script type="text/javascript" src="' . BASE_URL. 'dashboard/js/parsley.js"></script>

<link href="' . BASE_URL. 'dashboard/js/markdown/pagedown/highlightjs.css" rel="stylesheet" type="text/css" />	
		
<script type="text/javascript" src="' . BASE_URL. 'dashboard/js/markdown/pagedown/highlight.min.js"></script>

<script src="' . BASE_URL. 'dashboard/js/bootstrap-tagsinput.min.js"></script>
		
<script type="text/javascript">
	$(function(){
		$(\'.wmd-input\').keypress(function(){
			window.clearTimeout(hljs.Timeout);
			hljs.Timeout = window.setTimeout(function() {
				hljs.initHighlighting.called = false;
				hljs.initHighlighting();
			}, 500);
		});
		window.setTimeout(function() {
			hljs.initHighlighting.called = false;
			hljs.initHighlighting();
		}, 500);
	});			
</script>
<script type="text/javascript">
	jQuery(function ($) {
		$("#articles").dataTable();
		$("#plugins").dataTable();	
		$("#plugins_ii").dataTable();	
		$("#pending").dataTable();	
		$("#offline").dataTable();	
		$("#exports").dataTable();
		$("#all").dataTable();
		$("#inbox").dataTable({ "order": [[ 1, "desc" ]]});
		
		$.fn.editable.defaults.mode = "inline";
		$.fn.editable.defaults.showbuttons = false;
		$(".edit").editable();		
		$("a").tooltip();				
	});		
</script>
<script type="text/javascript">	
	$(function(){
		try{
			IPMapper.initializeMap("map");
			var ipArray = [' . get_online_ips() . '];
			IPMapper.addIPArray(ipArray);
		} catch(e){
			//handle error
		}
	});
</script>
<script type="text/javascript">			
	jQuery(function ($) {							
		$("#check-all").on("ifUnchecked", function(event) {
			$("input[type=\"checkbox\"]", ".table-mailbox").iCheck("uncheck");
		});
		
		$("#check-all").on("ifChecked", function(event) {
			$("input[type=\"checkbox\"]", ".table-mailbox").iCheck("check");
		});	
		
		$("#checkall").on("ifUnchecked", function(event) {
			$("input[type=\"checkbox\"]", ".checkall").iCheck("uncheck");
		});
		
		$("#checkall").on("ifChecked", function(event) {
			$("input[type=\"checkbox\"]", ".checkall").iCheck("check");
		});
				
		$(".fa-star, .fa-star-o, .glyphicon-star, .glyphicon-star-empty").click(function(e) {
			e.preventDefault();
			var glyph = $(this).hasClass("glyphicon");
			var fa = $(this).hasClass("fa");
		
			if (glyph) {
				$(this).toggleClass("glyphicon-star");
				$(this).toggleClass("glyphicon-star-empty");
			}
		
			if (fa) {
				$(this).toggleClass("fa-star");
				$(this).toggleClass("fa-star-o");
			}
		});			
	});
			
	function check(source, name) {
	  checkboxes = document.getElementsByName(name);
	  for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = source.checked;
	  }
	}					
</script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<style>
	.wmd-button > span { background-image: url("' . BASE_URL. 'dashboard/js/markdown/pagedown/wmd-buttons.png") }		
</style>
</head>		
');

print $_head;
?>