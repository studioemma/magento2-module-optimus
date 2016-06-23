<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace StudioEmma\Optimus\Controller\Index;

/**
 * Responsible for loading page content.
 *
 * This is a basic controller that only loads the corresponding layout file. It may duplicate other such
 * controllers, and thus it is considered tech debt. This code duplication will be resolved in future releases.
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Page\Config */
    private $pageConfig;

    /** @var \Magento\Framework\View\Result\PageFactory */
    private $pageFactory;


    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Page\Config $pageConfig,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        parent::__construct($context);
        $this->pageConfig = $pageConfig;
        $this->pageFactory = $pageFactory;
    }
    /**
     * Load the page defined in view/frontend/layout/samplenewpage_index_index.xml
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $this->pageConfig->addBodyClass('page-content-examples');
        $this->pageConfig->addBodyClass('cms-page-view');
        $this->pageConfig->addBodyClass('cms-page');
        return $this->pageFactory->create();
    }
}
