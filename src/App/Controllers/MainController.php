<?php


namespace Choco\App\Controllers;

use Choco\App\Model\Promo;
use Choco\Helpers;

class MainController
{
    /**
     * @param Promo $promo
     * @return string
     */
    public function index(Promo $promo) : string
    {
        // Загружаем csv данные в базу
        $promo->loadCSV('data.csv');

        // Выбираем случайную запись и меняем его статус
        $randomPromo = $promo->randomPromo();

        // Выбираем все записи
        $allPromo = $promo->allPromo();

        return Helpers::view('home.php', compact('randomPromo', 'allPromo'));
    }
}
