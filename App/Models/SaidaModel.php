<?php

namespace App\Models;

final class SaidaModel
{
    //PROPRIEDADES
    /**
     * @var int
     */
    private $pk_saida;

    /**
     * @var int
     */
    private $qtd_item;

    /**
     * @var string
     */
    private $data_saida;

    /**
     * @var int
     */
    private $fk_usuario;

    /**
     * @var int
     */
    private $fk_produto;

    //METODOS
    /**
     * @return  int
     */
    public function getPk_saida(): int
    {
        return $this->pk_saida;
    }

    /**
     * @param  int  $pk_saida
     * @return  self
     */
    public function setPk_saida(int $pk_saida): self
    {
        $this->pk_saida = $pk_saida;

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
     * @return  string
     */
    public function getData_saida()
    {
        return $this->data_saida;
    }

    /**
     * @param  string  $data_saida
     * @return  self
     */
    public function setData_saida(string $data_saida)
    {
        $this->data_saida = $data_saida;

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
}