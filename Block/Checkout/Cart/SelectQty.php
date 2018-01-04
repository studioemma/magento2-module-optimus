<?php

namespace StudioEmma\Optimus\Block\Checkout\Cart;

class SelectQty extends \Magento\Framework\View\Element\Template
{

    /**
     *  @var int
     */
    protected $_qty = 1;

    /**
     *  @var int[]
     */
    protected $_qtyOptions;

    public function getQty() {
        return $this->_qty;
    }

    public function setQty($qty) {
        $this->_qty = $qty;
        return $this;
    }

    public function getQtyOptions () {
        if (!empty($this->_qtyOptions)) {
            return $this->_qtyOptions;
        } else {
            $options = [];
            $optionsStr = $this->_scopeConfig->getValue('checkout/cart/select_qty_options', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            if (!empty($optionsStr)) {
                // remove all evil characters
                $optionsStr = preg_replace('/[^0-9\,\-]+/', '', $optionsStr);
                // remove double comma's and dashes
                $optionsStr = preg_replace('/\,+/', ',', rtrim($optionsStr, ','));
                $optionsStr = preg_replace('/\-+/', '-', rtrim($optionsStr, '-'));
                // split on ,
                $optionParts = explode(',', $optionsStr);
                foreach ($optionParts as $optionPart) {
                    $optionRange = explode('-', $optionPart);
                    if (count($optionRange) == 1) {
                        $optionInt = intval($optionRange[0]);
                        if ($optionInt) {
                            $options[] = $optionInt;
                        }
                    }
                    if (count($optionRange) > 1) {
                        $optionStart = intval($optionRange[0]);
                        $optionEnd = intval($optionRange[1]);
                        if ($optionStart && $optionEnd && $optionStart < $optionEnd) {
                            $options = array_merge($options, range($optionStart, $optionEnd));
                        }
                    }
                }
            }
            if (empty($options)) {
                $this->_qtyOptions = [1, 2, 3];
            } else {
                $this->_qtyOptions = $options;
            }
            return $this->_qtyOptions;
        }
    }

    public function isEnabled() {
        return !empty($this->_scopeConfig->getValue('checkout/cart/select_qty_enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE));
    }
}
