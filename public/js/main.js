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

	var screenWidth = window.innerWidth;
//|| document.documentElement.clientWidth
//|| document.body.clientWidth;
	var left = -(screenWidth - $("#product-thumbnail img").width())/2.0;

	var screenHeight = window.innerHeight;
//|| document.documentElement.clientHeight
//|| document.body.clientHeight;
	var top = -(screenHeight - $("#product-thumbnail img").height())/2.0;

	$("#product-thumbnail").css("left", left);
	$("#product-thumbnail").css("top", top);
});

function openPopup() {
	document.getElementById('product-thumbnail').style.display = "block";
}
