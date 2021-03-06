<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Joki20\Models\Pokerhighscore; // database

?>

<h1>Highscore</h1>

<?php

$pokerhighscores = Pokerhighscore::all();

$scoreDesc = $pokerhighscores->sortByDesc('score');

$rowCount = count($pokerhighscores);

if ($rowCount == 0) {
    print_r('<p>No scores yet</p>');
} else {
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
    <?php } ?>
