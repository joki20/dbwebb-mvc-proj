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
    <nav>
        <a href="<?= url("/") ?>">Home</a>
        <a href="<?= url("/play") ?>">Play Texas Hold'Em</a>
        <a href="<?= url("/highscore") ?>">High score</a>
    </nav>
</header>
<main>
