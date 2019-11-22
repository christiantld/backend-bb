<?php

namespace App\Models;

final class UsuarioModel
{
    //PROPRIEDADES
    /**
     * @var int
     */
    private $pk_usuario;

    /**
     * @var string
     */
    private $no_usuario;

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
    public function getPk_usuario(): int
    {
        return $this->pk_usuario;
    }

    /**
     * @param  int  $pk_usuario
     * @return  self
     */
    public function setPk_usuario(int $pk_usuario): self
    {
        $this->pk_usuario = $pk_usuario;

        return $this;
    }

    /**
     * @return string
     */
    public function getNo_usuario(): string
    {
        return $this->no_usuario;
    }

    /**
     * @param string  $no_usuario
     * @return self
     */
    public function setNo_usuario(string $no_usuario): self
    {
        $this->no_usuario = $no_usuario;

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