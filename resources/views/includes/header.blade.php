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
        <ul>
            <li><a href="<?= url("/") ?>">Home</a></li>
            <li><a href="<?= url("/pokersquares") ?>">Play</a></li>
            <li><a href="<?= url("/highscore") ?>">High score</a></li>
        </ul>
    </nav>
</header>
<main>
