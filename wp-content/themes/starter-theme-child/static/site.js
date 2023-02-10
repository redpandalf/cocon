$( document ).ready( function( $ ) {


  // all clickable function 
  $(".all-clickable").each(function () {
    var t = $(this).find("a:first-of-type").attr("href");
    
    $(this).on("click", function () {
      console.log(t);

      var i = $(this).find("input");
      r = $(this).find(".no-all-clickable");
      
      t != typeof inputOfCar ? $(event.target).closest(i).length || e(t) : (void 0 !== r && $(event.target).closest(r).length) || e(t);
      /*var i = $(this).find("input"),
          r = $(this).find(".no-all-clickable");
      "undefined" != typeof inputOfCar ? $(event.target).closest(i).length || e(t) : (void 0 !== r && $(event.target).closest(r).length) || e(t);
      */
    });
    
  });
  
});