<?php

namespace StudioEmma\Optimus\Block\Opengraph;

class Page extends \Magento\Framework\View\Element\Template
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
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Cms\Model\Page $page
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Filesystem $filesystem
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Cms\Model\Page $page,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Filesystem $filesystem,
        $data = []
    ) {
        $this->_page = $page;
        $this->_storeManager = $storeManager;
        $this->_filesystem = $filesystem;
        parent::__construct($context, $data);
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
                $fileInfo = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Catalog\Model\Category\FileInfo');
                $type = $fileInfo->getMimeType($image);
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
