<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/bootstrap.min.js'></script>
<script type='text/javascript' src='js/mytip.js'></script>
<script>
	  $(function() {
		$('.tipsy-atas').tipsy
		({
			fade: true,
			gravity: 's'
		});
		$('.tipsy-bawah').tipsy
		({
			fade: true,
			gravity: 'n'
		});
		
		$('.tipsy-kiri').tipsy
		({
			fade: true,
			gravity: 'e'
		});
		
		$('.tipsy-kanan').tipsy
		({
			fade: true,
			gravity: 'w'
		});
		
		$('.tipsy-kanan-bawah').tipsy
		({
			fade: true,
			gravity: 'nw'
		});
		
		$('.tipsy-kanan-atas').tipsy
		({
			fade: true,
			gravity: 'sw'
		});
		
		$('.tipsy-kiri-bawah').tipsy
		({
			fade: true,
			gravity: 'ne'
		});
		
		$('.tipsy-kiri-atas').tipsy
		({
			fade: true,
			gravity: 'se'
		});
		
	  });
</script>