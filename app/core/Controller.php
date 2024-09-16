<?php 


Trait Controller
{

    public function safe($request_data)
    {
        $safe_data = strip_tags($request_data);
        $safe_data = htmlentities($safe_data, ENT_COMPAT, 'UTF-8');
        $safe_data = stripslashes($safe_data);
        $safe_data = htmlspecialchars($safe_data);

        return str_replace("&amp;zwnj;", "&zwnj;", $safe_data);
    }

	public function view($name, $data = [])
	{
		if(!empty($data))
			extract($data);
		
		$filename = "./app/views/".$name.".view.php";
		if(file_exists($filename))
		{
			require $filename;
		}else{

			$filename = "./app/views/404.view.php";
			require $filename;
		}
	}

    public function response($data, $httpCode = 200)
    {
        ob_start();
        ob_clean();
        header_remove();
        header("Content-type: application/json; charset=utf-8");
        http_response_code($httpCode);
        echo json_encode($data);
        exit();
    }
}