<?php

namespace Bangnation\UserBundle\Listener;

use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use DateTime;
use Bangnation\UserBundle\Entity\User;

class Activity
{
    protected $context;
    
    protected $em;
    
    public function __construct(SecurityContext $context, Doctrine $doctrine)
    {
        $this->context = $context;
        $this->em = $doctrine->getEntityManager();
    }
    
    /**
     * On each request we want to update the user's last activity datetime
     *
     * @param \Symfony\Component\HttpKernel\Event\FilterControllerEvent $event
     * @return void
     */
    public function onCoreController(FilterControllerEvent $event)
    {
        // If you use partial controller like {% render %} you call 
        // onCoreController each time and have many sql inserts. This avoids 
        // that issue.
        if ($event->getRequestType() !== \Symfony\Component\HttpKernel\HttpKernel::MASTER_REQUEST) {
            return;
        };

        if ($this->context->getToken()) {
            $user = $this->context->getToken()->getUser();
            if($user instanceof User)
            {
                //here we can update the user as necessary
                $user->setLastActivity(new DateTime());
                $this->em->persist($user);
                $this->em->flush($user);
            }
        }
    }
}
