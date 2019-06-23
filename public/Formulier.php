<?php
/*
 // Deze code om contactformulier via mail te versturen met de informatie
*/

  $name = $_POST['naam'];
  $lastname = $_POST['achternaam'];
  $email= $_POST['email'];
  $adress= $_POST['adres'];
  $housenumber= $_POST['huisnummer'];
  $postcode= $_POST['postcode'];
  $place = $_POST['plaats'];
  $telefoonnummer= $_POST['telefoonnummer'];
  $comment= $_POST['commentaar'];

  $totaal = "$name $lastname . $place . $email . $adress $housenumber . $postcode . $telefoonnummer . $comment";
  $tomail = "giovannivr@live.com";

  mail($tomail, "Nieuwe vraag", $totaal);

?>
<h1>Uw bericht is verstuurd wij nemen zo spoedig mogelijk contact met u op.</h1>
<h1>Druk op de home link om terug te gaan naar de homepagina van ons hotel</h1>
<a class="nav-link text-white" href="http://127.0.0.1:8000/">Home</a>
