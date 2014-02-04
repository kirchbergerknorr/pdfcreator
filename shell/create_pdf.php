<?php
require_once "../app/Mage.php";
require_once 'abstract.php';

Mage::app('admin');
Mage::setIsDeveloperMode(true);

class Kirchbergerknorr_Shell_PDF extends Mage_Shell_Abstract
{
    public function run()
    {
        $creator = new Kirchbergerknorr_PDFCreator_Model_Creator;
        $creator->createPDF();
    }
}

$shell = new Kirchbergerknorr_Shell_PDF();
$shell->run();