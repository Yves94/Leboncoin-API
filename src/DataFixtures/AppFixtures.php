<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AppFixtures extends Fixture implements ContainerAwareInterface
{
    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
    	//$this->loadAnnouncements($manager);
	}

	private function loadAnnouncements(ObjectManager $manager)
	{
		// for ($i = 0; $i < 20; $i++) {
		// 	$book = new Book();
		// 	$book->setTitle('Foo bar'. $i);
		// 	$book->setPrice(mt_rand(10, 100));
		// 	$manager->persist($book);
		// }

		// $manager->flush();

	}

	private function loadUsers(ObjectManager $manager)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');
        $userAdmin = new User();
        $userAdmin->setFirstname('John');
        $userAdmin->setLastname('Doe');
        $userAdmin->setEmail('john.doe@symfony.com');
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $encodedPassword = $passwordEncoder->encodePassword($userAdmin, 'admin');
        $userAdmin->setPassword($encodedPassword);
        $manager->persist($userAdmin);
        $manager->flush();
    }
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
