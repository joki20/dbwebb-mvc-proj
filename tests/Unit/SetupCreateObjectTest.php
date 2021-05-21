<?php

// php artisan test
namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\PokerSquares;
use App\Http\Controllers\Setup;
/**
 * Test cases for class Guess.
 */
class SetupCreateObjectTest extends TestCase
{
    // /**
    //  * Construct object and verify that the object is instance of class
    //  */
    public function testCreateObjectPokerSquares()
    {
        $setup = new Setup();
        $this->assertInstanceOf("\Joki20\Http\Controllers\Setup", $setup);
    }

    public function testSetupName()
    {
        $setup = new Setup();

        $exp = 265;
        $res = strlen($setup->name());

        $this->assertEquals($exp, $res);

        $exp = '<div class="enterName"><form method="POST" autocomplete="off">
                <input type="text" name="setName" placeholder="Name" minlength=3 onfocus=this.placeholder = required >
                <input type="submit" value="GO">
            </form></div>
        ';
        $res = $setup->name();
        $this->assertEquals($exp, $res);
    }

    public function testPrepareSessions()
    {
        $setup = new Setup();
        $_POST['setName'] = 'Johan';
        $setup->prepareSessions();

        $exp = 'Johan';
        $res = session('name');
        $this->assertEquals($exp, $res);
    }

    public function testShuffleDeck()
    {
        $setup = new Setup();

        $setup->shuffleDeck();
        $firstShuffle = session('deck');
        $setup->shuffleDeck();
        $secondShuffle = session('deck');
        $this->assertNotEquals($firstShuffle, $secondShuffle);
    }

    public function testPrepareStack()
    {
        $setup = new Setup();
        //
        session()->put('deck', ['a','b','c','d','e','f']);
        $beforeFirstValue = session('deck')[0];
        $setup->prepareStack(); // reverses order of array
        $afterLastValue = session('deck')[5];
        $this->assertEquals($beforeFirstValue, $afterLastValue);

    }

    public function testDisplayGrid()
    {
        $setup = new Setup();

        session()->put('scoreRow0.score', 10);
        session()->put('scoreRow1.score', 10);
        session()->put('scoreRow2.score', 10);
        session()->put('scoreRow3.score', 10);
        session()->put('scoreRow4.score', 10);
        session()->put('scoreColumn0.score', 10);
        session()->put('scoreColumn1.score', 10);
        session()->put('scoreColumn2.score', 10);
        session()->put('scoreColumn3.score', 10);
        session()->put('scoreColumn4.score', 10);

        $setup->displayGrid();
        $exp = 100;
        $res = session('totalScore');

        $this->assertEquals($exp, $res);

        session()->put('round', 20);
        $substring = '<tr>';
        $exp = $setup->displayGrid();
        $this->assertStringContainsString($substring, $exp);
    }

    public function testPlaceCard() {
        $setup = new Setup();

        session()->put('deck', [1,2,3,4,5,6,7,8,9]);
        $_POST['position'] = '00';
        session()->put('round', 14);
        $setup->placeCard();

        $exp = 15;
        $res = session('round');

        $this->assertEquals($exp, $res);
    }

}
