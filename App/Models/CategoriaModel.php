<?php

namespace App\Models;

final class CategoriaModel
{
    //PROPRIEDADES
    /**
     * @var int
     */
    private $pk_categoria;

    /**
     * @var string
     */
    private $no_categoria;

    //METODOS
    /**
     * @return  int
     */
    public function getPk_categoria(): int
    {
        return $this->pk_categoria;
    }

    /**
     * @param  int  $pk_categoria
     * @return  self
     */
    public function setPk_categoria(int $pk_categoria): self
    {
        $this->pk_categoria = $pk_categoria;

        return $this;
    }

    /**
     * @return  string
     */
    public function getNo_categoria(): string
    {
        return $this->no_categoria;
    }

    /**
     * @param  string  $no_categoria
     * @return  self
     */
    public function setNo_categoria(string $no_categoria): self
    {
        $this->no_categoria = $no_categoria;

        return $this;
    }
}