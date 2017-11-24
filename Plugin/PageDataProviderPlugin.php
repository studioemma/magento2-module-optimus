<?php

namespace StudioEmma\Optimus\Plugin;

class PageDataProviderPlugin
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Catalog\Model\Category\FileInfo
     */
    protected $_fileInfo;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\Category\FileInfo $fileInfo
    ) {
        $this->_storeManager = $storeManager;
        $this->_fileInfo = $fileInfo;
    }

    public function afterGetData(\Magento\Cms\Model\Page\DataProvider $subject, $results)
    {
        if (!empty($results)) {
            foreach ($results as &$result) {
                if (!empty($result['og_image'])) {
                    $url = $this->_storeManager->getStore()->getBaseUrl(
                        \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                    ) . 'catalog/category/' . $result['og_image'];
                    $stat = $this->_fileInfo->getStat($result['og_image']);
                    $mime = $this->_fileInfo->getMimeType($result['og_image']);
                    $ogImage = array();
                    $ogImage[0] = array();
                    $ogImage[0]['name'] = $result['og_image'];
                    $ogImage[0]['url'] = $url;
                    $ogImage[0]['size'] = isset($stat) ? $stat['size'] : 0;
                    $ogImage[0]['type'] = $mime;
                    $result['og_image'] = $ogImage;
                }
            }
        }
        return $results;
    }
}
