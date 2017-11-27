<?php

namespace StudioEmma\Optimus\Block\Opengraph;

class Page extends \StudioEmma\Optimus\Block\Opengraph\General
{

    /**
     * @var \Magento\Cms\Model\Page
     */
    protected $_page;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     *  @var \Magento\Framework\Filesystem
     */
    protected $_filesystem;

    /**
     *  @var \Magento\Catalog\Model\Category\FileInfo
     */
    protected $_fileInfo;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\View\Page\Config $pageConfig
     * @param \Magento\Cms\Model\Page $page
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Catalog\Model\Category\FileInfo $fileInfo
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Page\Config $pageConfig,
        \Magento\Cms\Model\Page $page,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Catalog\Model\Category\FileInfo $fileInfo,
        $data = []
    ) {
        $this->_page = $page;
        $this->_storeManager = $storeManager;
        $this->_filesystem = $filesystem;
        $this->_fileInfo = $fileInfo;
        parent::__construct($context, $pageConfig, $data);
    }

    /**
     * @return string
     */
    public function getOgImageUrl()
    {
        $url = $this->getViewFileUrl('Magento_Theme::images/facebook-og-preview.jpg');
        $image = $this->_page->getData('og_image');
        if ($image) {
            if (is_string($image)) {
                $url = $this->_storeManager->getStore()->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                ) . 'catalog/category/' . $image;
            }
        }
        return $url;
    }

    /**
     * @return string
     */
    public function getOgImageType()
    {
        $type = "image/jpg";
        $image = $this->_page->getData('og_image');
        if ($image) {
            if (is_string($image)) {
                $type = $this->_fileInfo->getMimeType($image);
            }
        }
        return $type;
    }

    /**
     * @return array
     */
    public function getOgImageDimensions()
    {
        $dimensions = array('1200', '600');
        $image = $this->_page->getData('og_image');
        if ($image) {
            if (is_string($image)) {
                $mediapath = $this->_filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath();
                $filepath = $mediapath . 'catalog/category/' . $image;
                $dimensions = getimagesize($filepath);
            }
        }
        return $dimensions;
    }
}
