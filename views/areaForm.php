<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container d-flex justify-content-center align-items" style="min-height: 100vh;">
        <form method="post" class="col-sm-12 col-md-6" action="index.php?path=save&type=area">
            <h3 class="d-flex justify-content-center align-items-center">Área</h3>
            <div class="form-row">
                <input id="id" name="id" value="<?= $model->id ?>" hidden=true />
                <label class="" for="descricao">Nome:</label>
                <textarea class="form-control mb-2" id="descricao"
                name="descricao" rows="2"
                 type="text"><?= $model->descricao ?></textarea>
                <small id="areaHelp" class="form-text text-muted">Adicione o nome da área.</small>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit"  class="btn btn-primary">Salvar</button>

            </div>
    </div>
    </form>
    </div>
</body>

</html>