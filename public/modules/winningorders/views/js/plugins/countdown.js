/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author    Dvit <support@dvit.fr>
 *  @copyright 2016 Dvit
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
    };
}

function initializeClock(clock) {
    
    var starttime = clock.querySelector('input.starttime').value;
    var endtime = clock.querySelector('input.endtime').value;
    var countdown_color = clock.querySelector('input.countdown_color').value;
    
    if (!endtime || !starttime)
        return;
    
    var dateendtime = new Date(endtime * 1000);
    var daysSpan = clock.querySelector('.days');
    var hoursSpan = clock.querySelector('.hours');
    var minutesSpan = clock.querySelector('.minutes');
    var secondsSpan = clock.querySelector('.seconds');
    var circle = false;
    var circle2 = false;
    var circleClock = false;
    var initialOffset = 0;
    var diffTime = 0;
    
    if (clock.classList.contains('circle') || 
            clock.classList.contains('circle2')){
        circle = true;
        
        var path = clock.querySelector('#circle_seconds');
        var radius = path.attributes.r.value;
        initialOffset = parseFloat(2*radius*Math.PI);
    
        var dayscircle = clock.querySelector('#circle_days');
        var dayshours = clock.querySelector('#circle_hours');
        var daysminutes = clock.querySelector('#circle_minutes');
        var daysseconds = clock.querySelector('#circle_seconds');
        
        if (clock.classList.contains('circle2')){
            circle2 = true;
            var initialOffsetDays = getOffset('#circle_days');
            var initialOffsetHours = getOffset('#circle_hours');
            var initialOffsetMinutes = getOffset('#circle_minutes');
            var initialOffsetSeconds = getOffset('#circle_seconds');
            dayscircle.style.strokeDasharray = initialOffsetDays;
            dayshours.style.strokeDasharray = initialOffsetHours;
            daysminutes.style.strokeDasharray = initialOffsetMinutes;
            daysseconds.style.strokeDasharray = initialOffsetSeconds;
        }
        
        var circles = clock.querySelectorAll('.circle_animation');
        for (var i = 0; i < circles.length; i++) {
            circles[i].style.stroke = countdown_color;
        }
    }else if(clock.classList.contains('clock')) {
        circleClock = true;
        var path = clock.querySelector('#circle_clock');
        path.style.strokeOpacity = 0.8;
        var radius = path.attributes.r.value;
        initialOffset = parseFloat(2*radius*Math.PI);
        diffTime =  endtime - starttime;
        var stops = clock.querySelectorAll('.stopgr');
        for (var i = 0; i < stops.length; i++) {
            stops[i].style.stopColor = countdown_color;
        }
    }else{
        var blocs = clock.querySelectorAll('.smalltext');
        for (var i = 0; i < blocs.length; i++) {
            blocs[i].style.backgroundColor = countdown_color;
        }
    }
    
    function updateClock() {
        var t = getTimeRemaining(dateendtime);
        if (t.total >= 0) {
            daysSpan.innerHTML = (((''+t.days).length == 1)?('0' + t.days).slice(-2): ''+t.days);
            hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
            minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
            secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
            
            if (circle === true) {
                if (circle2 == true) {
                    dayscircle.style.strokeDashoffset = initialOffsetDays - (t.days * initialOffsetDays / 365);
                    dayshours.style.strokeDashoffset = initialOffsetHours - (t.hours * initialOffsetHours / 24);
                    daysminutes.style.strokeDashoffset = initialOffsetMinutes - (t.minutes * initialOffsetMinutes / 60);
                    daysseconds.style.strokeDashoffset = initialOffsetSeconds - (t.seconds * initialOffsetSeconds / 60);
                }else{
                    dayscircle.style.strokeDashoffset = initialOffset - (t.days * initialOffset / 365);
                    dayshours.style.strokeDashoffset = initialOffset - (t.hours * initialOffset / 24);
                    daysminutes.style.strokeDashoffset = initialOffset - (t.minutes * initialOffset / 60);
                    daysseconds.style.strokeDashoffset = initialOffset - (t.seconds * initialOffset / 60);
                }
            } else if(circleClock === true) {
                path.style.strokeDashoffset = initialOffset - (((t.total/1000)/diffTime) * initialOffset);
            }
        }
        if (t.total <= 0) {
            clearInterval(timeinterval);
        }
    }

    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
}

function getOffset(selector)
{
    var path = document.querySelector(selector);
    var radius = path.attributes.r.value;
    var initialOffset = parseFloat(2*radius*Math.PI);
    return initialOffset;
}

$(function () {
    var clocks = document.querySelectorAll('.countdown');
    for (var i = 0; i < clocks.length; i++) {
        initializeClock(clocks[i]);
    }
    
});