<?php

abstract class BaseSql {

  protected $db;

  protected $table;

  protected $columns;

  public function __construct($condition = []) {
    $this->db = new MyPDO();
    $this->updateColumns();
    if (count($condition) !== 0) {
      $this->poplulate($condition);
    } else {
      $this->id = -1;
    }
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
    $data = [];
    foreach ($this->columns as $columns => $value) {
      if ($columns !== 'updated' AND $columns !== 'created') {
        $sqlCol .= ",".$columns;
        $sqlKey .= ",:".$columns;
        $data[$columns] = $value;
      }
    }
    $sqlCol = ltrim($sqlCol, ',');
    $sqlKey = ltrim($sqlKey, ',');

    $sql = "INSERT INTO `".strtolower($this->table)."` (created ,updated,".$sqlCol.")
          VALUES (sysdate(),sysdate(),".$sqlKey.");";
    $req = $this->db->prepare($sql);
    $req->execute($data);
  }

  protected function update() {
    $sqlUpdate = null;
    foreach ($this->columns as $columns => $value) {
      if ($columns !== 'updated') {
        $sqlUpdate[] = $columns . "=:" . $columns;
      }
    }

    $sql = "UPDATE ".strtolower($this->table)." SET updated = sysdate(),".implode(",", $sqlUpdate)." WHERE id = :id;";
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
  public function poplulate($condition = ["id" => 1])
  {
    $sqlSelect = null;
    foreach ($condition as $columns => $value) {
      $sqlSelect[] = $columns . "=:" . $columns;
    }
    $sql = "SELECT * FROM ".strtolower($this->table)." WHERE ".implode(",", $sqlSelect).";";
    $req = $this->db->prepare($sql);
    $req->execute($condition);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) === 0) {
      return false;
    }

    $query = $result[0];

    foreach ($this->columns as $columns => $value) {
      $this->$columns = $query[$columns];
    }
  }

}
