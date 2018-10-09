        <div class="login-box login-sidebar">
            <div class="white-box">
                <form class="form-horizontal form-material" id="loginform" >
                    <br><br><br><br><br>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control"  type="text" id="admin_username" onfocus="true" onKeyDown="if (event.keyCode === 13)
									login()" placeholder="Username" autofocus/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" id="admin_password" onKeyDown="if (event.keyCode === 13)
									login()" placeholder="Password"/>
                        </div>
                    </div>
                   <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> Remember me </label>
                            </div>
						</div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">'
                            <a class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" onclick="login()">Log In</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
	</div>
<script type="text/javascript">
	function login() {
		var username = $.trim($('#admin_username').val());
		var password = $.trim($('#admin_password').val());

		if (!username) {
			$('#admin_username').val("");
			$('#admin_password').val("");
			swal('Please enter username and password');
		} else if (!password) {
			$('#admin_password').val("");
			swal('Please enter password');
		} else {
			$.ajax({
				url: '?pact=login',
				type: "POST",
				dataType: 'json',
				data: {
					username: username,
					password: password,
				},
				success: function (data) {
					if (data[0]) {
						window.location = '?loc=dashboard';
					} else {
						alert(data[1]);
						window.location.reload();
					}

				}
			});
		}
	}
</script>