<?php

declare(strict_types=1);

// Folder \Controllers containing classes
namespace App\Http\Controllers;

use App\Models\Pokerhighscore;

/**
 * Generating histogram data.
 */

class Histogram implements HistogramInterface
{
    private $serie = [];
    private int $differentHands;

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
        $sumAll = (
            $royalstraightflush +
            $straightflush +
            $fourofakind +
            $fullhouse +
            $flush +
            $straight +
            $threeofakind +
            $twopairs +
            $pair +
            $nothing
        );

        $this->serie = [
            ['Royal straight flush', round(($royalstraightflush / $sumAll) * 100, 1) . '%', $royalstraightflush],
            ['Straight flush', round(($straightflush / $sumAll) * 100, 1) . '%', $straightflush],
            ['Four of a kind', round(($fourofakind / $sumAll) * 100, 1) . '%',$fourofakind],
            ['Full house', round(($fullhouse / $sumAll) * 100, 1) . '%',$fullhouse],
            ['Flush', round(($flush / $sumAll) * 100, 1) . '%',$flush],
            ['Straight', round(($straight / $sumAll) * 100, 1) . '%',$straight],
            ['Three of a kind', round(($threeofakind / $sumAll) * 100, 1) . '%',$threeofakind],
            ['Two pairs', round(($twopairs / $sumAll) * 100, 1) . '%',$twopairs],
            ['Pair', round(($pair / $sumAll) * 100, 1) . '%',$pair],
            ['Nothing', round(($nothing / $sumAll) * 100, 1) . '%',$nothing],
        ];

        $this->differentHands = count($this->serie);

        for ($hand = 0; $hand < $this->differentHands; $hand++) {
            // change third element with count in each above series to * output
            $this->serie[$hand][2] = str_repeat("*", $this->serie[$hand][2]);
        }

        return $this->serie;
    }
}
