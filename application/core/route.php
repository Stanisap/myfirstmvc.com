<?php
/**
 * 
 */
class Route
{
	
	static function start() 
	{
		// контроллер и действия по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// плучаем имя контроллера
		if (!empty($routes[1]))
		{
			$controller_name = $routes[1];
		}

		// получаем имя экшина
		if (!empty($routes[2]))
		{
			$action_name = $routes[2];
		}

		// добавляем префиксы
		$model_name = 'Model_' . $controller_name;
		$controller_name = 'Controller_' . $controller_name;
		$action_name = 'action_' . $action_name;

		// подцепляем файл с классом модели (файла модели может и не быть)
		$model_file = strtolower($model_name) . '.php';
		$model_path = 'application/models/' . $model_file;

		if (file_exists($model_path))
		{
			include 'application/models/' . $model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name) . '.php';
		$controller_path = 'application/controllers/' . $controller_file;

		if (file_exists($controller_path))
		{
			include 'application/controllers/' . $controller_file;
		}
		else
		{
			/*правильно бы было кинуть сдесь исключение, но для упрощение
			сделаем редирект на страницу 404*/
			Route::ErrorPage404();
		}

		// создаем контоллер
		$controller = null;
		if (class_exists($controller_name)) 
		{
			// создаем контроллер
			$controller = new $controller_name;
		} 
		else 
		{
			Route::ErrorPage404();
		}

		$action = $action_name;

		if (method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			// здесь так же разумно кинуть исключения
			Route::ErrorPage404();
		}

	}

	function ErrorPage404()
	{
		$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header("Location:".  $host . '404');
	}
}