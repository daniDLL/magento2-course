<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:35
 */

namespace Hiberus\Library\Model;

use Hiberus\Library\Api\Data\BookInterfaceFactory;
use Hiberus\Library\Api\Data\BookSearchResultsInterface;
use Hiberus\Library\Model\ResourceModel\Book\Collection;
use Hiberus\Library\Model\ResourceModel\Book\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Hiberus\Library\Api\Data;
use Hiberus\Library\Api\BookRepositoryInterface;
use Hiberus\Library\Model\ResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Class BookRepository
 * @package Hiberus\Library\Model
 */
class BookRepository implements BookRepositoryInterface
{
    /**
     * @var \Hiberus\Library\Model\ResourceModel\Book
     */
    private $resourceBook;

    /**
     * @var BookInterfaceFactory
     */
    private $bookFactory;

    /**
     * @var CollectionFactory
     */
    private $bookCollectionFactory;

    /**
     * @var Data\BookSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param \Hiberus\Library\Model\ResourceModel\Book $resourceBook
     * @param BookInterfaceFactory $bookFactory
     * @param CollectionFactory $bookCollectionFactory
     * @param Data\BookSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    function __construct(
        ResourceModel\Book $resourceBook,
        BookInterfaceFactory $bookFactory,
        CollectionFactory $bookCollectionFactory,
        Data\BookSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resourceBook = $resourceBook;
        $this->bookFactory = $bookFactory;
        $this->bookCollectionFactory = $bookCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param Data\BookInterface|AbstractModel $book
     * @return Data\BookInterface
     * @throws CouldNotSaveException
     */
    public function save(Data\BookInterface $book)
    {
        try {
            $this->resourceBook->save($book);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $book;
    }

    /**
     * @param int $bookId
     * @return Data\BookInterface
     * @throws NoSuchEntityException
     */
    public function getById($bookId)
    {
        /** @var Data\BookInterface|AbstractModel $book */
        $book = $this->bookFactory->create();
        $this->resourceBook->load($book, $bookId);
        if (!$book->getId()) {
            throw new NoSuchEntityException(__('Book with id "%1" does not exist', $bookId));
        }
        return $book;
    }

    /**
     * @param Data\BookInterface|AbstractModel $book
     * @return bool|Data\BookInterface
     * @throws CouldNotSaveException
     */
    public function delete(Data\BookInterface $book)
    {
        try {
            $this->resourceBook->delete($book);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $book;
    }

    /**
     * @param int $bookId
     * @return bool|Data\BookInterface
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function deleteById($bookId)
    {
        return $this->delete($this->getById($bookId));
    }

    /**
     * Retrieve books matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return BookSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->bookCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var Data\BookSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
