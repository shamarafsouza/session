<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title> 
    <link rel="stylesheet" href="style-principal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

<style>
        html, body {
            height: 100%;
        }

    
    </style>
</head>

<body >

    
    <nav class="bgfundo navbar bg-light">
        <div class="container">
            <p class="navbar-brand text-monospace mx-auto text-center"><i class="bi bi-book"></i>
                Biblioteca
            </p>
        </div>

        <form method="GET" action="">
        <div class="input-group">
           
        <input type="input-group-text text"  class="form-control" name="search_query" placeholder="Digite o nome do livro">
        <div class="input-group-append">
        <button class="btn btn-dark" type="submit">Buscar</button>
        </form>
    </nav>

    <div class="container py-5">
        <div class="row row-cols-1 row-cols-md-4 g-3">

            
    
        <?php
        // Verifica se a consulta foi submetida
        if (isset($_GET['search_query'])) {
            $api_key = 'AIzaSyDIYpl2khY7icYeJSOLY5ldt9ft1ZY5CzE';
            $search_query = urlencode($_GET['search_query']);
            $url = "https://www.googleapis.com/books/v1/volumes?q=$search_query&key=$api_key";

            // Faz a requisição HTTP para a API do Google Books
            $options = [
                'http' => [
                    'header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
                ]
            ];
            $context = stream_context_create($options);
            $response = file_get_contents($url, false, $context);
            $data = json_decode($response, true);

            // Exibe os resultados
            if ($data['totalItems'] > 0) {
                foreach ($data['items'] as $item) {
                    $title = $item['volumeInfo']['title'];
                    $thumbnail = isset($item['volumeInfo']['imageLinks']['thumbnail']) ? $item['volumeInfo']['imageLinks']['thumbnail'] : '';
                    $previewLink = isset($item['volumeInfo']['previewLink']) ? $item['volumeInfo']['previewLink'] : '';
                    $description = isset($item['volumeInfo']['description']) ? $item['volumeInfo']['description'] : '';
                     
                    echo '<div class="col">';
                    echo '<div class="card text-center card-front">';
                    echo '<a href="' . $previewLink . '" target="_blank">';
                    if (!empty($thumbnail)) {
                        echo '<img src="' . $thumbnail . '" alt="' . $title . '" class="card-img-top">';
                    } else {
                        echo '<img src="imagem-padrao.jpg" alt="Imagem Padrão" class="card-img-top">';
                     }
                    // echo '<img src="' . $thumbnail . '" alt="' . $title . '">';
                    echo '</a>';
                    echo '<div class="card-body">';
                    echo '<p>' . $title . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="card-body p-2">';
                    // echo '<h5 class="card-title">Sinopse:</h5>';
                    // echo '<p class="card-text">' . $description . '</p>';
                    echo '</div>';
                    echo '</div>';

                }
            } else {
                echo "<p>Nenhum livro encontrado.</p>";
            }
        }
        ?>
    </div>

    <script src="autocomplete.js"></script>
</body>
</html>