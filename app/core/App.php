<?php


class App
{
	private $controller = 'Home';
	private $method 	= 'index';

	private function splitURL()
	{
		$URL = $_SERVER['REQUEST_URI'] ?? 'home';
		$URL = explode("/", trim($URL,"/"));
		return $URL;	
	}

	public function loadController()
	{
        $dsn = 'mysql:host=localhost;dbname='.DBNAME.';charset=utf8';
        $db = new Database($dsn, DBUSER, DBPASS);

		$URL = $this->splitURL();

		$filename = "./app/controllers/".ucfirst($URL[0]).".php";
		if(file_exists($filename))
		{
			require $filename;
			$this->controller = ucfirst($URL[0]);
			unset($URL[0]);
		}else{

			$filename = "./app/controllers/_404.php";
			require $filename;
			$this->controller = "_404";
		}

        $server_uri = $_SERVER['REQUEST_URI'];

        $menuModel = new Menu($db);
        $menuController = new MenuController($menuModel);

        // routes
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $server_uri === '/menu/create') {
            echo $menuController->create();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && $server_uri === '/menu/get') {
            echo $menuController->get();
        }

	}	

}


