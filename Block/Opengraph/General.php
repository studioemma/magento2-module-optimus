<?php

namespace StudioEmma\Optimus\Block\Opengraph;

class General extends \Magento\Framework\View\Element\Template
{

    /**
     *  @var \Magento\Framework\View\Page\Config
     */
    protected $_pageConfig;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\View\Page\Config $pageConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Page\Config $pageConfig,
        $data = []
    ) {
        $this->_pageConfig = $pageConfig;
        parent::__construct($context, $data);
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
