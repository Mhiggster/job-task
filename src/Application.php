<?php


namespace Choco;

use Choco\App\Controllers\MainController;
use Choco\App\Model\Promo;
use Choco\Database\DB;
use Choco\Request;

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
         $this->callAction(new MainController($this->getStorage('promo')));
    }

    /**
     * Сохроняем параметры в контейнер
     *
     * @return void
     */
    private function bindParams() : void
    {
        $this->bind('database', require 'configs/database.php');
        $this->bind('promo', new Promo(
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
    private function getStorage(string $name)
    {
        return $this->storage[$name];
    }

    /**
     * @param MainController $mainController
     * @return string
     */
    private function callAction(MainController $mainController)
    {
        if( Request::method() === 'GET' && Request::uri() === 'random-promo' ) {
            return $mainController->getRandomData();
        }

        if( Request::method() === 'GET' && Request::uri() === 'promos' ) {
            return $mainController->getAllPromo();
        }

        if( Request::method() === 'GET' && Request::uri() === 'promo' ) {
            return $mainController->getPromo(17);
        }

        // promo/:id // delete
        return $mainController->deletePromo(17);
    }
}
