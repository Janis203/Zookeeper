<?php
require 'vendor/autoload.php';

use App\Animal;
use App\User;

$animals = [
    new Animal("chicken", 150, "grain", 100),
    new Animal("panda", 200, "bamboo", 250),
    new Animal("penguin", 300, "fish", 400),
    new Animal("lion", 500, "meat", 600),
    new Animal("whale", 100, "fish", 300),
];
$zookeeper = new User($animals);
$zookeeper->interact();