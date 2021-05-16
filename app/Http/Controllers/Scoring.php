<?php

declare(strict_types=1);

// Folder \Controllers containing classes
namespace Joki20\Http\Controllers;
// use Joki20\Http\Controllers\PokerSquares;
use Joki20\Http\Controllers\Setup;

/**
 * Trait Scoring;
 */

trait Scoring
{
    use Setup;

    private ?string $currentSession = '';
    private ?array $suitsRow = [];
    private ?array $valuesRow = [];
    private ?array $suitsColumn = [];
    private ?array $valuesColumn = [];
    private ?array $scoreSession = [];
    private ?array $sortedValues = [];
    private ?bool $consecutiveArray;
    private ?int $times;
    private ?array $occurrencesSuits = [];
    private ?array $occurrencesValues = [];

    public function fullHandsData(): void {
        $this->suitsRow = [];
        $this->valuesRow = [];
        $this->suitsColumn = [];
        $this->valuesColumn = [];
        $this->currentSession = '';
        // row data (suits array and values array)
        session()->put('dataRow0', []);
        session()->put('dataRow1', []);
        session()->put('dataRow2', []);
        session()->put('dataRow3', []);
        session()->put('dataRow4', []);
        // column data (suits array and values array)
        session()->put('dataColumn0', []);
        session()->put('dataColumn1', []);
        session()->put('dataColumn2', []);
        session()->put('dataColumn3', []);
        session()->put('dataColumn4', []);
        // counting times of each result for highscore list
        // has to reset to 0 each time score is calculated, and not null according to database
        session()->put('count', [
            'nothing' => 0,
            'pair' => 0,
            'twoPairs' => 0,
            'threeofakind' => 0,
            'straight' => 0,
            'flush' => 0,
            'fullhouse' => 0,
            'fourofakind' => 0,
            'straightflush' => 0,
            'royalstraightflush' => 0,
        ]);

        // LOOP FOR EACH ROW
        for ($row = 0; $row < 5; $row++) {
            for ($column = 0; $column < 5; $column++) {
                // initial length is 0, if not then session contians card
                // ROW SUITS AND VALUES
                // if a card is existing (form length has 235)
                $this->currentSession = session('grid.' . $row . $column);
                if (strlen($this->currentSession) != 235) {
                    // collect suit HDSC and value 02-14 for row
                    array_push($this->suitsRow, substr($this->currentSession,23,1));
                    array_push($this->valuesRow, substr($this->currentSession,21,2));
                }

                // ROW SAVE AND SCORE DATA
                // if five cards (five suits), push suits and values arrays
                if ($column == 4 && count($this->suitsRow) == 5) {
                    session()->push('dataRow' . $row, $this->suitsRow);
                    session()->push('dataRow' . $row, $this->valuesRow);

                    // send array of suits and values for row to score function
                    $this->scoreFullHand('Row' . $row);
                }

                // reset suits and values before next column
                if ($column == 4) {
                    $this->suitsRow = [];
                    $this->valuesRow = [];
                }
            }
        }

        // LOOP FOR EACH COLUMN
        for ($column = 0; $column < 5; $column++) {
            for ($row = 0; $row < 5; $row++) {
                // ROW SUITS AND VALUES
                // if a card is existing (form length has 233)
                $this->currentSession = session('grid.' . $row . $column);
                if (strlen($this->currentSession) != 235) {
                    // collect suit HDSC and value 02-14 for column
                    array_push($this->suitsColumn, substr($this->currentSession,23,1));
                    array_push($this->valuesColumn, substr($this->currentSession,21,2));
                }

                // COLUMN SAVE AND SCORE DATA
                if ($row == 4 && count($this->suitsColumn) == 5) {
                    session()->push('dataColumn' . $column, $this->suitsColumn);
                    session()->push('dataColumn' . $column, $this->valuesColumn);

                    $this->scoreFullHand('Column' . $column);
                }

                // reset suits and values before next column
                if ($row == 4) {
                    $this->suitsColumn = [];
                    $this->valuesColumn = [];
                }
            }
        }
    }

