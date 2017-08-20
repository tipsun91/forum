<?php

namespace ForumBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ForumBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
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
        $users = [
            'user' => [
                'plainPassword' => '12345678',
                'sex' => User::SEX_FEMALE,
                'role' => 'ROLE_USER',
            ],
            'admin' => [
                'plainPassword' => '12345678',
                'sex' => User::SEX_MALE,
                'role' => 'ROLE_ADMIN',
            ],
            'super' => [
                'plainPassword' => '12345678',
                'sex' => User::SEX_MALE,
                'role' => 'ROLE_SUPER_ADMIN',
            ],
        ];

        foreach($users as $username => $data) {
            $user = new User();
            $user->setUsername($username);
            $user->setPlainPassword($data['plainPassword']);
            $user->setSex($data['sex']);
            $user->setRoles([$data['role']]);

            $manager->persist($user);
            $manager->flush();

            if ('user' == $username) {
                $this->setReference('user', $user);
            }
        }
    }

    public function getOrder()
    {
        return 1;
    }
}
