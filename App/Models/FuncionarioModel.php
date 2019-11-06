<?php

namespace App\Models;

final class FuncionarioModel
{
    //PROPRIEDADES
    /**
     * @var int
     */
    private $pk_funcionario;

    /**
     * @var string
     */
    private $no_funcionario;

    /**
     * @var int
     */
    private $nu_cpf;

    /**
     * @var string
     */
    private $email;

    /**
     * @var int
     */
    private $telefone;

    /**
     * @var string
     */
    private $senha;

    /**
     * @var int
     */
    private $fk_cargo;

    //METODOS
    /**
     * @return  int
     */
    public function getPk_funcionario(): int
    {
        return $this->pk_funcionario;
    }

    /**
     * @param  int  $pk_funcionario
     * @return  self
     */
    public function setPk_funcionario(int $pk_funcionario): self
    {
        $this->pk_funcionario = $pk_funcionario;

        return $this;
    }

    /**
     * @return string
     */
    public function getNo_funcionario(): string
    {
        return $this->no_funcionario;
    }

    /**
     * @param string  $no_funcionario
     * @return self
     */
    public function setNo_funcionario(string $no_funcionario): self
    {
        $this->no_funcionario = $no_funcionario;

        return $this;
    }

    /**
     * @return  int
     */
    public function getNu_cpf(): int
    {
        return $this->nu_cpf;
    }

    /**
     * @param  int  $nu_cpf
     * @return  self
     */
    public function setNu_cpf(int $nu_cpf): self
    {
        $this->nu_cpf = $nu_cpf;

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

    /**
     * @return  string
     */
    public function getSenha(): string
    {
        return $this->senha;
    }

    /**
     * @param  string  $senha
     * @return  self
     */
    public function setSenha(string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * @return  int
     */
    public function getFk_cargo(): int
    {
        return $this->fk_cargo;
    }

    /**
     * @param  int  $fk_cargo
     * @return  self
     */
    public function setFk_cargo(int $fk_cargo): self
    {
        $this->fk_cargo = $fk_cargo;

        return $this;
    }
}