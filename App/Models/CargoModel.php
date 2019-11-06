<?php

namespace App\Models;

final class CargoModel
{
    //PROPRIEDADES
    /**
     * @var int
     */
    private $pk_cargo;

    /**
     * @var string
     */
    private $no_cargo;

    //METODOS
    /**
     * @return  int
     */
    public function getPk_cargo(): int
    {
        return $this->pk_cargo;
    }

    /**
     * @param  int  $pk_cargo
     * @return  self
     */
    public function setPk_cargo(int $pk_cargo): self
    {
        $this->pk_cargo = $pk_cargo;

        return $this;
    }

    /**
     * @return  string
     */
    public function getNo_cargo(): string
    {
        return $this->no_cargo;
    }

    /**
     * @param  string  $no_cargo
     * @return  self
     */
    public function setNo_cargo(string $no_cargo): self
    {
        $this->no_cargo = $no_cargo;

        return $this;
    }
}