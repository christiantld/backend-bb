<?php

namespace App\Models;

final class LoteModel
{
    //PROPRIEDADES
    /**
     * @var int
     */
    private $pk_lote;

    /**
     * @var string
     */
    private $data_fabricacao;

    /**
     * @var string
     */
    private $lote;

    /**
     * @var string
     */
    private $data_validade;

    /**
     * @var int
     */
    private $fk_produto;

    //METODOS
    /**
     * @return  int
     */
    public function getPk_lote(): int
    {
        return $this->pk_lote;
    }

    /**
     * @param  int  $pk_lote
     * @return  self
     */
    public function setPk_lote(int $pk_lote): self
    {
        $this->pk_lote = $pk_lote;

        return $this;
    }

    /**
     * @return  string
     */
    public function getData_fabricacao(): string
    {
        return $this->data_fabricacao;
    }

    /**
     * @param  string  $data_fabricacao
     * @return  self
     */
    public function setData_fabricacao(string $data_fabricacao): self
    {
        $this->data_fabricacao = $data_fabricacao;

        return $this;
    }

    /**
     * @return  string
     */
    public function getLote(): string
    {
        return $this->lote;
    }

    /**
     * @param  string  $lote
     * @return  self
     */
    public function setLote(string $lote): self
    {
        $this->lote = $lote;

        return $this;
    }

    /**
     * @return  string
     */
    public function getData_validade(): string
    {
        return $this->data_validade;
    }

    /**
     * @param  string  $data_validade
     * @return  self
     */
    public function setData_validade(string $data_validade): self
    {
        $this->data_validade = $data_validade;

        return $this;
    }

    /**
     * @return  int
     */
    public function getFk_produto(): int
    {
        return $this->fk_produto;
    }

    /**
     * @param  int  $fk_produto
     * @return  self
     */
    public function setFk_produto(int $fk_produto): self
    {
        $this->fk_produto = $fk_produto;

        return $this;
    }
}