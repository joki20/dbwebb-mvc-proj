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
}
