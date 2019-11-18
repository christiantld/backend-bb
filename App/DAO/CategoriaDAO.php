<?php

namespace App\DAO;

use App\Models\CategoriaModel;

class CategoriaDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getCategoriaById(int $id): ?array
  {
    $statement = $this->pdo->prepare(
      'SELECT  
      *
      FROM tb_categoria
      WHERE pk_categoria = :id;'
    );
    $statement->bindParam('id', $id);
    $statement->execute();
    $categoria = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($categoria) !== 1)
      return null;

    return $categoria;
  }

  public function getAllCategorias(): array
  {
    $categorias = $this->pdo
      ->query('SELECT 
              pk_categoria,
              no_categoria
              FROM tb_categoria;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $categorias;
  }

  public function insertCategoria(CategoriaModel $categoria): void
  {
    $statement = $this->pdo
      ->prepare('INSERT INTO tb_categoria (no_categoria) VALUES(
                  :no_categoria
            );');

    $statement->execute([
      'no_categoria' => $categoria->getNo_categoria()
    ]);
  }

  public function updateCategoria(CategoriaModel $categoria): void
  {
    $statement = $this->pdo
      ->prepare('UPDATE tb_categoria SET 
      pk_categoria = :pk_categoria,
      no_categoria = :no_categoria
      WHERE 
          pk_categoria = :pk_categoria 
        ;)');

    $statement->execute([
      'pk_categoria' => $categoria->getPk_categoria(),
      'no_categoria' => $categoria->getNo_categoria()
    ]);
  }

  public function deleteCategoria(int $pk_categoria): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_categoria WHERE pk_categoria = :id;');

    $statement->execute([
      'id' => $pk_categoria
    ]);
  }
}