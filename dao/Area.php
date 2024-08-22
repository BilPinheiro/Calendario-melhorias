<?php 

namespace DAO;
use DAO\Melhoria;
use ModelArea;

class Area extends Database {

    const TABLE = 'area';
    protected static $oInstance;



    public function insertArea(ModelArea $model){
        $verificacao = $this->verificaDuplicidade($model->descricao);
        if($verificacao){
            return 'Não é possível adicionar uma área já existente!';
        }

        $sql = "INSERT INTO " . static::TABLE . " (descricao) VALUES (:descricao);";
        $dbst = $this->db->prepare($sql);
        $dbst->bindParam(":descricao", $model->descricao, \PDO::PARAM_STR);
        $res = $this->insertUpdate($dbst);
        return $res;

    }

    public function updateArea(ModelArea $model){
        $verificacao = $this->verificaDuplicidade($model->descricao);
        if($verificacao){
            return 'Não é possível adicionar uma área já existente!';
        }
        
        $sql = "UPDATE " . static::TABLE . " SET descricao = :descricao WHERE id = :id;";
        $dbst = $this->db->prepare($sql);
        $dbst->bindParam(":descricao", $model->descricao, \PDO::PARAM_STR);
        $dbst->bindParam(":id", $model->id, \PDO::PARAM_STR);
        $res =  $this->insertUpdate($dbst);
        return $res;
    }

    public function deleteArea($id){
        if($this->filtrarPorId($id)){
            $verifica_atribuicoes = Melhoria::getInstance()->filtrarPorArea($id);
                if(empty($verifica_atribuicoes))
                {
                    return $this->delete($id);
                }else{
                    return 'Não foi possível excluir a área, pois existem tarefas atribuídas!';
                }
        }
    }

    public function areaFiltrarPorID($id){
    
        $area = Area::getInstance()->filtrarPorId($id);
         return $area;
     }

     public function verificaDuplicidade($descricao){
        $areas = Area::getInstance()->filtrarPorDescricao($descricao);
        
        return !empty($areas);
     }
}
