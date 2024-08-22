<?php 
use DAO\Melhoria;

class ModelMelhoria{

public  $id,
        $tarefa,
        $descricao,
        $demanda_legal, 
        $prazo_acordado,
        $prazo_legal,
        $gravidade,
        $urgencia,
        $tendencia,
        $area ;

    public function save(){
        $melhoria = new Melhoria();

   

        $this->id = $_POST['id'];
        $this->tarefa = $_POST['tarefa'];
        $this->descricao = $_POST['descricao'];
        $this->demanda_legal = isset($_POST['demanda_legal']) ? true : False ;
        $this->prazo_acordado = $_POST['prazo_acordado'];
        $this->prazo_legal = $_POST['prazo_legal'];
        $this->gravidade = $_POST['gravidade'];
        $this->urgencia = $_POST['urgencia'];
        $this->tendencia = $_POST['tendencia'];
        $this->area = $_POST['area'];

        if(empty($this->id)){
           $res =  $melhoria->insertMelhoria($this);
        }else{
           $res =  $melhoria->updateMelhoria($this);
        }

        return $res; 
    }


    public function delete($id){
        $id = intval($id);
        $melhoria = new Melhoria();

       $res = $melhoria->delete($id);
       return $res;
    }
}
?>