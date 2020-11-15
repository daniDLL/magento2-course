<?php
/**
 * @author: daniDLL
 * Date: 4/11/20
 * Time: 19:35
 */

namespace Hiberus\Sample\Console\Command;

use Hiberus\Sample\Api\Data\StudentInterface;
use Hiberus\Sample\Api\StudentRepositoryInterface;
use Hiberus\Sample\Console\Command\Input\ShowStudents\ListInputValidator;
use Hiberus\Sample\Console\Command\Options\ShowStudents\ListOptions;
use Hiberus\Sample\Helper\Config;
use Hiberus\Sample\Helper\FastLoading;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Console\Cli;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

/**
 * Class ShowStudentsCommand
 * @package Hiberus\Sample\Console\Command
 */
class ShowStudentsCommand extends Command
{
    const   DETAIL_TAG  =   'detail';

    /**
     * @var ListInputValidator
     */
    protected $validator;

    /**
     * @var ListOptions
     */
    protected $listOptions;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var StudentRepositoryInterface
     */
    private $studentRepository;

    /**
     * @var FastLoading
     */
    private $fastLoading;

    /**
     * @var Config
     */
    private $config;

    /**
     * ShowStudentsCommand constructor.
     * @param ListInputValidator $validator
     * @param ListOptions $listOptions
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param StudentRepositoryInterface $studentRepository
     * @param FastLoading $fastLoading
     * @param Config $config
     * @param string|null $name
     */
    public function __construct(
        ListInputValidator $validator,
        ListOptions $listOptions,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        StudentRepositoryInterface $studentRepository,
        FastLoading $fastLoading,
        Config $config,
        string $name = null
    ) {
        $this->validator = $validator;
        $this->listOptions = $listOptions;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->studentRepository = $studentRepository;
        $this->fastLoading = $fastLoading;
        $this->config = $config;

        parent::__construct($name);
    }

    /**
     * Configure
     */
    protected function configure()
    {
        $this->setName('hiberus:students:show')
            ->setDescription('Show Students List')
            ->setDefinition($this->listOptions->getOptionsList());

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws LocalizedException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $time = microtime(true);

        if($this->config->isEnabled()) {
            $this->initFormatter($output);

            $output->writeln($this->fastLoading->getSlowValue());

            $this->process($input, $output);

            $output->writeln('Execution time: ' . (microtime(true) - $time));
        }

        return Cli::RETURN_SUCCESS;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    private function process(InputInterface $input, OutputInterface $output)
    {
        $this->validator->validate($input);

        /** @var StudentInterface $student */
        foreach ($this->getStudentList() as $student) {
            $output->writeln(
                sprintf(
                    "<%s> >> Name: %s - Birth Date: %s <%s>",
                    self::DETAIL_TAG,
                    $student->getName(),
                    $student->getBirthData(),
                    self::DETAIL_TAG
                )
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
     * @param OutputInterface $output
     */
    private function initFormatter(OutputInterface $output)
    {
        /** @var OutputFormatterInterface $outputFormatter */
        $outputFormatter = $output->getFormatter();
        $outputFormatter->setStyle(self::DETAIL_TAG, new OutputFormatterStyle('yellow'));
    }
}
