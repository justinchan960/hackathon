<div class="box box-default" id="creation">  
    <div class="box-body">       
        <div class="panel panel-default" >
            <div class="panel-heading"> 
                <div id="heading">             
                    Add New Admin         
                </div>           
            </div>            <!-- /.panel-heading -->           
            <div class="panel-body">
			 <input type="hidden" id="action" name="action" placeholder="" value="update">
				<form id="admin_form">
					<input type="hidden" id="admin_id" name="admin_id" placeholder="">
					<div class="col-lg-12">
					  <div class="col-lg-6">
							<div class="col-lg-12">
								<div class="form-group col-md-12" style="">        
									<label for="" class="col-md-5 control-label">Login ID :<span style='color:red;'>&nbsp;*</span></label> 
									<div class="col-md-7">  
										<input class="form-control required" id="admin_username" name="admin_username" placeholder="" >
									</div>                  
								</div>  							
							</div>
							<div class="col-lg-12">
								<div class="form-group col-md-12" style="">        
									<label for="" class="col-md-5 control-label">Password :<span style='color:red;'>&nbsp;*</span></label> 
									<div class="col-md-7">  
										<input class="form-control required" id="admin_password" name="admin_password" placeholder="" >
									</div>                  
								</div>  							
							</div>
						</div>
						<div class="col-lg-6">
							<div class="col-lg-12">
								<div class="form-group col-md-12" style="">        
									<label for="" class="col-md-5 control-label">Admin Name :<span style='color:red;'>&nbsp;*</span></label> 
									<div class="col-md-7">  
										<input class="form-control required" id="admin_name" name="admin_name" placeholder="" >
									</div>                  
								</div>  							
							</div>
							<div class="col-lg-12">
								<div class="form-group col-md-12" style="">        
									<label for="" class="col-md-5 control-label">Admin Email :</label> 
									<div class="col-md-7">  
										<input class="form-control" id="admin_email" name="admin_email" placeholder="" >
									</div>                  
								</div>  							
							</div>
						</div>
					</div>
                </form>          
                <div class="form-group col-md-12" style="text-align:center">
                    <a href="#" class="btn btn-primary" onclick="create_admin()" id="create_btn"><?php echo $LANG_CREATE_SAVE; ?></a>					
					<input class="btn btn-primary" id="update_btn" name="update_btn" type="button" onclick="update_admin()" value="update" style="width:auto; display: none;">
                    <a href="#" class="btn btn-default" onclick="cancel()">Reset</a>
                </div>       
            </div>       
        </div><!-- /.panel-body -->    
    </div><!-- /.box-body -->
</div><!-- /.box -->


<div class="box box-default" id="display">
	<div class="box-body">
		<div class="panel panel-default" >
			<div class="panel-heading">
                <div id="heading">
                     Admin 
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
				<div class="dataTable_wrapper table-responsive" >
					<table class="table table-striped table-advance table-hover dataTables">
						<thead>
							<tr class="pluginth">
								<th style="width:50px;"><span>ID</span></th>
								<th style=""><span>Name</span></th>
								<th style=""><span>Email</span></th>								
								<th style=""><span>Action</span></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i =1;
						$stmt_select_member = $mysqli->prepare("SELECT admin_id,admin_name,admin_email,admin_username,admin_type FROM admin");
						$stmt_select_member->execute();
						$stmt_select_member->store_result();
						$stmt_select_member->bind_result($admin_id, $admin_name, $admin_email, $admin_username,$admin_type);
						while ($stmt_select_member->fetch()) {
							?>
							<tr class="plugintr">							
								<td ><?php print $i++; ?></td>
								<td ><?php print $admin_name; ?></td>
								<td ><?php print $admin_email; ?></td>
								<td>
								<a href="#" class="btn btn-primary btn-xs" style="cursor:pointer;" onclick="select_admin(<?php echo $admin_id; ?>)"><i class="fa fa-pencil"></i></a>
								<a href="#" class="btn btn-danger btn-xs" style="cursor:pointer;" onclick="delete_(<?php echo $admin_id; ?>)"><i class="fa fa-trash-o "></i></a>
								</td>
							</tr>
						<?php }
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function select_admin(admin_id){		
		$.ajax({
                type: 'POST',
                dataType: 'json',
                url: '?f=admin_registration',
                data: {
					action : 'select',
					admin_id :admin_id
				},
                beforeSend: function () {
                    show_processing();					
                },
                success: function (data) {
                    hide_processing();					
                    if (data[0] == true) {
						$("#admin_name").val(data[1]);
						$("#admin_username").val(data[2]);
						// $("#admin_password").val(data[3]);
						$("#admin_email").val(data[4]);
						$("#admin_id").val(data[6]);
						$("#create_btn").hide();
						$("#update_btn").show();
                    } else {
						alert("unsuccessful");
                    }
                }
            });
		
	}
	
	function update_admin(){
		var check = true;
        var error_msg = [];
		var form_data = $('#admin_form').serialize();
        $('.required').each(function () {
            if ($(this).val() == "") {
                $(this).addClass('errorBorder');
                check = false;
                error_msg.push("<?php echo $LANG_REQUIRED ?>");
            } else {
                $(this).removeClass('errorBorder');
            }
        });
        if (check) {
            if (confirm('<?php echo $LANG_CONFIRM; ?>')) {
				$.ajax({					
					type: "POST",
					dataType: 'json',
					url: '?f=admin_registration',
					data:form_data+'&action=update',
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
						}
					}
				});
            }
        } else {
            alert(jQuery.unique(error_msg).join('\n'));
        }
	}
	
	function create_admin(){
		var check = true;
        var error_msg = [];
		var form_data = $('#admin_form').serialize();
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
			if(confirm("Are you sure want to proceed")){
				$.ajax({					
					url: '?f=admin_registration',
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
			}
		} else {
            alert(jQuery.unique(error_msg).join("\n"));
            $('.errorBorder:first').focus();
        }				
	}

	function delete_(admin_id){
        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '?f=admin_registration',
                data: {
                    action: 'delete',
                    admin_id: admin_id
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