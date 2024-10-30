jQuery(window).load(function($) {
  jQuery('.flexslider').flexslider({
    animation: 'slide',
    selector: ".slides > li",
    slideshow: true, 
    animationLoop: true, 
    controlNav: true,
    directionNav:false      
  });
});
