<?php

namespace StudioEmma\Optimus\Block;

class PageWideContent extends \Magento\Framework\View\Element\Template
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();

        // Add the css class 'page-wide-content' to the body
        $this->pageConfig->addBodyClass('page-wide-content');
    }

    public function getPageConfig()
    {
        return $this->pageConfig;
    }
}
