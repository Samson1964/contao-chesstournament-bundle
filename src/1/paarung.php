<?php
include_once("class.form.php");

extract ($_GET);
extract ($_POST);

// Formular anzeigen
$form = new HTML_Form("paarung.php","POST");
$form->start(600,"paarform");
$form->addHidden("action","paarungsliste");
$form->addTitle("Paarungsliste erstellen");
$form->addBlank("Bitte Spielernamen eintragen. Je Zeile einen Namen. Nur gradzahlige Teilnehmerzahlen, evtl. inkl. spielfrei!");
$form->addTextarea("","spieler",$spieler,10,52);
$form->submit("Paarungen generieren");
$form->end();
echo $form->get();

if($action=="paarungsliste") {
  // Spielernamen in Array speichern
  if($spieler) {
    $teilnehmer = explode("\n",chop($spieler));
    echo "<pre>";
    print_r($teilnehmer);
    $dim = count($teilnehmer);
    $sys = "std";
    echo "\nPaarungstafel:\n";
    for($runde=1;$runde<$dim;$runde++) {
      $gegner = holpaare($dim,$runde,$sys);
      echo "$runde.Runde: ";
      $i=0;
      while ($gegner[$i]) {
        echo $gegner[$i++],'-',$gegner[$i++],' ';
      }
      echo "\n";
    }
    echo "\nPaarungsliste:\n";
    for($runde=1;$runde<$dim;$runde++) {
      $gegner = holpaare($dim,$runde,$sys);
      echo "&lt;ABSCHNITT &quot;$runde. Runde&quot;&gt;\n";
      echo "&lt;pre&gt;\n";
      $i=0;
      while ($gegner[$i]) {
        echo sprintf('%-22s',trim($teilnehmer[$gegner[$i++]-1]));
        echo "|  -  | ";
        echo sprintf('%-22s',trim($teilnehmer[$gegner[$i++]-1]));
        echo "\n";
      }
      echo "&lt;/pre&gt;\n\n";
    }
    echo "</pre>";
  }


}

function holpaare($dim, $runde, $sys){
  switch ($sys){
    case 'tds': $runde = $runde%($dim-1)  +1;
    case 'std': $gegner = paar_std($dim, $runde); break;
  }
  return $gegner;
}

#liefert die Paarungen nach Standardsystem#
function paar_std($dim, $runde){
  $gegner = range(1, $dim);
  if ($runde % 2){
    $gegner[0] = $odd = ($runde+1)/2;
    $gegner[1] = $dim;
  }
  else{
    $gegner[0] = $dim;
    $gegner[1] = $odd = ($runde+$dim)/2;
  }
  for ($i=2; $i< $dim;){
    $gegner[$i++]= ($odd++)%($dim-1)+1;
    $gegner[$i++]= ($runde-$odd+$dim-1)%($dim-1)+1;
  }
  return $gegner;
}
?>
