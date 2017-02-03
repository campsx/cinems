<?php

abstract class BaseSql {

  protected $db;

  protected $table;

  protected $columns;

  public function __construct() {
    try {
      $this->db = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";", DB_USER, DB_PWD);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
      die("Erreur SQL:" . $e->getMessage());
    }
    $this->updateColumns();
  }

  protected function updateColumns() {
    $this->table = get_called_class();
    $allColumns = get_object_vars($this);
    $removeColumns = get_class_vars(__CLASS__);

    $this->columns = array_diff_key($allColumns, $removeColumns);
  }

  protected function insert() {
    unset($this->columns['id']);
    $sqlCol = null;
    $sqlKey = null;
    foreach ($this->columns as $columns => $value) {
      $sqlCol .= ",".$columns;
      $sqlKey .= ",:".$columns;
    }
    $sqlCol = ltrim($sqlCol, ',');
    $sqlKey = ltrim($sqlKey, ',');

    $sql = "INSERT INTO `".strtolower($this->table)."` (".$sqlCol.")
          VALUES (:".$sqlKey.");";
    $req = $this->db->prepare($sql);
    $req->execute($this->columns);
  }

  protected function update() {
    $sqlUpdate = null;
    foreach ($this->columns as $columns => $value) {
      $sqlUpdate[] = $columns . "=:" . $columns;
    }

    $sql = "UPDATE ".strtolower($this->table)." SET date_updated = sysdate(),".implode(",", $sqlUpdate)." WHERE id = :id;";
    $req = $this->db->prepare($sql);
    $req->execute($this->columns);
  }

  public function save() {
    $this->updateColumns();

    if ($this->id == -1) {
      $this->insert();
    } else {
      $this->update();
    }

  }

  // la fonction a pour but d'alimenter l'objet suite
  // a une requete sql (Attention la requete ne doit retourner
  // qu'une seule valeur
  public function poplulate( $condition = ["id" => 3])
  {
    // requete SQL
    // vérification
    // Alimentation de l'objet
  }

}
