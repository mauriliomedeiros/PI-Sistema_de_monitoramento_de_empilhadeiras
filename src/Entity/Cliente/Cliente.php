<?php

namespace App\Entity\Cliente;

use App\Entity\Local;
use App\Entity\Maquina\ListaEmpilhadeira;
use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClienteRepository::class)
 * @ORM\Table(name="empsys.cliente")
 */
class Cliente
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
    private $razao_social;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nome_fantasia;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $cnpj;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ativo;

    /**
     * @ORM\OneToMany(targetEntity=Local::class, mappedBy="cliente")
     */
    private $local;

    /**
     * @ORM\OneToMany(targetEntity=ListaEmpilhadeira::class, mappedBy="cliente")
     */
    private $empilhadeira;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $inscricaoEstadual;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telefone;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomeResponsavel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $endereco;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cidade;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $estado;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $cep;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataCadastro;

    public function __construct()
    {
        $this->local = new ArrayCollection();
        $this->empilhadeira = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRazaoSocial(): ?string
    {
        return $this->razao_social;
    }

    public function setRazaoSocial(string $razao_social): self
    {
        $this->razao_social = $razao_social;

        return $this;
    }

    public function getNomeFantasia(): ?string
    {
        return $this->nome_fantasia;
    }

    public function setNomeFantasia(?string $nome_fantasia): self
    {
        $this->nome_fantasia = $nome_fantasia;

        return $this;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj): self
    {
        $this->cnpj = $cnpj;

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
     * @return Collection<int, Local>
     */
    public function getLocal(): Collection
    {
        return $this->local;
    }

    public function addLocal(Local $local): self
    {
        if (!$this->local->contains($local)) {
            $this->local[] = $local;
            $local->setCliente($this);
        }

        return $this;
    }

    public function removeLocal(Local $local): self
    {
        if ($this->local->removeElement($local)) {
            // set the owning side to null (unless already changed)
            if ($local->getCliente() === $this) {
                $local->setCliente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ListaEmpilhadeira>
     */
    public function getEmpilhadeira(): Collection
    {
        return $this->empilhadeira;
    }

    public function addEmpilhadeira(ListaEmpilhadeira $empilhadeira): self
    {
        if (!$this->empilhadeira->contains($empilhadeira)) {
            $this->empilhadeira[] = $empilhadeira;
            $empilhadeira->setCliente($this);
        }

        return $this;
    }

    public function removeEmpilhadeira(ListaEmpilhadeira $empilhadeira): self
    {
        if ($this->empilhadeira->removeElement($empilhadeira)) {
            // set the owning side to null (unless already changed)
            if ($empilhadeira->getCliente() === $this) {
                $empilhadeira->setCliente(null);
            }
        }

        return $this;
    }

    public function getInscricaoEstadual(): ?string
    {
        return $this->inscricaoEstadual;
    }

    public function setInscricaoEstadual(?string $inscricaoEstadual): self
    {
        $this->inscricaoEstadual = $inscricaoEstadual;

        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNomeResponsavel(): ?string
    {
        return $this->nomeResponsavel;
    }

    public function setNomeResponsavel(string $nomeResponsavel): self
    {
        $this->nomeResponsavel = $nomeResponsavel;

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

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

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

    public function getDataCadastro(): ?\DateTimeInterface
    {
        return $this->dataCadastro;
    }

    public function setDataCadastro(\DateTimeInterface $dataCadastro): self
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }
}
