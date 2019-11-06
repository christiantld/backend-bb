<?php

namespace App\Models;

final class Item_CompraModel
{
    //PROPRIEDADES
    /**
     * @var int
     */
    private $pk_item_compra;

    /**
     * @var string
     */
    private $data_entrada;

    /**
     * @var int
     */
    private $qtd_item;

    /**
     * @var int
     */
    private $fk_produto;

    /**
     * @var int
     */
    private $fk_compra;


    //METODOS
    /**
     * @return  int
     */
    public function getPk_item_compra(): int
    {
        return $this->pk_item_compra;
    }

    /**
     * @param  int  $pk_item_compra
     * @return  self
     */
    public function setPk_item_compra(int $pk_item_compra): self
    {
        $this->pk_item_compra = $pk_item_compra;

        return $this;
    }

    /**
     * @return  string
     */
    public function getData_entrada(): string
    {
        return $this->data_entrada;
    }

    /**
     * @param  string  $data_entrada
     * @return  self
     */
    public function setData_entrada(string $data_entrada): self
    {
        $this->data_entrada = $data_entrada;

        return $this;
    }

    /**
     * @return  int
     */
    public function getQtd_item(): int
    {
        return $this->qtd_item;
    }

    /**
     * @param  int  $qtd_item
     * @return  self
     */
    public function setQtd_item(int $qtd_item): self
    {
        $this->qtd_item = $qtd_item;

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

    /**
     * @return  int
     */
    public function getFk_compra(): int
    {
        return $this->fk_compra;
    }

    /**
     * @param  int  $fk_compra
     * @return  self
     */
    public function setFk_compra(int $fk_compra): self
    {
        $this->fk_compra = $fk_compra;

        return $this;
    }
}