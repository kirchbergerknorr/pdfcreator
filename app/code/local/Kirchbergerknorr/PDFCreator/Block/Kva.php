<?php

class Kirchbergerknorr_PDFCreator_Block_Kva extends Mage_Core_Block_Template{

    protected static $_xmlData;
    protected static $_logSysId;

    /**
     * Set kva data
     */
    public function setXmlData($data)
    {
        self::$_xmlData = $data;
    }
    /**
     * set logsys id
     */
    public function setLogSysId($id)
    {
        $this->$_logSysId = $id;
    }

    /**
     * LogsysID getter
     *
     * @return int
     */
    public function getLogSysId()
    {
        return (isset($this->$_logSysId)) ? $this->$_logSysId : null;
    }

    /**
     * XML Data getter
     *
     * @return array
     */
    public function getXmlData()
    {
        if(self::$_xmlData){
            return self::$_xmlData;
        }
        return null;
    }

    /**
     * Create Footer
     *
     */
    protected function getFooter()
    {
        $this->setTemplate('kirchbergerknorr/pdfcreator/kva/footer.phtml');
        return $this->toHtml();
    }

    /**
     * Create Footer
     *
     */
    protected function getHeader()
    {
        $this->setTemplate('kirchbergerknorr/pdfcreator/kva/header.phtml');
        return $this->toHtml();
    }

}