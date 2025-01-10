<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $ingredient = null;

    #[ORM\ManyToOne(inversedBy: 'pizzas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pate $pate = null;

    /**
     * @var Collection<int, ingredient>
     */
    #[ORM\ManyToMany(targetEntity: Ingredient::class,mappedBy:"otheringredient")]
    private Collection $otheringredient;

    public function __construct()
    {
        $this->otheringredient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIngredient(): ?string
    {
        return $this->ingredient;
    }

    public function setIngredient(string $ingredient): static
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getPate(): ?Pate
    {
        return $this->pate;
    }

    public function setPate(?Pate $pate): static
    {
        $this->pate = $pate;

        return $this;
    }

    /**
     * @return Collection<int, ingredient>
     */
    public function getOtheringredient(): Collection
    {
        return $this->otheringredient;
    }

    public function addOtheringredient(Ingredient $otheringredient): static
    {
        if (!$this->otheringredient->contains($otheringredient)) {
            $this->otheringredient->add($otheringredient);
        }

        return $this;
    }

    public function removeOtheringredient(Ingredient $otheringredient): static
    {
        $this->otheringredient->removeElement($otheringredient);

        return $this;
    }
}
