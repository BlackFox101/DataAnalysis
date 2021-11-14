<?php

namespace App\Command;

use App\Entity\CsseCovid19DailyReport;
use DateInterval;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[AsCommand(
    name: 'app:get-covid19-data',
    description: 'Get Covid19 US data',
)]
class GetCovid19DataCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    private const FILES_URL = 'https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_daily_reports/';

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $count = $this->getData($output);
            $output->writeln("$count csseCovid19DailyReport records added");
        }
        catch (Exception $e) {
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }
        $output->writeln('SUCCESS');
        return Command::SUCCESS;
    }

    private function getData(OutputInterface $output): int
    {
        $httpClient = HttpClient::create();
        $startDate = new \DateTime('01-01-2020');
        $endDate = new \DateTime('now');
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        $counter = 0;

        for ($date = $startDate; $date <= $endDate; $date->add(new DateInterval('P1D')))
        {
            $output->writeln($date->format('m-d-Y'));

            try {
                $data = [];
                $response = $httpClient->request(
                    'GET',
                    self::FILES_URL . $date->format('m-d-Y') . '.csv'
                );

                if ($response->getStatusCode() != 200)
                {
                    continue;
                }

                $data = $serializer->decode($response->getContent(), 'csv', []);
                $counter += count($data);

                $this->saveData($data);

            }
            catch (Exception $e)
            {
                $output->writeln($e->getMessage());
                continue;
            }
        }

        return $counter;
    }

    private function saveData(array $data)
    {
        foreach ($data as $record)
        {
            $entity = new CsseCovid19DailyReport();
            $entity->setFips($record['FIPS'] ?? null);
            $entity->setAdmin2($record['Admin2'] ?? null);
            $entity->setProvinceState($record['Province_State'] ?? null);
            $entity->setCountryRegion($record['Country_Region'] ?? null);
            $entity->setLastUpdated(isset($record['Last_Update']) ? new \DateTime($record['Last_Update']) : null);
            $entity->setLat(isset($record['Lat']) ? (float)$record['Lat'] : null);
            $entity->setLongField(isset($record['Long_']) ? (float)$record['Long_'] : null);
            $entity->setConfirmed(isset($record['Confirmed']) ? (int)$record['Confirmed'] : null);
            $entity->setDeaths(isset($record['Deaths']) ? (int)$record['Deaths'] : null);
            $entity->setRecovered(isset($record['Recovered']) ? (int)$record['Recovered'] : null);
            $entity->setActive(isset($record['Active']) ? (int)$record['Active'] : null);
            $entity->setCombinedKey($record['Combined_Key'] ?? null);
            $entity->setIncidentRate(isset($record['Incident_Rate']) ? (float)$record['Active'] : null);
            $entity->setCaseFatalityRatio(isset($record['Case_Fatality_Ratio']) ? (float)$record['Case_Fatality_Ratio'] : null);

            $this->entityManager->persist($entity);
        }
        $this->entityManager->flush();
    }
}
