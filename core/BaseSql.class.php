<?php

abstract class BaseSql {

  protected $db;

  protected $table;

  protected $columns;

  /**
   * [
   *    'OneToMany' => [
   *        'propertyName' => [
   *            'persiste' => true,
   *            'table' => 'className'
   *        ]
   *    ],
   *    'ManyToOne' => [
   *        'propertyName' => [
   *            'table' => 'className'
   *        ],
   *    'ManyToMany' => [
   *        'propertyName' => [
   *            'persiste' => true,
   *            'table' => 'className',
   *            'joinTable' => 'nameHasName'
   *        ]
   * ]
   * @var array
   */
  protected $joinProperties = [
      'OneToMany' => [],
      'ManyToOne' => [],
      'ManyToMany' => []
  ];

  public function __construct($condition = []) {
    $this->db = new MyPDO();
    $this->updateColumns();
    if (count($condition) !== 0) {
      $this->initPoplulate($condition);
    } else {
      $this->id = $this->id ?: -1;
    }
  }

  protected function updateColumns()
  {
    $this->table = get_called_class();
    $allColumns = get_object_vars($this);
    $removeColumns = get_class_vars(__CLASS__);

    $this->columns = array_diff_key($allColumns, $removeColumns);
  }

  protected function insert()
  {
    $sqlCol = null;
    $sqlKey = null;
    $data = [];
    foreach ($this->columns as $columns => $value) {
          $join = $this->checkJoinType($columns);
          if ($columns !== 'updated' AND $columns !== 'created' AND $columns !== 'id' AND $join === false) {
            $sqlCol .= ",".$columns;
            $sqlKey .= ",:".$columns;
            $data[$columns] = $value;
          } elseif (is_string($join)) {
              $function = "save".$join;
              if ($join == 'ManyToOne') {
                  $sqlCol .= ",".$columns;
                  $sqlKey .= ",:".$columns;
                  $data[$columns] = $this->$function($columns);
              } else {
                  $this->$function($columns);
              }
          }
    }

    $sqlCol = ltrim($sqlCol, ',');
    $sqlKey = ltrim($sqlKey, ',');

    $sql = "INSERT INTO `".strtolower($this->table)."` (created ,updated,".$sqlCol.")
          VALUES (sysdate(),sysdate(),".$sqlKey.");";
    $req = $this->db->prepare($sql);
    $req->execute($data);
    $this->id = $this->db->lastInsertId();
  }

  protected function update()
  {
    $sqlUpdate = null;
    $data = [];
    foreach ($this->columns as $columns => $value) {
        $join = $this->checkJoinType($columns);
      if ($columns !== 'updated' AND $columns !== 'created' AND $join === false) {
          $sqlUpdate[] = $columns . "=:" . $columns;
          $data[$columns] = $value;
      } elseif (is_string($join)) {
          $function = "save".$join;
          if ($join == 'ManyToOne') {
              $sqlUpdate[] = $columns . "=:" . $columns;
              $data[$columns] = $this->$function($columns);
          } else {
              $this->$function($columns);
          }
      }
    }

    $sql = "UPDATE ".strtolower($this->table)." SET updated = sysdate(),".implode(",", $sqlUpdate)." WHERE id = :id;";
    $req = $this->db->prepare($sql);
    $req->execute($data);
  }

  public function save()
  {
    $this->updateColumns();

    if ($this->id == -1) {
      $this->insert();
    } else {
      $this->update();
    }

  }


  protected function saveOneToMany($columns)
  {
      if (count($this->getJoin($columns)) === 0){
          return null;
      }
      $tableName = $this->joinProperties['OneToMany'][$columns]['table'];
      $sql = "SELECT a.id FROM ".$tableName." as a WHERE a.".strtolower($this->table)."_id = ".$this->id." ;";
      $query = $this->db->prepare($sql);
      $query->execute();
      $allId = $query->fetchAll(PDO::FETCH_ASSOC);
      $idAlreadyPersiste = [];
      foreach ($this->$columns as $model) {
          $alreadyPersiste = false;
          for ($i = 0; $i < count($allId) ; $i++) {
              if ($allId[$i]['id'] == $model->getId()) {
                  $alreadyPersiste = true;
                  $idAlreadyPersiste[] = $i;
              }
          }
          if ($alreadyPersiste === false) {
              if($model->id == -1){
                  $model->save();
              }
              $sql = "UPDATE ".$tableName." SET ".strtolower($this->table)."_id = ".$this->id."  WHERE id = ".$model->id." ;";
              $query = $this->db->prepare($sql);
              $query->execute();
          }
      }
      foreach ($idAlreadyPersiste as $i) {
          unset($allId[$i]);
      }
      foreach ($allId as $id) {
          $sql = "DELETE FROM ".$tableName." WHERE id = ".$id['id']." ;";
          $query = $this->db->prepare($sql);
          $query->execute();
      }
  }

