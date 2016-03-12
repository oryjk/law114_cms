function autoimg(){
    imgwidth=$('.imgauto').width();
    width=100;
    height=70;
    bili=width/height;
    nn=imgwidth/bili;
    $('.imgauto').attr("height",nn+"px");
    imgwidth=$('.imgauto2').width();
    width=80;
    height=100;
    bili=width/height;
    nn=imgwidth/bili;
    $('.imgauto2').attr("height",nn+"px");
}