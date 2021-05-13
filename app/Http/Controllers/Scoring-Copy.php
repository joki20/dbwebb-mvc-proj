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

    private ?int $columnCounter = 0;
    private ?int $rowCounter = 0;
    private ?array $suitsRow = [];
    private ?array $valuesRow = [];
    private ?array $suitsColumn = [];
    private ?array $valuesColumn = [];

    public function dataRow() {
        $this->suitsRow = [];
        $this->valuesRow = [];

        for ($row = 0; $row < 5; $row++) {
            for ($column = 0; $column < 5; $column++) {
                // initial length is 0, if not then session contians card

                // ROW SUITS AND VALUES
                // if a card is existing
                if (!str_starts_with(session("$row . $column"), '<form')) {
                    // collect suit HDSC
                    array_push($this->suitsRow, substr(session($row . $column),23,1));
                    // collect value 02-14
                    array_push($this->valuesRow, substr(session($row . $column),21,2));
                }

                // if there are five cards in row (five suits)
                if ($column == 4 && count($this->suitsRow) == 5) {
                    session()->push('dataRow' . $row, $this->suitsRow);
                    session()->push('dataRow' . $row, $this->valuesRow);
                }

                // reset suits and values before next row
                if ($column == 4) {
                    $this->suits = [];
                    $this->values = [];
                }
            }
        }
    }

    // public function rowData() {
    //     for ($row = 0; $row < 5; $row++) {
    //         // ROW SUITS AND VALUES
    //         if (strlen(session($row . $column)) != 0 ) {
    //             // collect all suits DHCS
    //             array_push($this->suitsRow, substr(session($row . 0),23,1));
    //             // collect all values 02-14
    //             array_push($this->valuesRow, substr(session($row . 0),21,2));
    //             }
    //         }
    //     }
    // }
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
