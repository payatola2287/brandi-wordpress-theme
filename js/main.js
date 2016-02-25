jQuery(document).ready(function($){
    windowHeight = $(window).height();
    $('#main-menu a[href*="#"]:not([href="#"])').click(function() {
        $(this).closest(".menu-item").addClass("active").siblings(".menu-item").removeClass("active");
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 450);
                return false;
            }
        }
    });
    
    $(window).scroll(function(){
        var scroll = $(this).scrollTop() + 50;
        if(!$(".main-nav").hasClass("scrolled")){
            if(scroll > windowHeight){
                $(".main-nav").addClass("scrolled");
            }        
        }else{
            if(scroll < windowHeight){
                $(".main-nav").removeClass("scrolled");
            }
        }
        if($("#main-menu").hasClass('open')){
            $("#main-menu").removeClass('open');
        }
    });
    $('.animated').viewportChecker({
        classToAdd : 'fadeInUp'
    });
    $(".menu-toggle").click(function(){
        $($(this).data('menu')).toggleClass('open');
    });
    $("#works-showcase .row").mixItUp({
        selectors : {
            target : '.work'
        },
        layout : {
            display: 'block'
        },
        callbacks : {
            onMixEnd(state){
                console.log(state.activeFilter);
            }
        }
    });
    $("#main-menu .menu-item > .menu-link").click(function(){
        $(this).closest("li").addClass("active").siblings().removeClass("active");
    });
});
