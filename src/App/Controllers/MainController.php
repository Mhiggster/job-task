<?php


namespace Choco\App\Controllers;

use Choco\App\Model\Promo;
use Choco\Helpers;

class MainController
{
    private $promo;

    /**
     * MainController constructor.
     * @param Promo $promo
     */
    public function __construct(Promo $promo)
    {
        $this->promo = $promo;
        // Загружаем csv данные в базу
        $this->promo->loadCSV('data.csv');
    }

    /**
     * @return string
     */
    public function index() : string
    {
        return Helpers::view('home.php');
    }

    public function getRandomData()
    {
        echo Helpers::jsonResponse(
            array_merge(
                $this->promo->getResponseMessage(),
                $this->promo->randomPromo()
            ), 200
        );
    }

    public function getAllPromo()
    {
        echo Helpers::jsonResponse(
            array_merge(
                $this->promo->getResponseMessage(),
                $this->promo->allPromo()
            ), 200
        );
    }

    public function getPromo(int $id)
    {
        echo Helpers::jsonResponse(
            array_merge(
                $this->promo->getResponseMessage(),
                $this->promo->promo($id)
            ), 200
        );
    }

    public function deletePromo($id)
    {
        echo Helpers::jsonResponse(
            array_merge(
                $this->promo->getResponseMessage(),
                    $this->promo->deletePromo($id)
            ), 200
        );
    }
}
