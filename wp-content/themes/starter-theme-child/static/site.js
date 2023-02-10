jQuery(document).ready(function() {

  alert('Coucou');

  jQuery(".all-clickable").each(function () {
    var t = jQuery(this).find("a:first-of-type").attr("href");
    jQuery(this).on("click", function () {
      var i = jQuery(this).find("input"),
          r = jQuery(this).find(".no-all-clickable");
      "undefined" != typeof inputOfCar ? jQuery(event.target).closest(i).length || e(t) : (void 0 !== r && jQuery(event.target).closest(r).length) || e(t);
    });
  }),

});