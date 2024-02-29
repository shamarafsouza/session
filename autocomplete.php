<?php

if (isset($_GET['query'])) {
    $search_query = $_GET['query'];

    $api_key = 'AIzaSyDIYpl2khY7icYeJSOLY5ldt9ft1ZY5CzE'; // Substitua pela sua própria chave de API do Google Books
    $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($search_query) . "&key=" . $api_key;

    $options = [
        'http' => [
            'header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
        ]
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $data = json_decode($response, true);

    $suggestions = array();

    if (isset($data['items'])) {
        foreach ($data['items'] as $item) {
            $title = $item['volumeInfo']['title'];
            $suggestions[] = $title;
        }
    }

    echo json_encode($suggestions);
}
?>
