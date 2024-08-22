<?php

use DAO\Melhoria;
use DAO\Area;

include ROOT_PATH . '/models/modelMelhoria.php';
include ROOT_PATH . '/models/modelArea.php';


class RouterController
{

    public static function inicio()
    {
        require_once(ROOT_PATH . '/views/inicio.php');
    }
    public static function errorpage()
    {
        require_once(ROOT_PATH . '/views/errorPage.php');
    }
    public static function agenda()
    {
        require_once(ROOT_PATH . '/views/agenda.php');
    }
    public static function form()
    {
        $type = $_GET['type'];

        switch ($type) {
            case 'melhoria':
                $model = new ModelMelhoria;
                if (!empty($_GET['id'])) {
                    $id = intval($_GET['id']);
                    $model = Melhoria::getInstance()->melhoriaFiltrarPorID($id);
                }

                require_once(ROOT_PATH . '/views/melhoriaForm.php');
                break;
            case 'area':
                $model = new ModelArea;
                if (!empty($_GET['id'])) {
                    $id = intval($_GET['id']);
                    $model = Area::getInstance()->areaFiltrarPorID($id);
                }

                require_once(ROOT_PATH . '/views/areaForm.php');
                break;
            default:
               null;
        }
    }

    public static function save()
    {
        $type = $_GET['type'];

        switch ($type) {
            case 'melhoria':
                $melhoria = new ModelMelhoria();
                $res = $melhoria->save();
                break;
            case 'area':
                $area = new ModelArea();
                $res = $area->save();
                break;
            default:
                null;
        }


        if (!empty($res)) {
            $_SESSION['mensagem'] = 'Cadastro realizado com sucesso';
            print "<script> location.href=('?path=inicio');</script>";
        } else {
            $_SESSION['dbUpdateError'] = $res;
            print "<script> location.href=('?path=inicio');</script>";
        }
    }

    public static function delete()
    {
        $type = $_GET['type'];
        $delId = $_GET['id'];

        switch ($type) {
            case 'melhoria':
                $melhoria = new ModelMelhoria();
                $melhoria->delete($delId);
            case 'area':
                $area = new ModelArea();
                $res = $area->delete($delId);
                break;
            default:
                $res = 'Erro Inesperado';
        }

        if (!empty($res)) {
            $_SESSION["dbUpdateError"] = "Informação deletada com sucesso";
            print "<script> location.href=('?path=inicio');</script>";
        } else {
            $_SESSION["dbUpdateError"] = $res;
            print "<script> location.href=('?path=inicio');</script>";
        }
    }

    public static function paginaNaoEncontrada()
    {
        $_SESSION['paginaNaoEncontrada'] = "Infelizmente a página que voce tentou acessar não existe.";
        print "<script> location.href=('?path=inicio');</script>";
    }
}
