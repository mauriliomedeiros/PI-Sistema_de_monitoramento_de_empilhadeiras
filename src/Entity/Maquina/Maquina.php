<?php

namespace App\Entity\Maquina;

use App\Entity\Checklist\Checklist;
use App\Entity\Cliente\Cliente;
use App\Entity\Local\Local;
use App\Repository\Maquina\MaquinaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaquinaRepository::class)
 * @ORM\Table(name="empsys_maquina.maquina")
 */
class Maquina
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Modelo::class, inversedBy="maquinas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modelo;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="maquinas")
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity=Local::class, inversedBy="maquinas")
     */
    private $local;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descricao;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ativo;

    /**
     * @ORM\OneToMany(targetEntity=Checklist::class, mappedBy="maquina")
     */
    private $checklists;

    public function __construct()
    {
        $this->checklists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModelo(): ?Modelo
    {
        return $this->modelo;
    }

    public function setModelo(?Modelo $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getLocal(): ?Local
    {
        return $this->local;
    }

    public function setLocal(?Local $local): self
    {
        $this->local = $local;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getAtivo(): ?bool
    {
        return $this->ativo;
    }

    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * @return Collection<int, Checklist>
     */
    public function getChecklists(): Collection
    {
        return $this->checklists;
    }

    public function addChecklist(Checklist $checklist): self
    {
        if (!$this->checklists->contains($checklist)) {
            $this->checklists[] = $checklist;
            $checklist->setMaquina($this);
        }

        return $this;
    }

    public function removeChecklist(Checklist $checklist): self
    {
        if ($this->checklists->removeElement($checklist)) {
            // set the owning side to null (unless already changed)
            if ($checklist->getMaquina() === $this) {
                $checklist->setMaquina(null);
            }
        }

        return $this;
    }
}
