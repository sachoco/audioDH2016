jQuery ($) -> 
    # $('#example').DataTable paging: false
	$grid = $('.isotope').imagesLoaded ->
		$grid.isotope itemSelector: "li", layoutMode: 'masonry', getSortData: { name: '.name', date: '.date'}

	# $(".button").on "click", ->
	# 	sort = $(this).data("sort-by")
	# 	# console.log(sort)
	# 	$(".isotope").isotope({ sortBy : sort })
	# $(".mobile-menu").on "click", ->
	# 	$(".mobile-nav").slideToggle()
	# 	$("section.background").toggleClass("blur")
	# 	$(".viewport").toggleClass("blur")
	# 	$("section.main").toggleClass("blur")
	# 	$("footer").toggleClass("blur")


	@
