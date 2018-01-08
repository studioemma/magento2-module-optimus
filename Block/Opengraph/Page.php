<?php

namespace StudioEmma\Optimus\Block\Opengraph;

class Page extends \StudioEmma\Optimus\Block\Opengraph\General
{

    /**
     * @var \Magento\Cms\Model\Page
     */
    protected $_page;

    /**
     *  @var \Magento\Catalog\Model\Category\FileInfo
     */
    protected $_fileInfo;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\View\Page\Config $pageConfig
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Locale\Resolver $localeResolver
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Cms\Model\Page $page
     * @param \Magento\Catalog\Model\Category\FileInfo $fileInfo
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Page\Config $pageConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Locale\Resolver $localeResolver,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Cms\Model\Page $page,
        \Magento\Catalog\Model\Category\FileInfo $fileInfo,
        $data = []
    ) {
        $this->_page = $page;
        $this->_fileInfo = $fileInfo;
        parent::__construct($context, $pageConfig, $storeManager, $localeResolver, $filesystem, $data);
    }

    /**
     * @return string
     */
    public function getOgImageUrl()
    {
        $image = $this->_page->getData('og_image');
        if ($image) {
            if (is_string($image)) {
                $url = $this->_storeManager->getStore()->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                ) . 'catalog/category/' . $image;
            }
        }
        if (empty($url)) {
            $url = parent::getOgImageUrl();
        }
        return $url;
    }

    /**
     * @return string
     */
    public function getOgImageType()
    {
        $image = $this->_page->getData('og_image');
        if ($image) {
            if (is_string($image)) {
                $type = $this->_fileInfo->getMimeType($image);
            }
        }
        if (empty($type)) {
            $type = parent::getOgImageType();
        }
        return $type;
    }

    /**
     * @return array
     */
    public function getOgImageDimensions()
    {
        $image = $this->_page->getData('og_image');
        if ($image) {
            if (is_string($image)) {
                $mediapath = $this->_filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath();
                $filepath = $mediapath . 'catalog/category/' . $image;
                $dimensions = getimagesize($filepath);
            }
        }
        if (empty($dimensions)) {
            $dimensions = parent::getOgImageDimensions();
        }
        return $dimensions;
    }
}
