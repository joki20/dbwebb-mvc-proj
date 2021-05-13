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
        // session()->put('gridData', [ // 7x6 [row][column]
        //     ['','','','','','',''],
        //     ['','','','','','',''],
        //     ['','','','','','',''],
        //     ['','','','','','',''],
        //     ['','','','','','',''],
        //     ['','','','','','','']
        // ]);

        session()->put('00','');
        session()->put('01','');
        session()->put('02','');
        session()->put('03','');
        session()->put('04','');
        session()->put('05','');
        session()->put('06','');
        session()->put('07','');
        session()->put('10','');
        session()->put('11','');
        session()->put('12','');
        session()->put('13','');
        session()->put('14','');
        session()->put('15','');
        session()->put('16','');
        session()->put('17','');
        session()->put('20','');
        session()->put('21','');
        session()->put('22','');
        session()->put('23','');
        session()->put('24','');
        session()->put('25','');
        session()->put('26','');
        session()->put('27','');
        session()->put('30','');
        session()->put('31','');
        session()->put('32','');
        session()->put('33','');
        session()->put('34','');
        session()->put('35','');
        session()->put('36','');
        session()->put('37','');
        session()->put('40','');
        session()->put('41','');
        session()->put('42','');
        session()->put('43','');
        session()->put('44','');
        session()->put('45','');
        session()->put('46','');
        session()->put('47','');
        session()->put('50','');
        session()->put('51','');
        session()->put('52','');
        session()->put('53','');
        session()->put('54','');
        session()->put('55','');
        session()->put('56','');
        session()->put('57','');
        session()->put('60','');
        session()->put('61','');
        session()->put('62','');
        session()->put('63','');
        session()->put('64','');
        session()->put('65','');
        session()->put('66','');
        session()->put('67','');
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

        session()->put('stack', $this->stack);
        //Session::push('user.teams', 'developers');
        session('gridData')[0][0]->put("hej");
    }

    public function setupGrid() {
        var_dump(session('gridData'));
        // $stack = session('stack');

        for ($row = 0; $row < 6; $row++) {
            $this->cells .= '
            <tr>
                <td>' . session('gridData')[$row][0] . '</td>
                <td>' . session('gridData')[$row][1] . '</td>
                <td>' . session('gridData')[$row][2] . '</td>
                <td>' . session('gridData')[$row][3] . '</td>
                <td>' . session('gridData')[$row][4] . '</td>
                <td>' . session('gridData')[$row][5] . '</td>
                <td>' . session('gridData')[$row][6] . '</td>';
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
