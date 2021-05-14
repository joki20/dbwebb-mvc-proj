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

        // LOOP FOR EACH ROW
        for ($row = 0; $row < 5; $row++) {
            for ($column = 0; $column < 5; $column++) {
                // initial length is 0, if not then session contians card
                // ROW SUITS AND VALUES
                // if a card is existing (form length has 233)
                $this->currentSession = session($row . $column);
                if (strlen($this->currentSession) != 233) {
                    // collect suit HDSC and value 02-14 for row
                    array_push($this->suitsRow, substr(session($row . $column),23,1));
                    array_push($this->valuesRow, substr(session($row . $column),21,2));
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
                $this->currentSession = session($row . $column);
                if (strlen($this->currentSession) != 233) {
                    // collect suit HDSC and value 02-14 for column
                    array_push($this->suitsColumn, substr(session($row . $column),23,1));
                    array_push($this->valuesColumn, substr(session($row . $column),21,2));
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
       // type is string dataRowX/dataColumnX array with suits. Used with session()->put()
       // scoreSession[0] is suits, scoreSession[1] is values
       $this->scoreSession = session('data' . $type);

       // set consecutive to true
       $this->consecutiveArray = true;
        // CREATE COPY ARRAY AND SORT VALUES
       $this->sortedValues = $this->scoreSession[1];
       asort($this->sortedValues);

       // check if consecutive numbers
       for ($i = 0; $i < 4; $i++) {
           if ($this->sortedValues[$i+1] != $this->sortedValues[$i] + 1) {
               $this->consecutiveArray = false;
           }
       }

       if ($this->sortedValues === ["14", "1", "2", "3", "4"]) {
           $this->consecutiveArray = true;
       }
       // END OF SORT


       // ///////////// SAME SUIT /////////////
        if (count(array_count_values($this->scoreSession[0])) == 1) {
            // if straight
            if ($this->consecutiveArray == true) {
                // ROYAL STRAIGHT FLUSH 10-A
                if ($this->sortedValues[0] == "10") {
                    session()->put('score' . $type, 100);
                // STRAIGHT FLUSH
                } else {
                    session()->put('score' . $type, 75);
                }
            }
            // FLUSH
            elseif ($this->consecutiveArray == false) {
                session()->put('score' . $type, 20);
            }
        }

        ///////////// AT LEAST 2 DIFFERENT SUITS /////////////
        elseif (count(array_count_values($this->scoreSession[1])) > 1) {
            // count occurrences of each value, insert into $occurrences array
            foreach ($this->scoreSession[1] as $value) {
                array_push($this->occurrencesValues, count($this->scoreSession, intval($value)));
            }
            // 4 OF A KIND
            if (in_array("4", $this->occurrencesValues)) {
                session()->put('score' . $type, 50);
                // FULL HOUSE
            } elseif (in_array("3", $this->occurrencesValues) && in_array("2", $this->occurrencesValues)) {
                session()->put('score' . $type, 25);
                // 3 OF A KIND
            } elseif (in_array("3", $this->occurrencesValues) && in_array("1", $this->occurrencesValues)) {
                session()->put('score' . $type, 25);
                // 2 PAIR
            } elseif (in_array("2", $this->occurrencesValues) && count($this->occurrencesValues, 1) == "1") {
                session()->put('score' . $type, 5);
                // PAIR
            } elseif (in_array("2", $this->occurrencesValues) && count($this->occurrencesValues, 1) == "3") {
                session()->put('score' . $type, 2);
                var_dump("hej");
                // CHECK FOR STRAIGHT
            } elseif ($this->consecutiveArray == true) {
                session()->put('score' . $type, 15);
                // no points
            } elseif ($this->consecutiveArray == false) {
                session()->put('score' . $type, 0);
            }
        }
    }
}
