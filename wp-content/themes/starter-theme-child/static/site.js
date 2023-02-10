$( document ).ready( function( $ ) {


  // all clickable function 
  $(".all-clickable").each(function () {
    var t = $(this).find("a:first-of-type").attr("href");
    console.log(t);

    /*
    $(this).on("click", function () {
      var i = $(this).find("input"),
          r = $(this).find(".no-all-clickable");
      "undefined" != typeof inputOfCar ? $(event.target).closest(i).length || e(t) : (void 0 !== r && $(event.target).closest(r).length) || e(t);
    });
    */
  });
  
});