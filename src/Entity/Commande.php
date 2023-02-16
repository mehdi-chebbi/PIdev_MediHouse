<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datecommande = null;

    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'commandes')]
    private Collection $lignecommande;

    public function __construct()
    {
        $this->lignecommande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatecommande(): ?\DateTimeInterface
    {
        return $this->datecommande;
    }

    public function setDatecommande(\DateTimeInterface $datecommande): self
    {
        $this->datecommande = $datecommande;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getLignecommande(): Collection
    {
        return $this->lignecommande;
    }

    public function addLignecommande(Produit $lignecommande): self
    {
        if (!$this->lignecommande->contains($lignecommande)) {
            $this->lignecommande->add($lignecommande);
        }

        return $this;
    }

    public function removeLignecommande(Produit $lignecommande): self
    {
        $this->lignecommande->removeElement($lignecommande);

        return $this;
    }
}
