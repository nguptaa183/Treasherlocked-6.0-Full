	<footer>
		<div class="container">
			<div class="row">
				<ul class="navigation">
					<li><a class="hint" onclick=""><span>Hint</span></a></li>
					<style>
						.hint:hover span {display:none}
						.hint:hover:before {content:"2003"}
					</style>
					<script>
						$(window).load(function() { 
    						$('footer').css('visibility','visible');

						});
					</script>
					<li><a href="<?php echo SITE_URL; ?>about/">About</a></li>
					<li><a href="https://www.facebook.com/Treasherlocked" target="_blank">Treasherlocked's Facebook</a></li>
					<li><a href="<?php echo SITE_URL; ?>privacy/">Privacy Policy</a></li>
					<li><a href="mailto:msclub.nitr@gmail.com">Contact Us</a></li>
				</ul>
				<ul class="legal">
					<li>
						2013 - 2017 &copy; <a href="https://www.facebook.com/MicrosoftCampusClub" target="_blank">Microsoft Campus Club</a>
						<em>(based in <a href="http://nitrkl.ac.in" target="_blank">National Institute of Technology Rourkela</a>)</em>
					</li>
				</ul>
			</div>
		</div>
	</footer>