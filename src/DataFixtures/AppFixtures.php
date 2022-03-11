<?php

namespace App\DataFixtures;

use App\Entity\Challenge;
use App\Entity\CigarettesStat;
use App\Entity\StepsStat;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $UsersConst = [
        //     "male",
        //     "female"
        // ];

        // $challengeConst = [
        //     "step",
        //     "cigarettes"
        // ];
        // $faker = Faker\Factory::create();
        // for ($i = 0; $i < 20; $i++) {
        //     //Creatation d'un utilisateurs et des differentes relations qu'il peut avoir
        //     $gender = $UsersConst[$faker->numberBetween(0, 1)];
        //     $user = new User();
        //     $faker->firstNameFemale;
        //     $user->setFirstname($faker->firstName($gender))
        //         ->setLastname($faker->lastName())
        //         ->setGender($gender)
        //         ->setAge($faker->numberBetween(18, 99))
        //         ->setEmail($faker->email)
        //         ->setPassword($faker->password(8, 10))
        //         ->setRoles(['ROLE_USER'])
        //         ->setAvatar("https://picsum.photos/200/300?random=". $faker->numberBetween(1,500));
        //     $isNewUser = $faker->numberBetween(0, 1);
        //     // Creation de CigarettesStat et liaison à l'utilisateur créer plus haut 
        //     if (!$isNewUser) {
        //         for ($j = 0; $j < $faker->numberBetween(0, 50); $j++) {
        //             $statCigarette = new CigarettesStat();
        //             $statCigarette->setDate($faker->dateTimeThisMonth($max = 'now', $timezone = null))
        //                 ->setcigarettes($faker->numberBetween(3, 20))
        //                 ->setUser($user);
        //             $manager->persist($statCigarette);
        //         }
        //         // Creation de StepsStat et liaison à l'utilisateur créer plus haut 
        //         for ($j = 0; $j < $faker->numberBetween(20, 50); $j++) {
        //             $StepsStats = new StepsStat();
        //             $StepsStats->setDate($faker->dateTimeThisMonth($max = 'now', $timezone = null))
        //                 ->setSteps($faker->numberBetween(0, 3000))
        //                 ->setUser($user);
        //             $manager->persist($StepsStats);
        //         }
        //         // Creation d'un Challenge  et liaison à l'utilisateur créer plus haut 
        //         // for ($j = 0; $j < $faker->numberBetween(0, 3); $j++) {

        //         //     $challenges = new Challenge();
        //         //     $challenges->setType($challengeConst[$faker->numberBetween(0, 1)])
        //         //         ->setState($faker->numberBetween(0, 1))
        //         //         ->setCreatedAt($faker->dateTimethisMonth('now', null))
        //         //         ->setUpdatedAt($faker->dateTimethisMonth('now', null))
        //         //         ->setUser($user);

        //         //     if ($faker->numberBetween(1, 10) > 5) {
        //         //         $challenges->setExpiredAt($faker->dateTimethisMonth('now', null));
        //         //     }
        //         //     $manager->persist($challenges);
        //         // }
        //     }
        //     $manager->persist($user);
        // }
        // $manager->flush();
    }
}
