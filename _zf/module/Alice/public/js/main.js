$(document).ready(function(){
	$(".left-sidebar ul li").hover(function(){
		$(this).children("a.category-tree").css("text-decoration", "underline");
		$(this).children("a.category-tree").css("color","#fff");
	}, function(){
		$(this).children("a.category-tree").css("text-decoration", "none");
		$(this).children("a.category-tree").css("color","#000");
	});

	$(".homepage-banner").css("width", "62%");
//	$(".header-navigation").css("line-height", $("header").css("height"));
//	$(".header-title").css("line-height", $("header").css("height"));
});
