<?php

// ****************DEFINITION OF CONSTANTS****************
define ('LIVING_MINIMUM', 194.58); // zivotne minimum 2013
define ('AVERAGE_WAGE', 786);
define ('CHILDREN', 21.03); //Danove zvyhodnenie na deti 2012 - child bonus per child per month

define ('HEALTH_EE',0.04); //zdravotne poistenie - health insurance
define ('HEALTH_EE_DISABLED',0.02); //zdravotne poistenie - health insurance - zdravotne postihnuti (41% +) polovicna sadzba
define ('SICKNESS_EE', 0.014); //nemocenske poistenie - sickness insurance
define ('PENSION_OLD_EE', 0.04); //dochodkove poistenie starobne - pension insurance old age
define ('PENSION_INVALID_EE', 0.03); //dochodkove poistenie invalidne - pension insurance invalid
define ('UNEMPLOYMENT_EE', 0.01); // Poistenie v nezamestnanosti - unemployment insurance
define ('WARRANTY_EE', 0); // Garan&#269;ný fond - Warranty insurance
define ('RESERVE_EE', 0); // Rezervný fond - Reserve fund
define ('ACCIDENT_EE', 0); // Úrazové poistenie - Accident insurance

define ('HEALTH_ER',0.10); //zdravotne poistenie - health insurance
define ('HEALTH_EE_DISABLED',0.05); //zdravotne poistenie - health insurance - zdravotne postihnuti (41% +) polovicna sadzba
define ('SICKNESS_ER', 0.014); //nemocenske poistenie - sickness insurance
define ('PENSION_OLD_ER', 0.14); //dochodkove poistenie starobne - pension insurance old age
define ('PENSION_INVALID_ER', 0.03); //dochodkove poistenie invalidne - pension insurance invalid
define ('UNEMPLOYMENT_ER', 0.01); // Poistenie v nezamestnanosti - unemployment insurance
define ('WARRANTY_ER', 0.0025); // Garan&#269;ný fond - Warranty insurance
define ('RESERVE_ER', 0.0475); // Rezervný fond - Reserve fund
define ('ACCIDENT_ER', 0.008); // Úrazové poistenie - Accident insurance

define ('MAX_HEALTH_INSURANCE_BASE', 3930); //maximalny vymeriavaci zaklad je najviac pä&#357;násobok priemernej mesa&#269;nej mzdy
define ('MAX_SOC_INSURANCE_BASE', 3930); //maximalny zaklad pre poistenia soc. pä&#357;násobok priemernej mesa&#269;nej mzdy - Maximálny vymeriavací základ platný od 1. januára 2013 do 31. decembra 2013 je u&#382; jednotný pre v&#353;etky fondy sociálneho poistenia – nemocenské poistenie, dôchodkové poistenie, poistenie v nezamestnanosti, garan&#269;né poistenie, rezervný fond solidarity (s výnimkou úrazového poistenia) a je v sume 3 930,00 eur.
define ('MIN_WAGE_FOR_CHILD_BONUS', 168.85); // minimalna mzda, pri ktorej je mozne uplatnit si danovy bonus - 6 nasobok minimalnej mzdy
define ('STUDENTS_MINWAGE', 155); // hranica, nad ktoru sa uz platia odvody

define ('TAX_RATE', 0.19); //nizsia sadzba dane z prijmov
define ('TAX_RATE_HIGH', 0.25); // vyssia sadzba dane
define ('TAX_TRASHHOLD', 2866.81); //prijem, pre ktory uz plati vyssia dan - 176,8 nasobok zivotneho minima - Suma &#382;ivotného minima, platná k 1. januáru 2013, je 194,58 eura. Hranica 176,8-násobku je tak pre rok 2013 suma 34401,74 eura (ro&#269;ne, v prepo&#269;te na mesiac je to 2866,81 eura). Sadzbou 25% sa tak za rok 2013 zdaní tá &#269;as&#357; základu dane da&#328;ovníka, ktorá presiahne sumu 34401,74 eura.

define ('GROSS_WAGE_DEFAULT', 350); //cislo, ktore sa objavi v poli Hruba mzda pred vyplnenim formulara


//*************DEFINITION OF VARIABLES**********************
$array = $_GET; //nacitanie hodnot z formulara

$tax_ded = floor((19.2 * LIVING_MINIMUM / 12)*100)/100; //najviac suma zodpovedajúca 19,2-násobku sumy &#382;ivotného minima pre jednu plnoletú fyzickú osobu platného k 1. januáru príslu&#353;ného zda&#328;ovacieho obdobia

//zapamata si, ktora moznost bola vybrata uzivatelom
$status_selected[$array["status"]] = "selected";
$is_ZP_selected[$array["is_ZP"]] = "selected";
$has_bonus_selected[$array["has_bonus"]] = "selected";
$has_child_bonus_selected[$array["has_child_bonus"]] = "selected";
$has_spouse_bonus_selected[$array["has_spouse_bonus"]] = "selected";
$has_pension_bonus_selected[$array["has_pension_bonus"]] = "selected";

