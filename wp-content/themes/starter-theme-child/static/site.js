$( document ).ready( function( $ ) {


  // all clickable function 

  jQuery(".all-clickable").each(function() {

    var toto = jQuery(this).find("a:first-of-type").attr("href");

    jQuery(this).on("click", function() {
      console.log('tot' + toto);
      /*
      var i = jQuery(this).find("input");
      var r = jQuery(this).find(".no-all-clickable");
      "undefined" != typeof inputOfCar ? jQuery(event.target).closest(i).length || e(t) : void 0 !== r && jQuery(event.target).closest(r).length || e(t);
      */
    });
    
  });
  
});