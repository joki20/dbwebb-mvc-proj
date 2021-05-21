<?php

// php artisan test
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Joki20\Http\Controllers\PokerSquares;

/**
 * Test cases for class Guess.
 */
class PokerSquaresCreateObjectTest extends TestCase
{
    // /**
    //  * Construct object and verify that the object is instance of class
    //  */
    public function testCreateObjectPokerSquares()
    {
        $pokersquares = new PokerSquares();
        $this->assertInstanceOf("\Joki20\Http\Controllers\PokerSquares", $pokersquares);
    }

    // /**
    //  * Test empty $_POST array
    //  */
    public function testEmptyPost()
    {
        $pokersquares = new PokerSquares();
        $this->assertInstanceOf("\Joki20\Http\Controllers\PokerSquares", $pokersquares);

        $exp = $pokersquares->game();
        $this->assertEquals($exp, null);
    }

    public function testTraitDeckName()
    {
        $pokersquares = new PokerSquares();

        $exp = strlen($pokersquares->name());
        $this->assertEquals($exp, 265);
    }

    public function testTraitDeckDeckSize()
    {
        $pokersquares = new PokerSquares();

        $exp = $pokersquares->deckSize(['<div class="card rank08C">8 <br/> &clubs;</div>','<div class="card rank09C">9 <br/> &clubs;</div>',]);
        $this->assertEquals($exp, 2);
    }

    public function testTraitSetupName()
    {
        $pokersquares = new PokerSquares();

        $exp = strlen($pokersquares->name());
        $this->assertEquals($exp, 265);
    }
}
