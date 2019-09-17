<?php
	class Controller {
		
		public function loadView($viewName, $viewData = array()){
			extract($viewData);
			require 'views/'.$viewName.'/'.$viewName.'.php';
		}

		public function loadViewAjax($viewName, $viewAjax, $viewData = array()){
			extract($viewData);
			require 'views/'.$viewName.'/'.$viewAjax.'.php';
		}
	

	/* aqui puxa o template do site (tudo que é exibido em todas as páginas, no caso o menu) */

	public function loadTemplate($viewName, $viewData = array()){
		require 'views/template/template.php';
	}

	/* aqui ele vai carregar os dados do view no template que eu selecionei */

	public function loadViewInTemplate($viewName, $viewData = array()){
		extract($viewData); // o extract serve para extrair os dados do array e transformar em variáveis
		require 'views/'.$viewName.'/'.$viewName.'.php';
	}


	}

?>