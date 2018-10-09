<div class="box box-default" id="creation">  
    <div class="box-body">       
        <div class="panel panel-default" >
            <div class="panel-heading"> 
                <div id="heading">             
                    Add New Member         
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
									<label for="" class="col-md-5 control-label">Login ID :<span style='color:red;'>&nbsp;*</span></label> 
									<div class="col-md-7">  
										<input class="form-control required" id="member_username" name="member_username" placeholder="" >
									</div>                  
								</div>  							
							</div>
							<div class="col-lg-12">
								<div class="form-group col-md-12" style="">        
									<label for="" class="col-md-5 control-label">Password : <span style='color:red;'>&nbsp;*</span></label> 
									<div class="col-md-7">  
										<input class="form-control required" id="member_password" name="member_password" placeholder="" >
									</div>                  
								</div>  							
							</div>
						</div>
						<div class="col-lg-6">
							<div class="col-lg-12">
								<div class="form-group col-md-12" style="">        
									<label for="" class="col-md-5 control-label">Full Name : <span style='color:red;'>&nbsp;*</span></label> 
									<div class="col-md-7">  
										<input class="form-control required" id="member_fullname" name="member_fullname" placeholder="" >
									</div>                  
								</div>  							
							</div>
							<div class="col-lg-12">
								<div class="form-group col-md-12" style="">        
									<label for="" class="col-md-5 control-label">Email : <span style='color:red;'>&nbsp;*</span></label> 
									<div class="col-md-7">  
										<input class="form-control required" id="member_email" name="member_email" placeholder="" >
									</div>                  
								</div>  							
							</div>
							<div class="col-lg-12">
								<div class="form-group col-md-12" style="">        
									<label for="" class="col-md-5 control-label">Package : <span style='color:red;'>&nbsp;*</span></label> 
									<div class="col-md-7"> 
										<select class="form-control required" name="member_package" id="member_package">
											<option value="">Choose Package</option>
											<?php 
											$stmt_select_package = $mysqli->prepare("SELECT package_id,package_amount FROM package");
											$stmt_select_package->execute();
											$stmt_select_package->store_result();
											$stmt_select_package->bind_result($package_id,$package_amount);
											while ($stmt_select_package->fetch()) {										
											?>
											<option value="<?php echo $package_id; ?>"><?php echo $package_amount; ?></option>
											<?php } ?>
										</select>                        
									</div>                 
								</div>  							
							</div>
							<div class="col-lg-12">
								<div class="form-group col-md-12" style="">        
									<label for="" class="col-md-5 control-label">Status : <span style='color:red;'>&nbsp;*</span></label> 
									<div class="col-md-7"> 
										<select class="form-control required" name="member_status" id="member_status">
											<option value="1">Active</option>
											<option value="0">Inactive</option>
										</select>                        
									</div>                 
								</div>  							
							</div>
						</div>			
					</div>
                </form>          
                <div class="form-group col-md-12" style="text-align:center">
                    <a href="#" class="btn btn-primary" onclick="create_member()" id="create_btn"><?php echo $LANG_CREATE_SAVE; ?></a>					
					<a href="#" class="btn btn-default" onclick="cancel()">Reset</a>
                </div>       
            </div>       
        </div><!-- /.panel-body -->    
    </div><!-- /.box-body -->
</div><!-- /.box -->

<script>
	
	function create_member(){
		var check = true;
        var error_msg = [];
		var form_data = $('#member_form').serialize();
		$('.required').each(function () {
            if ($.trim($(this).val()) == "")
            {
                $(this).addClass('');
                $(this).addClass('errorBorder');
                check = false;
                error_msg.push("Please fill in the mandatory field(s)");
            }
        });
		if (check) {
				$.ajax({					
					url: '?f=member',
					type: "POST",
					dataType: 'json',
					data: form_data+'&action=insert',
					beforeSend: function () {
						show_processing();
					},
					success: function (data) {
						hide_processing();
						if (data[0]) {
							alert(data[1]);
							window.location.reload();
						} else {
							alert(data[1]);
							// window.location.reload();
						}
					}
				});
			
		} else {
            alert(jQuery.unique(error_msg).join("\n"));
            $('.errorBorder:first').focus();
        }				
	}

	function delete_(member_id){
        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '?f=member_registration',
                data: {
                    action: 'delete',
                    member_id: member_id
                },
                beforeSend: function () {
                    show_processing();
                },
                success: function (data) {
                    hide_processing();
                    if (data[0] == true) {
                        alert(data[1]);
                        window.location.reload();
                    } else {
                        alert(data[1]);
                    }
                }
            });
       }

	}
</script>