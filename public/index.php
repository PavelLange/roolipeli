<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {

    case '/':
        require __DIR__ . '/../partials/header.php';
        require __DIR__ . '/../views/front.php';
        require __DIR__ . '/../partials/footer.php';
        break;


    case '/login':
        require __DIR__ . '/../partials/header.php';
        require __DIR__ . '/../views/login.php';
        require __DIR__ . '/../partials/footer.php';
        break;


    case '/register':
        require __DIR__ . '/../partials/header.php';
        require __DIR__ . '/../views/register.php';
        require __DIR__ . '/../partials/footer.php';
        break;


    case '/campaigns':
        require __DIR__ . '/../partials/header.php';
        require __DIR__ . '/../views/campaign.php';
        require __DIR__ . '/../partials/footer.php';
        break;


    case '/new-character':
        require __DIR__ . '/../partials/header.php';
        require __DIR__ . '/../views/new_character.php';
        require __DIR__ . '/../partials/footer.php';
        break;


    default:
        http_response_code(404);

        require __DIR__ . '/../partials/header.php';

        echo '<main class="container">';
        echo '<h1>404 - Page not found</h1>';
        echo '<p>The page you are looking for does not exist.</p>';
        echo '</main>';

        require __DIR__ . '/../partials/footer.php';
        break;
}