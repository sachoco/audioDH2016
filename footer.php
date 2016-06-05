<section class="footer parent clear">
	<section class="controller gr-6">
		<!-- <a href="#" id="prev" class="fa fa-backward fa-lg" style="color: #3c3c3c;"></a>
		<a href="#" id="play-pause" class="fa fa-play fa-3x" style="color: #3c3c3c;"></a>
		<a href="#" id="next" class="fa fa-forward fa-lg" style="color: #3c3c3c;"></a></div> -->

		<button class="prev"><i class="fa fa-backward fa-lg" aria-hidden="true"></i></button>
		<button class="playpause"><i class="fa fa-play fa-3x" aria-hidden="true"></i></button>
		<button class="next"><i class="fa fa-forward fa-lg" aria-hidden="true"></i></button>
		<button class="shuffle"><i class="fa fa-random fa-lg" aria-hidden="true"></i></button>
		<button class="download" disabled><i class="fa fa-download fa-lg" aria-hidden="true"></i></button>
		<!-- <a class="download" disabled></a> -->

		<div id="volume-bar" class="gutter-right">
		    <div id="volume-scrubber">
		        <div id="volume-indicator"></div>
		    </div>
		    <div id="volume-sign" class="fa fa-volume-up fa-lg"></div>
		</div>

		<br>

		<div id="progress-bar">
		    <div id="progress-scrubber">
		        <div id="progress-indicator"></div>
		    </div>
		</div>

		<br>
		<small><span class="cur">00.00</span><span class="dur">00.00</span></small>

	    <article class="trackinfo-cur clear">
	        <div class="title"></div>
	        <div class="artist"></div>
	        <div class="link"></div> 
	    </article>

	</section>

	<section class="gr-6 no-gutter">
		<div class="gr-12 curtrack-description"></div>
	    <article class="gr-12 trackinfo clear">
	        <header></header>   
	        <section></section>
	    </article>
	</section>
</section>
    <?php wp_footer(); ?>

  </body>

</html>

