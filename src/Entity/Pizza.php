<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Repository\PizzaRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
#[Vich\Uploadable]
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
     * @var Collection<int, Ingredient>
     */
    #[ORM\ManyToMany(targetEntity: Ingredient::class)]
    private Collection $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

	#[Vich\UploadableField(mapping:"images", fileNameProperty:"imageName")]
	private ? File $imageFile = null;

	#[ORM\Column(nullable:true)]
	private ?string $imageName = null;

	#[ORM\Column(nullable:true)]
	private ?DateTimeImmutable $updatedAt = null;


	public function SetImageFile(? File $imageFile =null):void
	{
		$this->imageFile=$imageFile;
		if($imageFile){
			$this->updatedAt = new \DateTimeImmutable();
		}
	}

	public function getImageFile(): ? File
	{
		return $this->imageFile;
	}
	public function setImageName(?string $imageName):void
	{
		$this->imageName = $imageName;
	}
	public function getImageName(): ?string
	{
		return $this->imageName;
	}

	public function getNom(): ?string
	{
		return $this->nom;
	}

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): static
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): static
    {
        $this->ingredients->removeElement($ingredient);

        return $this;
    }

}
