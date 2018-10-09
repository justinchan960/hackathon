<div class="box box-default" id="creation">  
    <div class="box-body">       
        <div class="panel panel-default" >
            <div class="panel-heading"> 
                <div id="heading">             
                    Add New Package    
                </div>           
            </div>            <!-- /.panel-heading -->           
            <div class="panel-body">
			 <input type="hidden" id="action" name="action" placeholder="" value="update">
				<form id="package_form">
					<input type="hidden" id="package_id" name="package_id" placeholder="">
					<div class="col-lg-12">
					  <div class="col-lg-6">
							<div class="col-lg-12">
								<div class="form-group col-md-12" style="">        
									<label for="" class="col-md-5 control-label">Package Amount :<span style='color:red;'>&nbsp;*</span></label> 
									<div class="col-md-7">  
										<input class="form-control required" id="package_amount" name="package_amount" placeholder="" >
									</div>                  
								</div>  							
							</div>
						</div>
					</div>
                </form>          
                <div class="form-group col-md-12" style="text-align:center">
                    <a href="#" class="btn btn-primary" onclick="create_package()" id="create_btn"><?php echo $LANG_CREATE_SAVE; ?></a>					
					<input class="btn btn-primary" id="update_btn" name="update_btn" type="button" onclick="update_package()" value="update" style="width:auto; display: none;">
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
                     Package 
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
				<div class="dataTable_wrapper table-responsive" >
					<table class="table table-striped table-advance table-hover dataTables">
						<thead>
							<tr class="pluginth">
								<th style=""><span>ID</span></th>							
								<th style=""><span>Package Amount</span></th>							
								<th style=""><span>Action</span></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i =1;
						$stmt_select_package = $mysqli->prepare("SELECT package_id,package_amount FROM package");
						$stmt_select_package->execute();
						$stmt_select_package->store_result();
						$stmt_select_package->bind_result($package_id,$package_amount);
						while ($stmt_select_package->fetch()) {
							?>
							<tr class="plugintr">							
								<td ><?php print $i++; ?></td>
								<td ><?php print $package_amount; ?></td>
								<td>
								<a href="#" class="btn btn-primary btn-xs" style="cursor:pointer;" onclick="select_package(<?php echo $package_id; ?>)"><i class="fa fa-pencil"></i></a>
								<a href="#" class="btn btn-danger btn-xs" style="cursor:pointer;" onclick="delete_(<?php echo $package_id; ?>)"><i class="fa fa-trash-o "></i></a>
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
	function select_package(package_id){		
		$.ajax({
                type: 'POST',
                dataType: 'json',
                url: '?f=package',
                data: {
					action : 'select',
					package_id :package_id
				},
                beforeSend: function () {
                    show_processing();					
                },
                success: function (data) {
                    hide_processing();					
                    if (data[0] == true) {
						$("#package_amount").val(data[1]);
						$("#package_id").val(data[2]);
						$("#create_btn").hide();
						$("#update_btn").show();
                    } else {
						alert("unsuccessful");
                    }
                }
            });
		
	}
	
	function update_package(){
		var check = true;
        var error_msg = [];
		var form_data = $('#package_form').serialize();
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
					url: '?f=package',
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
	
	function create_package(){
		var check = true;
        var error_msg = [];
		var form_data = $('#package_form').serialize();
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
				url: '?f=package',
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

	function delete_(package_id){
        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '?f=package',
                data: {
                    action: 'delete',
                    package_id: package_id
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