<?php

namespace Bangnation\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/events", name="events")
     * @Template()
     */
    public function eventsAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $events = $em->getRepository('BangnationEventBundle:Event')->findAll();
        
        return array('events' => $events);
    }
    
    /**
     * @Route("/events/{slug}", name="event")
     * @Template()
     */
    public function eventAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $event = $em->getRepository('BangnationEventBundle:Event')->findOneBySlug($slug);
        
        return array('event' => $event);
    }
}
