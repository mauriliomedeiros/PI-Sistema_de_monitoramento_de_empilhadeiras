<?php

namespace App\Entity;

use App\Repository\EstadoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EstadoRepository::class)
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
}
