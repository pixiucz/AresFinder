<?php namespace Pixiucz\AresFinder;

use Pixiucz\AresFinder\Core\Parser;

class AresFinder
{
    const ARES = "http://wwwinfo.mfcr.cz/cgi-bin/ares/darv_std.cgi?";

    private $parser;

    public function __construct()
    {
        $this->parser = app('AresParser');
    }

    public function findByIco(string $ico)
    {
        if (!$this->isIcoValid($ico)) {
            return [
                'msg' => 'Ico is not valid'
            ];
        }
        $url = self::ARES . 'ico=' . $ico;
        return $this->getFromUrl($url);
    }

    public function findByName($name)
    {
        $url = self::ARES . 'Obchodni_firma=' . rawurlencode($name);
        return $this->getFromUrl($url);
    }

    private function isIcoValid($ico)
    {
        if (strlen(preg_replace("/[^0-9]/", "", $ico)) === 8) {
            return true;
        }
        return false;
    }

    private function getFromUrl($url)
    {
        $rawData = file_get_contents($url);
        return $this->parser->parse($rawData);
    }
}