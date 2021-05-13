<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Joki20\Http\Controllers\PokerSquares;

?>

<h1>Poker Squares</h1>

<?php session(['pokerSquares' => new PokerSquares()]);

echo session('pokerSquares')->game();

?>
