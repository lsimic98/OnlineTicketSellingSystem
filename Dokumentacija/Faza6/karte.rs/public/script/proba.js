$(document).ready(function () {

 $(".icon").click(function () {
   var x = $("#nav");

   if (x.css("display") === "block") {
     x.css({"display": "none"});
   } else {
       x.css({"display": "block"});
   }
 });

    $(window).resize(function () {
        var w = window.innerWidth;
        var x = $("#nav");
        if(w>768) x.css({"display": "block"});
    });

    $("a[aria-label='Next']").text("Sledeci");
    $("a[aria-label='Last']").text("Poslednja");
    $("a[aria-label='Previous']").text("Prethodna");
    $("a[aria-label='First']").text("Prva");

 });


