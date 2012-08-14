<?php
namespace Combo\BrandBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Bangnation\UserBundle\Entity\Preference;

class LoadPreferenceData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Jack Off',
            'Oral',
            'Fucking',
            '1 On 1',
            'Group Sex',
            'WS',
            'FF',
            'B&D',
            'Rimming',
            'Kissing',
            'Leather',
            'Role Playing',
            'S&M',
            'Nipples',
            'Feet',
            'Toys',
            'Voyeurism',
            'Straight Guys',
            'Bi-Sexual Guys',
            'Exhibition',
            'Jocks',
            'Verbal',
            'Gang Bangs',
            'Anonymous Sex',
            'Married Men',
            'Traveling Men',
            'Truckers',
            'Couples',
            'Glory Holes',
            'Uniforms',
            'Sex in Public',
            'Public Parks',
            'Tea Rooms',
            'Cowboys',
            'Bears',
            'Daddies',
            'Chubs',
            'Tattoos',
            'Piercings',
            'Raunch',
            'Vac-Pumping',
            'Rough',
            'Rape Play',
        );

        foreach ($names as $key => $name) {
            $preference = new Preference();
            $preference->setName($name);

            $this->addReference("preference-$key", $preference);

            $manager->persist($preference);
        }
        
        $manager->flush();        
    }
    
    /**
     * The order in which this fixture gets loaded
     * 
     * @return int 
     */
    public function getOrder()
    {
        return 10;
    }
}