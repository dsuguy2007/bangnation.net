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
        $user->setCity('Seattle');
        $user->setState('Washington');
        $user->addRole('ROLE_USER');
        $user->addRole('ROLE_USER_ADMIN');
        $user->addRole('ROLE_USER_SUPER_ADMIN');

        $this->addReference("user-super-admin", $user);

        $manager->persist($user);
        
        $user = new User();
        $user->setEmail('john@bangnation.net');
        $user->setUsername('john');
        $user->setPlainPassword('123');
        $user->setEnabled(true);
        $user->setBirthDate(new \DateTime('1981-02-02'));
        $user->setCity('Seattle');
        $user->setState('Washington');
        $user->addRole('ROLE_USER');

        $user->addTurnOn($manager->merge($this->getReference('preference-0')));
        $user->addTurnOn($manager->merge($this->getReference('preference-1')));

        $user->addTurnOff($manager->merge($this->getReference('preference-2')));
        $user->addTurnOff($manager->merge($this->getReference('preference-3')));
        $user->addTurnOff($manager->merge($this->getReference('preference-4')));

        $this->addReference("user-john", $user);

        $manager->persist($user);
        
        $user = new User();
        $user->setEmail('adam@bangnation.net');
        $user->setUsername('adam');
        $user->setPlainPassword('123');
        $user->setEnabled(true);
        $user->setBirthDate(new \DateTime('1982-03-03'));
        $user->setCity('Brooklyn');
        $user->setState('New York');
        $user->addRole('ROLE_USER');

        $user->addTurnOn($manager->merge($this->getReference('preference-0')));
        $user->addTurnOn($manager->merge($this->getReference('preference-1')));

        $user->addTurnOff($manager->merge($this->getReference('preference-2')));
        $user->addTurnOff($manager->merge($this->getReference('preference-3')));
        $user->addTurnOff($manager->merge($this->getReference('preference-4')));

        $this->addReference("user-adam", $user);

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