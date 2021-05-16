<?php

// php artisan test
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Joki20\Http\Controllers\Histogram;

/**
 * Test cases for class Guess.
 */
class HistogramCreateObjectTest extends TestCase
{
    // /**
    //  * Construct object and verify that the object is instance of class
    //  */
    public function testCreateObjectHistogram()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Joki20\Http\Controllers\Histogram", $histogram);
    }

    // /**
    //  * Test  call to database
    //  */
    public function testDatabase()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Joki20\Http\Controllers\Histogram", $histogram);

        $this->serie = [
            ['Royal straight flush', 0],
            ['Straight flush', 2],
            ['Four of a kind', 1],
            ['Full house', 2],
            ['Flush', 3],
            ['Straight', 0],
            ['Three of a kind', 1],
            ['Two pairs', 2],
            ['Pair', 1],
            ['Nothing', 0],
        ];

        for ($hand = 0; $hand < count($this->serie); $hand++) {
            // change second element in each above series to * output
            $this->serie[$hand][1] = str_repeat("•", $this->serie[$hand][1]);
        }
        $this->assertEquals(
            $this->serie,
            [
                ['Royal straight flush', null],
                ['Straight flush', '••'],
                ['Four of a kind', '•'],
                ['Full house', '••'],
                ['Flush', '•••'],
                ['Straight', null],
                ['Three of a kind', '•'],
                ['Two pairs', '••'],
                ['Pair', '•'],
                ['Nothing', null],
            ]
        );
    }
}
