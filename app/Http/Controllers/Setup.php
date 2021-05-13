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
    private ?array $arr;
    private ?string $currentCard = '';
    private ?string $pos = '';

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
                        <input type='hidden' name='position' value=" . $row . $col . ">
                        <input type='submit' name='placeCard'>
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

    public function prepareStack() {
        $this->stack = '<div class="cardstack">';
        // reversed order compared to array
        foreach (session('deck') as $card) {
            $this->stack .= $card;
        }
        $this->stack .= '</div>';

        session()->put('stack', $this->stack);

        // reverse array (top card is session('deck')[0])
        session()->put('deck', array_reverse(session('deck')));
        // insert shuffled game deck at position 06 (top right)

        session()->put('06', $this->stack);
    }

    public function displayGrid() {
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

        // place card stack at top right position
        session()->put('06', session('stack'));

        return $this->grid;
    }

    public function placeCard(): void {
        // 1. remove first card in session('deck');
        $arr = session('deck');
        $currentCard = array_shift($arr);
        session()->put('deck', $arr);
        // 2. place card at correct place
        $pos = $_POST['position'];
        session()->put($pos, $currentCard);
        // 3. check if scoring occurs
        // 4. calculate total score
    }

}
