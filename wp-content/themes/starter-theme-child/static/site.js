$( document ).ready( function( $ ) {


  // all clickable function 
  function e(e) {
    window.location.href = e;
  }

  jQuery(".all-clickable").each(function() {
    var link = jQuery(this).find("a:first-of-type").attr("href");

    jQuery(this).on("click", function() {    
      var i = jQuery(this).find("input");
      var nolink = jQuery(this).find(".no-all-clickable");
    
      "undefined" != typeof inputOfCar ? jQuery(event.target).closest(i).length 
      || e(link) : void 0 !== nolink && jQuery(event.target).closest(nolink).length 
      || e(link);
    });    
  });
  //
  
});

