$(document).ready(function(){
	$(".left-sidebar ul li").hover(function(){
		$(this).children("a.category-tree").css("text-decoration", "underline");
		$(this).children("a.category-tree").css("color","#fff");
	}, function(){
		$(this).children("a.category-tree").css("text-decoration", "none");
		$(this).children("a.category-tree").css("color","#000");
	});

	$(".button-order").click(function(){
		document.getElementById("detail-link").click();
	});

	$("#detail-link").click(function(e){
		e.stopPropagation();
       	return true;
	});

//	$(".homepage-banner").css("width", "62%");
//	$(".header-navigation").css("line-height", $("header").css("height"));
//	$(".header-title").css("line-height", $("header").css("height"));

	var screenHeight = window.innerHeight - 30;

	var ratio = $("#product-image img").width() * 1.0 / $("#product-image img").height();

	$("#product-thumbnail img").css("height",screenHeight);

	$("#product-thumbnail img").css("width",
		$("#product-thumbnail img").css("height") * ratio);

	var height = screenHeight * ratio;

	var screenWidth = window.innerWidth;
//|| document.documentElement.clientWidth
//|| document.body.clientWidth;
	var left = 0;
	var top = 0;

	
	if (window.innerHeight > $("#product-thumbnail img").height()){
		top = (window.innerHeight - $("#product-thumbnail img").height())/2;
		left = (window.innerWidth - $("#product-image img").width())/2;
	}

	$("#product-thumbnail img").css("margin-top", top);
	$("#product-thumbnail").css("top", 0);
	$("#product-thumbnail").css("left", 0);

	if ($("#product-thumbnail").css("display") == "block"){
		alert("a");
		$(document).not($("#product-thumbnail")).click(closePopup());
	}


	/*
	 * scroll the homepage banner
	 */
/*	var numberOfBanner = $(".homepage-banner img").length;
	
	for (var i = 0; i < numberOfBanner; i++){
		$(".homepage-banner img").click(function(){
			$(".homepage-banner img").next().css("display", "block");
			$(".homepage-banner img").css("display", "none");
		});

		if (numberOfBanner == i){
			i = 0;
		}
	}*/
	var currentBanner = $("#first-banner");
	
	currentBanner.click(function(){
		if (!currentBanner.next().length){
			currentBanner.css("display","none");
			currentBanner = $("#first-banner");
			currentBanner.css("display","block");
		}
	});

	currentBanner.css("display","none");
	currentBanner = currentBanner.next();

});

function openPopup() {
	document.getElementById('product-thumbnail').style.display = "block";
}

function closePopup() {
	document.getElementById('product-thumbnail').style.display = "none";
}
