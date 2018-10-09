function logout(admin_id) {
	$.ajax({
		type: 'POST',
		url: '?pact=logout',
		data: {
			admin_id: admin_id
		},
		dataType: 'json',
		success: function (data) { 
			if (data) {
				 window.location = '?p=login';
			} else {
				alert("Error Occur");
			}
			
		}
	});
} 

function show_processing(){
	var modal = "<div id=\"load_screen\"> ";
	modal = modal + "<div class=\"modal-dialog\">";
	modal+="<div class=\"modal-content\" id=\"modal_content\" style=\"margin:auto auto;\">"
	modal+="<div class=\"modal-body\">";
	modal+="<h4 class=\"modal-title\" id=\"myModalLabel\"><?php echo $LANG_PROCESSING;?></h4>"
	modal+="<div id=\"loading\"><img src=\"images/camera-loader.gif\" width=\"auto\" alt=\"\"/></div>";
	modal+="</div> ";
	modal+="</div>";
	modal+="</div>";
	modal+="</div>";
	$("#loading_screen").html(modal);
	$("#load_screen").show(); 
	return true;
}
function hide_processing(){
	$("#load_screen").hide();
	$("#loading_screen").html();
	return true;
}

function cancel(){
	location.reload();
}