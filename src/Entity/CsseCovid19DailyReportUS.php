<?php

namespace App\Entity;

use App\Repository\CsseCovid19DailyReportUSRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CsseCovid19DailyReportUSRepository::class)
 */
class CsseCovid19DailyReportUS
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $provinceState;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $countryRegion;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $lastUpdate;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $lat;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longField;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $confirmed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $deaths;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $recovered;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $active;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fips;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $incidentRate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $totalTestResult;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $peopleHospitalized;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $caseFatalityRatio;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $uid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $iso3;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $testingRate;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $hospitalizationRate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProvinceState(): ?string
    {
        return $this->provinceState;
    }

    public function setProvinceState(?string $provinceState): self
    {
        $this->provinceState = $provinceState;

        return $this;
    }

    public function getCountryRegion(): ?string
    {
        return $this->countryRegion;
    }

    public function setCountryRegion(?string $countryRegion): self
    {
        $this->countryRegion = $countryRegion;

        return $this;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(?\DateTimeInterface $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLongField(): ?float
    {
        return $this->longField;
    }

    public function setLongField(?float $longField): self
    {
        $this->longField = $longField;

        return $this;
    }

    public function getConfirmed(): ?int
    {
        return $this->confirmed;
    }

    public function setConfirmed(?int $confirmed): self
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    public function getDeaths(): ?int
    {
        return $this->deaths;
    }

    public function setDeaths(?int $deaths): self
    {
        $this->deaths = $deaths;

        return $this;
    }

    public function getRecovered(): ?int
    {
        return $this->recovered;
    }

    public function setRecovered(?int $recovered): self
    {
        $this->recovered = $recovered;

        return $this;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(?int $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getFips(): ?int
    {
        return $this->fips;
    }

    public function setFips(?int $fips): self
    {
        $this->fips = $fips;

        return $this;
    }

    public function getIncidentRate(): ?float
    {
        return $this->incidentRate;
    }

    public function setIncidentRate(?float $incidentRate): self
    {
        $this->incidentRate = $incidentRate;

        return $this;
    }

    public function getTotalTestResult(): ?int
    {
        return $this->totalTestResult;
    }

    public function setTotalTestResult(?int $totalTestResult): self
    {
        $this->totalTestResult = $totalTestResult;

        return $this;
    }

    public function getPeopleHospitalized(): ?int
    {
        return $this->peopleHospitalized;
    }

    public function setPeopleHospitalized(?int $peopleHospitalized): self
    {
        $this->peopleHospitalized = $peopleHospitalized;

        return $this;
    }

    public function getCaseFatalityRatio(): ?float
    {
        return $this->caseFatalityRatio;
    }

    public function setCaseFatalityRatio(?float $caseFatalityRatio): self
    {
        $this->caseFatalityRatio = $caseFatalityRatio;

        return $this;
    }

    public function getUid(): ?int
    {
        return $this->uid;
    }

    public function setUid(?int $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getIso3(): ?string
    {
        return $this->iso3;
    }

    public function setIso3(?string $iso3): self
    {
        $this->iso3 = $iso3;

        return $this;
    }

    public function getTestingRate(): ?float
    {
        return $this->testingRate;
    }

    public function setTestingRate(?float $testingRate): self
    {
        $this->testingRate = $testingRate;

        return $this;
    }

    public function getHospitalizationRate(): ?float
    {
        return $this->hospitalizationRate;
    }

    public function setHospitalizationRate(?float $hospitalizationRate): self
    {
        $this->hospitalizationRate = $hospitalizationRate;

        return $this;
    }
}
