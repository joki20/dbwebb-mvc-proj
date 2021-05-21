<?php

// php artisan test
namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Joki20\Http\Controllers\PokerSquares;
use Joki20\Http\Controllers\Setup;
use Joki20\Http\Controllers\Scoring;
use Illuminate\Support\Facades\Session;

/**
 * Test cases for trait Scoring.
 */
class ScoringCreateObjectTest extends TestCase
{
    // /**
    //  * Construct object and verify that the object is instance of class
    //  */
    public function testCreateObjectScoring()
    {
        $scoring = new Scoring();
        $this->assertInstanceOf("\Joki20\Http\Controllers\Scoring", $scoring);
    }

    public function testSetPointsSessions()
    {
        $scoring = new Scoring();

        $scoring->setPointsSessions();

        $exp = null;
        $res = session('dataRow');

        $this->assertEquals($exp, $res);

    }
}
