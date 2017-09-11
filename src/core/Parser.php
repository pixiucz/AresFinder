<?php namespace Pixiucz\AresFinder\Core;

use Nathanmac\Utilities\Parser\Parser as XMLParser;
use Pixiucz\AresFinder\Enums\FormOfBussiness as FOM;

class Parser
{
    private $xmlParser;

    public function __construct()
    {
        $this->xmlParser = new XMLParser();
    }

    public function parse($rawData)
    {
        $array = $this->xmlParser->xml($rawData);

        if ($array['are:Odpoved']['are:Pocet_zaznamu'] == 0) { return []; }
        if ($array['are:Odpoved']['are:Pocet_zaznamu'] == 1) {
            $records[] = array_get($array, 'are:Odpoved.are:Zaznam');
        } else {
            $records = array_get($array, 'are:Odpoved.are:Zaznam');
        }

        $formatted = array_map(function($record) {
            return [
                'Name' => array_get($record, 'are:Obchodni_firma'),
                'Origin' => array_get($record, 'are:Datum_vzniku'),
                'Validity' => array_get($record, 'are:Datum_platnosti'),
                'Legal form of bussiness' => FOM::czechForms[array_get($record, 'are:Pravni_forma.dtt:Kod_PF', 1)],
                'ICO' => array_get($record, 'are:ICO'),
                'Address' => [
                    'State code' => array_get($record, 'are:Identifikace.are:Adresa_ARES.dtt:Kod_statu'),
                    'District' => array_get($record, 'are:Identifikace.are:Adresa_ARES.dtt:Nazev_okresu'),
                    'City' => array_get($record, 'are:Identifikace.are:Adresa_ARES.dtt:Nazev_obce'),
                    'Street' => array_get($record, 'are:Identifikace.are:Adresa_ARES.dtt:Nazev_ulice'),
                    'House number' => array_get($record, 'are:Identifikace.are:Adresa_ARES.dtt:Cislo_domovni'),
                    'Orientation number' => array_get($record, 'are:Identifikace.are:Adresa_ARES.dtt:Cislo_orientacni'),
                    'Zip' => array_get($record, 'are:Identifikace.are:Adresa_ARES.dtt:PSC')
                ]
            ];
        }, $records);

        return $formatted;
    }

}