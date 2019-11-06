<?php

namespace App\Models;

final class RequisicaoModel
{
    //PRODUTOS
    /**
     * @var int
     */
    private $pk_requisicao;

    /**
     * @var string
     */
    private $data_requisicao;

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
    public function getPk_requisicao(): int
    {
        return $this->pk_requisicao;
    }

    /**
     * @param  int  $pk_requisicao
     * @return  self
     */ 
    public function setPk_requisicao(int $pk_requisicao): self
    {
        $this->pk_requisicao = $pk_requisicao;

        return $this;
    }

    /**
     * @return  string
     */ 
    public function getData_requisicao(): string
    {
        return $this->data_requisicao;
    }

    /**
     * @param  string  $data_requisicao
     * @return  self
     */ 
    public function setData_requisicao(string $data_requisicao): self
    {
        $this->data_requisicao = $data_requisicao;

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