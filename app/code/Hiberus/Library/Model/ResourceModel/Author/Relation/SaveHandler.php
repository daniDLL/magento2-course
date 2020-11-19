<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:39
 */

namespace Hiberus\Library\Model\ResourceModel\Author\Relation;

use Exception;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Hiberus\Library\Api\Data\AuthorInterface;
use Hiberus\Library\Model\ResourceModel\Author;

/**
 * Class SaveHandler
 * @package Hiberus\Library\Model\ResourceModel\Author\Relation
 */
class SaveHandler implements ExtensionInterface
{
    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @var Author
     */
    protected $resourceAuthor;

    /**
     * @param MetadataPool $metadataPool
     * @param Author $resourceAuthor
     */
    public function __construct(
        MetadataPool $metadataPool,
        Author $resourceAuthor
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceAuthor = $resourceAuthor;
    }

    /**
     * @param AuthorInterface $entity
     * @param array $arguments
     * @return bool|object
     * @throws Exception
     */
    public function execute($entity, $arguments = [])
    {
        $entityMetadata = $this->metadataPool->getMetadata(AuthorInterface::class);

        $connection = $entityMetadata->getEntityConnection();

        $oldBooks = $this->resourceAuthor->lookupBookIds((int)$entity->getId());
        $newBooks = (array)$entity->getBookIds();

        $table = $this->resourceAuthor->getTable('hiberus_book_author');

        $delete = array_diff($oldBooks, $newBooks);
        if ($delete) {
            $where = [
                'author_id = ?' => $entity->getId(),
                'book_id IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_diff($newBooks, $oldBooks);
        if ($insert) {
            $data = [];
            foreach ($insert as $bookId) {
                $data[] = [
                    'author_id' => $entity->getId(),
                    'book_id' => (int)$bookId
                ];
            }
            $connection->insertMultiple($table, $data);
        }

        return $entity;
    }
}
