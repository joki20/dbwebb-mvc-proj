<?php

declare(strict_types=1);

namespace Joki20\Http\Controllers;

use Joki20\Http\Controllers\Deck;
use Joki20\Models\Pokerhighscore;

/**
 * Class Setup;
 */

class Setup extends Deck
{
    private $grid = '';
    private $cells = '';

    public function name()
    {
        return '<div class="enterName"><form method="POST" autocomplete="off">
                <input type="text" name="setName" placeholder="Name" minlength=3 onfocus=this.placeholder = required >
                <input type="submit" value="GO">
            </form></div>
        ';
    }

    public function prepareSessions(): void
    {

        session()->put('name', $_POST['setName']);
        session()->put('points', 0);
        session()->put('round', 0);
        // initialize session grid
        session()->put('grid', [
            '00' => '', '01' => '', '02' => '', '03' => '', '04' => '', '05' => '', '06' => '',
            '10' => '', '11' => '', '12' => '', '13' => '', '14' => '', '15' => '', '16' => '',
            '20' => '', '21' => '', '22' => '', '23' => '', '24' => '', '25' => '', '26' => '',
            '30' => '', '31' => '', '32' => '', '33' => '', '34' => '', '35' => '', '36' => '',
            '40' => '', '41' => '', '42' => '', '43' => '', '44' => '', '45' => '', '46' => '',
            '50' => '', '51' => '', '52' => '', '53' => '', '54' => '', '55' => '', '56' => ''
        ]);
        // create sessions 00-06, 10-14, ... 40-44 with button for card placement
        for ($row = 0; $row < 5; $row++) {
            for ($col = 0; $col < 5; $col++) {
                $cell = strval($row) . strval($col);
                $form = '
                    <form method="POST">
                        <input type="hidden" name="position" value="' . $cell . '">
                        <input type="submit" name="placeCard" value="">
                    </form>
                    ';
                // session()->put('counter', ['countStraight' => $this->countStraight]);
                session()->put('grid.' . strval($cell), $form);
            }
        }

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
        // row scores
        session()->put('scoreRow0', ['score' => null, 'feedback' => '']);
        session()->put('scoreRow1', ['score' => null, 'feedback' => '']);
        session()->put('scoreRow2', ['score' => null, 'feedback' => '']);
        session()->put('scoreRow3', ['score' => null, 'feedback' => '']);
        session()->put('scoreRow4', ['score' => null, 'feedback' => '']);
        // column scores
        session()->put('scoreColumn0', ['score' => null, 'feedback' => '']);
        session()->put('scoreColumn1', ['score' => null, 'feedback' => '']);
        session()->put('scoreColumn2', ['score' => null, 'feedback' => '']);
        session()->put('scoreColumn3', ['score' => null, 'feedback' => '']);
        session()->put('scoreColumn4', ['score' => null, 'feedback' => '']);
        // needs to be set also here (also set in Scoring) since setup
        session()->put('count', [
            'nothing' => 0,
            'pair' => 0,
            'twopairs' => 0,
            'threeofakind' => 0,
            'straight' => 0,
            'flush' => 0,
            'fullhouse' => 0,
            'fourofakind' => 0,
            'straightflush' => 0,
            'royalstraightflush' => 0,
        ]);
    }

    public function shuffleDeck(): void
    {
        // save grid in session
        shuffle($this->deck);
        session()->put('deck', $this->deck);
    }

    public function prepareStack(): void
    {
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

    public function displayGrid()
    {
        session()->put(
            'totalScore',
            session('scoreRow0.score') +
            session('scoreRow1.score') +
            session('scoreRow2.score') +
            session('scoreRow3.score') +
            session('scoreRow4.score') +
            session('scoreColumn0.score') +
            session('scoreColumn1.score') +
            session('scoreColumn2.score') +
            session('scoreColumn3.score') +
            session('scoreColumn4.score')
        );

        print_r('<p class="totalScore">' . (session('round') == 25 ? 'Final ' : 'Current ') . ' score: ' . session('totalScore') . '</p>');

        for ($row = 0; $row < 6; $row++) {
            // if not last row
            if ($row < 5) {
                $this->cells .= '
                <tr>
                    <td>' . session('grid.' . $row . '0') . '</td>
                    <td>' . session('grid.' . $row . '1') . '</td>
                    <td>' . session('grid.' . $row . '2') . '</td>
                    <td>' . session('grid.' . $row . '3') . '</td>
                    <td>' . session('grid.' . $row . '4') . '</td>
                    <td><br><p>' . session('scoreRow' . $row . '.feedback') . '</p><p>' . session('scoreRow' . $row . '.score')  . '</p></td>';
                    // show stack if still rounds left
                if ($row == 0 && session('round') < 25) {
                    $this->cells .= '<td>' . session('06') . '</td></tr>';
                } elseif ($row != 0) {
                    $this->cells .= '<td></td></tr>';
                }
            }

            if ($row == 5) {
                $this->cells .= '
                <tr>
                    <td><p>' . session('scoreColumn0.feedback') . '</p><p>' . session('scoreColumn0.score') . '</p></td>

                    <td><p>' . session('scoreColumn1.feedback') . '</p><p>' . session('scoreColumn1.score') . '</p></td>

                    <td><p>' . session('scoreColumn2.feedback') . '</p><p>' . session('scoreColumn2.score') . '</p></td>

                    <td><p>' . session('scoreColumn3.feedback') . '</p><p>' . session('scoreColumn3.score') . '</p></td>

                    <td><p>' . session('scoreColumn4.feedback') . '</p><p>' . session('scoreColumn4.score') . '</p></td>

                    <td></td>
                    <td></td>
                </tr>';
            }
        }

        $this->grid = '
            <table id="grid">
                ' . $this->cells . '
            </table>
            ';

        session()->put('06', session('stack'));


        return $this->grid;
    }

    public function placeCard(): void
    {

        // 1. remove first card in session('deck');
        $arr = session('deck');
        $currentCard = array_shift($arr);
        session()->put('deck', $arr);
        // 2. place card at correct place
        $pos = $_POST['position'];
        session()->put('grid.' . $pos, $currentCard);

        // if last card placed, write to database
        session()->put('round', session('round') + 1);
    }

    public function storeToDatabase()
    {
        // if end of game, add game data to highscore table
        if (session('round') == 25) {
            // create Highscore instance
            $highscore = new Pokerhighscore();

            // insert into database
            $highscore->score = session('totalScore');
            $highscore->player = session('name');
            $highscore->count_nothing = session('count.nothing');
            $highscore->count_pair = session('count.pair');
            $highscore->count_twopairs = session('count.twopairs');
            $highscore->count_threeofakind = session('count.threeofakind');
            $highscore->count_straight = session('count.straight');
            $highscore->count_flush = session('count.flush');
            $highscore->count_fullhouse = session('count.fullhouse');
            $highscore->count_fourofakind = session('count.fourofakind');
            $highscore->count_straightflush = session('count.straightflush');
            $highscore->count_royalstraightflush = session('count.royalstraightflush');
            // insert name
            // save to db
            $highscore->save();
        }
    }
}
