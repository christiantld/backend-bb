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
    private $marca;

    // /**
    //  * @var string
    //  */
    private $descricao;

    /**
     * @var int
     */
    private $qtd_minima;

    /**
     * @var int
     */
    private $qtd_max;

    /**
     * @var int
     */
    private $qtd_total;

    /**
     * @var int
     */
    private $fk_categoria;

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
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param  string  $marca
     * @return  self
     */
    public function setMarca(string $marca)
    {
        $this->marca = $marca;

        return $this;
    }

    // /**
    //  * @return  string
    //  */
    public function getDescricao()
    {
        return $this->descricao;
    }

    // /**
    //  * @param  string  $descricao
    //  * @return  self
    //  */
    public function setDescricao($descricao)
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
     * @return  int
     */
    public function getQtd_max()
    {
        return $this->qtd_max;
    }

    /**
     * @param  int  $qtd_max
     * @return  self
     */
    public function setQtd_max(int $qtd_max)
    {
        $this->qtd_max = $qtd_max;

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
}