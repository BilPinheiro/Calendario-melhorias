<?php

namespace DAO;

use ModelMelhoria;


class Melhoria extends Database
{

    const TABLE = 'melhorias';
    protected static $oInstance;

    public function filtrarPorUrgencia($urgencia, $fields = null)
    {
        if (is_array($urgencia)) {
            return $this->filtrar('urgencia IN (' . implode(', ', $urgencia) . ')', null, $fields);
        }

        $whereValues = [];

        $where                   = 'urgencia = :urgencia OR urgencia IS NULL';
        $whereValues['urgencia'] = $urgencia;

        return $this->filtrar($where, $whereValues, $fields);
    }


    public function filtrarPorArea($area, $fields = null)
    {
        if (is_array($area)) {
            return $this->filtrar('area IN (' . implode(', ', $area) . ')', null, $fields);
        }

        $whereValues = [];

        $where                   = 'area = :area';
        $whereValues['area'] = $area;

        return $this->filtrar($where, $whereValues, $fields);
    }
    public function melhoriaFiltrarPorID($id){
    
       $melhoria = Melhoria::getInstance()->filtrarPorId($id);
        return $melhoria;
    }

    public function insertMelhoria(ModelMelhoria $model)
    {   
        $col = $this->getColumns($model);
        $columns = $col[0];
        $insert_columns = $col[1];
        $sql = "INSERT INTO " . static::TABLE . " (" . $columns . ") VALUES (" . $insert_columns . ");";
        $dbst = $this->db->prepare($sql);
        $dbst->bindParam(":tarefa", $model->tarefa, \PDO::PARAM_STR);
        $dbst->bindParam(":descricao", $model->descricao, \PDO::PARAM_STR);
        $dbst->bindParam(":demanda_legal", $model->demanda_legal, \PDO::PARAM_BOOL);
        $dbst->bindParam(":prazo_acordado", $model->prazo_acordado, \PDO::PARAM_STR);
        $dbst->bindValue(":prazo_legal", !empty($model->prazo_legal) ? $model->prazo_legal : NULL, !empty($model->prazo_legal) ? \PDO::PARAM_STR : \PDO::PARAM_NULL);
        $dbst->bindValue(":gravidade",!empty($model->gravidade)? $model->gravidade : NULL , !empty($model->gravidade) ? \PDO::PARAM_STR : \PDO::PARAM_NULL);
        $dbst->bindParam(":tendencia",!empty($model->tendencia)? $model->tendencia : NULL , !empty($model->tendencia) ? \PDO::PARAM_STR : \PDO::PARAM_NULL);
        $dbst->bindParam(":urgencia", !empty($model->urgencia) ? $model->urgencia : NULL, !empty($model->urgencia) ? \PDO::PARAM_STR : \PDO::PARAM_NULL);
        $dbst->bindParam(":area", $model->area, \PDO::PARAM_STR);
        $res = $this->insertUpdate($dbst);
        return $res;
    }
    
    public function updateMelhoria(ModelMelhoria $model)
    {
        $sql = "UPDATE " . static::TABLE . " SET tarefa = :tarefa , descricao = :descricao,
                                            demanda_legal = :demanda_legal, prazo_acordado = :prazo_acordado,
                                            prazo_legal = :prazo_legal, gravidade = :gravidade, urgencia = :urgencia,
                                            tendencia = :tendencia, area= :area WHERE id = :id";
        $dbst = $this->db->prepare($sql);
        $dbst->bindParam(":tarefa", $model->tarefa, \PDO::PARAM_STR);
        $dbst->bindParam(":descricao", $model->descricao, \PDO::PARAM_STR);
        $dbst->bindParam(":demanda_legal", $model->demanda_legal, \PDO::PARAM_BOOL);
        $dbst->bindParam(":prazo_acordado", $model->prazo_acordado, \PDO::PARAM_STR);
        $dbst->bindParam(":prazo_legal", $model->prazo_legal, \PDO::PARAM_STR);
        $dbst->bindParam(":gravidade", $model->gravidade, \PDO::PARAM_STR);
        $dbst->bindParam(":urgencia", $model->urgencia, \PDO::PARAM_STR);
        $dbst->bindParam(":tendencia", $model->tendencia, \PDO::PARAM_STR);
        $dbst->bindParam(":area", $model->area, \PDO::PARAM_STR);
        $dbst->bindParam(":id", $model->id, \PDO::PARAM_INT);
        $res = $this->insertUpdate($dbst);
        return $res;
    }

    public function deleteMelhoria(int $id){
        
        if($this->filtrarPorId($id)){            
           $res = $this->delete($id);
        }
        return $res;
    }

    function getColumns(ModelMelhoria $model){
        $columns = ' ';
        $insert_columns = ' ';
        foreach ($model  as $column => $value) {
            if ($column != 'id') {
                $columns .= $column . ", ";
                $insert_columns .= ':' . $column . ", ";
            }
        }
        $columns = substr($columns, 0, -2);
        $insert_columns = substr($insert_columns, 0, -2);

        return [$columns, $insert_columns];
    }
    
}