//help messages
$status_help = decode("'Zvo&#318;te typ pracovného pomeru, pre ktorý chcete vypo&#269;íta&#357; &#269;istú mzdu.'");
$gross_wage_help = decode("'Za mzdu sa nepova&#382;uje najmä náhrada mzdy, odstupné, odchodné, cestovné náhrady vrátane nenárokových cestovných náhrad, príspevky zo sociálneho fondu, príspevky na doplnkové dôchodkové sporenie a &#271;al&#353;ie polo&#382;ky, ktoré sú definované v &sect;118 zákona &#269;. 311/2001 Z. z. zákonník práce.'");
$has_bonus_help = decode("'Pri ro&#269;nom príjme do 19 458 eur nezdanite&#318;ná &#269;a&#357; dane je suma zodpovedajúca 19,2-násobku sumy platného &#382;ivotného minima, &#269;o pre prvý polrok 2013 predstavuje sumu ".number_format(LIVING_MINIMUM*19.2, 2, ',', ' ')." ro&#269;ne a teda ".number_format(LIVING_MINIMUM*19.2/12, 2, ',', ' ')." mesa&#269;ne.'");
$has_child_bonus_help = decode("'Da&#328; mô&#382;e by&#357; zní&#382;ená o tzv. da&#328;ový bonus na die&#357;a. Tento bonus je mo&#382;né uplatni&#357; len  v prípade, ak ro&#269;ný príjem neprekro&#269;il 6 násobok minimálnej mzdy. Viac sa o bonuse do&#269;ítate v &sect;33 zákona &#269;. 595/2003 Z. z. o dani z príjmov.'");
$has_spouse_bonus_help = decode("'Nárok vzniká v prípadoch, ak:<br>- man&#382;elka (man&#382;el) sa v príslu&#353;nom zda&#328;ovacom období starala o vy&#382;ivované (&sect; 33 ods. 2) maloleté die&#357;a &#382;ijúce s da&#328;ovníkom v domácnosti, do zániku nároku na rodi&#269;ovský príspevok,<br>- man&#382;elka (man&#382;el) v príslu&#353;nom zda&#328;ovacom období poberala pe&#328;a&#382;ný príspevok na opatrovanie alebo<br>- man&#382;elka (man&#382;el) bola zaradená do evidencie uchádza&#269;ov o zamestnanie.<br>Vlastný príjem man&#382;elky nemô&#382;e po&#269;as roka prekro&#269;i&#357; 19,2-násobok platného &#382;ivotného minima.'");
$spouse_income_help = decode("'Ide o vlastný príjem man&#382;elky (man&#382;ela) zní&#382;ený o zaplatené poistné a príspevky, ktoré man&#382;elka (man&#382;el) v príslu&#353;nom zda&#328;ovacom období bola (bol) povinná z tohto príjmu zaplati&#357;.'");
$has_pension_bonus_help = decode("'Nezdanite&#318;nou &#269;as&#357;ou základu dane je do 31. decembra 2016 aj suma preukázate&#318;ne zaplatených dobrovo&#318;ných príspevkov na starobné dôchodkové sporenie, a to najviac do vý&#353;ky 2 % zo základu dane.'");

$health_insurance_help = decode("'Zamestnanec odvádza ".((HEALTH_EE) * 100)."% a zamestnávate&#318; odvádza ".((HEALTH_ER) * 100)."%  z vymeriavacieho základu (maximálny vymeriavaci základ je ".(MAX_HEALTH_INSURANCE_BASE)." eur).'");
$sickness_insurance_help = decode("'Zamestnanec odvádza ".((SICKNESS_EE) * 100)."% a zamestnávate&#318; odvádza ".((SICKNESS_EE) * 100)."% z vymeriavacieho základu (maximálny vymeriavaci základ je ".(MAX_SOC_INSURANCE_BASE)." eur).'");
$pension_oldage_insurance_help = decode("'Zamestnanec odvádza ".((PENSION_OLD_EE) * 100)."% a zamestnávate&#318; odvádza ".((PENSION_OLD_ER) * 100)."% z vymeriavacieho základu (maximálny vymeriavaci základ je ".(MAX_SOC_INSURANCE_BASE)." eur).'");
$pension_invalid_insurance_help = decode("'Zamestnanec odvádza ".((PENSION_INVALID_EE) * 100)."% a zamestnávate&#318; odvádza ".((PENSION_INVALID_ER) * 100)."% z vymeriavacieho základu (maximálny vymeriavaci základ je ".(MAX_SOC_INSURANCE_BASE)." eur).'");
$unemployment_insurance_help = decode("'Zamestnanec odvádza ".((UNEMPLOYMENT_EE) * 100)."% a zamestnávate&#318; odvádza ".((UNEMPLOYMENT_ER) * 100)."% z vymeriavacieho základu (maximálny vymeriavaci základ je ".(MAX_SOC_INSURANCE_BASE)." eur).'");
$warranty_insurance_help = decode("'Zamestnanec neodvádza garan&#269;né poistenie a zamestnávate&#318; odvádza ".((WARRANTY_ER) * 100)."% z vymeriavacieho základu (maximálny vymeriavaci základ je ".(MAX_SOC_INSURANCE_BASE)." eur).'");
$accident_insurance_help = decode("'Zamestnanec neodvádza úrazové poistenie a zamestnávate&#318; odvádza ".((ACCIDENT_ER) * 100)."% z vymeriavacieho základu.'");
$reserve_fund_help = decode("'Zamestnanec neodvádza príspevok do rezervného fondu a zamestnávate&#318; odvádza ".((RESERVE_ER) * 100)."% z vymeriavacieho základu (maximálny vymeriavaci základ je ".(MAX_SOC_INSURANCE_BASE)." eur).'");

// 'question mark' image URL
$URL_help_image = "http://nl.salarycheck.wageindicator.org/salarycheck_static/what_is.png";

$count = 0; //pocet (poradie) otazok
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
  <script type="text/javascript" src="script.js">
  </script>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<?php
