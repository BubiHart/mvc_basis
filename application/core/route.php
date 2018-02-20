<?php

class route_class
{

  static function start()
  {

    /*
        for ($i = 0; $i < count($routes); $i++)
        {
          echo "<br />routes[$i] = $routes[$i]<br />";
        }
    */


    $requested_uri = (string) $_SERVER['REQUEST_URI'];

    $routes = (array) explode('/', $requested_uri);


    if ($routes[2] == '')
    {
      $routes[2] = (string) "index";
    }

    $controller_name = (string) $routes[2];

    $controller_file_name = (string) "$controller_name"."_controller.php";
    $model_file_name = (string) "$controller_name"."_model.php";

    $controller_file_path = (string) dirname(__FILE__, $levels = 2)."/controllers/".$controller_file_name;
    $model_file_path = (string) dirname(__FILE__, $levels = 2)."/models/".$model_file_name;

    if (file_exists($controller_file_path))
    {
      require_once $controller_file_path;
    }
    else
    {
      route_class::error404();
    }

    if (file_exists($model_file_path))
    {
      require_once $model_file_path;
    }

    $controller_class_name = $controller_name."_controller_class";
    $controller = new $controller_class_name;
		$action_name = "action_".$controller_name;
    $action = $action_name;

		if(method_exists($controller, $action))
		{
			$controller->$action();
		}
		else
		{
			route_class::error404();
		}

  }

  function error404()
	{
    $host = 'http://'.$_SERVER['HTTP_HOST'].'/';

    header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
  }

}
