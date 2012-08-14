<?php
namespace Combo\BrandBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Bangnation\UserBundle\Entity\User;
use Bangnation\UserBundle\Entity\Preference;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin@bangnation.net');
        $user->setUsername('super_admin');
        $user->setPlainPassword('123');
        $user->setEnabled(true);
        $user->setBirthDate(new \DateTime('1980-01-01'));
        $user->addRole('ROLE_USER');
        $user->addRole('ROLE_USER_ADMIN');
        $user->addRole('ROLE_USER_SUPER_ADMIN');

        $user->addTurnOn($manager->merge($this->getReference('preference-0')));
        $user->addTurnOn($manager->merge($this->getReference('preference-1')));

        $user->addTurnOff($manager->merge($this->getReference('preference-2')));
        $user->addTurnOff($manager->merge($this->getReference('preference-3')));
        $user->addTurnOff($manager->merge($this->getReference('preference-4')));

        $this->addReference("user-super-admin", $user);

        $manager->persist($user);
        
        $manager->flush();        
    }
    
    /**
     * The order in which this fixture gets loaded
     * 
     * @return int 
     */
    public function getOrder()
    {
        return 20;
    }
}