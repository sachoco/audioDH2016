myplayer = null
nowplaying = 0
isPlaying = false
dur = null
downloadURL = null

timecode = (ms) ->
	hms = (ms) ->
		return {
			h: Math.floor(ms/(60*60*1000)),
			m: Math.floor((ms/60000) % 60),
			s: Math.floor((ms/1000) % 60)
		};
	hms = hms(ms)
	tc =[]
	if hms.h > 0
		tc.push(hms.h)

	tc.push("0" + hms.m)
	# tc.push(if hms.m < 10 and hms.h > 0 then "0" + hms.m else hms.m)
	tc.push(if hms.s < 10 then "0" + hms.s else hms.s)
	tc.join('.')	

Array::shuffle ?= ->
	if @length > 1 then for i in [@length-1..1]
		j = Math.floor Math.random() * (i + 1)
		[@[i], @[j]] = [@[j], @[i]]
	this



jQuery ($) -> 	

	playPause = ->
		if isPlaying then pause() else play(tracks[nowplaying])

	play = (track)->
		SC.get('/tracks/'+track.track_id).then (track)->
			dur = track.duration
			downloadURL = track.download_url
			$("button.download").addClass('active').removeAttr('disabled')

		SC.stream('/tracks/'+track.track_id).then (player)->
			player.play()
			myplayer = player
			artist_name = if track.artist_full then track.artist_full else track.artist
			$(".trackinfo-cur .title").html(track.track_title);
			$(".trackinfo-cur .artist").html(artist_name);
			# if track.link then $(".trackinfo-cur .link").html("<a href='"+track.link+"' target='_blank'>"+track.link+"</a>");
			$(".curtrack-description header").html("<h3>"+track.artist_full+"</h3><h4>"+track.track_title+"</h4>")
			$(".curtrack-description section").html(track.description)
			$(".curtrack-description footer").html("<a href='"+track.link+"' target='_blank'>"+track.link+"</a>")
			$(".curtrack-description").show()
			$(".controller .dur").html(timecode(dur))
			$(".trackinfo").hide()

			player.on "time", ->
				$(".controller .cur").html(timecode(player.currentTime()))
				$("#progress-indicator").width((player.currentTime()/dur*100) + '%')
			
			player.on "finish", ->
				playNext();
			
			$("button.playpause i").addClass("fa-pause").removeClass("fa-play")
			$("ul.tracks li").removeClass("nowplaying")
			$("ul.tracks li[data-id='"+track.id+"']").addClass("nowplaying")
			isPlaying = true;

	pause = ->
		myplayer.pause()
		$("button.playpause i").removeClass("fa-pause").addClass("fa-play")
		isPlaying = false;

	playNext = ->
		nowplaying++
		if nowplaying>=tracks.length then nowplaying = 0
		if myplayer then myplayer.seek(0)
		play(tracks[nowplaying])

	playPrev = ->
		nowplaying--
		if nowplaying<0 then nowplaying = mytracks.length
		if myplayer then myplayer.seek(0)
		play(tracks[nowplaying])

	$("button.playpause").on "click", -> playPause()
	$("button.next").on "click", -> playNext()
	$("button.prev").on "click", -> playPrev()
	
	$("button.shuffle").on "click", ->
		$(this).toggleClass("active")
		cur_track = tracks[nowplaying]
		
		if $(this).hasClass("active") 
			tracks.shuffle()
		else
			tracks.sort (a, b)->
				parseFloat(a.id) - parseFloat(b.id);

		# 	_.sortBy(tracks, 'id')
		if myplayer
			nowplaying = $.inArray(cur_track, tracks)
		# console.log(tracks)
		# console.log(nowplaying)

	$("button.download").on "click", ->
		window.location.href = downloadURL+'?client_id=098249c9bda43969033f485dc628827d'
		# cur_track = tracks[nowplaying]
		# SC.get('/tracks/'+cur_track.track_id+'/download')


    
	moveProgressSlide = (e)->
		$target = $("#progress-scrubber")
		offset = $target.offset()
		width = $target.width()
		x = e.clientX - offset.left
		percentage = x / width
		$("#volume-indicator").width((percentage * 100) + '%')
		if myplayer then myplayer.seek(percentage*dur)

	startProgressSlide = (e)->
		$target = $("#progress-scrubber")
		offset = $target.offset()
		width = $target.width()
		x = e.clientX - offset.left
		percentage = x / width
		$("#progress-scrubber").on('mousemove', moveProgressSlide)
		$("#progress-indicator").width((percentage * 100) + '%')
		if myplayer then myplayer.seek(percentage*dur)

	stopProgressSlide = (e)->
		$("#progress-scrubber").off('mousemove', moveProgressSlide)

	$("#progress-scrubber").on('mousedown', startProgressSlide)
	$(document).on('mouseup', stopProgressSlide)

	moveVolumeSlide = (e)->
		$target = $("#volume-scrubber")
		offset = $target.offset()
		width = $target.width()
		x = e.clientX - offset.left
		percentage = x / width
		$("#volume-indicator").width((percentage * 100) + '%')
		if myplayer then myplayer.setVolume(percentage)

	startVolumeSlide = (e)->
		$target = $("#volume-scrubber")
		offset = $target.offset()
		width = $target.width()
		x = e.clientX - offset.left
		percentage = x / width
		$("#volume-scrubber").on('mousemove', moveVolumeSlide)
		$("#volume-indicator").width((percentage * 100) + '%')
		if myplayer then myplayer.setVolume(percentage)

	stopVolumeSlide = (e)->
		$("#volume-scrubber").off('mousemove', moveVolumeSlide)

	$("#volume-scrubber").on('mousedown', startVolumeSlide)
	$(document).on('mouseup', stopVolumeSlide)

	$("ul.tracks li").hover ->
		if !$(this).hasClass("nowplaying")
			id = $(this).data('id')
			track = $.grep tracks, (track) ->
				track.id == id
			track = track[0]
			# console.log(track)
			$(".curtrack-description").hide()
			$(".trackinfo header").html("<h3>"+track.artist_full+"</h3><h4>"+track.track_title+"</h4>")
			$(".trackinfo section").html(track.description)
			$(".trackinfo footer").html("<a href='"+track.link+"' target='_blank'>"+track.link+"</a>")
			$(".trackinfo").show()
		else
			showCurtrackDesc()
		@

	$("ul.tracks li").click ->
		id = $(this).data('id')
		# index = tracks.findIndex(x => x.id==id)
		track = $.grep tracks, (track, i) ->
			track.id == id
		track = track[0]
		index = $.inArray(track, tracks)
		nowplaying = index
		# $(".trackinfo-cur .title").html(track.track_title)
		# $(".trackinfo-cur .artist").html(track.artist_full)
		# $(".trackinfo-cur .link").html("<a href='"+track.link+"'>website</a>")
		# $(".curtrack-description header").html("<h3>"+track.artist_full+"</h3><h4>"+track.track_title+"</h4>")
		# $(".curtrack-description section").html(track.description+"<div class='link'><a href='"+track.link+"'>website</a></div>")

		# $(".curtrack-description").html(track.description)
		$(".tracks li").removeClass("nowplaying")
		$(this).addClass("nowplaying")
		play(track)


	$("nav.nav li:not('.download') a").on "click", (e) ->
		e.preventDefault()
		$(".content-wrapper").load $(this).attr('href')+" #content", ->
			$(".content-wrapper").show()
			$(".tracks").hide()

	$("section.header header").on "click", (e)->
		e.preventDefault()
		$(".content-wrapper").hide()
		$(".tracks").show()

	showCurtrackDesc = ->
		$(".curtrack-description").show()
		$(".trackinfo").hide()

	# $(".footer .controller").hover -> showCurtrackDesc()
	$(".footer").hover -> showCurtrackDesc()
	$(".header").hover -> showCurtrackDesc()



	$(window).resize ->
		h = $(window).height()
		top = $("section.footer").offset().top
		if h < 550 then $("section.footer").addClass("mini") else $("section.footer").removeClass("mini")
	@