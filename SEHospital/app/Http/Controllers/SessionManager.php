<?php

namespace App\Http\Controllers;

class SessionManager {
	public static function getSessionInfo() {
			$info = [];
	        session_start();
	        if (isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['role'])) {
	        	$id = $_SESSION['id'];
	            $name = $_SESSION['name'];
	            $role = $_SESSION['role'];
	            $info = [
	        		'id' => $id,
	        		'name' => $name,
			        'role' => $role
	    	    ];
	        };
	        session_write_close();
	        if (empty($info)) {	        	
	        	return null;
	        } else {
	        	return $info;
	        }	          
	}	
}