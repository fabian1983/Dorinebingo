🎉 Dorine's J❤️ris Bingo Molen
Een vrolijke en volledig interactieve Bingo Web App gebouwd in PHP. Perfect voor zorginstellingen, verjaardagen of familiefeesten! 
De webapplicatie genereert een persoonlijke bingo-kaart en laat je live bingo-nummers trekken – met of zonder afbeeldingen.

✨ Functionaliteit

✅ Genereert automatisch één gepersonaliseerde J❤️RIS-bingokaart per gebruiker

✅ Bingo-kaart heeft de kolommen: J, O, R, I, S (zoals BINGO, maar dan leuker 😄)

✅ Trek willekeurig getallen van 1 t/m 75

✅ Toon het laatst getrokken nummer groots, optioneel met een zorg-afbeelding (images/zorg/[nummer].png)

✅ Hou bij welke nummers al getrokken zijn

✅ Toon welke nummers al op jouw kaart afgevinkt zijn

✅ Resetmogelijkheid om een nieuw spel te starten

✅ Mogelijkheid om meerdere bingo-kaarten te printen via kaarten.php

✅ Optie om te spelen met of zonder afbeeldingen

📦 Bestandsoverzicht
index.php: hoofdspel, inclusief het trekken van nummers, tonen van je eigen kaart en de historie

kaarten.php: genereert tot 50 printbare bingo-kaarten

images/zorg/: map met 75 afbeeldingen (genummerd 1.png t/m 75.png), optioneel gebruikt bij het tonen van getrokken nummers en kaarten

📋 Bingo Kaartstructuur
Elke bingo-kaart bestaat uit 5 kolommen met bijbehorende nummerbereiken:

Kolom	Bereik
J	1–15
O	16–30
R	31–45
I	46–60
S	61–75

De middelste cel in kolom R is automatisch een gratis vakje: "FREE"

🖼️ Afbeeldingen (optioneel)
Je kunt het spel spelen met zorg-afbeeldingen in plaats van cijfers. Voeg daarvoor 75 afbeeldingen toe in de map images/zorg/, elk genummerd van 1.png tot 75.png. Zorg dat ze vierkant zijn (bijv. 100x100 pixels).
Gebruik bijvoorbeeld een PowerShell-script of online tool om de afbeeldingen automatisch te resizen.

📑 Instructies voor gebruik
Plaats alle bestanden op een server met PHP-ondersteuning

Open index.php in je browser

Klik op 🎲 Trek nieuw nummer om nummers te trekken

Bekijk of het getrokken nummer op je kaart staat (groen gemarkeerd)

Vink de optie "Afbeelding" aan voor de zorgversie met plaatjes

Print extra kaarten via kaarten.php

🔄 Opnieuw beginnen?
Klik op 🔄 Nieuw J❤️ris Bingo starten om alle voortgang te wissen en een nieuwe kaart + trekking te beginnen. Dit reset de sessie.

📊 Statistische info
Onder de trekking zie je bij benadering hoeveel getrokken nummers nodig zijn voor:

1 Lijn

2 Lijnen

Volle kaart

Voor verschillende groepsgroottes (25–100 spelers).

🧑‍💻 Gebouwd met
PHP (met $_SESSION)

HTML/CSS (zonder JavaScript)

Optioneel afbeeldingen in PNG-formaat

Gebruiksvriendelijk op desktop en tablet

🧠 Tip
Overweeg een zomereditie of andere thema’s door simpelweg de afbeeldingen in de map images/zorg/ aan te passen!
