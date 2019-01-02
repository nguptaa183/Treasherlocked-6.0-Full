<?php 
	require('config/consts.php' ); 
	
	$page = HOME;
	session_start();
	
	require_once( DOCUMENT_ROOT . 'classes/LoginHelper.php' );
	require_once( DOCUMENT_ROOT . 'config/db.php' );
		
	/* Check if the user is logged in/Login the user if presence cookie is present */
	$loginHelper = new LoginHelper($db);
	$loggedIn = $loginHelper->IsLoggedIn();
		
	/*	Get the event status	*/
	require( 'classes/Event.php' );
	$event = new Event();
	$event_status = $event->get_event_status();
	
	/*	Countdown to be sent to the client	*/
	if ( $event_status == EVENT_NOT_STARTED )
		$countdown = EVENT_START - time();
	elseif ( $event_status == EVENT_STARTED )
		$countdown = EVENT_END - time();
	else
		$countdown = null;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<link rel="shortcut icon" href="<?php echo SSTATIC; ?>favicon.png" type="image/png">
	<link rel="icon" href="<?php echo SSTATIC; ?>favicon.png" type="image/png">

	<title>Treasherlocked 6.0 by Microsoft Campus Club, NIT Rourkela - Treasure is locked, yet again!</title>
	
	<meta name="description" content="Treasherlocked 6.0 is the sixth installment to a three-day online cryptic treasure hunt organized by Microsoft Campus Club of NIT Rourkela. It will be held between 6th November and 8th November, 2015." />
	<meta name="keywords"  content="treasherlocked, treasure locked, treasure sherlocked, sherlock, treasherlocked 3.0, innovision 2015, NIT Rourkela, NIT Rourkela treasure hunt, cryptic hunt, online cryptic hunt, treasure hunt" />

	<link href="<?php echo SSTATIC; ?>css/bootstrap.css" rel="stylesheet" />
	<link href="<?php echo SSTATIC; ?>css/animate.css" rel="stylesheet" />
	<link href="<?php echo SSTATIC; ?>css/base.css" rel="stylesheet" />
	<link href="<?php echo SSTATIC; ?>css/home.css" rel="stylesheet" />
	<link href="<?php echo SSTATIC; ?>css/queries.css" rel="stylesheet" />
  
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>	   
<body id="top">
	<!-- <div class='popup' id="advert">
		<div class='cnt223'>
			<p>
				 <img src="<?php echo SSTATIC; ?>img/banner.jpg" alt="advert">
				<br/>
				<br/>
				<a href='https://www.printview.in/' target="_blank" id="pop-up-close" class="close">Continue</a>
			</p>
		</div>
	</div> -->

	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery.cookie.js"></script>
	<!-- <script type='text/javascript'>
		$(window).load(function(){
			if(typeof $.cookie('seenadvert')=== 'undefined'){
				console.log("1");
				var overlay = $('<div id="overlay"></div>');
				overlay.show();
				overlay.appendTo(document.body);
				$('.popup').show();
				$('.close').click(function(){
					$('.popup').hide();
					overlay.appendTo(document.body).remove();

				});
				$.cookie('seenadvert',1, { expires: 100 });
			}
		});
	</script> -->
	<?php require( 'includes/html/header.php' ); ?>
		
	<section id="home" class="autoheight">
		<div class="home-bg"></div>
		<div class="col-lg-12 landing-text-pos align-center">
			<img id="logo" class="wow animated fadeInDown" data-wow-duration="1s" data-wow-delay="1s" src="<?php echo SSTATIC; ?>img/logo.png" />
			<h2 class="wow animated fadeInDown" data-wow-duration="1s" data-wow-delay="1s">because the hunt is on</h2>
			<hr id="title_hr" />
			<p class="wow animated fadeInUp" data-wow-duration="1s" data-wow-delay="1s">11-13 January 2019</p>
			<?php if($loggedIn && $event_status==EVENT_STARTED){?>
			<a class="btn-effect wow animated fadeIn" data-wow-duration="0.5s" data-wow-delay="1.5s" data-scroll href="<?php echo SITE_URL . 'play/'; ?>">Play Now</a>
			<?php } ?>
			<?php if($loggedIn && $event_status==EVENT_NOT_STARTED){ ?>
			<a class="btn-effect wow animated fadeIn" data-wow-duration="0.5s" data-wow-delay="1.5s" data-scroll href="<?php echo SITE_URL . 'about/'; ?>">Learn More</a>
			<?php }?>
			<?php if(!$loggedIn){?>
			<a class="btn-effect wow animated fadeIn" data-wow-duration="0.5s" data-wow-delay="1.5s" data-scroll href="<?php echo SITE_URL . 'signup/'; ?>">Register Now</a>
			<?php }?>
		</div>
	</section>
	
	<?php /* COUNTDOWN--- */ ?>
	<section id="countdown" class="text-center section-padding">
		<div class="container">
			<div class="row">
				<input type="hidden" id="serve_time" name="serve_time" value="<?php echo $countdown; ?>" />
				<?php
				switch ($event_status) {
					case EVENT_NOT_STARTED:	{ require( 'includes/html/event/not_started.php' ); break; }
					case EVENT_STARTED:		{ require( 'includes/html/event/running.php' ); break; }
					case EVENT_CLOSED:		{ require( 'includes/html/event/closed.php' ); break; }
				}
				?>
			</div>
		</div>
	</section>
	<?php /* ---COUNTDOWN */ ?>

	<?php /*-- HOME ADMIN-- */?>
	<section id="home-admin">
		<div class="box">
			<div class="row ">
 				<div class="col-md-2 img-home-admin">
 					<img class="img-responsive img-circle" src="<?php echo SSTATIC; ?>img/admin/acd.jpg" />
 					<br/>
 					<p>Admin ACD</p>
 				</div>
	   			<div class="col-md-2 img-home-admin">
	   				<img class="img-responsive img-circle" src="<?php echo SSTATIC; ?>img/admin/sherlock.jpg" />
	   				<br/>
	   				<p>Admin Sherlock</p>
	 			</div>
				<div class="col-md-2 img-home-admin">
	 				<img class="img-responsive img-circle" src="<?php echo SSTATIC; ?>img/admin/watson.jpg" />
	 				<br/>
	 				<p>Admin Watson</p>
	 			</div>
	  			<div class="col-md-2 img-home-admin">
	   				<img class="img-responsive img-circle" src="<?php echo SSTATIC; ?>img/admin/moriarty.jpg" />
	   				<br/>
	   				<p>Admin Moriarty</p>
	 			</div>
	  			<div class="col-md-2 img-home-admin">
	   				<img class="img-responsive img-circle" src="<?php echo SSTATIC; ?>img/admin/mycroft.jpg" />
	   				<br/>
	   				<p>Admin Mycroft</p>
	 			</div>
			</div>
		</div>
	</section>
	<?php /*-- HOME ADMIN-- */?>
	
	<?php /* SPONSORS--- */ ?>	
	<section id="sponsors" class="text-center section-padding">
		<div class="container">
			<!--<div class="sponsor">
				<?php /*<a href="http://www.printview.in/" target="_blank"><img src="<?php echo SSTATIC; ?>img/sponsors/printview.png" /></img></a>
				<span class="sponsor-font">Title Sponsor</span> */?>
			</div>
			<div class="sponsor">
				<a href="http://silantechnology.com/" target="_blank"><img src="<?php echo SSTATIC; ?>img/sponsors/silian.jpg" /></a>
				<span class="sponsor-font">Gold Sponsor</span>
			</div>
			<div class="sponsor">
				 <a href="https://www.thesouledstore.com/" target="_blank"><img src="<?php echo SSTATIC; ?>img/sponsors/souledstore.jpg" /></a>
				<span class="sponsor-font">Merchandise Partner</span>
			</div>
			<div class="sponsor">
				<a href="http://www.punambookstore.com" target="_blank"><img src="<?php echo SSTATIC; ?>img/sponsors/punam.jpg" /></a>
				<span class="sponsor-font">Associate Partner</span>
			</div>
			<div class="sponsor">
				<a href="http://innovision.nitrkl.ac.in" target="_blank"><img src="<?php echo SSTATIC; ?>img/sponsors/innovision.jpg" /></a>
				<span class="sponsor-font">Event Partner</span>
			</div>
			<div class="sponsor">
				<a href="https://www.facebook.com/Cinematics.nitr/?ref=br_rs" target="_blank"><img src="<?php echo SSTATIC; ?>img/sponsors/cinematics.jpg" /></a>
				<span class="sponsor-font">Publicity Partner</span>
			</div>	
			<div class="sponsor">
				<a href="http://mondaymorning.nitrkl.ac.in" target="_blank"><img src="<?php echo SSTATIC; ?>img/sponsors/mm.png" /></a>
				<span class="sponsor-font">Media Partner</span>
			</div>-->		
			<div class="space space-40"></div>
			<div class="row">
				<a href="https://www.facebook.com/MicrosoftCampusClub" target="_blank"><img src="<?php echo SSTATIC; ?>img/msclublogo.png" /></a>
				<p>a <a href="https://www.facebook.com/MicrosoftCampusClub">Microsoft Campus Club</a> event</p>
			</div>
		</div>
	</section>
	<?php /* ---SPONSORS */ ?>  <?php/*  */?>
	
	   <audio src="<?php echo SSTATIC; ?>music/bg.mp3" loop="true" id="backgroundMusic" autoplay="true"> </audio> 

	<?php /* FOOTER--- */ ?>	
	<?php require('includes/html/footer.php'); ?>
	<?php /* ---FOOTER */ ?>

	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/main.js" ></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery-ui-1.10.4.min.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/bootstrap.min.js" ></script>

	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/smooth-scroll.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery.nicescroll.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/wow.min.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/init.js"></script>
	
	<?php if ( $event_status == EVENT_NOT_STARTED || $event_status == EVENT_STARTED ): ?>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/countdown.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/init_countdown.js"></script>
	<?php endif; ?>
	
	<?php require( 'includes/html/tracking.php' ); ?>
</body>
</html>