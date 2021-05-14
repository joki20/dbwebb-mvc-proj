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

    public function fullHandsData() {
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

                // ROW SAVE DATA
                // if five cards (five suits), push suits and values arrays
                if ($column == 4 && count($this->suitsRow) == 5) {
                    session()->push('dataRow' . $row, $this->suitsRow);
                    session()->push('dataRow' . $row, $this->valuesRow);
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

                // COLUMN SAVE DATA
                if ($row == 4 && count($this->suitsColumn) == 5) {
                    session()->push('dataColumn' . $column, $this->suitsColumn);
                    session()->push('dataColumn' . $column, $this->valuesColumn);
                }

                // reset suits and values before next column
                if ($row == 4) {
                    $this->suitsColumn = [];
                    $this->valuesColumn = [];
                }
            }
        }
    }

    public function scoreFullHands() {

    }

    //
    //
    //         }
    //     }
    //
    //     // CALCULATE SCORES
    //     if (strlen($this->suitsRow) == 5) {
    //         // if all suits same
    //         if (count(array_count_values($this->suitsRow)) == 1) {
    //             // if royal flush 10-14 (sum is 60)
    //
    //
    //         // collect all suits DHCS
    //         $this->suitsRow .= substr(session($row . $column),23,1);
    //         // collect all values 02-14
    //         $this->valuesRow .= substr(session($row . $column),21,2);
    //     }
    //         // after each row, check what score
    //
    //         // if same characters
    //
    //
    //         }
    //         if (strlen($this->suits) == 5) {
    //
    //         }
    //     }
    //
    //
    //     // for ($card = 0; $card < 5; $card++) {
    //     //     $this->suits = $this->suits . substr($this->hand[$card], 23, 1);
    //     // }
    //     // return $this->suits;
    // }
    //
    // public function valuesRow() {
    //     // for ($card = 0; $card < 5; $card++) {
    //     //     $this->values = $this->values . substr($this->hand[$card], 21, 2);
    //     // }
    //     // return $this->values;
}
