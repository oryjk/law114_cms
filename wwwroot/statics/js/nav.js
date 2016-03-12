$(document).ready(function() {
	$('.navbtn').click(function() {
		$('.navbg').toggle(500);
		$('.searchbox').hide();
		$('.subnavbg').hide();
	});
	$('.searchbtn').click(function() {
		$('.searchbox').toggle(500);
		$('.navbg').hide();
	});
	$('.subnavbtn').click(function() {
		$('.subnavbg').slideToggle(500);
		$('.navbg').hide();
	});
});