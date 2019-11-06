<?php

namespace App\Models;

final class TokenModel
{
  //PROPRIEDADES
  /**
   * @var int
   */
  private $pk_token;
  /**
   * @var string
   */
  private $token;
  /**
   * @var string
   */
  private $refresh_token;
  /**
   * @var string
   */
  private $expire_at;
  /**
   * @var int
   */
  private $fk_funcionario;
  /**
   * @var int
   */
  private $active;

  //METODOS
  /**
   * @return  int
   */
  public function getPk_token(): int
  {
    return $this->pk_token;
  }

  /**
   * @param  int  $pk_token
   * @return  self
   */
  public function setPk_token(int $pk_token): self
  {
    $this->pk_token = $pk_token;

    return $this;
  }

  /**
   * @return  string
   */
  public function getToken(): string
  {
    return $this->token;
  }

  /**
   * @param  string  $token
   * @return  self
   */
  public function setToken(string $token): self
  {
    $this->token = $token;

    return $this;
  }

  /**
   * @return  string
   */
  public function getRefresh_token(): string
  {
    return $this->refresh_token;
  }

  /**
   * @param  string  $refresh_token
   * @return  self
   */
  public function setRefresh_token(string $refresh_token): self
  {
    $this->refresh_token = $refresh_token;

    return $this;
  }

  /**
   * @return  string
   */
  public function getExpire_at(): string
  {
    return $this->expire_at;
  }

  /**
   * @param  string  $expire_at
   * @return  self
   */
  public function setExpire_at(string $expire_at): self
  {
    $this->expire_at = $expire_at;

    return $this;
  }

  /**
   * @return  int
   */
  public function getFk_funcionario(): int
  {
    return $this->fk_funcionario;
  }

  /**
   * @param  int  $fk_funcionario
   * @return  self
   */
  public function setFk_funcionario(int $fk_funcionario): self
  {
    $this->fk_funcionario = $fk_funcionario;

    return $this;
  }

  /**
   * @return  int
   */
  public function getActive(): int
  {
    return $this->active;
  }

  /**
   * @param  int  $active
   * @return  self
   */
  public function setActive(int $active): self
  {
    $this->active = $active;

    return $this;
  }
}