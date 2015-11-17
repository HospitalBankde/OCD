<?php

namespace App\Http\Controllers;

class SessionManager {
	public static function getSessionInfo() {
			$info = [];
	        session_start();
	        if (isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['type'])) {
	        	$id = $_SESSION['id'];
	            $name = $_SESSION['name'];
	            $type = $_SESSION['type'];
	            $info = [
	        		'id' => $id,
	        		'name' => $name,
			        'type' => $type
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