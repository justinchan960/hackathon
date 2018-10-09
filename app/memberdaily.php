<link href="js/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
<div class="box box-default" id="creation">  
    <div class="box-body">       
        <div class="panel panel-default" >
            <div class="panel-heading"> 
                <div id="heading">             
                    View member daily status        
                </div>           
            </div>            <!-- /.panel-heading -->           
            <div class="panel-body">
			 <input type="hidden" id="action" name="action" placeholder="" value="update">
				<form id="member_form">
					<input type="hidden" id="member_id" name="member_id" placeholder="">
					<div class="col-lg-12">
					  <div class="col-lg-6">
							<div class="col-lg-12">
								<div class="form-group col-md-12" style="">        
									<label for="" class="col-md-3 control-label">Username :<span style='color:red;'>&nbsp;*</span></label> 
									<div class="col-md-9">  
										<select class="form-control required" name="member_username" id="member_username">
											<option value="">-- Please Select --</option>
											<?php 
											$stmt_select_member = $mysqli->prepare("SELECT member_id,member_username FROM member");
											$stmt_select_member->execute();
											$stmt_select_member->store_result();
											$stmt_select_member->bind_result($member_id,$member_username);
											while ($stmt_select_member->fetch()) {										
											?>
											<option value="<?php echo $member_id; ?>"><?php echo $member_username; ?></option>
											<?php } ?>
										</select> 
									</div>                 
								</div>  							
							</div>
						</div>
						<div class="col-lg-6">
							<div class="col-lg-12">
								<a href="#" class="btn btn-primary" onclick="search_member()" id="create_btn">Search</a>	 							
							</div>						
						</div>			
					</div>
                </form>      
            </div>       
        </div><!-- /.panel-body -->    
    </div><!-- /.box-body -->
</div><!-- /.box -->
<div class="box box-default" id="search_result">   
   
</div><!-- /.box -->

  
<script>
	function search_member(){
		var member_username = $('#member_username').val();
		if(member_username == ""){	
			alert("Please select a member");
		}else{
			$.ajax({					
				type: "POST",
				url: '?f=memberdaily',
				beforeSend: function () {
					show_processing();
				},
				success: function (data) {
					hide_processing();
					$('#search_result').html(data);
				}
			});
		}
	}
</script>