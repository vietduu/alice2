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
		var selectedIdx = parseInt($(this).find("option:selected").val());
		switch(selectedIdx){
			case 0:
			case 4:
			case 9:
			case 13:
			case 15:
			case 17:
			case 18:
			case 19:
			case 21:
			case 27:
				$(this).find("option:selected").addClass("off");
				$("#cms-detail-page .ui-summary").append(createTextbox(selectedIdx, name));
				break;
			case 1:
			case 2:
			case 3:
			case 5:
			case 6:
			case 7:
			case 8:
			case 10:
			case 12:
			case 14:
			case 20:
			case 22:
			case 23:
			case 24:
			case 25:
			case 26:
			case 28:
			case 29:
				$(this).find("option:selected").addClass("off");
				$("#cms-detail-page .ui-summary").append(createTextarea(selectedIdx, name));
				break;
			case 11:
			case 16:
				$(this).find("option:selected").addClass("off");
				$("#cms-detail-page .ui-summary").append(createCheckbox(selectedIdx, name));
				break;	
			default:
			
		}
	});



	$("#cms-detail-page #submit_btn").click(function(){
		$("#cms-detail-page").load();
		var href = window.location.href;
		var generalFolder = href.substr(href.lastIndexOf('/')+1);
		$("#cms-detail-page .ui-formRow:not(.ui-summary,.ui-submit-field)").each(function(){
			var fk_cms_folder = generalFolder;
			var fk_cms_item_type = $(this).attr("data-id");
			var content = $(this).children(".ui-formCol2").children().val();
		});
	});
});


function createTextbox(id, name) {
	var data = 	"<div class='ui-formRow' data-id=" + id + ">"
			+		"<div class='ui-formCol1'>"
			+			"<label>" + name + " </label>"
			+		"</div>"
			+		"<div class='ui-formCol2'>"
			+			"<input type='text' name='" + name + "'></input>"
			+		"</div>"
			+		"<div class='ui-formCol3'>"
			+ 			"<a class='remove' onClick='removeField(this,"+ id + ")'><img src='/alice2/public/img/icon/circle-delete.png')' alt='delete' /></a>"
			+		"</div>"
			+	"</div>";

	return data;
}

function createTextarea(id, name) {
	var data = 	"<div class='ui-formRow' data-id=" + id + ">"
			+		"<div class='ui-formCol1'>"
			+			"<label>" + name + " </label>"
			+		"</div>"
			+		"<div class='ui-formCol2'>"
			+			"<textarea></textarea>"
			+		"</div>"
			+		"<div class='ui-formCol3'>"
			+ 			"<a class='remove' onClick='removeField(this,"+ id + ")'><img src='/alice2/public/img/icon/circle-delete.png')' alt='delete' /></a>"
			+		"</div>"
			+	"</div>";

	return data;
}

function createCheckbox(id, name) {
	var data = 	"<div class='ui-formRow' data-id=" + id + ">"
			+		"<div class='ui-formCol1'>"
			+			"<label>" + name + " </label>"
			+		"</div>"
			+		"<div class='ui-formCol2'>"
			+			"<input type='checkbox' name='"+name+"'>"
			+		"</div>"
			+		"<div class='ui-formCol3'>"
			+ 			"<a class='remove' onClick='removeField(this,"+ id + ")'><img src='/alice2/public/img/icon/circle-delete.png')' alt='delete' /></a>"
			+		"</div>"
			+	"</div>";

	return data;
}

function removeField(element, id) {
	$("select[name='fk_cms_item_type']").find("option[value="+id+"]").removeClass("off");
	$(element).parent().parent().remove();
}