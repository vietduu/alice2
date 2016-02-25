$(document).ready(function(){
	$("#navigation .item").each(function(){
		$(this).hover(function(){
			$(this).children(".sub-menu").css("display", "block");
		}, function(){
			$(this).children(".sub-menu").css("display", "none");
		});
	});

	$("select[name='fk_cms_item_type']").on('change',function(){
		var name = $(this).find("option:selected").text();
		var selectedIdx = parseInt($(this).find("option:selected").val())+1;
		switch(selectedIdx){
			case 1:
				alert(1);
				$("#cms-detail-page").append(createForm(name));
				break;
			default:
				alert(2);
		}
	});
});


function createForm(name) {
	var data = 	"<div class='ui-formRow'>"
			+		"<div class='ui-formCol1'>"
			+			"<label>" + name + ": </label>"
			+		"</div>"
			+		"<div class='ui-formCol2'>"
			+			"<input type='text' name='" + name + "'></input>"
			+		"</div>"
			+		"<div class='ui-formRow'>"
			+	"</div>";

	return data;
}