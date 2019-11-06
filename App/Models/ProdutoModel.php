<?php

namespace App\Models;

final class ProdutoModel
{
    /**
     * @var int
     */
    private $pk_produto;

    /**
     * @var string
     */
    private $no_produto;

    /**
     * @var string
     */
    private $descricao;

    /**
     * @var int
     */
    private $qtd_minima;

    /**
     * @var int
     */
    private $qtd_total;

    /**
     * @var float
     */
    private $valor_produto;

    /**
     * @var int
     */
    private $fk_categoria;

    /**
     * @var int
     */
    private $fk_fornecedor;

    //METODO
    /**
     * @return  int
     */
    public function getPk_produto(): int
    {
        return $this->pk_produto;
    }

    /**
     * @param  int  $pk_produto
     * @return  self
     */
    public function setPk_produto(int $pk_produto): self
    {
        $this->pk_produto = $pk_produto;

        return $this;
    }

    /**
     * @return  string
     */
    public function getNo_produto(): string
    {
        return $this->no_produto;
    }

    /**
     * @param  string  $no_produto
     * @return  self
     */
    public function setNo_produto(string $no_produto): self
    {
        $this->no_produto = $no_produto;

        return $this;
    }

    /**
     * @return  string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param  string  $descricao
     * @return  self
     */
    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return  int
     */
    public function getQtd_minima(): int
    {
        return $this->qtd_minima;
    }

    /**
     * @param  int  $qtd_minima
     * @return  self
     */
    public function setQtd_minima(int $qtd_minima): self
    {
        $this->qtd_minima = $qtd_minima;

        return $this;
    }

    /**
     * @return  float
     */
    public function getValor_produto(): float
    {
        return $this->valor_produto;
    }

    /**
     * @param  float  $valor_produto
     * @return  self
     */
    public function setValor_produto(float $valor_produto): self
    {
        $this->valor_produto = $valor_produto;

        return $this;
    }

    /**
     * @return  int
     */
    public function getFk_categoria(): int
    {
        return $this->fk_categoria;
    }

    /**
     * @param  int  $fk_categoria
     * @return  self
     */
    public function setFk_categoria(int $fk_categoria): self
    {
        $this->fk_categoria = $fk_categoria;

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
        $this->fk_produto = $fk_fornecedor;

        return $this;
    }

    /**
     * @return  int
     */
    public function getQtd_total()
    {
        return $this->qtd_total;
    }

    /**
     * @param  int  $qtd_total
     * @return  self
     */
    public function setQtd_total(int $qtd_total)
    {
        $this->qtd_total = $qtd_total;

        return $this;
    }
}