// *********************************** ZACIATOK FORMULARA ***********************************
echo
  '<div id="wrapper">'.
	'<form action="gross-net.php" id="form" method="get">'.
		'<table id="table_input">';

$height = 27;
$indent = 37;

//STATUS NA TRHU PRACE
echo
		'<tr>'.
			'<td>'.
				'<div class="help" onmouseover="help_on('.$status_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div>'.
				decode("Typ pracovného pomeru").
			'</td>'.
			'<td>'.
				'<select type="select" class="input" name="status" id="status">'.
					'<option value=0 '.$status_selected[0].'>'.decode("Pracovná zmluva").
					'<option value=1 '.$status_selected[1].'>'.decode("Dohoda s pravidelným príjmom").
					'<option value=2 '.$status_selected[2].'>'.decode("Dohoda s nepravidelným príjmom").
					'<option value=3 '.$status_selected[3].'>'.decode("Dohoda o brigádnickej práci &#353;tudentov").
					'<option value=4 '.$status_selected[4].'>'.decode("Dohoda - Poberate&#318; starobného dôchodku").
					'<option value=5 '.$status_selected[5].'>'.decode("Dohoda - &#381;iaci strednej &#353;koly do 18 rokov").
				'</select>'.
			'</td>'.
		'</tr>';
// HRUBA MZDA
$count++;
echo
		'<tr>'.
			'<td width="300px">'.
				'<div class="help" onmouseover="help_on('.$gross_wage_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div></div>'.
				decode('Hrubá mesa&#269;ná mzda').
				'<span id="help_message_span" onmouseover="stopCount()" onmouseout="help_off()"></span>'.
			'</td>'.
			'<td>'.
				'<span class="currency">'.decode("&euro;").'</span>';
	if (isset($array["gross_wage"]))			
		echo
				'<input type="text" class="input" name="gross_wage" id="gross_wage" onchange="check_input(1)" value='.$array["gross_wage"].'>';
	else
		echo
				'<input type="text" name="gross_wage" class="input" id="gross_wage" value='.GROSS_WAGE_DEFAULT.' onchange="check_input(1)"><br/>';

echo
			'</td>'.
		'</tr>';
		
//ZLE ZADANA HRUBA MZDA
	echo		
		'<tr class="alert" id="alert1" style="display:none">'.
			'<td id="alert_message1" colspan=2></td>'.
		'</tr>';

		
$count++;
// nezdanitelna ciastka dane
	echo		
		'<tr>'.
			'<td>'.
				'<div class="help" onmouseover="help_on('.$has_bonus_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div>'.
				decode("Nezdanite&#318;ná &#269;iastka dane").
			'</td>'.
			'<td>'.
				'<select type="select" class="input" name="has_bonus">'.
					'<option value=1 '.$has_bonus_selected[1].'>'.decode("Uplat&#328;ujem").
					'<option value=0 '.$has_bonus_selected[0].'>'.decode("Neuplat&#328;ujem").
				'</select>'.
			'</td>'.
		'</tr>';
	
$count++;
// DETI - ano/nie
	echo		
		'<tr>'.
			'<td>'.
				'<div class="help" onmouseover="help_on('.$has_child_bonus_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div>'.
				decode("Bonus na die&#357;a").
			'</td>'.
			'<td>'.
				'<select type="select" class="input" name="has_child_bonus" id="has_child_bonus" onclick="fc_has_child_bonus()">'.
					'<option value=0 '.$has_child_bonus_selected[0].'>'.decode("Neuplat&#328;ujem").
					'<option value=1 '.$has_child_bonus_selected[1].'>'.decode("Uplat&#328;ujem").
				'</select>'.
			'</td>'.
		'</tr>';

// DETI - pocet celkovo
if ($array["has_child_bonus"] == 1)
	{
	$count++;
	echo		
		'<tr id="child_bonus_span">';
	}
else
	echo
		'<tr id="child_bonus_span"  style="display:none">';
	echo
			'<td>'.
				'<i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.decode("Po&#269;et vy&#382;ivovaných nezaopatrených detí").'</i>'.
			'</td>'.
			'<td>';
	if (!isset($array["children_nr"]))
		echo
				'<input type="text" class="input" name="children_nr" id="children_nr" onchange="check_input(2)" value=0>';
	else
		echo
				'<input type="text" class="input" name="children_nr" id="children_nr" onchange="check_input(2)" value='.$array["children_nr"].'>';
	echo
			'</td>'.
		'</tr>';
	
//ZLE ZADANY POCET DETI
	echo		
		'<tr class="alert" id="alert2" style="display:none">'.
			'<td id="alert_message2" colspan=2></td>'.
		'</tr>';


// MANZELKA - ano/nie
$count++;
	echo		
		'<tr>'.
			'<td>'.
				'<div class="help" onmouseover="help_on('.$has_spouse_bonus_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div>'.
				decode("Bonus na man&#382;elku / man&#382;ela").
			'</td>'.
			'<td>'.
				'<select type="select" class="input" name="has_spouse_bonus" id="has_spouse_bonus" onclick="fc_has_spouse_bonus()">'.
					'<option value=0 '.$has_spouse_bonus_selected[0].'>'.decode("Neuplat&#328;ujem").
					'<option value=1 '.$has_spouse_bonus_selected[1].'>'.decode("Uplat&#328;ujem").
				'</select>'.
			'</td>'.
		'</tr>';

// MANZELKA - mzda
if ($array["has_spouse_bonus"] == 1)
	{
	$count++;
	echo		
		'<tr id="spouse_bonus_span">';
	}
