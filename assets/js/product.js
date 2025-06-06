document.addEventListener('DOMContentLoaded', function(){
    if (typeof Swiper !== 'undefined') {
        new Swiper('.product-gallery-swiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            }
        });
    }
});