  protected function saveManyToOne($column)
  {
      if ($this->$column === null) {
          return null;
      } elseif (is_int($this->$column) || is_string($this->$column)) {
          return $this->$column;
      } else {
          return $this->$column->getId();
      }
  }

  protected function saveManyToMany($columns)
  {
      $this->getJoin($columns);
      $tableName = $this->joinProperties['ManyToMany'][$columns]['table'];
      $joinTableName = $this->joinProperties['ManyToMany'][$columns]['joinTable'];
      $sql = "SELECT a.".$tableName."_id FROM ".$joinTableName." as a WHERE a.".strtolower($this->table)."_id = ".$this->id." ;";
      $query = $this->db->prepare($sql);
      $query->execute();
      $allId = $query->fetchAll(PDO::FETCH_ASSOC);
      $idAlreadyPersiste = [];
      foreach ($this->$columns as $model) {
          $alreadyPersiste = false;
          for ($i = 0; $i < count($allId) ; $i++) {
              if ($allId[$i][$tableName.'_id'] == $model->getId()) {
                  $alreadyPersiste = true;
                  $idAlreadyPersiste[] = $i;
              }
          }
          if ($alreadyPersiste === false) {
              if($model->id == -1){
                  $model->save();
              }
              $sql = "INSERT INTO ".$joinTableName." SET ".strtolower($this->table)."_id = :idClass, ".$tableName."_id = :idModel ;";
              $query = $this->db->prepare($sql);
              $query->execute([
                  'idModel' => $model->getId(),
                  'idClass' => $this->id
              ]);
          }
      }
      foreach ($idAlreadyPersiste as $i) {
          unset($allId[$i]);
      }
      foreach ($allId as $id) {
          $sql = "DELETE FROM ".$joinTableName." WHERE ".$tableName."_id = :idModel and ".strtolower($this->table)."_id = :idClass ;";
          $query = $this->db->prepare($sql);
          $query->execute([
              'idModel' => $id[$tableName.'_id'],
              'idClass' => $this->id
          ]);
      }
  }

  //protected function poplulate($condition = ["id" => 1])
  //{
  //  $query = $this->getOneBy($condition, true);
  //  $query->setFetchMode(PDO::FETCH_CLASS, $this->table);
  //  $result = $query->fetch();
  //  return $result;
  //}

  protected function initPoplulate($condition = ["id" => 1])
  {
      $query = $this->getOneBy($condition);
      foreach ($this->columns as $columns => $value) {
          if (!(array_key_exists($columns, $this->joinProperties['OneToMany']) ||
              array_key_exists($columns, $this->joinProperties['ManyToMany']))){
              $this->$columns = $query[$columns];
          }
      }
  }

  protected function getOneBy($search = [], $returnQuery = false)
  {
      foreach ($search as $columns => $value) {
          $sqlSelect[] = $columns . "=:" . $columns;
      }
      $sql = "SELECT * FROM ".strtolower($this->table)." WHERE ".implode(",", $sqlSelect).";";
      $query = $this->db->prepare($sql);
      $query->execute($search);

      if ($returnQuery) {
          return $query;
      }
      return $query->fetch(PDO::FETCH_ASSOC);

  }

    protected function checkJoinType($joinPropertyName)
    {
        if (array_key_exists($joinPropertyName, $this->joinProperties['OneToMany'])) {
            return 'OneToMany';
        } else if (array_key_exists($joinPropertyName, $this->joinProperties['ManyToOne'])) {
            return 'ManyToOne';
         } else if (array_key_exists($joinPropertyName, $this->joinProperties['ManyToMany'])) {
            return 'ManyToMany';
        }
        return false;
    }




    /**
     * function remove
     */
    protected function removeJoin($joinPropertyName, $model)
    {
        $this->getJoin($joinPropertyName);
        $join = $this->checkJoinType($joinPropertyName);
        if (is_string($join)) {
            $function = "remove".$join;
            $this->$function($joinPropertyName, $model);
        }
    }

