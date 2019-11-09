<?php

namespace App\Models;

final class Produto_FornecedorModel
{
  //PROPRIEDADES

  /**
   * @var int
   */
  private $pk_produto_fornecedor;

  /**
   * @var int
   */
  private $fk_produto;

  /**
   * @var int
   */
  private $fk_fornecedor;

  //METODOS
  /**
   * @return  int
   */
  public function getPk_produto_fornecedor()
  {
    return $this->pk_produto_fornecedor;
  }

  /**
   * @param  int  $pk_produto_fornecedor
   * @return  self
   */
  public function setPk_produto_fornecedor(int $pk_produto_fornecedor)
  {
    $this->pk_produto_fornecedor = $pk_produto_fornecedor;

    return $this;
  }

  /**
   * @return  int
   */
  public function getFk_produto()
  {
    return $this->fk_produto;
  }

  /**
   * @param  int  $fk_produto
   * @return  self
   */
  public function setFk_produto(int $fk_produto)
  {
    $this->fk_produto = $fk_produto;

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