    public function scoreFullHand($type) {
        // set initial value to 0, increment with ++ when a hand fulfills
        $this->countNothing = 0;
        $this->countPair = 0;
        $this->countTwopairs = 0;
        $this->countThreeofakind = 0;
        $this->countStraight = 0;
        $this->countFlush = 0;
        $this->countFullhouse = 0;
        $this->countFourofakind = 0;
        $this->countStraightflush = 0;
        $this->countRoyalstraightflush = 0;
       // type is string dataRowX/dataColumnX array with suits. Used with session()->put()
       // scoreSession[0] is suits, scoreSession[1] is values
       $this->scoreSession = session('data' . $type);

       // set consecutive to true
       $this->consecutiveArray = true;
        // CREATE COPY ARRAY AND SORT VALUES
       $this->sortedValues = $this->scoreSession[1];
       sort($this->sortedValues);

       // check if consecutive numbers
       for ($i = 0; $i < 4; $i++) {
           if (intval($this->sortedValues[$i+1]) != intval($this->sortedValues[$i]) + 1) {
               $this->consecutiveArray = false;
           }
       }

       if ($this->sortedValues === ["14", "01", "02", "03", "04"]) {
           $this->consecutiveArray = true;
       }
       // END OF SORT


       // ///////////// SAME SUIT /////////////
       // how many different suits. 1 means all are same
        if (count(array_count_values($this->scoreSession[0])) == 1) {
            // if straight
            if ($this->consecutiveArray == true) {
                // ROYAL STRAIGHT FLUSH 10-A
                if ($this->sortedValues[0] == "10") {
                    session()->put('score' . $type, ['score' => 100, 'feedback' => 'ROYAL STRAIGHT FLUSH']);
                    session()->put('count.royalstraightflush', session('count.royalstraightflush') + 1);

                // STRAIGHT FLUSH
                } else {
                    session()->put('score' . $type, ['score' => 75, 'feedback' => 'STRAIGHT FLUSH']);
                    session()->put('count.straightflush', session('count.straightflush') + 1);
                }
            }
            // FLUSH
            elseif ($this->consecutiveArray == false) {
                session()->put('score' . $type, ['score' => 20, 'feedback' => 'FLUSH']);
                session()->put('count.flush', session('count.flush') + 1);
            }
        }

        ///////////// AT LEAST 2 DIFFERENT SUITS /////////////
        elseif (count(array_count_values($this->scoreSession[1])) > 1) {
            $this->occurrencesValues = [];
            // count occurrences of each value, insert into $occurrences array
            $this->times = 0;
            for ($val = 0; $val < 5; $val++) {
                for ($match = 0; $match < 5; $match++) {
                    if ($this->scoreSession[1][$val] == $this->scoreSession[1][$match]) {
                        $this->times++;
                    }
                }
                array_push($this->occurrencesValues, $this->times);
                $this->times = 0;
            }

            // 4 OF A KIND
            if (in_array(4, $this->occurrencesValues)) {
                session()->put('score' . $type, ['score' => 50, 'feedback' => 'FOUR OF A KIND']);
                session()->put('count.fourofakind', session('count.fourofakind') + 1);

                // FULL HOUSE
            } elseif (in_array(3, $this->occurrencesValues) && in_array(2, $this->occurrencesValues)) {
                session()->put('score' . $type, ['score' => 25, 'feedback' => 'FULL HOUSE']);
                session()->put('count.fullhouse', session('count.fullhouse') + 1);

                // 3 OF A KIND
            } elseif (in_array(3, $this->occurrencesValues) && in_array(1, $this->occurrencesValues)) {
                session()->put('score' . $type, ['score' => 10, 'feedback' => 'THREE OF A KIND']);
                session()->put('count.threeofakind', session('count.threeofakind') + 1);

                // 2 PAIRS OR 1 PAIR
            } elseif (in_array(2, $this->occurrencesValues) && in_array(1, $this->occurrencesValues)) {
                // 2 PAIRS
                if (array_count_values($this->occurrencesValues)[2] == 4) {
                    session()->put('score' . $type, ['score' => 5, 'feedback' => 'TWO PAIRS']);
                    session()->put('count.twopairs', session('count.twopairs') + 1);

                    // 1 PAIR
                } elseif (array_count_values($this->occurrencesValues)[2] == 2) {
                    session()->put('score' . $type, ['score' => 2, 'feedback' => 'PAIR']);
                    session()->put('count.pair', session('count.pair') + 1);

                }
                // CHECK FOR STRAIGHT
            } elseif ($this->consecutiveArray == true) {
                session()->put('score' . $type, ['score' => 15, 'feedback' => 'STRAIGHT']);
                session()->put('count.straight', session('count.straight') + 1);

                // NO POINTS
            } elseif ($this->consecutiveArray == false) {
                session()->put('score' . $type, ['score' => 0, 'feedback' => 'NOTHING']);
                session()->put('count.nothing', session('count.nothing') + 1);
            }
        }
    }
}
