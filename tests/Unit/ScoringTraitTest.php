<?php

// php artisan test
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Joki20\Http\Controllers\PokerSquares;
use Joki20\Http\Controllers\Scoring;
/**
 * Test cases for trait Scoring.
 */
class ScoringTestTrait extends TestCase
{
    // /**
    //  * Construct object and verify that the object is instance of class
    //  */
    public function testCreateObjectPokerSquares()
    {
        $pokersquares = new PokerSquares();
        $this->assertInstanceOf("\Joki20\Http\Controllers\PokerSquares", $pokersquares);
    }

    public function testCheckFullRow()
    {
        $pokersquares = new PokerSquares();

        $this->currentSession = 234;
        $pokerSquares->checkFullRow();

        var_dump($this->suitsRow);


    }
}
