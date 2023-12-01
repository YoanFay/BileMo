<?php

namespace App\DataFixtures;

use App\Entity\Customers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CustomersFixtures extends Fixture
{

    private $userPasswordHasher;


    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {

        $this->userPasswordHasher = $userPasswordHasher;
    }


    public function load(ObjectManager $manager): void
    {

        $customers = [
            ['firstname' => 'John', 'lastname' => 'Doe', 'email' => 'johndoe@example.com', 'password' => 'motdepasse123'],
            ['firstname' => 'Alice', 'lastname' => 'Smith', 'email' => 'alice@example.com', 'password' => 'mdpAlice123'],
            ['firstname' => 'Bob', 'lastname' => 'Johnson', 'email' => 'bob@example.com', 'password' => 'mdpBob456'],
            ['firstname' => 'Claire', 'lastname' => 'Williams', 'email' => 'claire@example.com', 'password' => 'mdpClaire789'],
            ['firstname' => 'David', 'lastname' => 'Anderson', 'email' => 'david@example.com', 'password' => 'mdpDavid123'],
            ['firstname' => 'Eva', 'lastname' => 'Brown', 'email' => 'eva@example.com', 'password' => 'mdpEva456'],
            ['firstname' => 'Frank', 'lastname' => 'Davis', 'email' => 'frank@example.com', 'password' => 'mdpFrank789'],
            ['firstname' => 'Grace', 'lastname' => 'Wilson', 'email' => 'grace@example.com', 'password' => 'mdpGrace123'],
            ['firstname' => 'Henry', 'lastname' => 'Martinez', 'email' => 'henry@example.com', 'password' => 'mdpHenry456'],
            ['firstname' => 'Ivy', 'lastname' => 'Garcia', 'email' => 'ivy@example.com', 'password' => 'mdpIvy789']
        ];

        foreach ($customers as $customer) {

            $customerEntity = new Customers();

            $customerEntity->setFirstname($customer['firstname']);
            $customerEntity->setLastname($customer['lastname']);
            $customerEntity->setEmail($customer['email']);
            $customerEntity->setPassword($this->userPasswordHasher->hashPassword($customerEntity, $customer['password']));
            $customerEntity->setRoles(["ROLE_CUSTOMERS"]);

            $manager->persist($customerEntity);

        }

        $manager->flush();
    }
}
