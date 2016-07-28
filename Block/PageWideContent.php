<?php


/* Remark : this is now deprecated -> when using the most recent version of theme-frontend-optimus -> you can select a 1 'column wide' option on the Design tab of a cms page that does exactly the same */

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
