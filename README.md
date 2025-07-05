# 🎉 Dorine's J❤️ris Bingo Molen 🎲

Welkom bij **Dorine's J❤️ris Bingo Molen** 
– Een interactieve webapp om ouderwets bingo te spelen, speciaal met een J❤️ris-thema!
– Deze PHP-app genereert een bingo-kaart, laat willekeurig getrokken nummers zien.
– Ondersteunt zowel tekst als afbeeldingen per nummer.
- 🎫 Willekeurige bingo-kaarten volgens het J-O-R-I-S schema (B-I-N-G-O, maar anders 😉)
- 🎲 Trek willekeurig nummers (1 t/m 75)
- 🖼️ Ondersteuning voor afbeeldingen (optioneel)
- 🧮 Live statistiek over getrokken nummers
- 🖨️ Mogelijkheid om veel bingo-kaarten tegelijk te printen (alleen de kaarten)
- 🧼 Reset-knop om opnieuw te beginnen
- 🎁 Inclusief "FREE"-vakje in het midden van de J❤️ris Kaart

---

## 📦 Bestandsoverzicht
- index.php: hoofdspel, inclusief het trekken van nummers, tonen van je eigen kaart en de historie
- kaarten.php: genereert tot 50 printbare bingo-kaarten
- images/zorg/: map met 75 afbeeldingen (genummerd 1.png t/m 75.png), 
- [optioneel] gebruikt bij het tonen van getrokken nummers en kaarten

## 📋 Bingo Kaartstructuur
Elke bingo-kaart bestaat uit 5 kolommen met bijbehorende nummerbereiken:

Kolom	Bereik
- J	1–15
- O	16–30
- R	31–45
- I	46–60
- S	61–75

De middelste cel in kolom R is automatisch een gratis vakje: "FREE"

## 🔄 Opnieuw beginnen?
Klik op 🔄 Nieuw J❤️ris Bingo starten om alle voortgang te wissen en een nieuwe kaart + trekking te beginnen. 
Dit reset de sessie.

## 🧑‍💻 Gebouwd met
- PHP (met $_SESSION)
- HTML/CSS (zonder JavaScript)
- Optioneel afbeeldingen in PNG-formaat
- Gebruiksvriendelijk op desktop en tablet
