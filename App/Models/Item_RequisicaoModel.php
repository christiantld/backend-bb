<?php

namespace App\Models;

final class Item_RequisicaoModel
{
    //PROPRIEDADES
    /**
     * @var int
     */
    private $pk_item_requisicao;

    /**
     * @var int
     */
    private $qtd_item;

    /**
     * @var int
     */
    private $fk_requisicao;

    /**
     * @var int
     */
    private $fk_produto;

    //METODOS
    /**
     * @return  int
     */
    public function getPk_item_requisicao(): int
    {
        return $this->pk_item_requisicao;
    }

    /**
     * @param  int  $pk_item_requisicao
     * @return  self
     */
    public function setPk_item_requisicao(int $pk_item_requisicao): self
    {
        $this->pk_item_requisicao = $pk_item_requisicao;

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
    public function getFk_requisicao(): int
    {
        return $this->fk_requisicao;
    }

    /**
     * @param  int  $fk_requisicao
     * @return  self
     */
    public function setFk_requisicao(int $fk_requisicao): self
    {
        $this->fk_requisicao = $fk_requisicao;

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