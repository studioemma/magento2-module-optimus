<?php

namespace StudioEmma\Optimus\Plugin;

class CheckCartEditActionPlugin
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

    public function afterToHtml(\Magento\Checkout\Block\Cart\Item\Renderer\Actions\Edit $subject, $results)
    {
        $configValue = $this->_scopeConfig->getValue('checkout/cart/show_edit_button', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if (!empty($configValue)) {
            return $results;
        } else {
            return '';
        }
    }
}
