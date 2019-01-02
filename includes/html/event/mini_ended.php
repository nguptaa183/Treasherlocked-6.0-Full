<?php 
	require( 'config/consts.php' );
	$page = MINI_SERIES;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<link rel="shortcut icon" href="<?php echo SSTATIC; ?>favicon.png" type="image/png">
	<link rel="icon" href="<?php echo SSTATIC; ?>favicon.png" type="image/png">

	<title>Event has come to an end - Treasherlocked 2.x Mini Series</title>
	
	<link href="<?php echo SSTATIC; ?>css/bootstrap.css" rel="stylesheet" />
	<link href="<?php echo SSTATIC; ?>css/animate.css" rel="stylesheet" />
	<link href="<?php echo SSTATIC; ?>css/base.css" rel="stylesheet" />
	<link href="<?php echo SSTATIC; ?>css/social.css" rel="stylesheet" />
	<link href="<?php echo SSTATIC; ?>css/game.css" rel="stylesheet" />
	<link href="<?php echo SSTATIC; ?>css/queries.css" rel="stylesheet" />
  
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>	   
<body id="top">

	<?php require( DOCUMENT_ROOT . 'includes/html/header.php' ); ?>
	
	<section class="page section-padding">
		<div class="container">
			<div class="row">
				<div class="social">
					<div class="treasherlocked box">
						<p>Treasherlocked 2.x has come to an end.</p>
						<h2>Treasherlocked 3.0</h2>
						<h4 class="no-transform">starts</h4>
						<h3 class="no-transform">November 06, 2100 hours (IST)</h3>
						<a class="btn btn-effect" href="https://www.facebook.com/MicrosoftCampusClub" target="_blank">Stay tuned</a>
					</div>
				</div>
			</div>
			<div class="space space-20"></div>
			<div class="row box disqus" id="disqus">
			    <div id="disqus_thread"></div>
				<script>
				    (function() {
				        var d = document, s = d.createElement('script');
				        
				        s.src = '//treasherlocked3.disqus.com/embed.js';
				        
				        s.setAttribute('data-timestamp', +new Date());
				        (d.head || d.body).appendChild(s);

				        setInterval( function() {
				        	console.log( 'Refreshing' );
				        	DISQUS.reset( { reload: true } );
				        }, 20000 );
				    })();
				</script>
				<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
			</div>
		</div>
	</section>
		
	<!--FOOTER-->	
	<?php require( DOCUMENT_ROOT . 'includes/html/footer.php'); ?>
	<!-- /FOOTER -->
		
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery-ui-1.10.4.min.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/bootstrap.min.js" ></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/smooth-scroll.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery.nicescroll.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/wow.min.js"></script>
	<script type="text/javascript" src="<?php echo SSTATIC; ?>js/init.js"></script>
	
	<?php require( DOCUMENT_ROOT . 'includes/html/tracking.php' ); ?>
</body>
</html>