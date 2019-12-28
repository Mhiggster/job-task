<?php


namespace Choco;

use Choco\Request;

class Router
{
    private $pathCache = [];

    public function load(Application $app)
    {
        // require from another file // routes.php
        $this->get('/random-promo', 'MainController@getRandomData');
        $this->get('/promos', 'MainController@getAllPromo');
        $this->get('/promo', 'MainController@getPromo');
        $this->get('/links', 'MainController@links');
        $this->delete('/promo', 'MainController@deletePromo');

        try {
            $this->callRouting($app);
        } catch (\Exception $e) {
            echo Helpers::jsonResponse(
            [
                'erros_status' => 404,
                'error_message' => 'page not found',
            ], 200);
        }
    }

    public function get($uri, $controller)
    {
        $this->pathCache['GET'][trim($uri, '/')] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->pathCache['POST'][trim($uri, '/')] = $controller;
    }

    public function delete($uri, $controller)
    {
        $this->pathCache['DELETE'][trim($uri, '/')] = $controller;
    }

    public function put($uri, $controller)
    {
        $this->pathCache['PUT'][trim($uri, '/')] = $controller;
    }

    public function callRouting($app)
    {
        $path = explode('/', Request::uri());
        $controller = $this->pathCache[Request::method()][array_shift($path)];

        if ( isset($controller) ) {
            $handlers = explode('@', $controller);
            $controllerClass = '\Choco\App\Controllers\\'.$handlers[0];

            return call_user_func_array(array(new $controllerClass($app->getStorage('promo-service')), $handlers[1]), $path);
        }

        throw new \Exception('Controller Not Found');
    }
}