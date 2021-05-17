<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Joki20\Http\Controllers\Histogram;
use Joki20\Models\Pokerhighscore; // database

?>

<h1>Histogram</h1>

<?php

$pokerhighscores = Pokerhighscore::all();
$rowCount = count($pokerhighscores);

$histogram = new Histogram();
$histogramArray = $histogram->getSerie();


if ($rowCount == 0) {
    print_r('<p>No data to show yet</p>');
} else {
    ?>
        <table id="histogram">
            <thead>
                <tr>
                    <th>Hand</th>
                    <th>Share</th>
                    <th>Frequency</th>
                </tr>
            </thead>
            <tbody>
        <?php

        foreach ($histogramArray as $hand) { ?>
            <tr>
                <td><?= $hand[0] ?></td>
                <td><?= $hand[1] ?></td>
                <td><?= $hand[2] ?></tr>
        <?php }; ?>
            </tbody>
        </table>
    <?php } ?>
