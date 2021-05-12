<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Joki20\Http\Controllers\Card; // use Deck class

?>

<h1>Home</h1>

<p>
    Welcome to this page where you can play a game of Poker against 3 other computer players. The game doesn't contain any betting.
</p>

<p>
    The result of each game will be saved in a highscore list. You will be able to see which player won the most number of games, and also the result of the latest game.
</p>
<div class="card rank12H">Q <br/> &hearts;</div>
<?php
$card = new Card();
$card->shuffleDeck();
// // echo $card->drawCard();
// echo '<br><br><br><br><br><br><br><br>';
// echo $card->deckSize();
 ?>


<!-- <div class="card rank5S">5 <br/> &spades;</div> -->
