<?php

namespace App\DataFixtures;

use App\Entity\Users;
use App\Repository\CustomersRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture implements DependentFixtureInterface
{

    private $customersRepository;


    public function __construct(CustomersRepository $customersRepository)
    {

        $this->customersRepository = $customersRepository;
    }


    public function load(ObjectManager $manager): void
    {

        $users = [
            [
                'firstname' => 'Jean',
                'lastname'  => 'Dupont',
                'email'     => 'jean.dupont@example.com',
                'address'   => '123 Rue de la République',
                'city'      => 'Paris',
                'zipcode'   => '75001'
            ],
            [
                'firstname' => 'Pierre',
                'lastname'  => 'Martin',
                'email'     => 'pierre.martin@example.com',
                'address'   => '27 Avenue de la Liberté',
                'city'      => 'Marseille',
                'zipcode'   => '13001'
            ],
            [
                'firstname' => 'Sophie',
                'lastname'  => 'Moreau',
                'email'     => 'sophie.moreau@example.com',
                'address'   => '8 Rue des Fleurs',
                'city'      => 'Toulouse',
                'zipcode'   => '31000'
            ],
            [
                'firstname' => 'Lucas',
                'lastname'  => 'Lefebvre',
                'email'     => 'lucas.lefebvre@example.com',
                'address'   => '56 Avenue des Étoiles',
                'city'      => 'Nice',
                'zipcode'   => '06000'
            ],
            [
                'firstname' => 'Camille',
                'lastname'  => 'Dubois',
                'email'     => 'camille.dubois@example.com',
                'address'   => '12 Rue de la Paix',
                'city'      => 'Strasbourg',
                'zipcode'   => '67000'
            ],
            [
                'firstname' => 'Antoine',
                'lastname'  => 'Roy',
                'email'     => 'antoine.roy@example.com',
                'address'   => '33 Boulevard Voltaire',
                'city'      => 'Bordeaux',
                'zipcode'   => '33000'
            ],

            [
                'firstname' => 'Emma',
                'lastname'  => 'Garcia',
                'email'     => 'emma.garcia@example.com',
                'address'   => '19 Rue du Château',
                'city'      => 'Nantes',
                'zipcode'   => '44000'
            ],
            [
                'firstname' => 'Louis',
                'lastname'  => 'Sanchez',
                'email'     => 'louis.sanchez@example.com',
                'address'   => '7 Avenue des Roses',
                'city'      => 'Lille',
                'zipcode'   => '59000'
            ],
            [
                'firstname' => 'Chloé',
                'lastname'  => 'Legrand',
                'email'     => 'chloe.legrand@example.com',
                'address'   => '14 Rue de la Liberté',
                'city'      => 'Rennes',
                'zipcode'   => '35000'
            ],
            [
                'firstname' => 'Hugo',
                'lastname'  => 'Roux',
                'email'     => 'hugo.roux@example.com',
                'address'   => '25 Avenue du Soleil',
                'city'      => 'Montpellier',
                'zipcode'   => '34000'
            ],
            [
                'firstname' => 'Léa',
                'lastname'  => 'Bertrand',
                'email'     => 'lea.bertrand@example.com',
                'address'   => '6 Rue des Artistes',
                'city'      => 'Dijon',
                'zipcode'   => '21000'
            ],
            [
                'firstname' => 'Thomas',
                'lastname'  => 'Marchand',
                'email'     => 'thomas.marchand@example.com',
                'address'   => '48 Avenue des Lilas',
                'city'      => 'Toulon',
                'zipcode'   => '83000'
            ],
            [
                'firstname' => 'Manon',
                'lastname'  => 'Girard',
                'email'     => 'manon.girard@example.com',
                'address'   => '9 Rue du Moulin',
                'city'      => 'Limoges',
                'zipcode'   => '87000'
            ],
            [
                'firstname' => 'Enzo',
                'lastname'  => 'Lemoine',
                'email'     => 'enzo.lemoine@example.com',
                'address'   => '37 Avenue des Cèdres',
                'city'      => 'Angers',
                'zipcode'   => '49000'
            ],
            [
                'firstname' => 'Clara',
                'lastname'  => 'Martinez',
                'email'     => 'clara.martinez@example.com',
                'address'   => '22 Rue des Orangers',
                'city'      => 'Clermont-Ferrand',
                'zipcode'   => '63000'
            ],
            [
                'firstname' => 'Raphaël',
                'lastname'  => 'Fournier',
                'email'     => 'raphael.fournier@example.com',
                'address'   => '18 Avenue des Violettes',
                'city'      => 'Grenoble',
                'zipcode'   => '38000'
            ],
            [
                'firstname' => 'Elise',
                'lastname'  => 'Perez',
                'email'     => 'elise.perez@example.com',
                'address'   => '10 Rue des Écoles',
                'city'      => 'Nîmes',
                'zipcode'   => '30000'
            ],
            [
                'firstname' => 'Nathan',
                'lastname'  => 'Blanc',
                'email'     => 'nathan.blanc@example.com',
                'address'   => '31 Avenue des Roses',
                'city'      => 'Troyes',
                'zipcode'   => '10000'
            ],
            [
                'firstname' => 'Juliette',
                'lastname'  => 'Morin',
                'email'     => 'juliette.morin@example.com',
                'address'   => '15 Rue des Champs',
                'city'      => 'Reims',
                'zipcode'   => '51000'
            ]
        ];

        foreach ($users as $user) {

            $userEntity = new Users();

            $userEntity->setFirstname($user['firstname']);
            $userEntity->setLastname($user['lastname']);
            $userEntity->setEmail($user['email']);
            $userEntity->setAddress($user['address']);
            $userEntity->setCity($user['city']);
            $userEntity->setZipcode($user['zipcode']);

            $customers = $this->customersRepository->findAll();

            $userEntity->setCustomer($customers[array_rand($customers)]);

            $manager->persist($userEntity);

        }

        $manager->flush();
    }


    /**
     * @return string[]
     */
    public function getDependencies(): array
    {

        return [
            CustomersFixtures::class,
        ];
    }
}
