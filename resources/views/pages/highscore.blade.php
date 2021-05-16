<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Joki20\Models\Pokerhighscore;

// Book class

?>

<h1>Poker Squares Highscore</h1>

<?php

$pokerhighscores = Pokerhighscore::all();

$scoreDesc = $pokerhighscores->sortByDesc('score');




?>

<table id="highscore">
    <thead>
        <tr>
            <th>Score</th>
            <th>Player</th>
        </tr>
    </thead>
    <tbody>
<?php

foreach ($scoreDesc as $row) { ?>
    <tr>
        <td><?= $row->score ?></td>
        <td><?= $row->player ?></td>
    </tr>
<?php }; ?>
    </tbody>
</table>
