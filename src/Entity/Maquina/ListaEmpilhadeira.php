<?php

namespace App\Entity\Maquina;

use App\Entity\Cliente\Cliente;
use App\Entity\Local\Local;
use App\Repository\Maquina\ListaEmpilhadeiraRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListaEmpilhadeiraRepository::class)
 * @ORM\Table(name="empsys.lista_empilhadeira")
 */
class ListaEmpilhadeira
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Modelo::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $modelo;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="empilhadeira")
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity=Local::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $local;

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
}
