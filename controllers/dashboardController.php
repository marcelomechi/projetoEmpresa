<?php

class DashboardController extends Controller{
	
	public function index(){
		$this -> loadTemplate('dashboard');
	}
}

?>