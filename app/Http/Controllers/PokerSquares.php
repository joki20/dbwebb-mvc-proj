<?php

/*
* Card class
*/

declare(strict_types=1);

// Folder \Controllers containing classes
namespace Joki20\Http\Controllers;
// use Joki20\Http\Controllers\PokerSquares;
use Joki20\Http\Controllers\Setup;

/**
 * Class PokerSquares.
 */

class PokerSquares
{
    use Setup;

    public function game() {
        // new game

        // set name
        empty($_POST) ? print_r($this->name()) : null;
        // save name and reset points
        // shuffle deck, store in session('deck');
        // create draw stack
        // setup grid
        isset($_POST['setName']) ? print_r($this->prepareSessions()) : null;
        isset($_POST['setName']) ? print_r($this->shuffleDeck()) : null;
        isset($_POST['setName']) ? print_r($this->createStack()) : null;
        isset($_POST['setName']) ? print_r($this->setupGrid()) : null;
    }
}
