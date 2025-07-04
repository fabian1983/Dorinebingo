<?php
// Parameters ophalen met default waardes
$aantal = isset($_GET['aantal']) && is_numeric($_GET['aantal']) ? (int)$_GET['aantal'] : 30;
if ($aantal < 1) $aantal = 30;      // default 30 als te klein
if ($aantal > 250) $aantal = 250;   // max 250

$use_images = isset($_GET['use_images']) && $_GET['use_images'] == '1' ? true : false;


$allowed_themas = ['flippo', 'zorg'];
$thema = $_GET['thema'] ?? 'zorg';

// Bijvoorbeeld om plaatjes folder te bepalen
if ($thema == 'flippo') {
    $imagePath = 'images/flippo';
} elseif ($thema == 'zorg') {
    $imagePath = 'images/zorg';
} else {
    $imagePath = 'images/zorg';
}

// map instellen op basis van thema






// userlogger, indien aanwezig
include __DIR__ . '/userlogger/index.php'; 

// Check of het een AJAX verzoek is om kaarten te genereren
if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {

    function generateCard() {
        $card = [];
        $ranges = [
            'J' => range(1, 15),
            'O' => range(16, 30),
            'R' => range(31, 45),
            'I' => range(46, 60),
            'S' => range(61, 75)
        ];
        foreach ($ranges as $letter => $nums) {
            shuffle($nums);
            $card[$letter] = array_slice($nums, 0, 5);
        }
    $card['R'][2] = "FREE";
        return $card;
    }

    $aantal = isset($_GET['aantal']) ? (int)$_GET['aantal'] : 30;
    $use_images = isset($_GET['use_images']) && $_GET['use_images'] == '1';
    if ($aantal < 1) $aantal = 1;
    if ($aantal > 250) $aantal = 250;

    $kaarten = [];
    for ($i = 0; $i < $aantal; $i++) {
        $kaarten[] = generateCard();
    }

    // Return alleen het kaarten HTML deel
    foreach ($kaarten as $index => $kaart): ?>
        <div class="kaart">
            <h4>J❤️ Kaart <?= $index + 1 ?></h4>
            <table>
                <tr style="color:white; background-color:#e0005b;">
                    <?php foreach (['J','O','R','I','S'] as $col): ?>
                        <th><?= $col ?></th>
                    <?php endforeach; ?>
                </tr>
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <tr>
                        <?php foreach (['J','O','R','I','S'] as $col): 
                            $val = $kaart[$col][$i];
                        ?>
                            <td class="<?= $val === 'FREE' ? 'free' : '' ?>">
                                <?php if ($val === 'FREE'): ?>
                                    FREE 
                                <?php elseif ($use_images): ?>
                                    <img src="<?= $imagePath ?>/<?= $val ?>.png" alt="<?= $val ?>">
                                <?php else: ?>
                                    <b><?= $val ?></b>
                                <?php endif; ?>                                
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endfor; ?>
            </table>
        </div>
    <?php endforeach;

    exit; // einde AJAX response
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dorine's J❤️ris Bingo Kaarten Generator</title>
    <style>
        @media print {
            @page {
                size: landscape;
            }
            /* Verberg header en formulier bij print */
            #page1 {
                display: none;
            }
            /* Elke kaart op een nieuwe pagina */
            .kaart {
                page-break-after: always;
            }
        }
        body { font-family: sans-serif; }
        #kaartContainer {
            margin-top: 20px;
        }
        .kaart { display: inline-block; margin: 10px; border: 2px solid black; padding: 5px; }
        table { border-collapse: collapse; }
        th, td {
            border: 1px solid #333;
            width: 40px;
            height: 40px;
            text-align: center;
        }
        .free { background: #ccc; font-style: italic; }
        img { max-width: 100%; max-height: 100%; }
        label { cursor: pointer; }
    </style>
</head>
<body>

<div id="page1">
    <h1>        <a href='./?'>Dorine's J❤️ris Bingo</a> Kaarten Generator</h1>
    <form id="bingoForm" onsubmit="return false;">
        Aantal J❤️riskaarten: 
<input type="number" name="aantal" value="<?= htmlspecialchars($aantal) ?>" min="1" max="250" id="aantalInput">
<label>
    <input type="checkbox" name="use_images" value="1" id="useImagesCheckbox" <?= $use_images ? 'checked' : '' ?>>
    Met afbeelding en schud de nummers
</label>

        <!-- Geen submit knop meer -->
        <button type="button" onclick="window.print()">Print kaarten (liggend)</button>
    </form>
    <hr>
</div>

<div id="kaartContainer">
    <!-- Kaarten worden hier geladen via AJAX -->
</div>

<script>
// Functie om kaarten via AJAX op te halen
function laadKaarten() {
    const aantal = document.getElementById('aantalInput').value;
    const useImages = document.getElementById('useImagesCheckbox').checked ? 1 : 0;

    const xhr = new XMLHttpRequest();
    xhr.open('GET', '?ajax=1&aantal=' + encodeURIComponent(aantal) + '&use_images=' + useImages, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('kaartContainer').innerHTML = xhr.responseText;
        } else {
            document.getElementById('kaartContainer').innerHTML = 'Fout bij laden kaarten.';
        }
    };
    xhr.send();
}

// Event listeners live update
document.getElementById('aantalInput').addEventListener('input', function() {
    // minimale vertraging om niet te vaak te laden
    clearTimeout(window._kaartTimeout);
    window._kaartTimeout = setTimeout(laadKaarten, 300);
});
document.getElementById('useImagesCheckbox').addEventListener('change', laadKaarten);

// Initial load
window.onload = laadKaarten;
</script>

</body>
</html>
