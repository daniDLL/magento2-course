<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:39
 */

namespace Hiberus\Library\Model\ResourceModel\Book\Relation;

use Exception;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Hiberus\Library\Api\Data\BookInterface;
use Hiberus\Library\Model\ResourceModel\Book;

/**
 * Class SaveHandler
 * @package Hiberus\Library\Model\ResourceModel\Book\Relation
 */
class SaveHandler implements ExtensionInterface
{
    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @var Book
     */
    protected $resourceBook;

    /**
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
     * @throws Exception
     */
    public function execute($entity, $arguments = [])
    {
        $entityMetadata = $this->metadataPool->getMetadata(BookInterface::class);

        $connection = $entityMetadata->getEntityConnection();

        $oldAuthors = $this->resourceBook->lookupAuthorIds((int)$entity->getId());
        $newAuthors = (array)$entity->getAuthorIds();

        $table = $this->resourceBook->getTable('hiberus_book_author');

        $delete = array_diff($oldAuthors, $newAuthors);
        if ($delete) {
            $where = [
                'book_id = ?' => $entity->getId(),
                'author_id IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_diff($newAuthors, $oldAuthors);
        if ($insert) {
            $data = [];
            foreach ($insert as $authorId) {
                $data[] = [
                    'book_id' => $entity->getId(),
                    'author_id' => (int)$authorId
                ];
            }
            $connection->insertMultiple($table, $data);
        }

        return $entity;
    }
}
