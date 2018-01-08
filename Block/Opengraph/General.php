<?php

namespace StudioEmma\Optimus\Block\Opengraph;

class General extends \Magento\Framework\View\Element\Template
{

    protected $_scope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

    /**
     *  @var \Magento\Framework\View\Page\Config
     */
    protected $_pageConfig;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\Locale\Resolver
     */
    protected $_localeResolver;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\View\Page\Config $pageConfig
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Locale\Resolver $localeResolver
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Page\Config $pageConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Locale\Resolver $localeResolver,
        $data = []
    ) {
        $this->_pageConfig = $pageConfig;
        $this->_storeManager = $storeManager;
        $this->_localeResolver = $localeResolver;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getOgSiteName()
    {
        return $this->_storeManager->getStore()->getName();
    }

    /**
     * @return string
     */
    public function getOgLocale()
    {
        return $this->_localeResolver->getLocale();
    }

    /**
     * @return string
     */
    public function getFbAppId()
    {
        return $this->_scopeConfig->getValue('socialmediachannels/facebookchannel/facebookappid', $this->_scope);
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        $title = '';
        $metaTitle = strip_tags($this->_pageConfig->getTitle()->getShort());
        if (!empty($metaTitle)) {
            $title = $metaTitle;
        }
        return $title;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        $description = '';
        $metaDescription = strip_tags($this->_pageConfig->getDescription());
        if (!empty($metaDescription)) {
            $description = $metaDescription;
        }
        return $description;
    }

    /**
     * @return string
     */
    public function getOgImageUrl()
    {
        $url = $this->getViewFileUrl('Magento_Theme::images/facebook-og-preview.jpg');
        return $url;
    }

    /**
     * @return string
     */
    public function getOgImageType()
    {
        $type = "image/jpg";
        return $type;
    }

    /**
     * @return array
     */
    public function getOgImageDimensions()
    {
        $dimensions = array('1200', '600');
        return $dimensions;
    }
}
