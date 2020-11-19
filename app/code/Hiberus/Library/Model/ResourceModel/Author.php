<?php
/**
 * @author: daniDLL
 * Date: 18/11/20
 * Time: 20:36
 */

namespace Hiberus\Library\Model\ResourceModel;

use Exception;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Hiberus\Library\Api\Data\AuthorInterface;

/**
 * Class Author
 * @package Hiberus\Library\Model\ResourceModel
 */
class Author extends AbstractDb
{
    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param Context $context
     * @param MetadataPool $metadataPool
     * @param EntityManager $entityManager
     * @param string|null $connectionName
     */
    public function __construct(
        Context $context,
        MetadataPool $metadataPool,
        EntityManager $entityManager,
        $connectionName = null
    ) {
        $this->metadataPool = $metadataPool;
        $this->entityManager = $entityManager;
        parent::__construct($context, $connectionName);
    }

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(AuthorInterface::TABLE, AuthorInterface::ID);
    }

    /**
     * Get all Book IDs for an author
     *
     * @param int $authorId
     * @return array
     * @throws LocalizedException
     * @throws Exception
     */
    public function lookupBookIds($authorId)
    {
        $connection = $this->getConnection();

        $entityMetadata = $this->metadataPool->getMetadata(AuthorInterface::class);
        $linkField = $entityMetadata->getLinkField();

        $select = $connection->select()
            ->from(['hba' => $this->getTable('hiberus_book_author')], 'book_id')
            ->join(
                ['auth' => $this->getMainTable()],
                'auth.' . $linkField . ' = hba.' . $linkField,
                []
            )
            ->where('hba.' . $entityMetadata->getIdentifierField() . ' = :author_id');

        return $connection->fetchCol($select, ['author_id' => (int)$authorId]);
    }

    /**
     * {@inheritDoc}
     */
    public function save(AbstractModel $object)
    {
        $this->entityManager->save($object);
        return $this;
    }

    /**
     * @param AbstractModel $object
     * @param mixed $value
     * @param null $field
     * @return AbstractDb|mixed
     */
    public function load(AbstractModel $object, $value, $field = null)
    {
        return $this->entityManager->load($object, $value);
    }

    /**
     * @param AbstractModel $object
     * @return AbstractDb|void
     * @throws Exception
     */
    public function delete(AbstractModel $object)
    {
        $this->entityManager->delete($object);
    }
}