    private function removeOneToMany($joinPropertyName, $model)
    {
        $className = ucfirst($this->joinProperties['OneToMany'][$joinPropertyName]['table']);
        if (!($model instanceof $className)) {
            $model = new $className([ "id" => $model]);
        }
        $this->$joinPropertyName = array_filter($this->$joinPropertyName, function ($mod) use ($model) {
            return($model->getId() !== $mod->getId());
        });
    }

    private function removeManyToMany($joinPropertyName, $model)
    {
        $className = ucfirst($this->joinProperties['ManyToMany'][$joinPropertyName]['table']);
        if (!($model instanceof $className)) {
            $model = new $className([ "id" => $model]);
        }
        $this->$joinPropertyName = array_filter($this->$joinPropertyName, function ($mod) use ($model) {
            return ($model->getId() !== $mod->getId());
        });
    }





    /**
     *  all set are here
     * function set
     */
    protected function setJoin($joinPropertyName, $model)
    {
        $this->getJoin($joinPropertyName);

        if (array_key_exists($joinPropertyName, $this->joinProperties['OneToMany'])) {

            $className = ucfirst($this->joinProperties['OneToMany'][$joinPropertyName]['table']);
            if ( $model instanceof $className ) {
                array_push($this->$joinPropertyName, $model);
            } else {
                array_push($this->$joinPropertyName, new $className([ "id" => $model]));
            }

        } elseif (array_key_exists($joinPropertyName, $this->joinProperties['ManyToOne'])) {

            $className = ucfirst($this->joinProperties['ManyToOne'][$joinPropertyName]['table']);
            if ( $model instanceof $className ) {
                $this->$joinPropertyName = $model;
            } elseif ($model === null) {
                $this->$joinPropertyName = null;
            } else {
                $this->$joinPropertyName = new $className([ "id" => $model]);
            }

        } elseif (array_key_exists($joinPropertyName, $this->joinProperties['ManyToMany'])) {
            $className = ucfirst($this->joinProperties['ManyToMany'][$joinPropertyName]['table']);
            if ( $model instanceof $className ) {
                array_push($this->$joinPropertyName, $model);
            } else {
                array_push($this->$joinPropertyName, new $className([ "id" => $model]));
            }
        }
    }





    /**
     * function get
     * @return array
     */
    protected function getJoin($joinPropertyName)
    {
        $join = $this->checkJoinType($joinPropertyName);
        if (is_string($join)) {
            $function = "get".$join;
           return $this->$function($joinPropertyName, $this->joinProperties[$join][$joinPropertyName]);
        }
        return null;
    }

    /**
     * @return mixed
     */
    private function getOneToMany($joinPropertyName, $options)
    {
        if (count($this->$joinPropertyName) !== 0){
            return $this->$joinPropertyName;
        }

        $joinClassName = $options['table'];
        $className = ucfirst($joinClassName);
        $sql = "SELECT a.id FROM ".$joinClassName." as a WHERE a.".strtolower($this->table)."_id = ".$this->id." ;";
        $query = $this->db->prepare($sql);
        $query->execute();
        $allId = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($allId){
            foreach ($allId as $id) {
                $this->{$joinPropertyName}[] = new $className([ "id" => $id['id']]);
            }
        }
        return $this->$joinPropertyName;
    }

    /**
     * @return mixed
     */
    protected function getManyToOne($joinPropertyName, $options)
    {
        if ($this->$joinPropertyName == null) {
            return null;
        }

        $className = ucfirst($options['table']);
        if( $this->$joinPropertyName instanceof $className ) {
            return $this->$joinPropertyName;
        }

        return $this->$joinPropertyName = new $className([ "id" => $this->$joinPropertyName]);
    }

    /**
     * @return mixed
     */
    protected function getManyToMany($joinPropertyName, $options)
    {
        if (count($this->$joinPropertyName) !== 0){
            return $this->$joinPropertyName;
        }

        $className = ucfirst($options['table']);
        $sql = "SELECT a.".$options['table']."_id FROM ".$options['joinTable']." as a WHERE a.".strtolower($this->table)."_id = ".$this->id." ;";
        $query = $this->db->prepare($sql);
        $query->execute();
        $allId = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($allId){
            foreach ($allId as $id) {
                $this->{$joinPropertyName}[] = new $className([ "id" => $id[$options['table'].'_id']]);
            }
        }
        return $this->$joinPropertyName;
    }

    public function unique($nameField, $field)
    {
        $sql = "SELECT a.id FROM ".strtolower($this->table)." as a WHERE a.".$nameField." = :field ;";
        $query = $this->db->prepare($sql);

        $query->execute([
                'field' => $field
            ]);

        return $query->fetch(PDO::FETCH_ASSOC) === false;
    }

}
