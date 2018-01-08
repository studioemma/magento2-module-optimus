<?php

namespace StudioEmma\Optimus\Block\Opengraph;

class Category extends \StudioEmma\Optimus\Block\Opengraph\General
{
    /**
     * @param \Magento\Framework\Registry $registry
     */
    protected $_registry;

    /**
     * @param string
     */
    protected $_categoryImage;

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
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Catalog\Model\Category\FileInfo $fileInfo
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Page\Config $pageConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Locale\Resolver $localeResolver,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\Category\FileInfo $fileInfo,
        $data = []
    ) {
        $this->_registry = $registry;
        $this->_fileInfo = $fileInfo;
        parent::__construct($context, $pageConfig, $storeManager, $localeResolver, $filesystem, $data);
    }

    /**
     * @return string
     */
    public function getOgType()
    {
        return 'product.group';
    }

    /**
     * @return string
     */
    protected function getCategoryImage()
    {
        if (empty($this->_categoryImage)) {
            $category = $this->_registry->registry('current_category');
            $this->_categoryImage = $category->getData('image');
        }
        return $this->_categoryImage;
    }

    /**
     * @return string
     */
    public function getOgImageUrl()
    {
        $image = $this->getCategoryImage();
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
        $image = $this->getCategoryImage();
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
        $image = $this->getCategoryImage();
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
