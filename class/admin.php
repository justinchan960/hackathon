<?php

class admin {

    private $admin_id;
    private $admin_name;
    private $admin_type;
    private $admin_email;
    private $admin_username; 
    private $admin_password; 

    function admin($admin_id, $admin_name, $admin_type, $admin_email, $admin_username,$admin_password) {
        $this->admin_id = $admin_id;
        $this->admin_name = $admin_name;
        $this->admin_type = $admin_type;
        $this->admin_email = $admin_email;
        $this->admin_username = $admin_username; 
        $this->admin_password = $admin_password; 
    }

    function getadmin_id() {
        return $this->admin_id;
    }

    function getadmin_name() {
        return $this->admin_name;
    }

    function getadmin_type() {
        return $this->admin_type;
    }

    function getadmin_email() {
        return $this->admin_email;
    }

    function getadmin_username() {
        return $this->admin_username;
    } 
	
	function getadmin_password() {
        return $this->admin_password;
    }  
}
