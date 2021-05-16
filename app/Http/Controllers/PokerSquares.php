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
    use Scoring;

    public function game() {
        // new game

        // SET NAME
        empty($_POST) ? print_r($this->name()) : null;
        // SET NAME RESULT
        // save name and reset points
        // shuffle deck, store in session('deck');
        // create draw stack
        // setup grid
        isset($_POST['setName']) ? $this->prepareSessions() : null;
        isset($_POST['setName']) ? $this->shuffleDeck() : null;
        isset($_POST['setName']) ? $this->prepareStack() : null;
        isset($_POST['setName']) ? print_r($this->displayGrid()) : null;
        // IF CARD WAS PLACED ($_POST begins with 'place')
        isset($_POST['placeCard']) ? $this->placeCard() : null;
        isset($_POST['placeCard']) ? $this->prepareStack() : null;
        isset($_POST['placeCard']) ? $this->fullHandsData() : null;
        isset($_POST['placeCard']) ? print_r($this->displayGrid()) : null;
        isset($_POST['placeCard']) ? $this->storeToDatabase()) : null;
    }
}
