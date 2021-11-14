<?php

namespace App\Command;

use App\Entity\CsseCovid19DailyReportUS;
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
    name: 'app:get-covid19-us-data',
    description: 'Get Covid19 data',
)]
class GetCovid19UsDataCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    private const FILES_URL = 'https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_daily_reports_us/';

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

//             $entity->setLastUpdated(isset($record['Last_Update']) ? new \DateTime($record['Last_Update']) : null);
    private function saveData(array $data)
    {
        foreach ($data as $record)
        {
            $entity = new CsseCovid19DailyReportUS();
            $entity->setProvinceState($record['Province_State'] ?? null);
            $entity->setCountryRegion($record['Country_Region'] ?? null);
            $entity->setLastUpdate(isset($record['Last_Update']) ? new \DateTime($record['Last_Update']) : null);
            $entity->setLat(isset($record['Lat']) ? (float)$record['Lat'] : null);
            $entity->setLongField(isset($record['Long_']) ? (float)$record['Long_'] : null);
            $entity->setConfirmed(isset($record['Confirmed']) ? (int)$record['Confirmed'] : null);
            $entity->setDeaths(isset($record['Deaths']) ? (int)$record['Deaths'] : null);
            $entity->setRecovered(isset($record['Recovered']) ? (int)$record['Recovered'] : null);
            $entity->setActive(isset($record['Active']) ? (int)$record['Active'] : null);
            $entity->setFips(isset($record['FIPS']) ? (int)$record['FIPS'] : null);
            $entity->setDeaths(isset($record['Deaths']) ? (int)$record['Deaths'] : null);
            $entity->setIncidentRate(isset($record['Incident_Rate']) ? (float)$record['Active'] : null);
            $entity->setTotalTestResult(isset($record['Total_Test_Results']) ? (int)$record['Total_Test_Results'] : null);
            $entity->setPeopleHospitalized(isset($record['People_Hospitalized']) ? (int)$record['People_Hospitalized'] : null);
            $entity->setCaseFatalityRatio(isset($record['Case_Fatality_Ratio']) ? (float)$record['Case_Fatality_Ratio'] : null);
            $entity->setUid(isset($record['UID']) ? (int)$record['UID'] : null);
            $entity->setIso3($record['ISO3'] ?? null);
            $entity->setTestingRate(isset($record['Testing_Rate']) ? (float)$record['Testing_Rate'] : null);
            $entity->setHospitalizationRate(isset($record['Hospitalization_Rate']) ? (float)$record['Hospitalization_Rate'] : null);

            $this->entityManager->persist($entity);
        }
        $this->entityManager->flush();
    }
}
