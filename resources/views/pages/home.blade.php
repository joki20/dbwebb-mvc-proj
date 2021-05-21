<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use App\Http\Controllers\PokerSquares; // use Deck class

?>

<h1>Home</h1>

<p>
    Welcome to this page where you can play a game of Poker Squares. The objective is to place cards in a 5x5 grid. After that, each row and column (a total of 10 hands) is scored as a regular poker hand of five cards. The better the hand, the more you score for that row or column.
</p>

<p>
    The sum of each game will be saved in a highscore with your name. You can also watch a histogram showing the frequency of each and every hand. This means that five played games will display a total of 5 * 10 = 50 dots distributed among the hands.
</p>
<div class="centerCard">
<?php

$obj = new PokerSquares();
print_r('<p>' . $obj->returnDeck()[rand(0,51)] . '</p>');
 ?>
</div>
