        <section class="footer clear">
<section class="controller gr-6">
	<!-- <a href="#" id="prev" class="fa fa-backward fa-lg" style="color: #3c3c3c;"></a>
	<a href="#" id="play-pause" class="fa fa-play fa-3x" style="color: #3c3c3c;"></a>
	<a href="#" id="next" class="fa fa-forward fa-lg" style="color: #3c3c3c;"></a></div> -->

	<button class="prev"><i class="fa fa-backward fa-lg" aria-hidden="true"></i></button>
	<button class="playpause"><i class="fa fa-play fa-3x" aria-hidden="true"></i></button>
	<button class="next"><i class="fa fa-forward fa-lg" aria-hidden="true"></i></button>
	<button class="shuffle"><i class="fa fa-random fa-lg" aria-hidden="true"></i></button>

	<div id="volume-bar">
	    <div id="volume-scrubber" style="background: #e3e3e3; width: 80px; height: 6px; border: 1px solid #e3e3e3;">
	        <div id="volume-indicator" style="background: #3c3c3c;"></div>
	    </div>
	    <div id="volume-sign" class="fa fa-volume-up fa-lg"></div>
	</div>

	<br>

	<progress value="0" max="100"
	  ng-click="seek($event)"
	  ng-value="currentTime / duration">
	    
	</progress>
	<br>
	<small><span class="cur">00.00</span><span class="dur">00.00</span></small>

	    <article class="trackinfo-cur clear">
	        <header>
			<!-- <small>Currently playing:</small> --> Three recycled pieces for seemingly minor instruments no1<br>Firstname Lastname</header>   
	        <!-- <section>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat ratione, veritatis sapiente minus reprehenderit? Dignissimos architecto earum perspiciatis placeat assumenda ratione consectetur accusamus adipisci facilis minima. Laudantium eius voluptatum quod.</section> -->
	    </article>

	</section>

	<section class="gr-6">
	    <article class="trackinfo clear">
	        <header></header>   
	        <section></section>
	    </article>
	</section>
</div>
        </section>
    <?php wp_footer(); ?>

  </body>

</html>

