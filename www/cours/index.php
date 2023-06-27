<?php

// Commentaire
/* 

	Variables :
	 -> Types :
	 	-> Float
	 	-> Int
	 	-> String
	 	-> Bool
	 	-> Null
	 -> Commence par un $
	 -> Cohérence
	 -> Auto déclarée à l'affectation
	 -> typée à l'affectation
	 -> typage dynamique
	 -> Anglais
	 -> CamelCase
	 -> Ne commence pas par un chiffre
	
*/
/*
//Incrémentation et Décrementation
$cpt = 0;
$cpt = $cpt + 1;
$cpt++;
$cpt += 1;
++$cpt;

$cpt = 0;
echo $cpt + 1; //1
echo $cpt; // 0
echo $cpt++; //0
echo $cpt; // 1
echo $cpt = $cpt + 1; // 2
echo $cpt += 1; // 3
echo ++$cpt; // 4
//echo --$cpt++; // Erreur


//Conditions 
$age = 18;
if ($age == 18) {
	echo "Tout juste majeur";
} else if ($age > 18) {
	echo "Majeur";
} else {
	echo "Mineur";
}


$scope = "admin";

switch ($country) {
	case 'admin':
		echo "Peut tout faire";
		break;
	case 'author':
		echo "Peut modifier le contenu";
	default:
		echo "Peut afficher le site";
		break;
}

//Condition ternaire
// Si on a juste un if et un else
// et une instruction commune et unique

$adult = true;
if ($adult == true)
	echo "Adulte";
else 
	echo "Mineur";

// instruction (condition)? vrai : faux;
echo ($adult == true) ? "Adulte" : "Mineur";

//null coalescent

echo $test ?? "ok";



$url = "/admin/fdsfdsq/Fdlogoutsqfdsq/Fdsqfdsq/fdsq/logout";

 match ($url) {
	"#logout#i" => logout()
	"#^+33#" => "Num international",
	default => "Autre"
}



//Boucles 
// For => nb connu d'iteration
// while => nb inconnu d'iteration
// do while =>  nb inconnu d'iteration mais au moins 1
// foreach => parcourir un tableau

for ($cpt = 0; $cpt < 10; $cpt++) {
	//
}


$dice = rand(1, 12);
$cpt = 1;
while ($dice != 6) {
	$dice = rand(1, 12);
	$cpt++;
}

echo $cpt . " tentative(s)";



$cpt = 0;
do{
	$dice = rand(1,12);
	$cpt++;
} while ($dice != 6);

echo $cpt . " tentative(s)";


//Tableaux PHP

//$array = array();
$array = [];

$student =  ["Estelle", "NKUMBA", 13];


//echo $student[1];


$student[] = 14;


$student = [
				"lastname"=>"Pierre",
				12 => "titi", 
				"firstname"=>"Michel", 
				"average"=>13,
				3 => "tutu"
			];

//Afficher Prenom nom a une moyenne de Note
//echo $student["firstname"]." ".$student["lastname"]." a une moyenne de ".$student["average"];

$student[] = 14;




//Dim : Profondeur
$class = [
	0=>["prenom", "nom", "moyenne"],
	1=>[
			0=>[0=>"Bilel",1=>"MrBonnet"], 
			1=>"nom", 
			2=>"moyenne"
		],
	2=>[0=>"Hugo", 1=>"nom", 2=>"moyenne"],
	3=>["prenom", "nom", "moyenne"],
]; //3D

//echo $class[1][0][1];



$array = [[],[],[[[[[],[[["toto"]]]]],[]]]]; //8D

//echo $array[2][0][0][0][1][0][0][0];


//Foreach

$fruits = ["Banane", "Cerise", "Fraise", "Framboise"];

echo "<ul>";
foreach ($fruits as $key => $fruit) {
	echo '<li>Le fruit N°'.$key." c'est : ".$fruit.'</li>';
}
echo "</ul>";


*/




//FONCTIONS
function helloWorld(): void
{
	echo "Bonjour tout le monde";
}

//helloWorld();



function helloYou(?String $you = null): void
{
	//echo "Bonjour ".$you;
}

$firstname = "Yves";
helloYou($firstname);
helloYou(null);
helloYou();



function cleanAndCheckLastname(String &$lastname): Bool
{
		$lastname = strtoupper(trim($lastname));
		return strlen($lastname)>=2;
}

$lastname = "    skRZypCZyk  ";
echo ( cleanAndCheckLastname($lastname) ) ? "OK : ".$lastname : "NOK : ".$lastname;
