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

        return "<div class='enterName'><form method='POST' autocomplete='off'>
                <input type='text' name='setName' placeholder='Name' minlength=3 onfocus=this.placeholder = required >
                <input type='submit' value='GO'>
            </form></div>
        ";

    }

    public function prepareSessions(): void {

        session()->put('name', $_POST['setName']);
        session()->put('points', 0);
        session()->put('round', 0);
        // create sessions 00-06, 10-14, ... 40-44 with button for card placement
        for ($row = 0; $row < 5; $row++) {
            for ($col = 0; $col < 5; $col++) {
                session()->put(
                    $row . $col, '
                    <form method="POST">
                        <input type="hidden" name="position" value="' . $row . $col . '">
                        <input type="submit" name="placeCard" value="">
                    </form>
                    '
                );
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
        session()->put('countNothing', 0);
        session()->put('countPair', 0);
        session()->put('countTwopairs', 0);
        session()->put('countThreeofakind', 0);
        session()->put('countStraight', 0);
        session()->put('countFlush', 0);
        session()->put('countFullhouse', 0);
        session()->put('countFourofakind', 0);
        session()->put('countStraightflush', 0);
        session()->put('countRoyalstraightflush', 0);
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
        session()->put('totalScore',
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
                    <td>' . session($row . '0') . '</td>
                    <td>' . session($row . '1') . '</td>
                    <td>' . session($row . '2') . '</td>
                    <td>' . session($row . '3') . '</td>
                    <td>' . session($row . '4') . '</td>
                    <td><br><p>' . session('scoreRow' . $row . '.feedback') . '</p><p>' . session('scoreRow' . $row . '.score')  . '</p></td>';
                    // show stack if still rounds left
                if ($row == 0 && session('round') < 25) {
                    $this->cells .= '<td>' . session('06') . '</td></tr>';
                } else {
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
            <table>
                ' . $this->cells . '
            </table>
            ';

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

        // if last card placed, write to database
       session()->put('round', session('round') + 1);

    }

    public function storeToDatabase() {
        // if end of game, add game data to highscore table
       if (session('round') == 25) {
           // create Highscore instance
           $highscore = new Pokerhighscore();
           // insert into database
           $highscore->score = session('totalScore');
           $highscore->player = session('player');
           $highscore->count_nothing = session('countNothing');
           $highscore->count_pair = session('countPair');
           $highscore->count_twopair = session('countTwopairs');
           $highscore->count_threeofakind = session('countThreeofakind');
           $highscore->count_straight = session('countStraight');
           $highscore->count_flush = session('countflush');
           $highscore->count_fullhouse = session('countFullhouse');
           $highscore->count_fourofakind = session('countFourofakind');
           $highscore->count_straightflush = session('countStraightflush');
           $highscore->count_royalstraightflush = session('countRoyalstraightflush');
           // insert name
           // save to db
           $highscore->save();
       }
    }

}
