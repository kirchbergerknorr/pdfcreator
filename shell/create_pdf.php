<?php
require_once "../app/Mage.php";
require_once 'abstract.php';

Mage::app('admin');
Mage::setIsDeveloperMode(true);

class Kirchbergerknorr_Shell_PDF extends Mage_Shell_Abstract
{
    public function run()
    {
        $string = '<status>
                      <status_id>1010</status_id>
                      <status_text>Estimate of costs forwarded</status_text>
                      <status_details kind="KVA_Reptext01">Displaytausch, Firmware Update notwendig</status_details>
                      <status_details kind="KVA_Reptext02">Für eine Repartur benötigen wir Ihr Bios PW</status_details>
                      <status_details kind="KVA_Waehrung">EUR</status_details>       
                      <status_details kind="KVA_Preis">120.89</status_details>              
                      <status_details kind="KVA_Versand">6.80</status_details>            
                      <status_details kind="KVA_Preis_unrepariert">0.00</status_details>        
                      <status_details kind="KVA_Preis_verwurf">30.00</status_details>             
                      <status_details kind="KVA_ET01_Text">Display</status_details>  
                      <status_details kind="KVA_ET01_Preis">57.34</status_details>    
                      <status_details kind="KVA_ET02_Text">Schraube</status_details>             
                      <status_details kind="KVA_ET02_Preis">0.00</status_details>       
                      <order_no>5100451159</order_no>
                      <repair_no />
                      <customer_order_no1>KundenAuftragNr</customer_order_no1>
                      <date>2014-01-20</date>
                      <time>15:13:42</time>
                      <user>SYS</user>
                    </status>';
        $creator = new Kirchbergerknorr_PDFCreator_Model_Creator;
        $creator->createKVA($string);
    }
}

$shell = new Kirchbergerknorr_Shell_PDF();
$shell->run();