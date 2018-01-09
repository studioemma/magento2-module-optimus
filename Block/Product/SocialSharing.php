<?php

namespace StudioEmma\Optimus\Block\Product;

class SocialSharing extends \Magento\Catalog\Block\Product\View
{
    protected $_scope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

    public function canRender()
    {
        return !empty($this->_scopeConfig->getValue('socialmediageneral/general/enablesharing', $this->_scope));
    }

    public function canRenderChannel($channel)
    {
        return !empty($this->_scopeConfig->getValue('socialmediachannels/'.$channel.'channel/enable'.$channel.'sharing', $this->_scope));
    }

    public function getAddThisCode()
    {
        return $this->_scopeConfig->getValue('socialmediageneral/addthis/addthisinstallcode', $this->_scope) . $this->_scopeConfig->getValue('socialmediageneral/addthis/addthisinlinesharebuttons', $this->_scope);
    }
}
