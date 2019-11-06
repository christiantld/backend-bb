<?php

namespace App\Models;

final class FornecedorModel
{
    //PROPRIEDADES
    /**
     * @var int
     */
    private $pk_fornecedor;

    /**
     * @var string
     */
    private $no_fornecedor;

    /**
     * @var string
     */
    private $email;

    /**
     * @var int
     */
    private $telefone;

    //METODOS
    /**
     * @return  int
     */
    public function getPk_fornecedor(): int
    {
        return $this->pk_fornecedor;
    }

    /**
     * @param  int  $pk_fornecedor
     * @return  self
     */
    public function setPk_fornecedor(int $pk_fornecedor): self
    {
        $this->pk_fornecedor = $pk_fornecedor;

        return $this;
    }

    /**
     * @return  string
     */
    public function getNo_fornecedor(): string
    {
        return $this->no_fornecedor;
    }

    /**
     * @param  string  $no_fornecedor
     * @return  self
     */
    public function setNo_fornecedor(string $no_fornecedor): self
    {
        $this->no_fornecedor = $no_fornecedor;

        return $this;
    }

    /**
     * @return  string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param  string  $email
     * @return  self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return  int
     */
    public function getTelefone(): int
    {
        return $this->telefone;
    }

    /**
     * @param  int  $telefone
     * @return  self
     */
    public function setTelefone(int $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }
}