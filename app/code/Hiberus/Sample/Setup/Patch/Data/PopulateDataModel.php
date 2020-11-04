<?php

namespace Hiberus\Sample\Setup\Patch\Data;

use Hiberus\Sample\Api\Data\StudentInterface;
use Hiberus\Sample\Api\Data\StudentInterfaceFactory;
use Hiberus\Sample\Api\Data\TeacherInterface;
use Hiberus\Sample\Api\Data\TeacherInterfaceFactory;
use Hiberus\Sample\Api\StudentRepositoryInterface;
use Hiberus\Sample\Api\TeacherRepositoryInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\HTTP\Client\CurlFactory;

/**
 * Class PopulateDataModel
 * @package Hiberus\Sample\Setup\Patch\Data
 */
class PopulateDataModel implements DataPatchInterface
{
    const   RANDOM_PERSON_DATA_API_ENDPOINT =   'https://api.namefake.com/{{locale}}/{{gender}}/';
    const   NUMBER_OF_STUDENTS  =   10;
    const   NUMBER_OF_TEACHERS  =   10;

    /**
     * @var StudentRepositoryInterface
     */
    private $studentRepository;

    /**
     * @var StudentInterfaceFactory
     */
    private $studentFactory;

    /**
     * @var TeacherRepositoryInterface
     */
    private $teacherRepository;

    /**
     * @var TeacherInterfaceFactory
     */
    private $teacherFactory;

    /**
     * @var CurlFactory
     */
    private $curlFactory;

    /**
     * PopulateDataModel constructor.
     * @param StudentRepositoryInterface $studentRepository
     * @param StudentInterfaceFactory $studentFactory
     * @param TeacherRepositoryInterface $teacherRepository
     * @param TeacherInterfaceFactory $teacherFactory
     * @param CurlFactory $curlFactory
     */
    public function __construct(
        StudentRepositoryInterface $studentRepository,
        StudentInterfaceFactory $studentFactory,
        TeacherRepositoryInterface $teacherRepository,
        TeacherInterfaceFactory $teacherFactory,
        CurlFactory $curlFactory
    ) {
        $this->studentRepository = $studentRepository;
        $this->studentFactory = $studentFactory;
        $this->teacherRepository = $teacherRepository;
        $this->teacherFactory = $teacherFactory;
        $this->curlFactory = $curlFactory;
    }

    /**
     * @return DataPatchInterface|void
     */
    public function apply()
    {
        $this->populateData();
    }

    /**
     * Populate Data Model
     */
    private function populateData()
    {
        $this->populateTeachers();
        $this->populateStudents();
    }

    /**
     * Populate Teachers Data
     */
    private function populateTeachers()
    {
        for ($i = 0; $i < self::NUMBER_OF_TEACHERS; $i++) {
            $teacherData = $this->getRandomPersonData();

            /** @var TeacherInterface $teacher */
            $teacher = $this->teacherFactory->create();

            $teacher->setName($teacherData['name'])
                ->setBirthData($teacherData['birth_data'])
            ;

            $this->teacherRepository->save(
                $teacher
            );
        }
    }

    /**
     * Populate Students Data
     */
    private function populateStudents()
    {
        for ($i = 0; $i < self::NUMBER_OF_STUDENTS; $i++) {
            $studentData = $this->getRandomPersonData();

            /** @var StudentInterface $student */
            $student = $this->studentFactory->create();

            $student->setName($studentData['name'])
                ->setBirthData($studentData['birth_data'])
            ;

            $this->studentRepository->save(
                $student
            );
        }
    }

    /**
     * @param string $locale
     * @param string $gender
     * @return array
     */
    private function getRandomPersonData($locale = 'spanish-spain', $gender = 'random')
    {
        /** @var Curl $curl */
        $curl = $this->curlFactory->create();
        $curl->setTimeout(5);

        $apiEndpoint = self::RANDOM_PERSON_DATA_API_ENDPOINT;
        $uri = str_replace('{{locale}}', $locale, $apiEndpoint);
        $uri = str_replace('{{gender}}', $gender, $uri);

        $curl->get($uri);

        return json_decode($curl->getBody(), true);
    }

    /**
     * @return string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return string[]
     */
    public function getAliases()
    {
        return [];
    }
}
