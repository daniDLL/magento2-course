<?php

namespace Hiberus\Test\Block\LastProducts;

class ProductList extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     */
    private $productRepository;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteria
     */
    private $searchCriteria;

    /** 
     * @var \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder
     */
    private $sortOrderBuilder;
    
    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ){
        $this->productRepository = $productRepository;
        $this->searchCriteria = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        parent::__construct($context, $data);
    }

    /**
     * Return last added product names
     * @param int $limit Number of products to be returned
     * @return string[] Last added product names
     */
    public function getLastProducts($limit)
    {
        $productNames = [];

        // Get product list
        $productList = $this->productRepository->getList(
            $this->searchCriteria
                ->addFilter('type_id', 'configurable')
                ->addSortOrder($this->sortOrderBuilder->setField('entity_id')->setDirection('desc')->create())
                ->setPageSize($limit)
                ->create()
        )->getItems();

        foreach ($productList as $product){
            $productNames[] = $product->getName();
        }

        return $productNames;
    }

}