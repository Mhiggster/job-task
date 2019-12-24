<?php


namespace Choco;


class Helpers
{
    /**
     * @param string $fileName
     * @return string
     */
    public static function fullPath(string $fileName) : string
    {
        return $_SERVER['DOCUMENT_ROOT']."/views/".$fileName;
    }

    /**
     * @param string $fileName
     * @return string
     */
    public static function checkFile(string $fileName) : string
    {
        return file_exists(self::fullPath($fileName));
    }

    /**
     * @param string $fileName
     * @return array
     */
    public static function parseCsv(string $fileName) : array
    {
        $result = [];
        if( self::checkFile($fileName) ) {
            if (($handle = fopen(self::fullPath($fileName), "r")) !== false) {
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    $result[] = explode(";", array_shift($data));
                }
                fclose($handle);
            }
            array_shift($result);
            return $result;
        } else {
            echo 'Файла нет';
        }

    }

    /**
     * @param string $templateName
     * @param array $data
     * @return string
     */
    public static function view(string $templateName, array $data = []) : string
    {
        extract($data);

        return require self::fullPath($templateName);
    }

    /**
     * @return array
     */
    public static function converterList() : array
    {
        return [
            "а" => "a",
            "ый" => "iy",
            "ые" => "ie",
            "б" => "b",
            "в" => "v",
            "г" => "g",
            "д" => "d",
            "е" => "e",
            "ё" => "yo",
            "ж" => "zh",
            "з" => "z",
            "и" => "i",
            "й" => "y",
            "к" => "k",
            "л" => "l",
            "м" => "m",
            "н" => "n",
            "о" => "o",
            "п" => "p",
            "р" => "r",
            "с" => "s",
            "т" => "t",
            "у" => "u",
            "ф" => "f",
            "х" => "kh",
            "ц" => "ts",
            "ч" => "ch",
            "ш" => "sh",
            "щ" => "shch",
            "ь" => "",
            "ы" => "y",
            "ъ" => "",
            "э" => "e",
            "ю" => "yu",
            "я" => "ya",
            "йо" => "yo",
            "ї" => "yi",
            "і" => "i",
            "є" => "ye",
            "ґ" => "g"
        ];
    }

    /**
     * @param string $str
     * @return string
     */
    public static function generateURL(string $str) : string
    {
        $str = strtr(mb_strtolower($str), self::converterList());

        $str = preg_replace("/(?![.=$'€%-])\p{P}/u", "-", $str);

        $str = preg_replace("/\s+/", "-", $str);

        $str = trim(preg_replace('/-+/', '-', $str), "-");
        return $str;

    }

    /**
     * @param array $promos
     * @return array
     */
    public static function addSlugable(array $promos) : array
    {
        $result = [];
        foreach ($promos as $promo) {
            $promo['link'] = self::generateURL(
                $promo['id'].' '.$promo['name']
            );
            $result[] = $promo;
        }
        return $result;
    }
}
