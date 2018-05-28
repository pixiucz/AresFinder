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
        $numberOfRecords = (int) $array['are:Odpoved']['are:Pocet_zaznamu'];

        if ($numberOfRecords <= 0) { return collect([]); }
        if ($numberOfRecords === 1) {
            $records[] = array_get($array, 'are:Odpoved.are:Zaznam');
        } else {
            $records = array_get($array, 'are:Odpoved.are:Zaznam');
        }

        $formatted = array_map(function($record) {
            return [
                'name' => array_get($record, 'are:Obchodni_firma'),
                'origin' => array_get($record, 'are:Datum_vzniku'),
                'validity' => array_get($record, 'are:Datum_platnosti'),
                'form_of_bussiness' => FOM::czechForms[array_get($record, 'are:Pravni_forma.dtt:Kod_PF', 1)],
                'ico' => array_get($record, 'are:ICO'),
                'address' => [
                    'state_code' => array_get($record, 'are:Identifikace.are:Adresa_ARES.dtt:Kod_statu'),
                    'district' => array_get($record, 'are:Identifikace.are:Adresa_ARES.dtt:Nazev_okresu'),
                    'city' => array_get($record, 'are:Identifikace.are:Adresa_ARES.dtt:Nazev_obce'),
                    'street' => array_get($record, 'are:Identifikace.are:Adresa_ARES.dtt:Nazev_ulice'),
                    'house_number' => array_get($record, 'are:Identifikace.are:Adresa_ARES.dtt:Cislo_domovni'),
                    'orientation_number' => array_get($record, 'are:Identifikace.are:Adresa_ARES.dtt:Cislo_orientacni'),
                    'zip' => array_get($record, 'are:Identifikace.are:Adresa_ARES.dtt:PSC')
                ]
            ];
        }, $records);

        return collect($formatted);
    }

}