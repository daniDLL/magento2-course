<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:39
 */

namespace Hiberus\Library\Model\ResourceModel\Author\Relation;

use Hiberus\Library\Api\Data\AuthorInterface;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Hiberus\Library\Model\ResourceModel\Author;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class ReadHandler
 * @package Hiberus\Library\Model\ResourceModel\Author\Relation
 */
class ReadHandler implements ExtensionInterface
{
    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @var Author
     */
    private $resourceAuthor;

    /**
     * ReadHandler constructor.
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
     * @throws LocalizedException
     */
    public function execute($entity, $arguments = [])
    {
        if ($entity->getId()) {
            $authorBookId = $this->resourceAuthor->lookupBookIds((int)$entity->getId());
            $entity->setBookIds($authorBookId);
        }

        return $entity;
    }
}
