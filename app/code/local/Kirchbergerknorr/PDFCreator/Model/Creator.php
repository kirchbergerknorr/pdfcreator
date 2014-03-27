<?php
/**
 * User: Benedikt Volkmer
 * Mail: bv@kirchbergerknorr.de
 * Date: 04.02.14
 * Time: 16:42
*/

require_once (dirname(dirname(__FILE__))."/etc/MPDF57/mpdf.php");

class Kirchbergerknorr_PDFCreator_Model_Creator
{

    public function createKVA($xml = null, $logSysId = null)
    {
        $logSysId = 5100451159;
        $content = $this->getKVAContent($logSysId,$xml);
        $stylesheet = $this->getStylesheet('kva');
        $this->generateKva($logSysId,$stylesheet,$content);

        return;

    }

    protected function getKVAContent(&$id,&$xml)
    {
        $details = array();

        try{
            $xmlObject = new SimpleXMLElement($xml);

            $details['order_no'] = (int) $xmlObject->order_no;
            $details['repair_no'] = (int) $xmlObject->repair_no;
            $details['customer_order_no1'] = (int) $xmlObject->customer_order_no1;
            $details['date'] = (string) $xmlObject->date;
            $details['time'] = (string) $xmlObject->time;
            $details['user'] = (string) $xmlObject->user;

            foreach ($xmlObject->status_details as $node) {
                $arr = $node->attributes();
                $kind = (string) $arr['kind'][0];
                $val = (string) $node;
                $details['details'][$kind] = $val;
            }

        }catch (Exception $e) {
            echo $e->getMessage();
        }
        $block = Mage::app()->getLayout()
            ->createBlock("pdfcreator/kva")
            ->setTemplate('kirchbergerknorr/pdfcreator/kva/template.phtml');


        $block->setXmlData($details);
        $block->setLogSysId($id);
echo print_r($block->getXmlData());
        return $block->toHtml();
    }

    protected function generateKva(&$id,&$stylesheet,&$content)
    {
        $mpdf = new mPDF('en-x','A4','','');
        $mpdf->debug = true;
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
        $mpdf->WriteHTML($content);

        $path = Mage::getBaseDir('media').'/downloadable/'.substr($id,0,3).'/'.substr($id,3,3).'/'.substr($id,6,3).'/'.$id;

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }


        $mpdf->Output($path.'/'.$id.'_kva.pdf', 'F');
    }

    protected function getStylesheet($type)
    {
        return file_get_contents(dirname(dirname(__FILE__)).'/etc/templates/'.$type.'/template.css');
    }
}