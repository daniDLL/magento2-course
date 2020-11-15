<?php

namespace Hiberus\Test\Block\SimpleProducts;

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
    
    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ){
        $this->productRepository = $productRepository;
        $this->searchCriteria = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    /**
     * Return some simple product names
     * @param int $limit Number of products to be returned
     * @return string[] Simple product names
     */
    public function getSimpleProducts($limit)
    {
        $productNames = [];

        // Get product list
        $productList = $this->productRepository->getList(
            $this->searchCriteria
                ->addFilter('type_id', 'simple')
                ->setPageSize($limit)
                ->create()
        )->getItems();

        foreach ($productList as $product){
            $productNames[] = $product->getName();
        }

        return $productNames;
    }

}