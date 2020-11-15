<?php

namespace Hiberus\Test\Block\RecoverPassword;

class CustomerTotal extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
     */
    private $customerRepository;
    
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteria
     */
    private $searchCriteriaBuilder;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ){
        $this->customerRepository = $customerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    /**
     * Return total number of registered customers
     * @return int Total number of registered customers
     */
    public function getTotalCustomers()
    {
        return count($this->customerRepository->getList($this->searchCriteriaBuilder->addFilter('entity_id', 0, 'gt')->create())->getItems());
    }

}