<?php


namespace Choco;

use Choco\App\Controllers\MainController;
use Choco\App\Model\Promo;
use Choco\Database\DB;
use Choco\Request;
use Choco\Router;

class Application
{
    /**
     * @var array
     */
    private $storage = [];

    /**
     * Запуск нашего приложения
     *
     * @return void
     */
    public function run()
    {
         $this->bindParams();
         // $this->callAction(new Router($this->getStorage('promo-service')));
         $this->callAction(new Router());
    }

    /**
     * Сохроняем параметры в контейнер
     *
     * @return void
     */
    private function bindParams() : void
    {
        $this->bind('database', require 'configs/database.php');
        $this->bind('promo-service', new Promo(
           DB::connection($this->getStorage('database'))
        ));
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    private function bind(string $name, $value) : void
    {
        $this->storage[$name] = $value;
    }

    /**
     * @param $name
     * @return array|object
     */
    public function getStorage(string $name)
    {
        return $this->storage[$name];
    }

    /**
     * @param \Choco\Router $router
     * @return string
     */
    private function callAction(Router $router)
    {
        $router->load($this);
//        if( Request::method() === 'GET' && Request::uri() === 'random-promo-service' ) {
//            return $mainController->getRandomData();
//        }
//
//        if( Request::method() === 'GET' && Request::uri() === 'promos' ) {
//            return $mainController->getAllPromo();
//        }
//
//        if( Request::method() === 'GET' && Request::uri() === 'promo-service' ) {
//            return $mainController->getPromo(17);
//        }
//
//        // promo-service/:id // delete
//        return $mainController->deletePromo(17);
    }
}
