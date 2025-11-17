<?php

namespace App\Entity\Local;

use App\Entity\Cliente\Cliente;
use App\Entity\Maquina\Maquina;
use App\Repository\LocalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocalRepository::class)
 * @ORM\Table(name="empsys_local.local")
 */
class Local
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $endereco;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cidade;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $cep;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observacao;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="local")
     */
    private $cliente;

    /**
     * @ORM\Column(type="boolean", options={"default": true})
     */
    private $ativo = true;

    /**
     * @ORM\ManyToOne(targetEntity=Estado::class, inversedBy="locais")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity=Maquina::class, mappedBy="local")
     */
    private $maquinas;

    public function __construct()
    {
        $this->maquinas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function setCidade(string $cidade): self
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(string $cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

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

    public function getAtivo(): ?bool
    {
        return $this->ativo;
    }

    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    public function getEstado(): ?Estado
    {
        return $this->estado;
    }

    public function setEstado(?Estado $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * @return Collection<int, Maquina>
     */
    public function getMaquinas(): Collection
    {
        return $this->maquinas;
    }

    public function addMaquina(Maquina $maquina): self
    {
        if (!$this->maquinas->contains($maquina)) {
            $this->maquinas[] = $maquina;
            $maquina->setLocal($this);
        }

        return $this;
    }

    public function removeMaquina(Maquina $maquina): self
    {
        if ($this->maquinas->removeElement($maquina)) {
            // set the owning side to null (unless already changed)
            if ($maquina->getLocal() === $this) {
                $maquina->setLocal(null);
            }
        }

        return $this;
    }

    public function getNomeComCliente(): string
    {
        return $this->nome . ' (' . $this->cliente->getRazaoSocial() . ')';
    }
}
