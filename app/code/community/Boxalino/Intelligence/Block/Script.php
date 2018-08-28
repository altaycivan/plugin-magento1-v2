<?php

class Boxalino_Intelligence_Block_Script extends Mage_Core_Block_Template
{
    CONST BXL_INTELLIGENCE_STAGE_SCRIPT="//r-st.bx-cloud.com/static/ba.min.js";
    CONST BXL_INTELLIGENCE_PROD_SCRIPT="//track.bx-cloud.com/static/ba.min.js";
    CONST BXL_INTELLIGENCE_SCRIPT = "//cdn.bx-cloud.com/frontend/rc/js/ba.min.js";

    private $helper = null;

    public function setTemplate($template)
    {
        if(!$this->getHelper()->isPluginEnabled()){
            return $this;
        }
        return parent::setTemplate($template); // TODO: Change the autogenerated stub
    }

    public function getScripts()
    {
        $html = '';
        $session = Mage::getSingleton('boxalino_intelligence/session');
        $scripts = $session->getScripts(false);

        foreach ($scripts as $script) {
            $html .= $script;
        }
        $session->clearScripts();

        return $html;
    }

    public function isSearch()
    {
        $current = $this->getRequest()->getRouteName() . '/' . $this->getRequest()->getControllerName();
        return $current == 'catalogsearch/result';
    }

    /**
     * getting the upgraded script
     * @return string
     */
    public function getBaScriptServerPath()
    {
        $apiKey = Mage::getStoreConfig('bxGeneral/general/apiKey');
        $apiSecret = Mage::getStoreConfig('bxGeneral/general/apiSecret');
        if(empty($apiKey) || empty($apiSecret))
        {
            return self::BXL_INTELLIGENCE_SCRIPT;
        }
        $isDev = Mage::getStoreConfig('bxGeneral/general/dev');
        if($isDev)
        {
            return self::BXL_INTELLIGENCE_STAGE_SCRIPT;
        }

        return self::BXL_INTELLIGENCE_PROD_SCRIPT;
    }

    /**
     * @return Boxalino_Intelligence_Helper_Data
     */
    public function getHelper()
    {
        if(is_null($this->helper))
        {
            $this->helper = Mage::helper("boxalino_intelligence");
        }

        return $this->helper;
    }

    public function getAccount()
    {
        return Mage::getStoreConfig('bxGeneral/general/account_name');
    }
}
