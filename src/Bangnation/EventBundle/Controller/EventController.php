<?php

namespace Bangnation\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class EventController extends Controller
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
    
    /**
     * @Route("/event/calendar", name="event_calendar")
     * @Template()
     */
    public function calendarAction() 
    {        
        $em = $this->getDoctrine()->getEntityManager();
        $events = $em->getRepository('BangnationEventBundle:Event')->findAll();
        
        return array(
            'events' => $events,
        );
    }
    
    /**
     * @Route("/eventdetail", name="event_detail")
     * @Template()
     */
    public function eventDetailAction() 
    {
        $id = $this->getRequest()->query->get('id');

        $em = $this->getDoctrine()->getEntityManager();
        $event = $em->getRepository('BangnationEventBundle:Event')->find($id);
        
        return array(
            'event' => $event, 
        );
    }
}
