<?php 
session_start();

if (!isset($_SESSION['bingo_card'])) {
    $_SESSION['bingo_card'] = generateCard();
    $_SESSION['drawn_numbers'] = [];
    $_SESSION['remaining_numbers'] = range(1, 75);
    $_SESSION['use_images'] = false;
}

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

if (isset($_POST['draw']) && count($_SESSION['remaining_numbers']) > 0) {
    shuffle($_SESSION['remaining_numbers']);
    $next = array_pop($_SESSION['remaining_numbers']);
    $_SESSION['drawn_numbers'][] = $next;
}

if (isset($_POST['reset'])) {
    session_destroy();
    header("Location: ?");
    exit();
}

if (isset($_POST['use_images'])) {
    $_SESSION['use_images'] = true;
} elseif (!isset($_POST['draw'])) {
    $_SESSION['use_images'] = false;
}

$lastNumber = end($_SESSION['drawn_numbers']);
$totalDrawn = count($_SESSION['drawn_numbers']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dorine's J❤️ris Bingo Molen</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background-color: #fafafa;
        }
        

        h1 {
            margin: 20px;
            color: #e0005b;
        }

        form {
            margin: 10px 0;
        }

        .controls {
            margin-bottom: 20px;
        }

        .flex-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin: 20px;
        }

        .column {
            flex: 1 1 45%;
            background-color: #fff;
            margin: 10px;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        table {
            border-collapse: collapse;
            margin: 0 auto;
            

        }

        th, td {
            border: 1px solid #999;
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 18px;            
        }
        .big-button {
            font-size: 24px;
            padding: 15px 30px;
            margin: 10px;
            cursor: pointer;
        }

        .drawn {
            background-color: #a5d6a7;
            font-weight: bold;
        }

        .free {
            background-color: #ccc;
            font-style: italic;
        }

        .number-anim {
            font-size: 200px;
            font-weight: bold;
            color: #d32f2f;
            animation: pop 0.5s ease-out;
        }

        @keyframes pop {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.3); opacity: 1; }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>

<h1>Dorine's J❤️ris Bingo Molen</h1>
<form method="post" class="controls">
    <button type="submit" name="reset" onclick="return confirm('Hey Dorine Weet je zeker dat je een nieuwe J❤️ris Bingo wilt starten? Alle voortgang gaat verloren. De woners kunnen dit niet waarderen als de J❤️ris Bingo NIET is afgelopen !')">🔄 Nieuw J❤️ris Bingo starten</button>
    <label>
        <input type="checkbox" name="use_images" value="1" <?= $_SESSION['use_images'] ? 'checked' : '' ?> onchange="this.form.submit()"> Afbeelding
    </label> =|= 
 <b>
        <a href='kaarten.php'>Maak 50x J❤️ris Kaarten</a> 
        <a href='kaarten.php?aantal=50' > ZONDER afbeelding</a> of  
        <a href='kaarten.php?aantal=50&use_images=1'>MET Zorgafbeelding</a>  </b>

</form>





<div class="flex-container">
    <!-- 🎯 Linkerkolom: Getrokken + trekknop -->
    <div class="column " >
        <form method="post">
            <button type="submit" name="draw" class="big-button">🎲 Trek nieuw nummer</button>
        </form>

        <?php if ($lastNumber): ?>
            <div class="number-anim">
                <?php if ($_SESSION['use_images']): ?>
                    <img src="images/zorg/<?= $lastNumber ?>.png" width="250">
                <?php else: ?>
                    <?= $lastNumber ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        

<table style="width:100%; color:white; background-color:#e0005b;">

    <thead>
        <tr>
            <th><p><strong>Trekking <?= $totalDrawn ?></strong>  (Max 75)</p></th>
            <th>25 spelers</th>
            <th>50 spelers</th>
            <th>75 spelers</th>
            <th>100 spelers</th>
        </tr>
    </thead>
    <tbody>
        <tr><td><b>1 Lijn</b></td><td>~29</td><td>~24</td><td>~22</td><td>~21</td></tr>
        <tr><td><b>2 Lijnen</b></td><td>~32</td><td>~27</td><td>~25</td><td>~24</td></tr>
        <tr><td>Volle Kaart</td><td>~42</td><td>~38</td><td>~37</td><td>~35</td></tr>
    </tbody>



</table>


        <hr>
         <h2>Dorine's J❤️ris Kaart</h2>
        <table>
            <tr >
                <?php foreach (['J','O','R','I','S'] as $col): ?>
                    <th style="color:white; background-color:#e0005b;"><?= $col ?></th>
                <?php endforeach; ?>
            </tr>
            <?php for ($i = 0; $i < 5; $i++): ?>
                <tr >
                    <?php foreach (['J','O','R','I','S'] as $col): 
                        $val = $_SESSION['bingo_card'][$col][$i];
                        $isDrawn = is_numeric($val) && in_array($val, $_SESSION['drawn_numbers']);
                        $class = $val === 'FREE' ? 'free' : ($isDrawn ? 'drawn' : '');
                    ?>
                        <td class="<?= $class ?>">
                            <?php if ($val === 'FREE'): ?>
                                FREE
                            <?php elseif ($_SESSION['use_images']): ?>
                                <img src="images/zorg/<?= $val ?>.png" alt="<?= $val ?>" width="35">
                            <?php else: ?>
                                <?= $val ?>
                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>

    <!-- 🧍 Rechterkolom: Jouw kaart + overzicht -->
    <div class="column">
       <h2 style="margin-top:30px;">📋 Getrokken nummers </h2>
            <p><strong>Aantal nummers getrokken:</strong> <?= $totalDrawn ?>/75</p>
        <table>
            <tr>
                <?php foreach (['J','O','R','I','S'] as $col): ?>
                    <th style="color:white; background-color:#e0005b;"><?= $col ?></th>
                <?php endforeach; ?>
            </tr>
            <?php for ($r = 0; $r < 15; $r++): ?>
                <tr>
                    <?php for ($c = 0; $c < 5; $c++): 
                        $num = $r + 1 + $c * 15;
                        $isDrawn = in_array($num, $_SESSION['drawn_numbers']);
                    ?>
                        <td class="<?= $isDrawn ? 'drawn' : '' ?>">
                            <?php if ($_SESSION['use_images']): ?>
                                <img src="images/zorg/<?= $num ?>.png" alt="<?= $num ?>" width="35">
                            <?php else: ?>
                                <b><?= $num ?></b>
                            <?php endif; ?>
                        </td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
</div>
Misschien kun je hem ooit breder inzetten, mocht het aanslaan, een zomer editie etc etc<br>
plaatjes : ik heb er 75 nodig, voor in map images<br>
liefste zijn ze allemaal even groot , 100px x 100px<br> 
zolang de breedte en lengte even groot zijn  mag het ook een andere maat zijn! Er zijn tools om ze te resizen en powershell kan het ook.
<form action="kaarten.php" method="get" target="_blank">
    <label for="aantal">Aantal J❤️ris kaarten om te printen:</label>
    <input type="number" name="aantal" id="aantal" min="4" step="4" value="4" required>
    <label>
        <input type="checkbox" name="use_images" value="1"> Met plaatjes
    </label>
    <button type="submit">🖨️ Print Bingo kaarten</button>
</form>

</body>
</html>

