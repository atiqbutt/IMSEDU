
<!DOCTYPE HTML>
<html>
<head>
<title>Admin</title>
<link href="<?php echo base_url();?>assets/login/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Transparent Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<!--web-fonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css' />
<!--web-fonts-->
</head>

<body>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js'></script><script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-30027142-1', 'w3layouts.com');
  ga('send', 'pageview');
</script>
<script async type='text/javascript' src='//cdn.fancybar.net/ac/fancybar.js?zoneid=1502&serve=C6ADVKE&placement=w3layouts' id='_fancybar_js'></script>
<style type='text/css'>  .adsense_fixed{position:fixed;bottom:-8px;width:100%;z-index:999999999999;}.adsense_content{width:720px;margin:0 auto;position:relative;background:#fff;}.adsense_btn_close,.adsense_btn_info{font-size:12px;color:#fff;height:20px;width:20px;vertical-align:middle;text-align:center;background:#000;top:4px;left:4px;position:absolute;z-index:99999999;font-family:Georgia;cursor:pointer;line-height:18px}.adsense_btn_info{left:26px;font-family:Georgia;font-style:italic}.adsense_info_content{display:none;width:260px;height:340px;position:absolute;top:-360px;background:rgba(255,255,255,.9);font-size:14px;padding:20px;font-family:Arial;border-radius:4px;-webkit-box-shadow:0 1px 26px -2px rgba(0,0,0,.3);-moz-box-shadow:0 1px 26px -2px rgba(0,0,0,.3);box-shadow:0 1px 26px -2px rgba(0,0,0,.3)}.adsense_info_content:after{content:'';position:absolute;left:25px;top:100%;width:0;height:0;border-left:10px solid transparent;border-right:10px solid transparent;border-top:10px solid #fff;clear:both}.adsense_info_content #adsense_h3{color:#000;margin:0;font-size:18px!important;font-family:'Arial'!important;margin-bottom:20px!important;}.adsense_info_content .adsense_p{color:#888;font-size:13px!important;line-height:20px;font-family:'Arial'!important;margin-bottom:20px!important;}.adsense_fh5co-team{color:#000;font-style:italic;}</style>

<body>

 
  

<!--<script async src='../../../../../../pagead2.googlesyndication.com/pagead/js/f.txt'></script>-->




  <style>
.error {
    color: red;
}
  </style>

<!---728x90--->
<!--header-->
	<div class="header-w3l">
		<h1>Admin Login Form</h1>
	</div>
<!--//header-->
<!---728x90--->
<!--main-->
<div class="main-content-agile">
<?php if($error=$this->session->flashdata('error'));?>
    <div class="row">
     <div class="col-lg-6">
        <div class="error"><?php echo $error; ?></div>
     </div><!--col-->
     </div><!--row-->
	<div class="sub-main-w3">	
		<!--<form action="#" method="post">-->
            <?php echo form_open('Admin/validate_login'); ?>
			<input placeholder="Username" name="Name" class="user" type="text" required=""><br>
			<input  placeholder="Password" name="Password" class="pass" type="password" required=""><br>
			<input type="submit" value="">
		</form>
	</div>
</div>
<!--//main-->
<!---728x90--->
<!--footer-->
<div class="footer">
	<!--<p>&copy; 2017 <a href="http://w3layouts.com/">W3layouts</a></p>-->
</div>
<!--//footer-->

</body>

</html>