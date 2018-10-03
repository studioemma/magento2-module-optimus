<?php

namespace StudioEmma\Optimus\Block;

class Navigation extends \Magento\Catalog\Block\Navigation
{
    /**
     *  @var \Magento\Catalog\Model\CategoryFactory
     */
    protected $_categoryFactory;

    /**
     * @var array
     */
    protected $_categories;

    /**
     * @var bool
     */
    protected $_bShowColumns;

    /**
     * @var int
     */
    protected $_columnCount;

    /**
     * @var int
     */
    protected $_categoriesCount;

    /**
     * @var int
     */
    protected $_nofItemsPerColumn;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Catalog\Model\CategoryFactory $categoryFactory
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Catalog\Model\Layer\Resolver $layerResolver
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param \Magento\Catalog\Helper\Category $catalogCategory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Catalog\Model\Indexer\Category\Flat\State $flatState
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        \Magento\Framework\App\Http\Context $httpContext,
        \Magento\Catalog\Helper\Category $catalogCategory,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\Indexer\Category\Flat\State $flatState,
        array $data = []
    ) {
        $this->_categoryFactory = $categoryFactory;
        parent::__construct($context, $categoryFactory, $productCollectionFactory, $layerResolver, $httpContext, $catalogCategory, $registry, $flatState, $data);
    }

    /**
     * @return \Magento\Catalog\Model\Category
     */
    public function getCategoryById($id)
    {
        return $this->_categoryFactory->create()->load($id);
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        if (isset($this->_categories)) {
            return $this->_categories;
        }
        $this->_categories = [];
        if (empty($this->getSelectedCategoryIds())) {

            if (!empty($this->getSelectedParentCategoryId())){
                $currentCategory = $this->getCategoryById($this->getSelectedParentCategoryId());
            } else {
                $currentCategory = $this->getCurrentCategory();
            }
            if ($currentCategory->hasChildren()) {
                foreach ($currentCategory->getChildrenCategories() as $category) {
                    $_cat = $this->getCategoryById($category->getId());
                    if ($_cat->getIsActive() && ($_cat->getIncludeInMenu() || empty($this->getOnlyCatsIncludedInMenu()))) {
                        $this->_categories[] = $_cat;
                    }
                }
            }
        } else {

            $selected_categories = explode(',', $this->getSelectedCategoryIds());
            foreach ($selected_categories as $category) {
                $_cat = $this->getCategoryById($category);
                if ($_cat->getIsActive() && ($_cat->getIncludeInMenu() || empty($this->getOnlyCatsIncludedInMenu()))) {
                    $this->_categories[] = $_cat;
                }
            }
        }

        return $this->_categories;
    }

    /**
     * @return int
     */
    public function nofItemsPerColumn()
    {
        if (isset($this->_nofItemsPerColumn)) {
            return $this->_nofItemsPerColumn;
        }
        $this->columnCount();
        return $this->_nofItemsPerColumn;
    }

    /**
     * @return bool
     */
    public function bShowColumns()
    {
        if (isset($this->_bShowColumns)) {
            return $this->_bShowColumns;
        }
        $this->columnCount();
        return $this->_bShowColumns;
    }

    /**
     *  @return int
     */
    public function categoriesCount()
    {
        if (isset($this->_categoriesCount)) {
            return $this->_categoriesCount;
        }
        $this->_categoriesCount = count($this->getCategories());
        return $this->_categoriesCount;
    }

    /**
     *  @return int
     */
    public function columnCount()
    {
        if (isset($this->_columnCount)) {
            return $this->_columnCount;
        }
        $bShowColumns = false;
        $nofItemsPerColumn = $this->categoriesCount();
        $columnCount = (int)$this->getColumnCount();

        //When no columncount has been requested, there's only 1 column
        if ($columnCount == 0) {
            $columnCount = 1;
        }

        //When requested column count exceeds number of items in total, set the requested columns to the number of items
        if ($columnCount > $nofItemsPerColumn) {
            $columnCount = $nofItemsPerColumn;
        }

        // At least 1 item per column should be available, otherwise, lower the columncount
        // When columnCount > 1 -> show colm-grid and set nofItemsPerColumn
        if ($columnCount > 1) {
            $bShowColumns = true;
            $nofItemsPerColumn = ceil($nofItemsPerColumn/$columnCount);

            $totalCount = $columnCount * $nofItemsPerColumn;
            $diff = abs($this->categoriesCount() - $totalCount);
            if ($diff > $nofItemsPerColumn) {
                $columnCount--;
            }
        }
        $this->_bShowColumns = $bShowColumns;
        $this->_columnCount = $columnCount;
        $this->_nofItemsPerColumn = $nofItemsPerColumn;
        return $this->_columnCount;
    }

    /**
     *  @return array
     */
    public function getSubcategories($category)
    {
        $subcategories = [];
        if ($category->hasChildren()) {
            foreach ($category->getChildrenCategories() as $childCategory) {
                $subcategory = $this->getCategoryById($childCategory->getId());
                if ($subcategory->getIsActive() && ($subcategory->getIncludeInMenu() || empty($this->getOnlyCatsIncludedInMenu()))){
                    $subcategories[] = $subcategory;
                }

            }
        }
        return $subcategories;
    }

}
