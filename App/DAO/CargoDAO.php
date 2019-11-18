<?php

namespace App\DAO;

use App\Models\CargoModel;

class CargoDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getCargoById(int $id): ?array
  {
    $statement = $this->pdo->prepare(
      'SELECT  
      * 
      FROM tb_cargo
      WHERE pk_cargo = :id;'
    );
    $statement->bindParam('id', $id);
    $statement->execute();
    $cargo = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($cargo) !== 1)
      return null;

    return $cargo;
  }

  public function getAllCargos(): array
  {
    $cargos = $this->pdo
      ->query('SELECT 
              pk_cargo,
              no_cargo
              FROM tb_cargo;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $cargos;
  }

  public function insertCargo(CargoModel $cargo): void
  {
    $statement = $this->pdo
      ->prepare('INSERT INTO tb_cargo (no_cargo) VALUES(
                  :no_cargo
            );');

    $statement->execute([
      'no_cargo' => $cargo->getNo_cargo()
    ]);
  }

  public function updateCargo(CargoModel $cargo): void
  {
    $statement = $this->pdo
      ->prepare('UPDATE tb_cargo SET 
      pk_cargo = :pk_cargo,
      no_cargo = :no_cargo
      WHERE 
          pk_cargo = :pk_cargo 
        ;)');

    $statement->execute([
      'pk_cargo' => $cargo->getPk_cargo(),
      'no_cargo' => $cargo->getNo_cargo()
    ]);
  }

  public function deleteCargo(int $pk_cargo): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_cargo WHERE pk_cargo = :id;');

    $statement->execute([
      'id' => $pk_cargo
    ]);
  }
}