<?php

/*
* Setup trait
*/

declare(strict_types=1);

namespace Joki20\Http\Controllers;
use Joki20\Http\Controllers\Deck;

trait Setup
{
    use Deck;
    private ?string $grid = '';
    private ?string $cells = '';
    private ?string $row = '';

    public function name() {
        return '
            <form method="POST" autocomplete="off">
                <input type="text" name="setName" placeholder="Name" minlength=3 required >
                <input type="submit" value="start">
            </form>
        ';

    }

    public function prepareSessions(): void {
        session()->put('name', $_POST['setName']);
        session()->put('points', 0);
        // create sessions 00-06, 10-14, ... 40-44 with button for card placement
        for ($row = 0; $row < 5; $row++) {
            for ($col = 0; $col < 5; $col++) {
                session()->put(
                    $row . $col, "
                    <form method='POST'>
                        <input type='submit' name= " . $row . $col . " value='hej'
                    </form>
                    "
                );
            }
        }
        // column scores
        session()->put('scoreColumn0', '');
        session()->put('scoreColumn1', '');
        session()->put('scoreColumn2', '');
        session()->put('scoreColumn3', '');
        session()->put('scoreColumn4', '');
        // row scores
        session()->put('scoreRow0', '');
        session()->put('scoreRow1', '');
        session()->put('scoreRow2', '');
        session()->put('scoreRow3', '');
        session()->put('scoreRow4', '');
    }

    public function shuffleDeck(): void {
        // save grid in session
        shuffle($this->deck);
        session()->put('deck', $this->deck);
    }

    public function createStack() {
        $this->stack = '<div class="cardstack">';
        // reversed order compared to array
        foreach (session('deck') as $card) {
            $this->stack .= $card;
        }
        $this->stack .= '</div>';

        // reverse array (top card is session('deck')[0])
        session()->put('deck', array_reverse(session('deck')));
        // insert shuffled game deck at position 06 (top right)
        session()->put('06', $this->stack);
    }

    public function setupGrid() {
        for ($row = 0; $row < 6; $row++) {
            // if not last row
            if ($row != 5) {
                $this->cells .= '
                <tr>
                    <td>' . session($row . '0') . '</td>
                    <td>' . session($row . '1') . '</td>
                    <td>' . session($row . '2') . '</td>
                    <td>' . session($row . '3') . '</td>
                    <td>' . session($row . '4') . '</td>
                    <td>' . session('scoreRow' . $row)  . '</td>
                    <td>' . session($row . '6') . '</td>
                </tr>';
            } else {
                $this->cells .= '
                <tr>
                    <td>' . session('scoreColumn0') . '</td>
                    <td>' . session('scoreColumn1') . '</td>
                    <td>' . session('scoreColumn2') . '</td>
                    <td>' . session('scoreColumn3') . '</td>
                    <td>' . session('scoreColumn4') . '</td>
                    <td></td>
                    <td></td>
                </tr>';
            }
        }

        $this->grid = '
            <table>
                ' . $this->cells . '
            </table>
            ';

        return $this->grid;
    }

}
