<?php

namespace StudioEmma\Optimus\Block\Html;

class Topmenu extends \Magento\Theme\Block\Html\Topmenu
{

    /**
     *  @var \Magento\Framework\UrlInterface
     */
    protected $_url;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Data\Tree\NodeFactory $nodeFactory
     * @param \Magento\Framework\Data\TreeFactory $treeFactory
     * @param \Magento\Framework\UrlInterface $url
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Data\Tree\NodeFactory $nodeFactory,
        \Magento\Framework\Data\TreeFactory $treeFactory,
        \Magento\Framework\UrlInterface $url,
        array $data = []
    ) {
        $this->_url = $url;
        parent::__construct($context, $nodeFactory, $treeFactory, $data);
    }

    /**
     * @return string
     */
    public function getCurrentUrl()
    {
        return parse_url($this->_url->getCurrentUrl())['path'];
    }
}
