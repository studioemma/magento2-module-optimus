<?php

namespace StudioEmma\Optimus\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;

class CartMoreButtonData implements SectionSourceInterface
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
        return ['showProductsNumber' => $this->getShowProductsNumber()];
    }

    public function getShowProductsNumber() {
        $number = $this->_scopeConfig->getValue('checkout/cart/number_of_items_mobile_cart', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if (!empty($number)) {
            return intval($number);
        } else {
            return 3;
        }
    }
}
