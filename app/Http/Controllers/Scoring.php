<?php

declare(strict_types=1);

// Folder \Controllers containing classes
namespace Joki20\Http\Controllers;

// use Joki20\Http\Controllers\PokerSquares;
use Joki20\Http\Controllers\Setup;

/**
 * Class Scoring;
 */


class Scoring extends Setup
{
    private string $currentSession = '';
    private array $suitsRow = [];
    private array $valuesRow = [];
    private array $suitsColumn = [];
    private array $valuesColumn = [];
    private array $scoreSession = [];
    private array $sortedValues = [];
    private bool $consecutiveArray = false;
    private int $times;
    private array $occurrencesValues = [];
    private bool $notScoredYet;

    public function setPointsSessions(): void
    {
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
            'nothing' => 0, 'pair' => 0,
            'twoPairs' => 0, 'threeofakind' => 0,
            'straight' => 0, 'flush' => 0,
            'fullhouse' => 0, 'fourofakind' => 0,
            'straightflush' => 0, 'royalstraightflush' => 0
        ]);
    }

    public function checkFullRow(): void
    {
        // LOOP FOR EACH ROW
        for ($row = 0; $row < 5; $row++) {
            for ($column = 0; $column < 5; $column++) {
                $this->notScoredYet = true;
                // initial length is 0, if not then session contians card
                // ROW SUITS AND VALUES
                // if a card is existing (form length has 235)
                $this->currentSession = session('grid.' . $row . $column);
                if (strlen($this->currentSession) != 235) {
                    // collect suit HDSC and value 02-14 for row
                    array_push($this->suitsRow, substr($this->currentSession, 23, 1));
                    array_push($this->valuesRow, substr($this->currentSession, 21, 2));
                }
                // ROW SAVE AND SCORE DATA
                // if five cards (five suits), push suits and values arrays
                if ($column == 4 && count($this->suitsRow) == 5) {
                    // session('dataRow00', [[H,D,C,S,D],[03,05,01,13,10]])
                    session()->push('dataRow' . $row, $this->suitsRow);
                    session()->push('dataRow' . $row, $this->valuesRow);
                    // send array of suits and values for row to score function
                    $this->sortHand('Row' . $row);
                    // when match is found, $this->notScoredYet = false and rest of functions will not proceed
                    $this->scoreSameSuit('Row' . $row);
                    $this->checkValueOccurrence('Row' . $row);
                    $this->fourOfaKind('Row' . $row);
                    $this->fullHouse('Row' . $row);
                    $this->threeOfAKind('Row' . $row);
                    $this->twoPairsOrPair('Row' . $row);
                    $this->straightOrNothing('Row' . $row);

                    // before next loop, reset to false
                    $this->setNotScoredYetBackToFalse();
                }
                // reset suits and values before next column
                if ($column == 4) {
                    $this->suitsRow = [];
                    $this->valuesRow = [];
                }
            }
        }
    }

    public function checkFullColumn(): void
    {
        // LOOP FOR EACH COLUMN
        for ($column = 0; $column < 5; $column++) {
            for ($row = 0; $row < 5; $row++) {
                $this->notScoredYet = true;
                // ROW SUITS AND VALUES
                // if a card is existing (form length has 233)
                $this->currentSession = session('grid.' . $row . $column);
                if (strlen($this->currentSession) != 235) {
                    // collect suit HDSC and value 02-14 for column
                    array_push($this->suitsColumn, substr($this->currentSession, 23, 1));
                    array_push($this->valuesColumn, substr($this->currentSession, 21, 2));
                }
                // COLUMN SAVE AND SCORE DATA
                if ($row == 4 && count($this->suitsColumn) == 5) {
                    session()->push('dataColumn' . $column, $this->suitsColumn);
                    session()->push('dataColumn' . $column, $this->valuesColumn);

                    //begin with sorting hand and set
                    $this->sortHand('Column' . $column);
                    // when match is found, $this->notScoredYet = false and rest of functions will not proceed
                    $this->scoreSameSuit('Column' . $column);
                    $this->checkValueOccurrence('Column' . $column);
                    $this->fourOfaKind('Column' . $column);
                    $this->fullHouse('Column' . $column);
                    $this->threeOfAKind('Column' . $column);
                    $this->twoPairsOrPair('Column' . $column);
                    $this->straightOrNothing('Column' . $column);
                    // before next loop, reset to false
                    $this->setNotScoredYetBackToFalse();
                }
                // reset suits and values before next column
                if ($row == 4) {
                    $this->suitsColumn = [];
                    $this->valuesColumn = [];
                }
            }
        }
    }

    public function sortHand($type)
    {
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
        $this->consecutiveArray = false;

       // type is string dataRowX/dataColumnX array with suits. Used with session()->put()
       // scoreSession[0] is suits, scoreSession[1] is values
        $this->scoreSession = session('data' . $type); // i e dataRow21
       // set consecutive to true
        $this->consecutiveArray = true;
        // CREATE COPY ARRAY AND SORT VALUES
        $this->sortedValues = $this->scoreSession[1];
        sort($this->sortedValues);
       // check if consecutive numbers
        for ($i = 0; $i < 4; $i++) {
            if (intval($this->sortedValues[$i + 1]) != intval($this->sortedValues[$i]) + 1) {
                $this->consecutiveArray = false;
            }
        }

        if ($this->sortedValues === ["14", "01", "02", "03", "04"]) {
            $this->consecutiveArray = true;
        }

        return $this->sortedValues;
       // END OF SORT
    }

    public function scoreSameSuit($type)
    {
        if ($this->notScoredYet == true) {
            // ///////////// SAME SUIT /////////////
            // how many different suits. 1 means all are same
            if (count(array_count_values($this->scoreSession[0])) == 1) {
                // if straight
                if ($this->consecutiveArray == true) {
                    // ROYAL STRAIGHT FLUSH 10-A
                    if ($this->sortedValues[0] == "10") {
                        session()->put('score' . $type, ['score' => 100, 'feedback' => 'ROYAL STRAIGHT FLUSH']);
                        session()->put('count.royalstraightflush', session('count.royalstraightflush') + 1);
                        $this->notScoredYet = false;
                    // STRAIGHT FLUSH
                    } elseif (($this->sortedValues[0] != "10")) {
                        session()->put('score' . $type, ['score' => 75, 'feedback' => 'STRAIGHT FLUSH']);
                        session()->put('count.straightflush', session('count.straightflush') + 1);
                        $this->notScoredYet = false;
                    } // FLUSH
                } elseif ($this->consecutiveArray == false) {
                    session()->put('score' . $type, ['score' => 20, 'feedback' => 'FLUSH']);
                    session()->put('count.flush', session('count.flush') + 1);
                    $this->notScoredYet = false;
                }
            }
        }
    }

    public function checkValueOccurrence(): void
    {
        if ($this->notScoredYet == true) {
            if (count(array_count_values($this->scoreSession[1])) > 1) {
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
            }
        }
    }

    public function fourOfAKind($type): void
    {
        if ($this->notScoredYet == true) {
            // 4 OF A KIND
            if (in_array(4, $this->occurrencesValues)) {
                session()->put('score' . $type, ['score' => 50, 'feedback' => 'FOUR OF A KIND']);
                session()->put('count.fourofakind', session('count.fourofakind') + 1);
                $this->notScoredYet = false;
            }
        }
    }
    public function fullHouse($type): void
    {
        if ($this->notScoredYet == true) {
            // FULL HOUSE
            if (in_array(3, $this->occurrencesValues) && in_array(2, $this->occurrencesValues)) {
                session()->put('score' . $type, ['score' => 25, 'feedback' => 'FULL HOUSE']);
                session()->put('count.fullhouse', session('count.fullhouse') + 1);
                $this->notScoredYet = false;
            }
        }
    }

    public function threeOfAKind($type): void
    {
        if ($this->notScoredYet == true) {
            // 3 OF A KIND
            if (in_array(3, $this->occurrencesValues) && in_array(1, $this->occurrencesValues)) {
                session()->put('score' . $type, ['score' => 10, 'feedback' => 'THREE OF A KIND']);
                session()->put('count.threeofakind', session('count.threeofakind') + 1);
                $this->notScoredYet = false;
            }
        }
    }

    public function twoPairsOrPair($type): void
    {
        if ($this->notScoredYet == true) {
            // 2 PAIRS OR 1 PAIR
            if (in_array(2, $this->occurrencesValues) && in_array(1, $this->occurrencesValues)) {
                // 2 PAIRS
                if (array_count_values($this->occurrencesValues)[2] == 4) {
                    session()->put('score' . $type, ['score' => 5, 'feedback' => 'TWO PAIRS']);
                    session()->put('count.twopairs', session('count.twopairs') + 1);
                    $this->notScoredYet = false;
                }
            }
        }

        // PAIR
        if ($this->notScoredYet == true) {
            // 2 PAIRS OR 1 PAIR
            if (in_array(2, $this->occurrencesValues) && in_array(1, $this->occurrencesValues)) {
                // 1 PAIR
                if (array_count_values($this->occurrencesValues)[2] == 2) {
                    session()->put('score' . $type, ['score' => 2, 'feedback' => 'PAIR']);
                    session()->put('count.pair', session('count.pair') + 1);
                    $this->notScoredYet = false;
                }
            }
        }
    }

    public function straightOrNothing($type): void
    {
        if ($this->notScoredYet == true) {
            // CHECK FOR STRAIGHT
            if ($this->consecutiveArray == true) {
                session()->put('score' . $type, ['score' => 15, 'feedback' => 'STRAIGHT']);
                session()->put('count.straight', session('count.straight') + 1);
                $this->notScoredYet = false;
            }
        }

        if ($this->notScoredYet == true) {
            // NO POINTS
            session()->put('score' . $type, ['score' => 0, 'feedback' => 'NOTHING']);
            session()->put('count.nothing', session('count.nothing') + 1);
            $this->notScoredYet = false;
        }
    }

    public function setNotScoredYetBackToFalse(): void
    {
        $this->notScoredYet = true;
    }
}
