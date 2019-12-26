<?php


namespace Choco\App\Model;

use Choco\Database\QueryBuilder;
use Choco\Helpers;

class Promo extends QueryBuilder
{
    /**
     * @var string
     */
    public $table = 'promo';

    /**
     * Promo constructor.
     * @param $pdo
     */
    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->createTable();
    }

    /**
     * @param string $csvName
     */
    public function loadCSV(string $csvName) : void
    {
        $this->insertToTable(
            Helpers::parseCsv($csvName)
        );
    }

    /**
     * @param array $data
     */
    private function insertToTable(array $data)
    {
        foreach($data as $chunk)
        {
            $this->insert([
                'id' => $chunk[0],
                'name' => $chunk[1],
                'start_date' => strtotime(date('Y-m-d', strtotime($chunk[2]))),
                'end_date' => strtotime(date('Y-m-d', strtotime($chunk[3]))),
                'status' => $chunk[4]
            ]);
        }
    }

    /**
     * @return array
     */
    public function randomPromo() : array
    {
        $promo = $this->selectRandom();
        $promo['status'] = ($promo['status'] === 'Off') ? 'On' : 'Off';
        return ['content' => $promo];
    }

    /**
     * @return array
     */
    public function allPromo() : array
    {
        return ['content' => Helpers::addSlugable($this->all())];
    }


    public function promo($id)
    {
        return ['content' => $this->find($id)];
    }

    public function deletePromo($id)
    {
        return ['deleted' => $this->delete($id)];
    }
}
