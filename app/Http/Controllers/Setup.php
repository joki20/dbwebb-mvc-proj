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

    public function saveName(): void {
        session()->put('name', $_POST['setName']);
        session()->put('points', 0);
        // create sessions 00-06, 10-16, ... 70-76
        for ($row = 0; $row < 7; $row++) {
            for ($col = 0; $col < 6; $col++) {
                session()->put($row . $col, '');
            }
        }

    }

    public function shuffleDeck(): void {
        // save grid in session
        shuffle($this->deck);
        session()->put('deck', $this->deck);
    }

    public function createStack() {
        $this->stack = '<div class="cardstack">';
        foreach (session('deck') as $card) {
            $this->stack .= $card;
        }
        $this->stack .= '</div>';

        session()->put('06', $this->stack);
        //Session::push('user.teams', 'developers');
        // session('gridData')[0][0]->put("hej");
    }

    public function setupGrid() {
        for ($row = 0; $row < 6; $row++) {
            $this->cells .= '
            <tr>
                <td>' . session($row . '0') . '</td>
                <td>' . session($row . '1') . '</td>
                <td>' . session($row . '2') . '</td>
                <td>' . session($row . '3') . '</td>
                <td>' . session($row . '4') . '</td>
                <td>' . session($row . '5') . '</td>
                <td>' . session($row . '6') . '</td>';
            //     <td>';
            // // if ($row == 0) { $this->cells .= $stack; };
            // // $this->cells .= '</td>
            // </tr>
            // ';
        }

        $this->grid = '
            <table>
                ' . $this->cells . '
            </table>
            ';

        session()->put('grid', $this->grid);

        return $this->grid;
    }

}