else
	echo
		'<tr id="spouse_bonus_span"  style="display:none">';
	echo
			'<td>'.
				'<div class="help" onmouseover="help_on('.$spouse_income_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div>'.
				'<i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.decode("Vý&#353;ka príjmu man&#382;ela / man&#382;elky").'</i>'.
			'</td>'.
			'<td>'.
			'<span class="currency">'.decode("&euro;").'</span>';
			
	if (!isset($array["spouse_income"]))
		echo
				'<input type="text" class="input" name="spouse_income" id="spouse_income" onchange="check_input(3)" value=0>';
	else
		echo
				'<input type="text" class="input" name="spouse_income" id="spouse_income" onchange="check_input(3)" value='.$array["spouse_income"].'>';
	echo
			'</td>'.
		'</tr>';
	
// PRILIS VYSOKA MZDA alebo ZAPORNA MZDA
	echo		
		'<tr class="alert" id="alert3" style="display:none">'.
			'<td id="alert_message3" colspan=2></td>'.
		'</tr>';
		
// III. pilier - ano/nie
$count++;
	echo		
		'<tr>'.
			'<td>'.
				'<div class="help" onmouseover="help_on('.$has_pension_bonus_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div>'.
				decode("Prispievam na doplnkové dôchodkové sporenie <br> &nbsp;&nbsp;&nbsp;&nbsp;(III. pilier)").
			'</td>'.
			'<td>'.
				'<select type="select" class="input" name="has_pension_bonus" id="has_pension_bonus" onclick="fc_has_pension_bonus()">'.
					'<option value=0 '.$has_pension_bonus_selected[0].'>'.decode('Nie').
					'<option value=1 '.$has_pension_bonus_selected[1].'>'.decode('Áno').
				'</select>'.
			'</td>'.
		'</tr>';

// III. pilier prispevok
if ($array["has_pension_bonus"] == 1)
	{
	$count++;
	echo		
		'<tr id="pension_bonus_span">';
	}
else
	echo
		'<tr id="pension_bonus_span"  style="display:none">';
	echo
			'<td>'.
				'<i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.decode("Vý&#353;ka príspevku").'</i>'.
			'</td>'.
			'<td>'.
			'<span class="currency">'.decode("&euro;").'</span>';
	if (!isset($array["pension"]))
		echo
				'<input type="text" class="input" name="pension" id="pension" onchange="check_input(4)" value=0>';
	else
		echo
				'<input type="text" class="input" name="pension" id="pension" onchange="check_input(4)" value='.$array["pension"].'>';
	echo
			'</td>'.
		'</tr>';
	
// ZAPORNY PRISPEVOK
	echo		
		'<tr class="alert" id="alert3" style="display:none">'.
			'<td id="alert_message3" colspan=2></td>'.
		'</tr>';

	echo
	'</table>';
		
//SUBMIT BUTTON
	echo		
	'<div id="submit_div">'.
		'<input type="submit" id="submit_button" value="'.decode("Vypo&#269;ítaj").'"></p>'.
	'</div>'.
    '</form>';

//*********************************** VYPOCTY ***********************************
$gross_wage = $array["gross_wage"]; //hruba mzda upravena

$adjusted_gross_wage_health_insurance = min(MAX_HEALTH_INSURANCE_BASE, $gross_wage); //hruba mzda pre ucely zdravotneho poistenia - nemoze prekrocit max vymeriavaci zaklad
$adjusted_gross_wage_soc_insurance = min(MAX_SOC_INSURANCE_BASE, $gross_wage); //hruba mzda pre ucely socialneho poistenia - nemoze prekrocit max vymeriavaci zaklad

