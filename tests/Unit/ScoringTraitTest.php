<?php

// php artisan test
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Joki20\Http\Controllers\PokerSquares;
use Joki20\Http\Controllers\Setup;
use Joki20\Http\Controllers\Scoring;

/**
 * Test cases for trait Scoring.
 */
class ScoringTraitTest extends TestCase
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
        // session('dataRow00', [[H,D,C,S,D],[03,05,01,13,10]])
        session()->put('dataRow01', [['h','c','d','s','c'], [2,5,6,3,1]]);
        $exp = [1,2,3,5,6];
        $res =  $pokersquares->sortHand('Row01');
        $this->assertEquals($exp, $res);
        // $this->currentSession = 234;
        // $pokersquares->checkFullRow();
        //
        // var_dump($this->suitsRow);
    }
}
