<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

?><!doctype html>
<html>
    <meta charset="utf-8">
    <title><?= $title ?? "No title" ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.ico') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>

<body>

<header>
    <?php
    $navbar = [
    ["controller" => "/",       "text" => "Home"],
    ["controller" => "/pokersquares",    "text" => "Play"],
    ["controller" => "/highscore",      "text" => "Highscore"],
];

$uri = $_SERVER["REQUEST_URI"]; // link to this file

?>
    <nav>
        <ul>
        <?php foreach ($navbar as $item) :
            $selected = $uri == $item['controller'] ? "selected" : null;
            ?>
            <a href="<?= $item["controller"] ?>" class="<?= $selected ?>"><li><?= $item["text"] ?></li></a>
        <?php endforeach; ?>
        </ul>
    </nav>
</header>
<main>
