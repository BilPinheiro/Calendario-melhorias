<?php

use DAO\Urgencia;
use DAO\Gravidade;
use DAO\Tendencia;
use DAO\Area;

$areas = Area::getInstance()->getAll();
$gravidadesAll = Gravidade::getInstance()->order('id')->getAll();
$urgenciasAll  = Urgencia::getInstance()->order('id')->getAll();
$tendenciasAll = Tendencia::getInstance()->order('id')->getAll();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Melhorias</title>

</head>
<div class="container d-flex justify-content-center align-items" style="min-height: 100vh;">
    <form method="post" class="col-sm-12 col-md-6" action="index.php?path=save&type=melhoria">
        <h3 class="d-flex justify-content-center align-items-center">Melhoria</h3>
        <input id="id" name="id" value="<?= $model->id ?>" hidden=true />
        <div class="form-group">
            <label for="tarefa">Tarefa</label>
            <input type="text" class="form-control mb-2" id="tarefa" name="tarefa" value="<?= $model->tarefa ?>" />
        </div>
        <div class="form-group">
            <label class="" for="descricao">Descrição</label>
            <textarea class="form-control mb-2" id="descricao" name="descricao" rows="8" required><?php echo $model->descricao ?></textarea>
        </div>
        <div class="form-group form-row">
            <div class="col">
                <label for="prazo_legal">Prazo legal</label>
                <input type="date" class="form-control mb-2" id="prazo_legal" name="prazo_legal"  value="<?= $model->prazo_legal ?>">
            </div>
            <div class="col">
                <label for="prazo_acordado">Prazo acordado</label>
                <input type="date" class="form-control" id="prazo_acordado" name="prazo_acordado" value="<?= $model->prazo_acordado ?>" required>
            </div>
        </div>
        <div class="form-group form-row">
            <div class="col">
                <label for="gravidade">Gravidade</label>
                <select class="form-control" id="gravidade" name="gravidade">
                    <option value=''>Não informado</option>
                    <?php foreach ($gravidadesAll as $gravidade) : ?>
                        <option <?php echo $gravidade->id == $model->gravidade ? 'selected' : '' ?> value="<?php echo $gravidade->id ?>"><?php echo $gravidade->descricao ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <label for="urgencia">Urgência</label>
                <select class="form-control" id="urgencia" name="urgencia" required>
                    <option value=''>Não informado</option>
                    <?php foreach ($urgenciasAll as $urgencia) : ?>
                        <option <?php echo $urgencia->id == $model->urgencia ? 'selected' : '' ?> value="<?php echo $urgencia->id ?>"><?php echo $urgencia->descricao ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group form-row">
            <div class="col">
                <label for="tendencia">Tendência</label>
                <select class="form-control" id="tendencia" name="tendencia">
                    <option value=''>Não informado</option>
                    <?php foreach ($tendenciasAll as $tendencia) : ?>
                        <option <?php echo $tendencia->id == $model->tendencia ? 'selected' : '' ?> value="<?php echo $tendencia->id ?>"><?php echo $tendencia->descricao ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <label for="area">Area</label>
                <select class="form-control" id="area" name="area" required>
                    <option value=''>Áreas</option>
                    <?php foreach ($areas as $area) : ?>
                        <option <?php echo $area->id == $model->area ? 'selected' : '' ?> value="<?php echo $area->id ?>"><?php echo $area->descricao ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col  d-flex justify-content-center align-items-end">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="demanda_legal" name="demanda_legal" <?php echo (bool)$model->demanda_legal ? 'checked' : '' ?>>
                    <label class="form-check-label" for="demanda_legal">Demanda Legal</label>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hoje = new Date();
        const finalAno = new Date(hoje.getFullYear(), 11, 31); 
        
        const formatDate = date => date.toISOString().split('T')[0];
        
        document.getElementById('prazo_acordado').setAttribute('min', formatDate(hoje));
        document.getElementById('prazo_acordado').setAttribute('max', formatDate(finalAno));
        document.getElementById('prazo_legal').setAttribute('min', formatDate(hoje));
        document.getElementById('prazo_legal').setAttribute('max', formatDate(finalAno));
    });
</script>
    </html>