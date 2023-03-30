<?php
require_once 'autoload.php';
// $faker = Faker\Factory::create("es_ES");
$faker = new Faker\Generator();
$faker->addProvider(new Faker\Provider\es_ES\Person($faker));
$faker->addProvider(new Faker\Provider\es_ES\Address($faker));
$faker->addProvider(new Faker\Provider\en_US\Company($faker));

for ($i = 0; $i < 100; $i++) {
  echo $faker->firstName," ",$faker->lastName," ",$faker->lastName," ",$faker->suffix, "<br>";
  // echo $faker->firstName," ",$faker->lastName," ",$faker->lastName," ",$faker->suffix," - ",$faker->company, "<br>";
}