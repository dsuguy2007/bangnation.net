<?php
namespace Combo\BrandBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Bangnation\EventBundle\Entity\Event;

class LoadEventData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $event = new Event(); 
        $event->setName('Event name 1');
        $event->setDescription('Event description 1');
        $event->setStartDate(new \DateTime());
        $event->addHost($manager->merge($this->getReference('user-super-admin')));
        $event->addInvitee($manager->merge($this->getReference('user-john')));
        $event->addInvitee($manager->merge($this->getReference('user-adam')));
        $event->addAttendee($manager->merge($this->getReference('user-john')));
        $event->addMaybe($manager->merge($this->getReference('user-adam')));
        
        $this->addReference("event-1", $event);
        
        $manager->persist($event);
        
        $event = new Event(); 
        $event->setName('Event name 2');
        $event->setDescription('Event description 2');
        $event->setStartDate(new \DateTime());
        $event->addHost($manager->merge($this->getReference('user-adam')));
        $event->addAttendee($manager->merge($this->getReference('user-adam')));
        $event->addInvitee($manager->merge($this->getReference('user-super-admin')));
        $event->addInvitee($manager->merge($this->getReference('user-john')));
        $event->addDecliner($manager->merge($this->getReference('user-john')));
        
        $this->addReference("event-2", $event);

        $manager->persist($event);
        
        $event = new Event(); 
        $event->setName('Event name 3');
        $event->setDescription('Event description 3');
        $event->setStartDate(new \DateTime());
        $event->addHost($manager->merge($this->getReference('user-super-admin')));
        $event->addHost($manager->merge($this->getReference('user-john')));
        $event->addHost($manager->merge($this->getReference('user-adam')));

        $this->addReference("event-3", $event);

        $manager->persist($event);
        
        $event = new Event(); 
        $event->setName('Event name 3');
        $event->setDescription('Event description 3 - Duplicate name');
        $event->setStartDate(new \DateTime());
        $event->addHost($manager->merge($this->getReference('user-super-admin')));
        $event->addAttendee($manager->merge($this->getReference('user-super-admin')));
        $event->addAttendee($manager->merge($this->getReference('user-john')));
        $event->addAttendee($manager->merge($this->getReference('user-adam')));

        $this->addReference("event-3-duplicate-name", $event);

        $manager->persist($event);
        
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