<?php

use DAO\Area;

class ModelArea{

public $id, $descricao;

public function save(){
    $area = new Area();
    $this->descricao = $_POST['descricao'];
    $this->id = $_POST['id'];

    if(empty($this->id)){
        $res = $area->insertArea($this);
    }else{
        $res = $area->updateArea($this);
    }
    return $res;
}

public function delete($id){
    $id = intval($id);
    $area = new Area();

    $res = $area->deleteArea($id);

    return $res;

}


}