// SOCIALNE POISTENIE
switch ($array["status"])
{
case 0: //pracovna zmluva
	$sickness_insurance_ee = SICKNESS_EE * $adjusted_gross_wage_soc_insurance;
	$pension_oldage_insurance_ee = PENSION_OLD_EE * $adjusted_gross_wage_soc_insurance;
	$pension_invalid_insurance_ee = PENSION_INVALID_EE * $adjusted_gross_wage_soc_insurance;
	$unemployment_insurance_ee = UNEMPLOYMENT_EE * $adjusted_gross_wage_soc_insurance;
	$warranty_insurance_ee = WARRANTY_EE * $adjusted_gross_wage_soc_insurance;
	$reserve_fund_ee = RESERVE_EE * $adjusted_gross_wage_soc_insurance;
	$accident_insurance_ee = ACCIDENT_EE * $gross_wage; // ziadny max vymeriavaci zaklad

	$sickness_insurance_er = SICKNESS_ER * $adjusted_gross_wage_soc_insurance;
	$pension_oldage_insurance_er = PENSION_OLD_ER * $adjusted_gross_wage_soc_insurance;
	$pension_invalid_insurance_er = PENSION_INVALID_ER * $adjusted_gross_wage_soc_insurance;
	$unemployment_insurance_er = UNEMPLOYMENT_ER * $adjusted_gross_wage_soc_insurance;
	$warranty_insurance_er = WARRANTY_ER * $adjusted_gross_wage_soc_insurance;
	$reserve_fund_er = RESERVE_ER * $adjusted_gross_wage_soc_insurance;
	$accident_insurance_er = ACCIDENT_ER * $gross_wage; // ziadny max vymeriavaci zaklad
	
	$health_insurance_er = HEALTH_ER * $adjusted_gross_wage_health_insurance; //vypocet odvodu zamestnavatela - vzdy plati x%
	$health_insurance_ee = HEALTH_EE * $adjusted_gross_wage_health_insurance; // vypocet odvodu zamestnanca - vzdy plati x%
	
case 1: // dohoda pravidelny prijem
	$sickness_insurance_ee = SICKNESS_EE * $adjusted_gross_wage_soc_insurance;
	$pension_oldage_insurance_ee = PENSION_OLD_EE * $adjusted_gross_wage_soc_insurance;
	$pension_invalid_insurance_ee = PENSION_INVALID_EE * $adjusted_gross_wage_soc_insurance;
	$unemployment_insurance_ee = UNEMPLOYMENT_EE * $adjusted_gross_wage_soc_insurance;
	$warranty_insurance_ee = WARRANTY_EE * $adjusted_gross_wage_soc_insurance;
	$reserve_fund_ee = RESERVE_EE * $adjusted_gross_wage_soc_insurance;
	$accident_insurance_ee = ACCIDENT_EE * $gross_wage; // ziadny max vymeriavaci zaklad

	$sickness_insurance_er = SICKNESS_ER * $adjusted_gross_wage_soc_insurance;
	$pension_oldage_insurance_er = PENSION_OLD_ER * $adjusted_gross_wage_soc_insurance;
	$pension_invalid_insurance_er = PENSION_INVALID_ER * $adjusted_gross_wage_soc_insurance;
	$unemployment_insurance_er = UNEMPLOYMENT_ER * $adjusted_gross_wage_soc_insurance;
	$warranty_insurance_er = WARRANTY_ER * $adjusted_gross_wage_soc_insurance;
	$reserve_fund_er = RESERVE_ER * $adjusted_gross_wage_soc_insurance;
	$accident_insurance_er = ACCIDENT_ER * $gross_wage; // ziadny max vymeriavaci zaklad
	
	$health_insurance_er = HEALTH_ER * $adjusted_gross_wage_health_insurance; //vypocet odvodu zamestnavatela - vzdy plati x%
	$health_insurance_ee = HEALTH_EE * $adjusted_gross_wage_health_insurance; // vypocet odvodu zamestnanca - vzdy plati x%
	break;
	
case 2: //dohoda nepravidelny prijem
	$pension_oldage_insurance_ee = PENSION_OLD_EE * $adjusted_gross_wage_soc_insurance;
	$pension_invalid_insurance_ee = PENSION_INVALID_EE * $adjusted_gross_wage_soc_insurance;
	$warranty_insurance_ee = WARRANTY_EE * $adjusted_gross_wage_soc_insurance;
	$reserve_fund_ee = RESERVE_EE * $adjusted_gross_wage_soc_insurance;
	$accident_insurance_ee = ACCIDENT_EE * $gross_wage; // ziadny max vymeriavaci zaklad

	$pension_oldage_insurance_er = PENSION_OLD_ER * $adjusted_gross_wage_soc_insurance;
	$pension_invalid_insurance_er = PENSION_INVALID_ER * $adjusted_gross_wage_soc_insurance;
	$warranty_insurance_er = WARRANTY_ER * $adjusted_gross_wage_soc_insurance;
	$reserve_fund_er = RESERVE_ER * $adjusted_gross_wage_soc_insurance;
	$accident_insurance_er = ACCIDENT_ER * $gross_wage; // ziadny max vymeriavaci zaklad
	
	$health_insurance_er = HEALTH_ER * $adjusted_gross_wage_health_insurance; //vypocet odvodu zamestnavatela - vzdy plati x%
	$health_insurance_ee = HEALTH_EE * $adjusted_gross_wage_health_insurance; // vypocet odvodu zamestnanca - vzdy plati x%
	break;
	
case 3: //dohoda studenti

if ($gross_wage > STUDENTS_MINWAGE)
	{
		$pension_oldage_insurance_ee = PENSION_OLD_EE * $adjusted_gross_wage_soc_insurance;
		$pension_invalid_insurance_ee = PENSION_INVALID_EE * $adjusted_gross_wage_soc_insurance;
		$reserve_fund_ee = RESERVE_EE * $adjusted_gross_wage_soc_insurance;

		$pension_oldage_insurance_er = PENSION_OLD_ER * $adjusted_gross_wage_soc_insurance;
		$pension_invalid_insurance_er = PENSION_INVALID_ER * $adjusted_gross_wage_soc_insurance;
		$reserve_fund_er = RESERVE_ER * $adjusted_gross_wage_soc_insurance;
	}
	$warranty_insurance_ee = WARRANTY_EE * $adjusted_gross_wage_soc_insurance;
	$accident_insurance_ee = ACCIDENT_EE * $gross_wage; // ziadny max vymeriavaci zaklad

	$warranty_insurance_er = WARRANTY_ER * $adjusted_gross_wage_soc_insurance;
	$accident_insurance_er = ACCIDENT_ER * $gross_wage; // ziadny max vymeriavaci zaklad
	break;
	
case 4: //dochodcovia
	$pension_oldage_insurance_ee = PENSION_OLD_EE * $adjusted_gross_wage_soc_insurance;
	$warranty_insurance_ee = WARRANTY_EE * $adjusted_gross_wage_soc_insurance;
	$reserve_fund_ee = RESERVE_EE * $adjusted_gross_wage_soc_insurance;
	$accident_insurance_ee = ACCIDENT_EE * $gross_wage; // ziadny max vymeriavaci zaklad

	$pension_oldage_insurance_er = PENSION_OLD_ER * $adjusted_gross_wage_soc_insurance;
	$warranty_insurance_er = WARRANTY_ER * $adjusted_gross_wage_soc_insurance;
	$reserve_fund_er = RESERVE_ER * $adjusted_gross_wage_soc_insurance;
	$accident_insurance_er = ACCIDENT_ER * $gross_wage; // ziadny max vymeriavaci zaklad
	break;
	
case 5: //ziaci strednej skoly
	$warranty_insurance_ee = WARRANTY_EE * $adjusted_gross_wage_soc_insurance;
	$accident_insurance_ee = ACCIDENT_EE * $gross_wage; // ziadny max vymeriavaci zaklad

	$warranty_insurance_er = WARRANTY_ER * $adjusted_gross_wage_soc_insurance;
	$accident_insurance_er = ACCIDENT_ER * $gross_wage; // ziadny max vymeriavaci zaklad
	break;
}

