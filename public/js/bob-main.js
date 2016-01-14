$(document).ready(function(){
	$("#navigation .item").each(function(){
		$(this).hover(function(){
			$(this).children(".sub-menu").css("display", "block");
		}, function(){
			$(this).children(".sub-menu").css("display", "none");
		});
	});
});