<?php

/*
* Card class
*/

declare(strict_types=1);

// Folder \Controllers containing classes
namespace Joki20\Http\Controllers;
use Joki20\Http\Controllers\PokerSquares;

/**
 * Class PokerSquares.
 */

class PokerSquares
{
    use CardHand;

    private ?string $grid;
    private ?string $cells;
    private ?string $row;

    public function createGrid() {

        for ($row = 0; $row < 5; $row++) {
            $this->cells .= '
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            ';
        };

        $this->grid = '
            <table>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            ' . $this->cells . '
            </table>;
            ';

        return $this->grid;
    }
}
