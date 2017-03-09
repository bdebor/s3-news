<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\News;
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

		for ($i = 1; $i <= 10; $i++) {
			${"user$i"} = new User();
			${"user$i"}->setEmail("user$i@pp.pp");
			${"user$i"}->setUsername("user$i");
			$encoder  = $this->container->get('security.password_encoder');
			$password = $encoder->encodePassword(${"user$i"}, 'ppppp');
			${"user$i"}->setPassword($password);
			${"user$i"}->addRole('ROLE_USER');
			${"user$i"}->setEnabled(true);
			$manager->persist(${"user$i"});
		}

		/**/

		$content = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad aliquid architecto assumenda beatae corporis eos esse et harum inventore libero magni modi nihil obcaecati perspiciatis porro quam, quia quisquam sint sit. Accusantium adipisci aspernatur aut autem beatae blanditiis eaque explicabo ipsum laudantium maxime nihil praesentium quaerat quisquam quo reiciendis rem reprehenderit, saepe sint tempore voluptatem. Cupiditate eius mollitia nesciunt quidem quisquam. Aperiam asperiores commodi cum debitis earum et excepturi hic iusto nam nostrum odit soluta, voluptates voluptatum. A magni pariatur sint tempora totam. Ab atque culpa dicta dolorum enim eum exercitationem porro possimus sapiente! Cupiditate eius ipsum nihil tenetur.';

//		$contentLength = strlen($content);
//		var_dump($contentLength);die(); // 745


		for ($i = 1; $i <= 10; $i++) {
			$userRand = 'user'.rand(1, 10);
			$news = new News();
			$news->setUser(${$userRand});
			$news->setTitle("News $i");
			$news->setContent(substr($content, 0, rand(400, 745)));
			$news->setCreatedAt(new \DateTime('now'));
			$manager->persist($news);
		}

		$manager->flush();
	}
}