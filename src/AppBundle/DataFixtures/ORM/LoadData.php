<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadData implements FixtureInterface, ContainerAwareInterface
{
	/**
	 * @var ContainerInterface
	 */
	private $container;

	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}

	public function load(ObjectManager $manager)
	{
		$user1 = new User();
		$user1->setEmail('admin@pp.pp');
		$user1->setUsername('admin');
		$encoder = $this->container->get('security.password_encoder');
		$password = $encoder->encodePassword($user1, 'ppppp');
		$user1->setPassword($password);
		$user1->addRole('ROLE_ADMIN');
		$user1->setEnabled(true);
		$manager->persist($user1);

		$user2 = new User();
		$user2->setEmail('user@pp.pp');
		$user2->setUsername('user');
		$encoder = $this->container->get('security.password_encoder');
		$password = $encoder->encodePassword($user2, 'ppppp');
		$user2->setPassword($password);
		$user2->addRole('ROLE_USER');
		$user2->setEnabled(true);
		$manager->persist($user2);

		$manager->flush();
	}
}