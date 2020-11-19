<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:35
 */

namespace Hiberus\Library\Model;

use Hiberus\Library\Api\Data\AuthorInterfaceFactory;
use Hiberus\Library\Api\Data\AuthorSearchResultsInterface;
use Hiberus\Library\Model\ResourceModel\Author\Collection;
use Hiberus\Library\Model\ResourceModel\Author\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Hiberus\Library\Api\Data;
use Hiberus\Library\Api\AuthorRepositoryInterface;
use Hiberus\Library\Model\ResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Class AuthorRepository
 * @package Hiberus\Library\Model
 */
class AuthorRepository implements AuthorRepositoryInterface
{
    /**
     * @var \Hiberus\Library\Model\ResourceModel\Author
     */
    private $resourceAuthor;

    /**
     * @var AuthorInterfaceFactory
     */
    private $authorFactory;

    /**
     * @var CollectionFactory
     */
    private $authorCollectionFactory;

    /**
     * @var Data\AuthorSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param \Hiberus\Library\Model\ResourceModel\Author $resourceAuthor
     * @param AuthorInterfaceFactory $authorFactory
     * @param CollectionFactory $authorCollectionFactory
     * @param Data\AuthorSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    function __construct(
        ResourceModel\Author $resourceAuthor,
        AuthorInterfaceFactory $authorFactory,
        CollectionFactory $authorCollectionFactory,
        Data\AuthorSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resourceAuthor = $resourceAuthor;
        $this->authorFactory = $authorFactory;
        $this->authorCollectionFactory = $authorCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param Data\AuthorInterface|AbstractModel $author
     * @return Data\AuthorInterface
     * @throws CouldNotSaveException
     */
    public function save(Data\AuthorInterface $author)
    {
        try {
            $this->resourceAuthor->save($author);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $author;
    }

    /**
     * @param int $authorId
     * @return Data\AuthorInterface
     * @throws NoSuchEntityException
     */
    public function getById($authorId)
    {
        /** @var Data\AuthorInterface|AbstractModel $author */
        $author = $this->authorFactory->create();
        $this->resourceAuthor->load($author, $authorId);
        if (!$author->getId()) {
            throw new NoSuchEntityException(__('Author with id "%1" does not exist', $authorId));
        }
        return $author;
    }

    /**
     * @param Data\AuthorInterface|AbstractModel $author
     * @return bool|Data\AuthorInterface
     * @throws CouldNotSaveException
     */
    public function delete(Data\AuthorInterface $author)
    {
        try {
            $this->resourceAuthor->delete($author);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $author;
    }

    /**
     * @param int $authorId
     * @return bool|Data\AuthorInterface
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function deleteById($authorId)
    {
        return $this->delete($this->getById($authorId));
    }

    /**
     * Retrieve authors matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return AuthorSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->authorCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var Data\AuthorSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
