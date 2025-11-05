<?php

namespace App\Entity\Local;

use App\Entity\Cliente\Cliente;
use App\Repository\EstadoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EstadoRepository::class)
 * @ORM\Table(name="empsys_local.estado")
 */
class Estado
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $sigla;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $ddd;

    /**
     * @ORM\OneToMany(targetEntity=Cliente::class, mappedBy="estado")
     */
    private $clientes;

    /**
     * @ORM\OneToMany(targetEntity=Local::class, mappedBy="estado")
     */
    private $locais;

    public function __construct()
    {
        $this->clientes = new ArrayCollection();
        $this->locais = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSigla(): ?string
    {
        return $this->sigla;
    }

    public function setSigla(string $sigla): self
    {
        $this->sigla = $sigla;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getDdd(): ?string
    {
        return $this->ddd;
    }

    public function setDdd(string $ddd): self
    {
        $this->ddd = $ddd;

        return $this;
    }

    /**
     * @return Collection<int, Cliente>
     */
    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function addCliente(Cliente $cliente): self
    {
        if (!$this->clientes->contains($cliente)) {
            $this->clientes[] = $cliente;
            $cliente->setEstado($this);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): self
    {
        if ($this->clientes->removeElement($cliente)) {
            // set the owning side to null (unless already changed)
            if ($cliente->getEstado() === $this) {
                $cliente->setEstado(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->sigla ?? '';
    }

    /**
     * @return Collection<int, Local>
     */
    public function getLocais(): Collection
    {
        return $this->locais;
    }

    public function addLocal(Local $local): self
    {
        if (!$this->locais->contains($local)) {
            $this->locais[] = $local;
            $local->setEstado($this);
        }

        return $this;
    }

    public function removeLocal(Local $local): self
    {
        if ($this->locais->removeElement($local)) {
            // set the owning side to null (unless already changed)
            if ($local->getEstado() === $this) {
                $local->setEstado(null);
            }
        }

        return $this;
    }
}
