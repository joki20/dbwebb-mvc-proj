<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Joki20\Http\Controllers\CardHand; // use Deck class

?>

<h1>Home</h1>

<p>
    Welcome to this page where you can play a game of Poker Squares. The objective is to place cards in a 5x5 grid. After that, each row and column is scored as a regular poker hand of five cards. The better the hand, the more you score for that row or column.
</p>

<p>
    The result of each game will be saved in a highscore list. You will be able to see which player won the most number of games, and also the result of the latest game.
</p>
<div class="card rank12H">Q <br/> &hearts;</div>
<?php
$cardHand = new CardHand();
$cardHand->shuffleDeck();
$cardHand->drawHand();
var_dump($cardHand->suits());
var_dump($cardHand->values());
// // echo $card->drawCard();
// echo '<br><br><br><br><br><br><br><br>';
// echo $card->deckSize();
 ?>


<!-- <div class="card rank5S">5 <br/> &spades;</div> -->
