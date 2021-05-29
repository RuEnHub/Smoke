$(window).scroll(function() {
    if ($(this).scrollTop() > 10) {
        $('.scrolldown').fadeOut(400);
    } else {
        $('.scrolldown').fadeIn(400);
    }
});

$(document).ready(function() {
    var glow = $('.pulsate');
    setInterval(function() {
        glow.hasClass('glow') ? glow.removeClass('glow') : glow.addClass('glow');
    }, 1000);
});

function lerp(v0, v1, t) {
    return v0*(1-t)+v1*t
}

var mouseX = 0;
var mouseY = 0;
var lerpedX = 0;
var lerpedY = 0;
function parallax() {
    lerpedX = lerp(lerpedX, mouseX, 0.1);
    lerpedY = lerp(lerpedY, mouseY, 0.1);
    $('.mouse-parallax-smoke').css('transform','translate(-' + lerpedX * 30 + 'px, -' + lerpedY * 30 + 'px)');//y * 30
}

function updateMousePos(event) {
    mouseX = event.pageX / $(window).width();
    mouseY = event.pageY / $(window).height();
}

document.addEventListener('mousemove', updateMousePos);
setInterval(parallax, 1000/60);

//Функция показа
function show(state)
{
    document.getElementById('window').style.display = state;    
    document.getElementById('gray').style.display = state;      
}   