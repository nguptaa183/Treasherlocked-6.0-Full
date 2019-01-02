<?php 
	require( 'config/consts.php' );
	session_start();
	
	require_once( DOCUMENT_ROOT . 'classes/LoginHelper.php' );
	require_once( DOCUMENT_ROOT . 'config/db.php' );
	require( DOCUMENT_ROOT . 'classes/Treasherlocked.php' );
		
	/* Check if the user is logged in */
	$loginHelper = new LoginHelper( $db );
	if ( !$loginHelper->IsLoggedIn() ) {
		$continue = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header( "Location: " . SITE_URL . "login/?continue=$continue" );
		exit;
	}
	
	// Check if the event has started
	$ts = new Treasherlocked( $db );		// Treasherlocked is the boss
	if ( $ts->getEventStatus() == EVENT_NOT_STARTED ) {
		header( 'Location: ' . SITE_URL );
		exit;
	}
	
	$curLevel = $ts->getCurrentLevel();		// Current levels of the user
	
	if ( isset( $_GET['level'] ) 
		&& $_GET['level'] <= $curLevel
	) {
		$reqLevel = $db->escape( $_GET['level'] );			// Requested level
		
		if ( is_numeric( $_GET['level'] ) ) {
		
			// Check if the level has an URL mask. If it has an URL mask, it should appear instead of level number
			$url_mask = $ts->getURLMask( $reqLevel );
			if ( $url_mask ) {
				header( 'Location: ' . SITE_URL . 'level/' . $url_mask . '/' );
				exit;
			}
			
			if ( $reqLevel == 0 && $curLevel == 0 ) {
				// Only Faceook users will be forced to like pages
				if ( $_SESSION['oauth_type'] == OAUTH_FACEBOOK ) {
					require( DOCUMENT_ROOT . 'includes/html/event/facebook_likes.php' );
					exit;
				} else {
					$ts->upgradeLevel( 1 );
					header( 'Location: ' . SITE_URL . 'level/' . $curLevel . '/' );
					exit;
				}
			} elseif ( $reqLevel == 0 && $curLevel != 0) {
				header( 'Location: ' . SITE_URL . 'level/' . $curLevel . '/' );
				exit;
			}
			
		} else {	// URL mask probably
		
			if ( $levelID = $ts->getLevel( $reqLevel ) ) {
				$reqLevel = $levelID;
			} else {	//Random strng
				header( 'Location: ' . SITE_URL . 'level/' . $curLevel . '/' );
				exit;
			}
			
		}
	} else {
		
		if ( $curLevel > NO_OF_LEVELS )
			require( DOCUMENT_ROOT . 'includes/html/event/finished.php' );
		else
			header( 'Location: ' . SITE_URL . 'level/' . $curLevel . '/' );
		
		exit;
	}

	/*if ( isset( $_GET['level'])  && $_GET['level'] == 11){
			$reqLevel = $db->escape( $_GET['level'] );	
			echo "<script> console.log('England') </script>";
		}*/

	require( 'classes/Event.php' );
	$event = new Event();
	$event_status = $event->get_event_status();
	
	// TBD: Check DIVERGENCE && CONVERGENCE
	
	// Load questions
	$question = $ts->getQuestion( $reqLevel );
	$explanation = $ts->getExplanation($reqLevel);
	$favicon = ( isset( $question['favicon'] ) ) ? $question['favicon']: false;
	
	/*	Begin Page Rendering */
	$page = NON_NAV;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	
	<?php if ( $favicon ) :?>
	<link rel="shortcut icon" href="<?php echo SSTATIC . 'img/questions/' . $favicon; ?>" type="image/png">
	<link rel="icon" href="<?php echo SSTATIC . 'img/questions/' . $favicon; ?>" type="image/png">
	<?php else : ?>
	<link rel="shortcut icon" href="<?php echo SSTATIC; ?>favicon.png" type="image/png">
	<link rel="icon" href="<?php echo SSTATIC; ?>favicon.png" type="image/png">
	<?php endif; ?>

	<title>Level <?php echo $reqLevel; ?> - Treasherlocked 5.0 Gameplay</title>

	<link href="<?php echo SSTATIC; ?>css/bootstrap.css" rel="stylesheet" />
	<link href="<?php echo SSTATIC; ?>css/animate.css" rel="stylesheet" />
	<link href="<?php echo SSTATIC; ?>css/base.css" rel="stylesheet" />
	<link href="<?php echo SSTATIC; ?>css/game.css" rel="stylesheet" />
	<link href="<?php echo SSTATIC; ?>css/queries.css" rel="stylesheet" />
  
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>	   
<body id="top">

	<?php require( 'includes/html/header.php' ); ?>
	
	<section class="page section-padding">
		<div class="container">
			<div class="row">
				<div class="row box status" id="level-info">
					<div class="info">
						<div class="level">Level <?php echo $reqLevel; ?></div>
						<div class="rank">Rank #<?php echo $ts->getUserRank(); ?></div>
					</div>
					<div class="progress-bar">
						<div class="progress" style="width: <?php echo ( ($curLevel - 1)/NO_OF_LEVELS )*100; ?>%;"></div>
					</div>
				</div>
				<div class="space space-20"></div>
				<div class="row box question-box" id="question-box">
					<div class="row" id="question">
						<?php echo $question['html']; ?>
					</div>
					<div class="row result wrong-ans" id="wrong-ans">
						<h1>Oops!</h1>
						<h3>We gotta tell you, that's not correct!</h3>
						<a class="btn btn-effect" id="back" href="javascript:void(0);">Back to question</a>
					</div>
					<div class="row result correct-ans" id="correct-ans">
						<h1>Congratulations!</h1>
						<h3>That was correct!</h3>
						<?php if($explanation['explanation']!=''){?>
							<h2>EXPLANATION</h2>
							<p><?php echo $explanation['explanation']; ?></p>
						<?php }?>
						<a class="btn btn-effect" id="back" href="<?php echo SITE_URL; ?>play/">Next question</a>
					</div>
				</div>
				<div class="space space-20"></div>
				
				<?php if ( $reqLevel == $curLevel ) : ?>
				<div class="row box answer-box" id="answer-box">
					<div class="row">
						<form id="mini">
							<input type="hidden" name="level" value="<?php echo $curLevel; ?>" />
							<input type="text" class="text" id="answer" name="answer" placeholder="Answer" maxlength="254" />
							<a class="btn btn-effect inline-block" id="submit" href="javascript:void(0);">Submit</a>
						</form>
					</div>
				</div>
				<div class="space space-20"></div>
				<?php else: ?>
				<div class="row text-center">
					<a class="btn btn-effect" href="<?php echo SITE_URL; ?>level/<?php echo $curLevel; ?>/">Go to current level</a>
				</div>
				<?php endif; ?>
				<div class="space space-30"></div>`
				<div class="row box disqus" id="disqus">
					<div class="row text-center">
						<a href="javascript:void(0);" onclick="DISQUS.reset( { reload: true } );">Refresh</a>
					</div>
				    <div id="disqus_thread"></div>
					<script>
						(function() { // DON'T EDIT BELOW THIS LINE
							var d = document, s = d.createElement('script');

							s.src = 'https://treasherlocked5.disqus.com/embed.js';

							s.setAttribute('data-timestamp', +new Date());
							(d.head || d.body).appendChild(s);
						})();
					</script>
					<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
				</div>
			</div>
		</div>
	</section>
		
	<!--FOOTER-->	
	<?php require('includes/html/footer.php'); ?>
	<!-- /FOOTER -->
		
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery-ui-1.10.4.min.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/bootstrap.min.js" ></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/smooth-scroll.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery.nicescroll.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/wow.min.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/init.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/init_level.js"></script>
	<?php require('includes/html/tracking.php'); ?>
</body>
</html>