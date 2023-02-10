$( document ).ready( function( $ ) {


  // all clickable function 
  function e(e) {
    window.location.href = e;
  }

  jQuery(".all-clickable").each((function() {
    var t = jQuery(this).find("a:first-of-type").attr("href");

    jQuery(this).on("click", (function() {
      console.log('tot' + t);
    });
    
  });
  
});