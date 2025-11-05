<?php

namespace App\Entity\Checklist;

use App\Entity\Maquina\Maquina;
use App\Repository\Checklist\ChecklistRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChecklistRepository::class)
 * @ORM\Table(name="empsys_checklist.checklist")
 */
class Checklist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=510)
     */
    private $nome;

    /**
     * @ORM\ManyToOne(targetEntity=Maquina::class, inversedBy="checklists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $maquina;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataHoraRealizado;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $operador;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observacoesComplementaresDeSeguranca;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $nivelOleoMotor;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $nivelOleoTransmissao;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $nivelOleoHidraulico;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $nivelAguaRadiador;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $vazamentoOleo;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $vazamentoGLP;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $nivelOleoFreio;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $buzinaSinalizadorSonoro;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $faroisLanternasGiroflex;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $retrovisor;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $pneus;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $freio;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $freioDeMao;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $sistemaDeDirecao;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $garfosCorrenteDaTorre;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $extintorDeIncendio;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $cintoDeSegurancaEBanco;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $instrumentosDoPainel;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $funcionamentoMotor;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $pinturaECarenagens;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $limpezaGeralExterna;

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

    public function getMaquina(): ?Maquina
    {
        return $this->maquina;
    }

    public function setMaquina(?Maquina $maquina): self
    {
        $this->maquina = $maquina;

        return $this;
    }

    public function getDataHoraRealizado(): ?\DateTimeInterface
    {
        return $this->dataHoraRealizado;
    }

    public function setDataHoraRealizado(\DateTimeInterface $dataHoraRealizado): self
    {
        $this->dataHoraRealizado = $dataHoraRealizado;

        return $this;
    }

    public function getOperador(): ?string
    {
        return $this->operador;
    }

    public function setOperador(string $operador): self
    {
        $this->operador = $operador;

        return $this;
    }

    public function getObservacoesComplementaresDeSeguranca(): ?string
    {
        return $this->observacoesComplementaresDeSeguranca;
    }

    public function setObservacoesComplementaresDeSeguranca(?string $observacoesComplementaresDeSeguranca): self
    {
        $this->observacoesComplementaresDeSeguranca = $observacoesComplementaresDeSeguranca;

        return $this;
    }

    public function getNivelOleoMotor(): ?string
    {
        return $this->nivelOleoMotor;
    }

    public function setNivelOleoMotor(string $nivelOleoMotor): self
    {
        $this->nivelOleoMotor = $nivelOleoMotor;

        return $this;
    }

    public function getNivelOleoTransmissao(): ?string
    {
        return $this->nivelOleoTransmissao;
    }

    public function setNivelOleoTransmissao(string $nivelOleoTransmissao): self
    {
        $this->nivelOleoTransmissao = $nivelOleoTransmissao;

        return $this;
    }

    public function getNivelOleoHidraulico(): ?string
    {
        return $this->nivelOleoHidraulico;
    }

    public function setNivelOleoHidraulico(string $nivelOleoHidraulico): self
    {
        $this->nivelOleoHidraulico = $nivelOleoHidraulico;

        return $this;
    }

    public function getNivelAguaRadiador(): ?string
    {
        return $this->nivelAguaRadiador;
    }

    public function setNivelAguaRadiador(string $nivelAguaRadiador): self
    {
        $this->nivelAguaRadiador = $nivelAguaRadiador;

        return $this;
    }

    public function getVazamentoOleo(): ?string
    {
        return $this->vazamentoOleo;
    }

    public function setVazamentoOleo(string $vazamentoOleo): self
    {
        $this->vazamentoOleo = $vazamentoOleo;

        return $this;
    }

    public function getVazamentoGLP(): ?string
    {
        return $this->vazamentoGLP;
    }

    public function setVazamentoGLP(string $vazamentoGLP): self
    {
        $this->vazamentoGLP = $vazamentoGLP;

        return $this;
    }

    public function getNivelOleoFreio(): ?string
    {
        return $this->nivelOleoFreio;
    }

    public function setNivelOleoFreio(string $nivelOleoFreio): self
    {
        $this->nivelOleoFreio = $nivelOleoFreio;

        return $this;
    }

    public function getBuzinaSinalizadorSonoro(): ?string
    {
        return $this->buzinaSinalizadorSonoro;
    }

    public function setBuzinaSinalizadorSonoro(string $buzinaSinalizadorSonoro): self
    {
        $this->buzinaSinalizadorSonoro = $buzinaSinalizadorSonoro;

        return $this;
    }

    public function getFaroisLanternasGiroflex(): ?string
    {
        return $this->faroisLanternasGiroflex;
    }

    public function setFaroisLanternasGiroflex(string $faroisLanternasGiroflex): self
    {
        $this->faroisLanternasGiroflex = $faroisLanternasGiroflex;

        return $this;
    }

    public function getRetrovisor(): ?string
    {
        return $this->retrovisor;
    }

    public function setRetrovisor(string $retrovisor): self
    {
        $this->retrovisor = $retrovisor;

        return $this;
    }

    public function getPneus(): ?string
    {
        return $this->pneus;
    }

    public function setPneus(string $pneus): self
    {
        $this->pneus = $pneus;

        return $this;
    }

    public function getFreio(): ?string
    {
        return $this->freio;
    }

    public function setFreio(string $freio): self
    {
        $this->freio = $freio;

        return $this;
    }

    public function getFreioDeMao(): ?string
    {
        return $this->freioDeMao;
    }

    public function setFreioDeMao(string $freioDeMao): self
    {
        $this->freioDeMao = $freioDeMao;

        return $this;
    }

    public function getSistemaDeDirecao(): ?string
    {
        return $this->sistemaDeDirecao;
    }

    public function setSistemaDeDirecao(string $sistemaDeDirecao): self
    {
        $this->sistemaDeDirecao = $sistemaDeDirecao;

        return $this;
    }

    public function getGarfosCorrenteDaTorre(): ?string
    {
        return $this->garfosCorrenteDaTorre;
    }

    public function setGarfosCorrenteDaTorre(string $garfosCorrenteDaTorre): self
    {
        $this->garfosCorrenteDaTorre = $garfosCorrenteDaTorre;

        return $this;
    }

    public function getExtintorDeIncendio(): ?string
    {
        return $this->extintorDeIncendio;
    }

    public function setExtintorDeIncendio(string $extintorDeIncendio): self
    {
        $this->extintorDeIncendio = $extintorDeIncendio;

        return $this;
    }

    public function getCintoDeSegurancaEBanco(): ?string
    {
        return $this->cintoDeSegurancaEBanco;
    }

    public function setCintoDeSegurancaEBanco(string $cintoDeSegurancaEBanco): self
    {
        $this->cintoDeSegurancaEBanco = $cintoDeSegurancaEBanco;

        return $this;
    }

    public function getInstrumentosDoPainel(): ?string
    {
        return $this->instrumentosDoPainel;
    }

    public function setInstrumentosDoPainel(string $instrumentosDoPainel): self
    {
        $this->instrumentosDoPainel = $instrumentosDoPainel;

        return $this;
    }

    public function getFuncionamentoMotor(): ?string
    {
        return $this->funcionamentoMotor;
    }

    public function setFuncionamentoMotor(string $funcionamentoMotor): self
    {
        $this->funcionamentoMotor = $funcionamentoMotor;

        return $this;
    }

    public function getPinturaECarenagens(): ?string
    {
        return $this->pinturaECarenagens;
    }

    public function setPinturaECarenagens(string $pinturaECarenagens): self
    {
        $this->pinturaECarenagens = $pinturaECarenagens;

        return $this;
    }

    public function getLimpezaGeralExterna(): ?string
    {
        return $this->limpezaGeralExterna;
    }

    public function setLimpezaGeralExterna(string $limpezaGeralExterna): self
    {
        $this->limpezaGeralExterna = $limpezaGeralExterna;

        return $this;
    }
}
