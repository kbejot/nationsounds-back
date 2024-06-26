<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\ConcertRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: ConcertRepository::class)]
#[ORM\Table(name: 'concert')]
#[ApiResource(
    denormalizationContext: ['groups' => ['concert:write']],
    normalizationContext: ['groups' => ['concert:read']]
)]
#[ApiFilter(DateFilter::class, properties: ["date", "horaire"])]
#[ApiFilter(DateFilter::class, properties: ["scene", "exact"])]
class Concert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['concert:read', 'concert:write'])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Artiste::class, inversedBy: "concerts")]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['concert:read', 'concert:write'])]
    private ?Artiste $artiste = null;
    #[ORM\ManyToOne(targetEntity: Scene::class, inversedBy: "concerts")]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['concert:read', 'concert:write'])]
    private ?Scene $scene = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['concert:read', 'concert:write'])]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Groups(['concert:read', 'concert:write'])]
    private ?\DateTimeInterface $Horaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    public function setArtiste(?Artiste $artiste): static
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getScene(): ?Scene
    {
        return $this->scene;
    }

    public function setScene(?Scene $scene): self
    {
        $this->scene = $scene;
        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    public function getHoraire(): ?\DateTimeInterface
    {
        return $this->Horaire;
    }

    public function setHoraire(\DateTimeInterface $Horaire): static
    {
        $this->Horaire = $Horaire;

        return $this;
    }
}
