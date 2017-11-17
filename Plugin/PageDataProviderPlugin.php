<?php

namespace StudioEmma\Optimus\Plugin;

class PageDataProviderPlugin
{

    private $_storeManager;

    public function __construct(\Magento\Store\Model\StoreManagerInterface $storeManager) {
        $this->_storeManager = $storeManager;
    }

    public function afterGetData(\Magento\Cms\Model\Page\DataProvider $subject, $results)
    {
        if (!empty($results)) {
            foreach ($results as &$result) {
                if (!empty($result['og_image'])) {
                    $fileInfo = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Catalog\Model\Category\FileInfo');
                    $url = $this->_storeManager->getStore()->getBaseUrl(
                        \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                    ) . 'catalog/category/' . $result['og_image'];
                    $stat = $fileInfo->getStat($result['og_image']);
                    $mime = $fileInfo->getMimeType($result['og_image']);
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
