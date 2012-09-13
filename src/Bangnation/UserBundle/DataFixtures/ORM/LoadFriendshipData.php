<?php
namespace Bangnation\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Bangnation\UserBundle\Entity\Friendship;

class LoadFriendshipData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Request fixture
        $friendship = new Friendship();
        $friendship->setUser($manager->merge($this->getReference('user-john')));
        $friendship->setFriend($manager->merge($this->getReference('user-adam')));
        $friendship->setFriendType("plays together only");
        $friendship->setRequested(new \DateTime);
        
        $manager->persist($friendship);
        
        $friendship = new Friendship();
        $friendship->setUser($manager->merge($this->getReference('user-john')));
        $friendship->setFriend($manager->merge($this->getReference('user-dave')));
        $friendship->setFriendType("monogamously coupled");
        $friendship->setRequested(new \DateTime);
        $friendship->setAccepted(new \DateTime);
                
        $manager->persist($friendship);        
        $friendship = new Friendship();
        $friendship->setUser($manager->merge($this->getReference('user-john')));
        $friendship->setFriend($manager->merge($this->getReference('user-mike')));
        $friendship->setFriendType("separate only");
        $friendship->setRequested(new \DateTime);
        $friendship->setAccepted(new \DateTime);
                
        $manager->persist($friendship);
        
        $friendship = new Friendship();
        $friendship->setUser($manager->merge($this->getReference('user-mike')));
        $friendship->setFriend($manager->merge($this->getReference('user-dave')));
        $friendship->setFriendType("together or separately");
        $friendship->setRequested(new \DateTime);
        $friendship->setAccepted(new \DateTime);
                
        $manager->persist($friendship);
        
        $manager->flush();        
    }
    
    /**
     * The order in which this fixture gets loaded
     * 
     * @return int 
     */
    public function getOrder()
    {
        return 30;
    }
}