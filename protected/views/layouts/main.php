<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/inc/calendar/calendar_js.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/inc/calendar/calendar.css" />

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/inc/java/common.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

  <script type="text/javascript">

    $.ajaxSetup ({
	// Disable caching of AJAX responses    
	cache: false
    });

    $(document).ready(JSClock());

  </script>

	
</head>

<body>

<div class="container" id="page">

	<div id="header">
	    <!--
		<div id="logo"><?php //echo CHtml::encode(Yii::app()->name); ?></div>
		<a id="sitelogo" href="javascript:void(null);" title="Swindon College Logo"></a>
		<h1 id="logo-text"><?php //echo CHtml::encode(Yii::app()->name); ?></h1>		
		<p id="slogan">Electronic Course Search<br/>Swindon College, Wiltshire (UK)</p>	
		//-->
		<div id="banner"></div>
        <?php
          /*if (!Yii::app()->user->isGuest) {
			echo "<div id=\"header-1\"><b>Hello, ".Yii::app()->user->name."</b><br/> ";
			echo "<a class=\"logout\" href=\"". Yii::app()->createUrl('site/logout') ."\">Logout</a></div>\n";
		  }*/ 
		?>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(	
				array('label'=>'College Home', 'url'=>'http://www.swindon-college.ac.uk'),
				array('label'=>'Course Search Home', 'url'=>array('/site/searchbb')),
				
				/*array('label'=>'Home', 'url'=>array('/site/index')),
				  array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				  array('label'=>'Contact', 'url'=>array('/site/contact')),*/
				
				        //array('label'=>'MyAdmin', 'url'=>array('/user/admin'), 'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->checkAccess('admin')),
				        //array('label'=>'MyAdmin', 'url'=>array('/user/admin'), 'visible'=>!Yii::app()->user->isGuest),
				/*array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest), */
				/*array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest) */
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'homeLink'=>false,
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
      
        <div class="jclock" id="jclock"></div>
        <div class="jdate" id="jdate"></div>

        <div class="clear"></div>

	<div id="main">
	    <?php echo $content; ?>
	</div>

	<div class="clear"></div>

	<div id="footer">
		Swindon College &copy; 2012. <?php echo Yii::powered(); ?>	
		
		<!-- paste your google analytics tracking code -->
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-1281566-10']);
			_gaq.push(['_setDomainName', 'swindon-college.ac.uk']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>

	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
