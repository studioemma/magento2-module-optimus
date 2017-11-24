<?php

namespace StudioEmma\Optimus\Observer;

use Magento\Framework\Event\ObserverInterface;

class CmsPagePrepareSaveObserver implements ObserverInterface
{

    /**
     *  @var Magento\Catalog\Model\ImageUploader
     */
    protected $_imageUploader;

    /**
     * @param \Magento\Catalog\Model\ImageUploader $imageUploader
     */
    public function __construct(
        \Magento\Catalog\Model\ImageUploader $imageUploader
    ){
        $this->_imageUploader = $imageUploader;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $model = $observer->getData('page');
        $data = $model->getData();

        if (isset($data['og_image']) && is_array($data['og_image'])) {
            if (!empty($data['og_image']['delete'])) {
                $data['og_image'] = null;
            } else {
                if (isset($data['og_image'][0]['name']) && isset($data['og_image'][0]['tmp_name'])) {
                    $this->_imageUploader->moveFileFromTmp($data['og_image'][0]['file']);
                }
                $data['og_image'] = $data['og_image'][0]['name'];
            }
            $model->setData('og_image', $data['og_image']);
        }
    }
}
