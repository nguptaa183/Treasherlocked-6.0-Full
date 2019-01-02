jQuery( document ).ready(function( $ ) {
	var processing = false;
	console.log("2");
	var retrieveRankings = function() {
		console.log("1");
		
		if ( !processing ) {
			processing = true;
			$( '#refresh' ).html( 'Loading...' );
			
			$.get (
				site_url + 'ajax/get/ranking.php',
				function( response ) {
					console.log(response.data);
					$( '#refresh' ).html( 'Refresh' );
					$( '#ranking' ).hide();
					$( '#user-rank' ).hide();
					$( '#user-rank' ).html( response.userRank );
					$( '#ranking' ).html( response.data );
					$( '#user-rank' ).fadeIn();
					$( '#ranking' ).fadeIn();
					processing = false;
				}
			);
			
		}
		
	};
	
	$( '#refresh' ).click( function() { retrieveRankings(); } );
	retrieveRankings();
});