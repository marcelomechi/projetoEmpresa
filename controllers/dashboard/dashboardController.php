<?php

class DashboardController extends Controller{
	
	public function index(){
		$_SESSION['relatorio'] = 'Dashboard';

		$dados = array(
			'relatorio' => 'Dashboard'
		);

		$this -> loadTemplate('dashboard',$dados);
	}
}

?>