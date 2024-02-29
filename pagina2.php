<?php
include('part3.php');

$vCdLivro = '';
$vNmLivro = '';
$vGenero = '';
$vAutorLivro = '';

//var_dump($_POST);

if (isset($_POST['btnSalvar'])) {
    extract($_POST);
    if (empty($_POST['codigo'])) {

        $stmt = $con->prepare("INSERT INTO livros(NM_LIVRO, GENERO, AUTOR_LIVRO) VALUES (:nome, :genero, :autor) ");
        $stmt->execute(array(
            ':nome' => $_POST['nome'],
            ':genero' => $_POST['genero'],
            ':autor' => $_POST['autor']
        ));
    } else {

        $stmt = $con->prepare("UPDATE livros SET NM_LIVRO= :nome, GENERO=:genero, AUTOR_LIVRO=:autor  WHERE CD_LIVRO = :codigo");
        $stmt->execute(array(
            ':nome' => $_POST['nome'],
            ':genero' => $_POST['genero'],
            ':autor' => $_POST['autor'],
            ':codigo' => $_POST['codigo']
        ));
    }
    } else
if (isset($_POST['btnEditar'])) {

    $stmt = $con->prepare("SELECT * FROM livros where CD_LIVRO=:codigo");
    $stmt->execute(array(
        ':codigo' => $_POST['codigo']
    ));
    $livro = $stmt->fetchAll();
    if (!empty($livro)) {
        foreach ($livro as $value) {
            $vCdLivro = $value['CD_LIVRO'];
            $vNmLivro = $value['NM_LIVRO'];
            $vGenero = $value['GENERO'];
            $vAutorLivro = $value['AUTOR_LIVRO'];
        }
    }
} else
if (isset($_POST['btnExcluir'])) {
    $stmt = $con->prepare("DELETE FROM livros where CD_LIVRO=:codigo");
    $stmt->execute(array(
        ':codigo' => $_POST['codigo']
    ));
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>ADM BIBLIOTECA</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
        src=""
</script>
    
    
</head>

<body>


<div class="container-fluid" style="background-color: #F6DDCC; padding: 100px ;">


<div class="container-fluid" style="background-color:  #EDBB99  ; padding: 20px ;">

<form method="POST" action="http://localhost/session/pagina2.php">
    <div style="text-align:center; margin-top:20px;">
<div class="row">
                <div class="col-12 col-md-1" >
                    <label for="formGroupExampleInput" class="fw-bold">Código </label>
                    <input type="text" class="form-control" name="codigo" id="formGroupExampleInput" placeholder="" value="<?php echo $vCdLivro?>" readonly>
                </div>
                <div class="col-12 col-md-7">
                    <label for="formGroupExampleInput" class="fw-bold">Nome Livro </label>
                    <input type="text" class="form-control" name="nome" id="formGroupExampleInput" placeholder="" value="<?php echo $vNmLivro ?>">
                </div>
                <div class="col-12 col-md-4">
                    <label for="formGroupExampleInput" class="fw-bold">Gênero </label>
                    <input type="text" class="form-control" name="genero" id="formGroupExampleInput" placeholder="" value="<?php echo $vGenero?>">
                </div>
                <div class="row">
                    <div class="centraliza">
                    <div class="col-xs-3">
                    <label for="formGroupExampleInput" class="fw-bold">Autor </label>
                    <input type="text" class="form-control" name="autor" id="formGroupExampleInput" placeholder="" value="<?php echo $vAutorLivro?>">
                </div>
                <div class="align-self-center">

                    <button type="submit" name="btnSalvar" class="btn btn-primary">Salvar</button>
                    <button type="submit" name="btnNovo" class="btn btn-success">Novo</button>

                </div>

            </div>
            
        </form>
    </div>

    <div class="container-fluid" style="background-color: #F5CBA7 ; padding: 100px ;">

        <div class="row">

            <?php

            //com parametro
            $stmt = $con->prepare("SELECT * FROM livros");
            $stmt->execute();
            $livro = $stmt->fetchAll();


            ?>

            </body>

            <div class="col-12 col-md-12">


            <table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Código</th>
            <th scope="col">Nome do livro</th>
            <th scope="col">Gênero</th>
            <th scope="col">Autor</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>

        <?php
        foreach ($livro as $value) {
        ?>
            <tr>
                <td><?php echo $value['CD_LIVRO'] ?></td>
                <td><?php echo $value['NM_LIVRO'] ?></td>
                <td><?php echo $value['GENERO'] ?></td>
                <td><?php echo $value['AUTOR_LIVRO'] ?></td>
                <td>
                    <form method="POST" name="nomeForm<?php echo $value['CD_LIVRO'] ?>" action="pagina2.php">
                        <input type="hidden" name="codigo" value="<?php echo $value['CD_LIVRO'] ?>">
                        <button type="submit" class="btn btn-info" name="btnEditar">Editar</button>
                    </form>

                </td>
                <td>
                    <form method="POST" name="nomeForm<?php echo $value['CD_LIVRO'] ?>" action="pagina2.php">
                        <input type="hidden" name="codigo" value="<?php echo $value['CD_LIVRO'] ?>">
                        <button type="submit" class="btn btn-danger" name="btnExcluir">Excluir</button>
                    </form>

                </td>

            </tr>
        <?php
        }
        ?>

    </tbody>
</table>


</div>
</div>

</div>

</body>

</html>
        