$soc_insurance_ee = ($sickness_insurance_ee + $pension_oldage_insurance_ee + $pension_invalid_insurance_ee + $unemployment_insurance_ee + $warranty_insurance_ee + $reserve_fund_ee + $accident_insurance_ee);

$soc_insurance_er = ($sickness_insurance_er + $pension_oldage_insurance_er + $pension_invalid_insurance_er + $unemployment_insurance_er + $warranty_insurance_er + $reserve_fund_er + $accident_insurance_er);

//celkove poistenie
$total_insurance_ee = $health_insurance_ee + $soc_insurance_ee;
$total_insurance_er = $health_insurance_er + $soc_insurance_er;

//zaklad dane
$tax_base = $gross_wage - $total_insurance_ee;

//nezdanitelna cast dane
if ($array["has_bonus"] == 0)
	if ((100 * LIVING_MINIMUM / 12) < $tax_base)
		$tax_ded = max(floor((44.2 * LIVING_MINIMUM / 12 - $tax_base / 4)*100)/100,0);
else
	$tax_ded = 0;

if ($array["has_pension_bonus"] == 1)
	$pension_ded = min(min(0.02 * $tax_base, $array["pension"]),60*AVERAGE_WAGE);

if ($array["has_spouse_bonus"] == 1)
	if ($tax_base <= 176.8 * LIVING_MINIMUM / 12)
		$spouse_ded = floor(((19.2 * LIVING_MINIMUM / 12) - $array["spouse_income"])*100)/100;
else
	$spouse_ded = floor((max(max(63.4 * LIVING_MINIMUM / 12 - $tax_base / 4, 0) - $array["spouse_income"],0))*100)/100;

$total_deductions = min($tax_ded + $pension_ded + $spouse_ded, $tax_base);

$adjusted_tax_base = $tax_base - $total_deductions;

if ($adjusted_tax_base <= (176.8 * LIVING_MINIMUM / 12))
	$tax = floor($adjusted_tax_base * TAX_RATE * 100)/100; 
else
	$tax = floor(((176.8 * LIVING_MINIMUM / 12 * TAX_RATE) + ($adjusted_tax_base - 176.8 * LIVING_MINIMUM / 12) * TAX_RATE_HIGH)*100)/100;

//danove bonusy
if ($gross_wage >=MIN_WAGE_FOR_CHILD_BONUS)
	$children_bonus = (CHILDREN*($array["children_nr"]));
else
	$children_bonus = 0;

$total_bonuses = $children_bonus;

//zaloha na dan
$tax_after_deductions = max($tax - $total_bonuses, 0);

//cista mzda
$net_wage = $gross_wage - $total_insurance_ee - ($tax - $total_bonuses);

// ******************************* VYSLEDNA TABULKA *******************************
if (!isset($_GET["gross_wage"]))
	echo
		'<input type="hidden" id="sent" value="no">';
