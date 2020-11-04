<?php
/**
 * @author: daniDLL
 * Date: 4/11/20
 * Time: 18:34
 */

namespace Hiberus\Sample\Setup\Patch\Data;

use Hiberus\Sample\Api\Data\StudentInterface;
use Hiberus\Sample\Api\Data\TeacherInterface;
use Hiberus\Sample\Api\StudentRepositoryInterface;
use Hiberus\Sample\Api\TeacherRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class LinkDataModel
 * @package Hiberus\Sample\Setup\Patch\Data
 */
class LinkDataModel implements DataPatchInterface
{
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var StudentRepositoryInterface
     */
    private $studentRepository;

    /**
     * @var TeacherRepositoryInterface
     */
    private $teacherRepository;

    /**
     * @var TeacherInterface[]
     */
    private $teacherResults;

    /**
     * LinkDataModel constructor.
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param StudentRepositoryInterface $studentRepository
     * @param TeacherRepositoryInterface $teacherRepository
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        StudentRepositoryInterface $studentRepository,
        TeacherRepositoryInterface $teacherRepository
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->studentRepository = $studentRepository;
        $this->teacherRepository = $teacherRepository;
    }

    /**
     * @return DataPatchInterface|void
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function apply()
    {
        $this->linkData();
    }

    /**
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    private function linkData()
    {
        $students = $this->getStudentList();

        /** @var StudentInterface $student */
        foreach ($students as $student) {
            $student->setTeacherIds($this->getRandomTeachers());

            $this->studentRepository->save(
                $student
            );
        }
    }

    /**
     * @return StudentInterface[]
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    private function getStudentList()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $studentResults = $this->studentRepository->getList($searchCriteria)->getItems();

        if (empty($studentResults)) {
            throw new NoSuchEntityException(
                __('No student found.')
            );
        }

        return $studentResults;
    }

    /**
     * @return TeacherInterface[]
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    private function getTeacherList()
    {
        if(null === $this->teacherResults) {
            $searchCriteria = $this->searchCriteriaBuilder->create();

            $this->teacherResults = $this->teacherRepository->getList($searchCriteria)->getItems();

            if (empty($this->teacherResults)) {
                throw new NoSuchEntityException(
                    __('No teacher found.')
                );
            }
        }

        return $this->teacherResults;
    }

    /**
     * @return array
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    private function getTeacherIds()
    {
        $teacherIds = [];

        /** @var TeacherInterface $teacher */
        foreach ($this->getTeacherList() as $teacher) {
            $teacherIds[] = $teacher->getId();
        }

        return $teacherIds;
    }

    /**
     * @return array
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    private function getRandomTeachers()
    {
        $teacherIds = $this->getTeacherIds();

        return array_rand(array_flip($teacherIds), rand(1, count($teacherIds)));
    }

    /**
     * @return string[]
     */
    public static function getDependencies()
    {
        return [
            PopulateDataModel::class
        ];
    }

    /**
     * @return string[]
     */
    public function getAliases()
    {
        return [];
    }
}
