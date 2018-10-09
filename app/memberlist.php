<div class="box box-default" id="display">
	<div class="box-body">
		<div class="panel panel-default" >
			<div class="panel-heading">
                <div id="heading">
                     Member List 
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
				<div class="dataTable_wrapper table-responsive" >
					<table class="table table-striped table-advance table-hover dataTables">
						<thead>
							<tr class="pluginth">
								<th style="width:50px;"><span>ID</span></th>
								<th style=""><span>Full Name</span></th>							
								<th style=""><span>Package</span></th>																					
								<th style=""><span>Status</span></th>																					
								<th style=""><span>Action</span></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i =1;
						$stmt_select_member = $mysqli->prepare("SELECT member_id,member_fullname,member_email,member_package,member_status FROM member");
						$stmt_select_member->execute();
						$stmt_select_member->store_result();
						$stmt_select_member->bind_result($member_id,$member_fullname,$member_email,$member_package,$member_status);
						while ($stmt_select_member->fetch()) {
							?>
							<tr class="plugintr">							
								<td ><?php print $i++; ?></td>
								<td ><?php print $member_fullname; ?></td>
								<td >$<?php echo select_name($member_package,'package_id','package_amount','package',$mysqli); ?></td>
								<td>
								<?php if($member_status == "1"){ ?>
									<span style="color:green;">Active<span>
								<?php }else{ ?>
									<span style="color:red;">Inactive<span>
								<?php } ?>
								</td>
								<td>
								<a href="#" class="btn btn-primary btn-xs" style="cursor:pointer;" onclick="select_member(<?php echo $member_id; ?>)" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></a>
								<a href="#" class="btn btn-danger btn-xs" style="cursor:pointer;" onclick="delete_(<?php echo $member_id; ?>)"><i class="fa fa-trash-o "></i></a>
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
<!--modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal_close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Member Detail</h4>
            </div>
            <div class="modal-body" id="update_content" style='overflow:auto;'>

            </div>
            <div class="modal-footer" style="text-align:center">
				<input class="btn btn-primary" id="save_btn" name="save_btn" type="button" onclick="update_member()" value="save" style="width:auto">
                <button type="button" class="btn btn-primary" data-dismiss="modal">cancel</button>               
            </div>
        </div>
    </div>
</div>
<script>
	function select_member(member_id){		
		$.ajax({
                type: 'POST',
                url: '?f=member',
                data: {
					action : 'select',
					member_id :member_id
				},
                beforeSend: function () {
                    show_processing();					
                },
                success: function (data) {
                    hide_processing();					
                    	$('#update_content').html(data);
                    
                }
            });
		
	}
	
	function update_member(){
		var check = true;
        var error_msg = [];
		var member_id = $('#hidden_member_id').val();
		var form_data = $('#member_form').serialize();
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
			$.ajax({					
				type: "POST",
				dataType: 'json',
				url: '?f=member',
				data:form_data+'&action=update'+'&member_id='+member_id,
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
        } else {
            alert(jQuery.unique(error_msg).join('\n'));
        }
	}
</script>