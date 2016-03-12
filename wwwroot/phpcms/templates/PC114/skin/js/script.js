/* 
* @Author: Charlie
* @Date:   2014-11-07
* @Last Modified by:   Charlie
* @Last Modified time: 2015-03-20 14:00:56
*/
$(function(){
	jQuery(".banner").slide({
		mainCell:".bd ul",
		effect:"leftLoop",
		autoPlay:true,
		interTime:5000
	});
});
$(function(){
	jQuery(".inner_banner").slide({
		mainCell:".bd ul",
		effect:"fold",
		autoPlay:true,
		delayTime:3000,
		interTime:5000
	});
});
$(function(){
	jQuery(".left1_slide").slide({
		titCell:".smallImg li",
		mainCell:".bigImg",
		effect:"fold",
		autoPlay:true,
		delayTime:200,
		interTime:3000
	});
});
$(function(){
	jQuery(".left2_slide").slide({
		mainCell:".bd ul",
		effect:"leftLoop",
		autoPlay:true,
		interTime:3000
	});
});
$(function(){
	jQuery(".index_left7").slide();
});
$(function(){
    jQuery(".nav").slide({
        type:"menu",
        titCell:".m",
        targetCell:".sub",
        effect:"slideDown",
        delayTime:200,
        triggerTime:0,
        returnDefault:true
    });
});
$(function(){
    jQuery(".voqr").click(function() {
    	jQuery(".qr").toggle()
    });
});
$(function(){
	var divcss = {
		background: 'none',
		width:'40px',
		height:'40px',
		overflow:'inherit',
		padding:'0px',
		};
	$("#ckepop a .jtico").css(divcss); 
});
function myfunction(){  
	var divcss = {
		background: 'none',
		width:'40px',
		height:'40px',
		overflow:'inherit',
		padding:'0px',
		};
	$("#ckepop a .jtico").css(divcss);  
};
