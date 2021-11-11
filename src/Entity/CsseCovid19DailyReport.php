<?php

namespace App\Entity;

use App\Repository\CsseCovid19DailyReportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CsseCovid19DailyReportRepository::class)
 */
class CsseCovid19DailyReport
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
    private $fips;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $admin2;

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
    private $lastUpdated;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $combinedKey;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $incidentRate;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $caseFatalityRatio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFips(): ?string
    {
        return $this->fips;
    }

    public function setFips(?string $fips): self
    {
        $this->fips = $fips;

        return $this;
    }

    public function getAdmin2(): ?string
    {
        return $this->admin2;
    }

    public function setAdmin2(?string $admin2): self
    {
        $this->admin2 = $admin2;

        return $this;
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

    public function getLastUpdated(): ?\DateTimeInterface
    {
        return $this->lastUpdated;
    }

    public function setLastUpdated(?\DateTimeInterface $lastUpdated): self
    {
        $this->lastUpdated = $lastUpdated;

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

    public function getLong�АField(): ?float
    {
        return $this->long�АField;
    }

    public function setLong�АField(?float $long�АField): self
    {
        $this->long�АField = $long�АField;

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

    public function getCombinedKey(): ?string
    {
        return $this->combinedKey;
    }

    public function setCombinedKey(?string $combinedKey): self
    {
        $this->combinedKey = $combinedKey;

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

    public function getCaseFatalityRatio(): ?float
    {
        return $this->caseFatalityRatio;
    }

    public function setCaseFatalityRatio(?float $caseFatalityRatio): self
    {
        $this->caseFatalityRatio = $caseFatalityRatio;

        return $this;
    }
}
