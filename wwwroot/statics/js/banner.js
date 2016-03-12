(function(window) {
    if (window.addEventListener) {
        window.addEventListener('DOMContentLoaded',
        function() {
            slider('.big-pic-in', '.pic-list', 'a', '.slide-dot', 'span', 'slide-dot-cur', 300, 8000);
            //slider('.slide', '.slide-con', '.slide-item', '.tab-nav', 'a', 'tab-nav-cur', 300);
            function slider(slide, slideCon, slideItem, nav, navItem, navCur, delay, autoTime) {
                var slides = document.querySelectorAll(slide),
                navs = document.querySelectorAll(nav),
                length = slides.length;

                for (var i = 0; i < length; i++) {
                    new Slider(slides[i], slideCon, slideItem, navs[i], navItem, navCur, delay, autoTime);
                }
            }
            function Slider(slide, slideCon, slideItem, nav, navItem, navCur, delay, autoTime) {
                var slide = slide,
                slideCon = slide.querySelector(slideCon),
                slideItem = slide.querySelectorAll(slideItem),
                nav = nav,
                navItem = nav.querySelectorAll(navItem),
                navCur = navCur,
                delay = delay,
                autoTime = autoTime || false,
                length = slideItem.length,
                temp,
                cur = 0,
                x,
                y,
                startX,
                startY,
                dx,
                dy,
                dir = {
                    left: false
                },
                isTouch = false,
                isBegin = false,
                isMove = false,
                isEnd = true,
                autoT;
                var width = slide.clientWidth;
                window.addEventListener('resize',
                function() {
                    width = slide.clientWidth;
                },
                false);
                function autoPlay() {
                    if (autoTime < 4 * delay || isBegin || isMove || !isEnd) {
                        return;
                    }
                    autoT = setTimeout(function() {
                        isEnd = false;
                        temp = cur;
                        cur = cur === length - 1 ? 0 : cur + 1;
                        Slider.addClass(slideCon, 'transition');
                        Slider.removeClass(navItem[temp], navCur);
                        Slider.addClass(navItem[cur], navCur);
                        Slider.transform(slideCon, ( - cur * 100 / length) + '%');
                        setTimeout(function() {
                            Slider.removeClass(slideCon, 'transition');
                            isEnd = true;
                            autoPlay();
                        },
                        delay);
                    },
                    autoTime);
                }
                function clearPlay() {
                    try {
                        clearTimeout(autoT);
                    } catch(e) {
                        return;
                    }
                }
                var aaa = 0;
                this.start = function(e) {
                    clearPlay();
                    if (!isEnd) {
                        return;
                    }
                    isBegin = true;
                    x = y = 0;
                    if (e.targetTouches) {
                        isTouch = true;
                        startX = e.targetTouches[0].clientX;
                        startY = e.targetTouches[0].clientY;
                    } else {
                        startX = e.clientX;
                        startY = e.clientY;
                    }
                };
                this.move = function(e) {
                    clearPlay();
                    if (!isBegin) {
                        return;
                    }
                    isMove = true;
                    var tempX, tempY;
                    if (isTouch) {
                        tempX = e.targetTouches[0].clientX;
                        tempY = e.targetTouches[0].clientY;
                    } else {
                        tempX = e.clientX;
                        tempY = e.clientY;
                    }
                    dx = tempX - startX;
                    dy = tempY - startY;
                    startX = tempX;
                    startY = tempY;
                    x += dx;
                    y += dy;
                    if (dir.horizontal === undefined) {
                        if (Math.abs(dx) > Math.abs(dy)) {
                            dir.horizontal = true;
                        } else {
                            dir.horizontal = false;
                        }
                    }
                    if (dir.horizontal) {
                        e.preventDefault();
                        if ((cur === 0 && x > 0) || (cur === length - 1 && x < 0)) {
                            Slider.transform(slideCon, ((x / 6 / width - cur) * 100 / length) + '%');
                        } else {
                            Slider.transform(slideCon, ((x / width - cur) * 100 / length) + '%');
                        }
                    } else {
                        isBegin = false;
                        isMove = false;
                        isEnd = true;
                        delete dir.horizontal;
                        return;
                    }
                };
                this.end = function(e) {
                    if (!isBegin || !isMove) {
                        isBegin = false;
                        isMove = false;
                        isEnd = true;
                        delete dir.horizontal;
                        autoPlay();
                        return;
                    }
                    isEnd = false;
                    isBegin = false;
                    isMove = false;
                    Slider.addClass(slideCon, 'transition');
                    temp = cur;
                    if (x > 0) {
                        cur = cur === 0 ? 0 : cur - 1;
                    } else {
                        cur = cur === length - 1 ? length - 1 : cur + 1;
                    }
                    Slider.removeClass(navItem[temp], navCur);
                    Slider.addClass(navItem[cur], navCur);
                    Slider.transform(slideCon, ( - cur * 100 / length) + '%');
                    setTimeout(function() {
                        x = 0;
                        Slider.removeClass(slideCon, 'transition');
                        isEnd = true;
                        autoPlay();
                    },
                    delay);
                    delete dir.horizontal;
                };
                slideCon.addEventListener('touchstart', this.start, false);
                slideCon.addEventListener('touchmove', this.move, false);
                slideCon.addEventListener('touchend', this.end, false);
                slideCon.addEventListener('touchcancel', this.end, false);
                slideCon.addEventListener('mousedown', this.start, false);
                slideCon.addEventListener('mousemove', this.move, false);
                slideCon.addEventListener('mouseup', this.end, false);
                slideCon.addEventListener('mouseout', this.end, false);
                autoPlay();
            }
            Slider.transform = function(element, x, y, z) {
                x = x || 0;
                y = y || 0;
                z = z || 0;
                var style = element.style;
                if (typeof x === 'string' && (x.indexOf('%') || y.indexOf('%' || z.indexOf('%')))) {
                    style.WebkitTransform = 'translate3d(' + x + ', ' + y + ', ' + z + ')';
                    style.MozTransform = 'translate(' + x + ', ' + y + ')';
                    style.OTransform = 'translate(' + x + ', ' + y + ')';
                    style.transform = 'translate(' + x + ', ' + y + ')';
                } else {
                    style.WebkitTransform = 'translate3d(' + x + '%, ' + y + '%, ' + z + '%)';
                    style.MozTransform = 'translate(' + x + '%, ' + y + '%)';
                    style.OTransform = 'translate(' + x + '%, ' + y + '%)';
                    style.transform = 'translate(' + x + '%, ' + y + '%)';
                }
            };
            Slider.addClass = function(element, className) {
                var temp = element.className;
                element.className = temp + ' ' + className;
            }
            Slider.removeClass = function(element, className) {
                var temp = element.className;
                temp = temp.split(' ');
                for (var i = 0,
                length = temp.length; i < length; i++) {
                    if (temp[i] === className) {
                        temp.splice(i, 1);
                        break;
                    }
                }
                element.className = temp.join(' ');
            }
        },
        false);
    }
})(window);