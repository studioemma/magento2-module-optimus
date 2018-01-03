<?php

namespace StudioEmma\Optimus\Block\Product;

/**
 * Product View block with access to config
 */
class ConfigView extends \Magento\Catalog\Block\Product\View
{

    public function getConfig()
    {
        return $this->_scopeConfig;
    }
}
