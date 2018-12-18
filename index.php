<?
	require_once 'app\core\Autoload.php';
	ini_set('display_errors', 1);
    use app\core\Router;
	 
    
	(new Router())->run();
	
	?>