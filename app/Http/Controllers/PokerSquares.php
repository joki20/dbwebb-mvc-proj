<?php

declare(strict_types=1);

// Folder \Controllers containing classes
namespace Joki20\Http\Controllers;

use Joki20\Http\Controllers\Scoring;
use Joki20\Http\Controllers\Setup;

/**
 * Class PokerSquares.
 */

class PokerSquares extends Scoring
{
    public function game() // new game
    {
        // SET NAME
        empty($_POST) ? print_r($this->name()) : null;
        // SET NAME RESULT
        if (isset($_POST['setName'])) {
            $this->prepareSessions(); // save name and reset points
            $this->shuffleDeck(); // shuffle deck, store in session('deck');
            $this->prepareStack(); // create draw stack
            print_r($this->displayGrid()); // setup grid
        }
        // // IF CARD WAS PLACED ($_POST begins with 'place')
        if (isset($_POST['placeCard'])) {
            $this->placeCard();
            $this->prepareStack();
            $this->setPointsSessions();
            $this->checkFullRow();
            $this->checkFullColumn();
            print_r($this->displayGrid());
            $this->storeToDatabase();
        }
    }
}