else
{
$count = 100;
$indent = 335;
$height = 22;

echo
	'<table id="table_results">'.
		'<td class="help_cell"></td>'.
		'<th colspan=4>'.decode("Výpo&#269;et &#269;istej mzdy pre rok 2013").'<th>'.
		
// zaciatok vystupov
		'<tr class="section_title">'.
			'<td class="help_cell"></td>'.
			'<td>'.decode("Mesa&#269;ná hrubá mzda").'</td>'.
			'<td align="right" colspan=2>'.number_format($array["gross_wage"], 2, ',', ' ').'</td>'.
		'</tr>';
echo
		'<input type="hidden" id="sent" value="no">';
		
echo
		'<tr class="section_title">'.
			'<td class="help_cell"></td>'.
			'<td align="center" colspan=3>'.decode("Odvody").'</td>'. //ODVODY
		'</tr>';
if ($array["status"] > 0)
		$dis_status = "";
	else
		$dis_status = 'style="display:none"';
echo
		'<tr id="status_info"'.$dis_status.'>'.
			'<td></td>'.
			'<td class="alert" colspan=3>'.decode('Podrobné informácie o odvodoch pri práci na dohodu si mô&#382;ete pre&#269;íta&#357; v sekcii <a href="http://www.mojplat.sk/hlavna-stranka/pravo/skratene-uvazky/zmeny-od-1.1.2013/nove-odvody-od-1.1.2013" target="_new">Pracovné právo</a>').'</td>'.
		'</tr>'.	
		'<tr class="subsection_text">'.
			'<td class="help_cell"></td>'.
			'<td></td>'.
			'<td align="center" >'.decode("Zamestnanec").'</td>'.
			'<td align="center" >'.decode("Zamestnávate&#318;").'</td>'.
		'</tr>'.		
		'<tr class="subsection_title">'.
			'<td><div class="help_result" onmouseover="help_on('.$health_insurance_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div></td>'.
			'<td>'.decode("Zdravotné poistenie").'</td>'.
			'<td align="right">'.number_format($health_insurance_ee, 2, ',', ' ').'</td>'.
			'<td align="right">'.number_format($health_insurance_er, 2, ',', ' ').'</td>'.
		'</tr>';
		
$count++;
		
echo
		'<tr class="subsection_title">'.
			'<td></td>'.
			'<td>'.decode("Sociálne poistenie").'</td>'.
			'<td align="right">'.number_format($soc_insurance_ee, 2, ',', ' ').'</td>'.
			'<td align="right">'.number_format($soc_insurance_er, 2, ',', ' ').'</td>'.
		'</tr>'.
		'<tr class="subsection_text">'.
			'<td class="help_cell"></td>'.
			'<td>'.decode("z toho:").'</td>'.
		'</tr>';
		
$count = $count + 2;
		
echo
		'<tr class="subsection_text">'.
			'<td><div class="help_result" onmouseover="help_on('.$sickness_insurance_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div></td>'.
			'<td>'.decode("nemocenské poistenie").'</td>'.
			'<td align="right">'.number_format($sickness_insurance_ee, 2, ',', ' ').'</td>'.
			'<td align="right">'.number_format($sickness_insurance_er, 2, ',', ' ').'</td>'.
		'</tr>';
$count++;
		
echo
		'<tr class="subsection_text">'.
			'<td><div class="help_result" onmouseover="help_on('.$pension_oldage_insurance_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div></td>'.
			'<td>'.decode("starobné poistenie").'</td>'.
			'<td align="right">'.number_format($pension_oldage_insurance_ee, 2, ',', ' ').'</td>'.
			'<td align="right">'.number_format($pension_oldage_insurance_er, 2, ',', ' ').'</td>'.
		'</tr>';
		
$count++;
		
echo
		'<tr class="subsection_text">'.
			'<td><div class="help_result" onmouseover="help_on('.$pension_invalid_insurance_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div></td>'.
			'<td>'.decode("invalidné poistenie").'</td>'.
			'<td align="right">'.number_format($pension_invalid_insurance_ee, 2, ',', ' ').'</td>'.
			'<td align="right">'.number_format($pension_invalid_insurance_er, 2, ',', ' ').'</td>'.
		'</tr>';

$count++;
		
echo
		'<tr class="subsection_text">'.
			'<td><div class="help_result" onmouseover="help_on('.$unemployment_insurance_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div></td>'.
			'<td>'.decode("poistenie v nezamestnanosti").'</td>'.
			'<td align="right">'.number_format($unemployment_insurance_ee, 2, ',', ' ').'</td>'.
			'<td align="right">'.number_format($unemployment_insurance_er, 2, ',', ' ').'</td>'.
		'</tr>';
		
$count++;
		
echo
		'<tr class="subsection_text">'.
			'<td><div class="help_result" onmouseover="help_on('.$warranty_insurance_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div></td>'.
			'<td>'.decode("garan&#269;né poistenie").'</td>'.
			'<td align="right">'.number_format($warranty_insurance_ee, 2, ',', ' ').'</td>'.
			'<td align="right">'.number_format($warranty_insurance_er, 2, ',', ' ').'</td>'.
		'</tr>';
		
$count++;
		
echo
		'<tr class="subsection_text">'.
			'<td><div class="help_result" onmouseover="help_on('.$accident_insurance_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div></td>'.
			'<td>'.decode("úrazové poistenie").'</td>'.
			'<td align="right">'.number_format($accident_insurance_ee, 2, ',', ' ').'</td>'.
			'<td align="right">'.number_format($accident_insurance_er, 2, ',', ' ').'</td>'.
		'</tr>';

$count++;
		
echo
		'<tr class="subsection_text">'.
			'<td><div class="help_result" onmouseover="help_on('.$reserve_fund_help.','.$count.','.$height.','.$indent.')" onmouseout="help_off()"></div></td>'.
			'<td>'.decode("rezervný fond").'</td>'.
			'<td align="right">'.number_format($reserve_fund_ee, 2, ',', ' ').'</td>'.
			'<td align="right">'.number_format($reserve_fund_er, 2, ',', ' ').'</td>'.
		'</tr>';
		
echo
		'<tr class="section_total">'.
			'<td class="help_cell"></td>'.
			'<td>'.decode("Odvody celkom").'</td>'.
			'<td align="right" style="border-top:solid black 1px;">'.number_format($total_insurance_ee, 2, ',', ' ').'</td>'.
			'<td align="right" style="border-top:solid black 1px;">'.number_format($total_insurance_er, 2, ',', ' ').'</td>'.
		'</tr>';

$count = $count + 3;
echo
		'<tr class="section_title">'.
			'<td class="help_cell"></td>'.
			'<td colspan=4 align="center" class="section_title">'.decode("Výpo&#269;et dane z príjmu").'</td>'. //DAN
		'</tr>';

$count++;
echo
		'<tr class="subsection_title">'.
			'<td></td>'.
			'<td>'.decode("Základ dane").'</td>'.
			'<td align="right" colspan=2>'.number_format($tax_base, 2, ',', ' ').'</td>'.
		'</tr>';

$count++;
echo
		'<tr class="subsection_title">'.
			'<td></td>'.
			'<td>'.decode("Nezdanite&#318;ná &#269;as&#357; základu dane na da&#328;ovníka").'</td>'.
			'<td align="right" colspan=2>'.number_format($tax_ded, 2, ',', ' ').'</td>'.
		'</tr>';

if ($spouse_ded > 0)
	{
$count++;
echo
		'<tr class="subsection_title">'.
			'<td></td>'.
			'<td>'.decode("Nezdanite&#318;ná &#269;as&#357; základu dane na man&#382;elku/man&#382;ela").'</td>'.
			'<td align="right" colspan=2>'.number_format($spouse_ded, 2, ',', ' ').'</td>'.
		'</tr>';
	}

if ($pension_ded > 0)
	{
$count++;
echo
		'<tr class="subsection_title">'.
			'<td></td>'.
			'<td>'.decode("Nezdanite&#318;ná &#269;as&#357; príspevku do III. piliera").'</td>'.
			'<td align="right" colspan=2>'.number_format($pension_ded, 2, ',', ' ').'</td>'.
		'</tr>';
	}

if ($children_bonus > 0)
	{
$count++;
echo
		'<tr class="section_total">'.
			'<td></td>'.
			'<td>'.decode("Výmer dane");
if ($adjusted_tax_base > (176.8 * LIVING_MINIMUM / 12))
	echo ' ('.TAX_RATE * 100 .'/'.TAX_RATE_HIGH * 100 .'%)</td>';
else
	echo ' ('.TAX_RATE * 100 .'%)</td>';
echo
			'<td align="right"></td>'.
			'<td align="right" style="border-top:solid black 1px;">'.number_format($tax, 2, ',', ' ').'</td>'.
		'</tr>';

$count++;
echo	
		
		'<tr class="subsection_title">'.
			'<td></td>';
		if ($array["children_nr"] == 1)
			echo '<td>'.decode("bonus na die&#357;a").'</td>';
		else
			echo '<td>'.decode("Bonus na deti").'</td>';
	echo
			'<td align="right" colspan=2>'.number_format($children_bonus, 2, ',', ' ').'</td>'.
		'</tr>';
	}
		
$count++;
echo
		'<tr class="section_total">'.
			'<td></td>'.
			'<td>'.decode("Preddavok na da&#328; z príjmu");
if (($adjusted_tax_base > (176.8 * LIVING_MINIMUM / 12)) && ($children_bonus == 0))
	echo ' ('.TAX_RATE * 100 .'/'.TAX_RATE_HIGH * 100 .'%)</td>';
if (($adjusted_tax_base <= (176.8 * LIVING_MINIMUM / 12)) && ($children_bonus > 0))
	echo ' ('.TAX_RATE * 100 .'%)</td>';

echo		'<td align="right"></td>'.
			'<td align="right" style="border-top:solid black 1px;">'.number_format($tax_after_deductions, 2, ',', ' ').'</td>'.
		'</tr>';
		
echo
		'<tr>'.
			'<td align="center" id="result" colspan=4>'.decode("Va&#353;a &#269;istá mesa&#269;ná mzda: ").number_format($net_wage, 2, ',', ' ').' EUR</td>'.
		'</tr>'.		
	'</table>'.
	'<p id="footer">'.decode("Výpo&#269;et je informatívny a je v súlade s platnou legislatívou Slovenskej Republiky.").'</p>'.
	'</div>';
    
}
?>
</body>
</html>	
			
	
<?php	

