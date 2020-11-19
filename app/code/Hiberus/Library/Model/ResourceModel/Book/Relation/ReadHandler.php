<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:39
 */

namespace Hiberus\Library\Model\ResourceModel\Book\Relation;

use Hiberus\Library\Api\Data\BookInterface;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Hiberus\Library\Model\ResourceModel\Book;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class ReadHandler
 * @package Hiberus\Library\Model\ResourceModel\Book\Relation
 */
class ReadHandler implements ExtensionInterface
{
    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @var Book
     */
    private $resourceBook;

    /**
     * ReadHandler constructor.
     * @param MetadataPool $metadataPool
     * @param Book $resourceBook
     */
    public function __construct(
        MetadataPool $metadataPool,
        Book $resourceBook
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceBook = $resourceBook;
    }

    /**
     * @param BookInterface $entity
     * @param array $arguments
     * @return bool|object
     * @throws LocalizedException
     */
    public function execute($entity, $arguments = [])
    {
        if ($entity->getId()) {
            $authorBookId = $this->resourceBook->lookupAuthorIds((int)$entity->getId());
            $entity->setAuthorIds($authorBookId);
        }

        return $entity;
    }
}
