<script type="text/javascript">
//Logout Function
function logout($admin_id) {
	
	if (confirm("<?php echo $LANG_LOGOUT_ALERT;?>")) {
		$.ajax({
			type: 'POST',
			url: '?pact=logout',
			data: {
				admin_id: $admin_id
			},
			dataType: 'json',
			success: function (data) { 
				if (data) {
					 window.location = '?p=login';
				} else {
					alert("<?php echo $LANG_ERROR_ALERT;?>");
				}
				
			}
		});
	}
} 
//Display Time
function DisplayTime() {
    var month = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    var weekday = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
    var CurrentDate = new Date();
	var language = "<?php echo $language;?>";

	var currentTime = CurrentDate.toLocaleTimeString();
	var currentDate = CurrentDate.toLocaleDateString(); 
    
    var currentDate = weekday[CurrentDate.getDay()] + ", " + CurrentDate.getDate() + " " + month[CurrentDate.getMonth()] + " " + CurrentDate.getFullYear();
    $("#curTime").html(currentTime);
    setTimeout("DisplayTime()", 1000);
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

$(document).ready(function(){
	 //Display Time
    DisplayTime();
});

function cancel(){
	location.reload();
}
</script>