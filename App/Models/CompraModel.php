<?php

namespace App\Models;

final class CompraModel
{
    //PROPRIEDADES
    /**
     * @var int
     */
    private $pk_compra;

    /**
     * @var float
     */
    private $nu_valor;

    /**
     * @var string
     */
    private $dt_compra;

    /**
     * @var int
     */
    private $fk_fornecedor;

    /**
     * @var int
     */
    private $fk_funcionario_solicitante;

    /**
     * @var int
     */
    private $fk_funcionario_movimentacao;

    //METODOS
    /**
     * @return  int
     */
    public function getPk_compra(): int
    {
        return $this->pk_compra;
    }

    /**
     * @param  int  $pk_compra
     * @return  self
     */
    public function setPk_compra(int $pk_compra): self
    {
        $this->pk_compra = $pk_compra;

        return $this;
    }

    /**
     * @return  float
     */
    public function getNu_valor(): float
    {
        return $this->nu_valor;
    }

    /**
     * @param  float  $nu_valor
     * @return  self
     */
    public function setNu_valor(float $nu_valor): self
    {
        $this->nu_valor = $nu_valor;

        return $this;
    }

    /**
     * @return  string
     */
    public function getDt_compra(): string
    {
        return $this->dt_compra;
    }

    /**
     * @param  string  $dt_compra
     * @return  self
     */
    public function setDt_compra(string $dt_compra): self
    {
        $this->dt_compra = $dt_compra;

        return $this;
    }

    /**
     * @return  int
     */
    public function getFk_fornecedor(): int
    {
        return $this->fk_fornecedor;
    }

    /**
     * @param  int  $fk_fornecedor
     * @return  self
     */
    public function setFk_fornecedor(int $fk_fornecedor): self
    {
        $this->fk_fornecedor = $fk_fornecedor;

        return $this;
    }

    /**
     * @return  int
     */
    public function getFk_funcionario_solicitante(): int
    {
        return $this->fk_funcionario_solicitante;
    }

    /**
     * @param  int  $fk_funcionario_solicitante
     * @return  self
     */
    public function setFk_funcionario_solicitante(int $fk_funcionario_solicitante): self
    {
        $this->fk_funcionario_solicitante = $fk_funcionario_solicitante;

        return $this;
    }

    /**
     * @return  int
     */
    public function getFk_funcionario_movimentacao(): int
    {
        return $this->fk_funcionario_movimentacao;
    }

    /**
     * @param  int  $fk_funcionario_movimentacao
     * @return  self
     */
    public function setFk_funcionario_movimentacao(int $fk_funcionario_movimentacao): self
    {
        $this->fk_funcionario_movimentacao = $fk_funcionario_movimentacao;

        return $this;
    }
}