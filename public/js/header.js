$(function(){
    var galleryContainer = $('.gallery-item-container');
    var showTitle = function(){
        $(".head-logo__title").css('color','white');
        $(".quote-text").css({'color':'white','text-shadow':'#000000 2px 2px 2px'});
    };
    setTimeout(showTitle,500);

    lightbox.option({
        'fitImagesInViewport': false,
    });
     $('.art-slider').slick({
         slidesToShow: 6,
         slidesToScroll: 1,
         autoplay: true,
         autoplaySpeed: 1000,
         centerMode: true,
         infinite:true,
         variableWidth: true,
         cssEase: 'linear',
         arrows: true,
         swipeToSlide: true,
         slide: "a.art-slider__item",responsive: [
             {
                 breakpoint: 768,
                 settings: {
                     arrows: false,
                     slidesToShow: 4,
                     slidesToScroll: 1
                 }
             },
             {
                 breakpoint: 480,
                 settings: {
                     arrows: false,
                     slidesToShow: 1,
                     slidesToScroll: 1
                 }
             }
         ]
     });

    galleryContainer.masonry({
        itemSelector: '.gallery-item',
        gutter: 15,
        isFitWidth: true,
        animated:true
    });

});
$(window).on("load",function(){
    var galleryContainer = $('.gallery-item-container');
    galleryContainer.masonry({
        itemSelector: '.gallery-item',
        gutter: 15,
        isFitWidth: true,
        animated:true
    });
});
