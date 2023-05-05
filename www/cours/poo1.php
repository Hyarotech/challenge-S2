<?php
/*
 * Convention : Pascal Case
 *
 */
/*
class House {
    // (Variable) => Attributs ou  Propriétés
    private $wall = 4;
    private $roof = 1;
    private $door = 1;
    private $window = 1;
    private $fundation = 1;
    private $stage = 0;

    //(fonction) => Methode
    public function addStage(): void
    {
        $this->stage++;
        $this->wall+=4;
        $this->window++;

    }

}
//L'objet myHouse est une instance de la classe House
//ma maison a été créée à partir du plan House
$myHouse = new House();
echo "<pre>";
var_dump($myHouse);


$myHouse2 = new House();
$myHouse2->addStage();
$myHouse2->addStage();
$myHouse2->stage++;
echo "<pre>";
var_dump($myHouse2);
*/


class User {
    private $email;
    private $pwd;
    private $firstname;
    private $lastname;

    public function __construct($email, $pwd, $firstname, $lastname)
    {
        $this->setEmail($email);
        $this->setPwd($pwd);
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
    }

    public function __invoke()
    {
       echo "Comme une fonction";
    }


    public function __toString()
    {
        return "L'utilisation a pour email : ".$this->email;
    }

    //ACCESSORS : getters et setters
    public function setEmail(String $email): void
    {
        $this->email = strtolower(trim($email));
    }
    public function setPwd(String $pwd): void
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }
    public function setFirstname(String $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }
    public function setLastname(String $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    public function getEmail(): ?String
    {
        return $this->email;
    }
    public function getFirstname(): ?String
    {
        return $this->firstname;
    }
    public function getLastname(): ?String
    {
        return $this->lastname;
    }

}


$myUser = new User("y.skrzypczyk@gmail.com", "Test1234", "yves","SKRZYPCZYK");
/*
$myUser->setEmail("y.skrzypczyk@gmail.com");
$myUser->setPwd("Test1234");
$myUser->setFirstname("yves");
$myUser->setLastname("Skrzypczyk");
*/
//echo "<pre>";
//print_r($myUser);
//echo $myUser->getFirstname();
//$myUser();
echo $myUser;








