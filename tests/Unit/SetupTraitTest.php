<?php

// php artisan test
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Joki20\Http\Controllers\PokerSquares;
use Joki20\Http\Controllers\Setup;
/**
 * Test cases for class Guess.
 */
class SetupTraitTest extends TestCase
{
    // /**
    //  * Construct object and verify that the object is instance of class
    //  */
    public function testCreateObjectPokerSquares()
    {
        $pokersquares = new PokerSquares();
        $this->assertInstanceOf("\Joki20\Http\Controllers\PokerSquares", $pokersquares);
    }

    public function testTraitSetupName()
    {
        $pokersquares = new PokerSquares();

        $exp = strlen($pokersquares->name());
        $this->assertEquals($exp, 265);
    }
}
