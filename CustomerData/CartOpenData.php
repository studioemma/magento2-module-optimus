<?php

namespace StudioEmma\Optimus\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;

class CartOpenData implements SectionSourceInterface
{

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @param \Magento\Framework\View\Element\Context $context
     */
    public function __construct(\Magento\Framework\View\Element\Context $context)
    {
        $this->_scopeConfig = $context->getScopeConfig();
    }

    public function getSectionData()
    {
        return ['openCartAfterAddingProduct' => $this->getOpenCartAfterAddingProduct()];
    }

    public function getOpenCartAfterAddingProduct() {
        $open = $this->_scopeConfig->getValue('checkout/cart/open_cart_after_adding', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $redirect = $this->_scopeConfig->getValue('checkout/cart/redirect_to_cart', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if (!empty($open) && empty($redirect)) {
            return true;
        } else {
            return false;
        }
    }
}
