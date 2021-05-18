<?php

// php artisan test
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Joki20\Http\Controllers\PokerSquares;
use Joki20\Http\Controllers\Setup;
/**
 * Test cases for class Guess.
 */
class DeckTraitTest extends TestCase
{
    // /**
    //  * Construct object and verify that the object is instance of class
    //  */
    public function testCreateObjectPokerSquares()
    {
        $pokersquares = new PokerSquares();
        $this->assertInstanceOf("\Joki20\Http\Controllers\PokerSquares", $pokersquares);
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

    public function testTraitDeckReturnDeck()
    {
        $pokersquares = new PokerSquares();

        $exp = 52;
        $res = count($pokersquares->returnDeck());
        $this->assertEquals($exp, $res);
    }
}
