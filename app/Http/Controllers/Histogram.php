<?php

/*
* Card class
*/

declare(strict_types=1);

// Folder \Controllers containing classes
namespace Joki20\Http\Controllers;
use Joki20\Models\Pokerhighscore;

/**
 * Generating histogram data.
 */

class Histogram implements HistogramInterface
{
    private $serie = [];

    /**
    * Get the serie.
    *
    * @return array with the serie.
    */
    public function getSerie()
    {
        $pokerhighscores = Pokerhighscore::all();

        $royalstraightflush = $pokerhighscores->sum('count_royalstraightflush');
        $straightflush = $pokerhighscores->sum('count_straightflush');
        $fourofakind = $pokerhighscores->sum('count_fourofakind');
        $fullhouse = $pokerhighscores->sum('count_fullhouse');
        $flush = $pokerhighscores->sum('count_flush');
        $straight = $pokerhighscores->sum('count_straight');
        $threeofakind = $pokerhighscores->sum('count_threeofakind');
        $twopairs = $pokerhighscores->sum('count_twopairs');
        $pair = $pokerhighscores->sum('count_pair');
        $nothing = $pokerhighscores->sum('count_nothing');

        $this->serie = [
            ['Royal straight flush', $royalstraightflush],
            ['Straight flush', $straightflush],
            ['Four of a kind', $fourofakind],
            ['Full house', $fullhouse],
            ['Flush', $flush],
            ['Straight', $straight],
            ['Three of a kind', $threeofakind],
            ['Two pairs', $twopairs],
            ['Pair', $pair],
            ['Nothing', $nothing],
        ];

        for ($hand = 0; $hand < count($this->serie); $hand++) {
            // change second element in each above series to * output
            $this->serie[$hand][1] = str_repeat("•", $this->serie[$hand][1]);
        }

        return $this->serie;
    }
}
