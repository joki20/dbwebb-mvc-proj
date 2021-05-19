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


    public function testSortHand() {

        $scoring = new Scoring();

        session()->put(
            'dataColumn01',
        [
            ["H","C","S","D","C"],
            ["02","05","12","06","03"]
        ]);

        $type = 'Column01';

        $exp = ["02","03","05","06","12"];
        $res = $scoring->sortHand($type);

        $this->assertEquals($exp, $res);

        $scoring->sortHand($type);

        $exp = false;
        $res = $scoring->consecutiveArray;

    }

    public function scoreSameSuit() {

        $scoring = new Scoring();

        $scoreSession = [
                    ["C","C","C","C","C"],
                    ["10","11","12","13","14"]
        ];

        $scoring->$consecutiveArray = true;
        $type = 'Column01';

        $scoring->scoreSameSuit($type);

        $exp = 100;
        $res = session('scoreColumn01')[0];

        $this->assertEquals($exp, $res);

    }

}
