<?php

namespace App\Models;

final class EntradaModel
{
    //PROPRIEDADES
    /**
     * @var int
     */
    private $pk_entrada;

    /**
     * @var string
     */
    private $data_entrada;

    /**
     * @var int
     */
    private $qtd_item;

    /**
     * @var float
     */
    private $valor_item;

    /**
     * @var int
     */
    private $fk_produto;

    /**
     * @var int
     */
    private $fk_usuario;

    /**
     * @var int
     */
    private $fk_fornecedor;


    //METODOS
    /**
     * @return  int
     */
    public function getPk_entrada(): int
    {
        return $this->pk_entrada;
    }

    /**
     * @param  int  $pk_entrada
     * @return  self
     */
    public function setPk_entrada(int $pk_entrada): self
    {
        $this->pk_entrada = $pk_entrada;

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
     * @return int
     */
    public function getFk_usuario(): int
    {
        return $this->fk_usuario;
    }

    /**
     * @param  int  $fk_usuario
     * @return  self
     */
    public function setFk_usuario(int $fk_usuario): self
    {
        $this->fk_usuario = $fk_usuario;

        return $this;
    }

    /**
     * @return  float
     */
    public function getValor_item()
    {
        return $this->valor_item;
    }

    /**
     * @param  float  $valor_item
     * @return  self
     */
    public function setValor_item(float $valor_item)
    {
        $this->valor_item = $valor_item;

        return $this;
    }

    /**
     * @return  int
     */
    public function getFk_fornecedor()
    {
        return $this->fk_fornecedor;
    }

    /**
     * @param  int  $fk_fornecedor
     * @return  self
     */
    public function setFk_fornecedor(int $fk_fornecedor)
    {
        $this->fk_fornecedor = $fk_fornecedor;

        return $this;
    }
}