// ***************************** FUNKCIE *****************************

//funkcia na dekodovanie ceskych/slovenskych znakov
function decode($str)
  {
   $str = str_replace('Á','&#193;',$str);
   $str = str_replace('Ä','&#196;',$str);
   $str = str_replace('É','&#201;',$str);
   $str = str_replace('Í','&#205;',$str);
   $str = str_replace('Ó','&#211;',$str);
   $str = str_replace('Ú','&#218;',$str);
   $str = str_replace('Ý','&#221;',$str);
   $str = str_replace('á','&#225;',$str);
   $str = str_replace('ä','&#228;',$str);
   $str = str_replace('é','&#233;',$str);
   $str = str_replace('í','&#237;',$str);
   $str = str_replace('ó','&#243;',$str);
   $str = str_replace('ú','&#250;',$str);
   $str = str_replace('ý','&#253;',$str);
   $str = str_replace('Č','&#268;',$str);
   $str = str_replace('Ď','&#270;',$str);
   $str = str_replace('Ň','&#327;',$str);
   $str = str_replace('Š','&#352;',$str);
   $str = str_replace('Ž','&#381;',$str);
   $str = str_replace('č','&#269;',$str);
   $str = str_replace('ď','&#271;',$str);
   $str = str_replace('ň','&#328;',$str);
   $str = str_replace('š','&#353;',$str);
   $str = str_replace('ž','&#382;',$str);
   $str = str_replace('Ť','&#356;',$str);
   $str = str_replace('ť','&#357;',$str);
   $str = str_replace('Ŕ','&#340;',$str);
   $str = str_replace('ŕ','&#341;',$str);
   $str = str_replace('Ľ','&#317;',$str);
   $str = str_replace('ľ','&#318;',$str);
   $str = str_replace('Ĺ','&#314;',$str);
   $str = str_replace('ô','&#244;',$str);
   $str = str_replace('Ě','&#282;',$str);
   $str = str_replace('ě','&#283;',$str);
   $str = str_replace('Ů','&#366;',$str);
   $str = str_replace('ů','&#367;',$str);
   $str = str_replace('Ř','&#344;',$str);
   $str = str_replace('ř','&#345;',$str);
   return ($str);
   }
?>
