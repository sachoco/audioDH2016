(function() {
  jQuery(function($) {
    var $grid;
    $grid = $('.isotope').imagesLoaded(function() {
      return $grid.isotope({
        itemSelector: "li",
        layoutMode: 'masonry',
        getSortData: {
          name: '.name',
          date: '.date'
        }
      });
    });
    return this;
  });

}).call(this);
