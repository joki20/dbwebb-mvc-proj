<?php

// php artisan test
namespace Tests\Unit;

use Tests\TestCase;
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
}
