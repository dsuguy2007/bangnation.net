<?php

namespace Bangnation\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
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
    
    /**
     * Testing QRCode
     * 
     * @param string $code
     * 
     * @Route("/code/{code}", name="code")
     */
    public function renderQrCode($code)
    {
        $request = $this->getRequest();
        
        // Error correction
        // Level L (Low)	7% of codewords can be restored.
        // Level M (Medium)	15% of codewords can be restored.
        // Level Q (Quartile)[28]	25% of codewords can be restored.
        // Level H (High)	30% of codewords can be restored.
        $ecl = $request->query->get('ecl', 'L');
        $zoom - $request->query->get('zoom', '4');
        $border = $request->query->get('border', 2);

        include __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."Resources".DIRECTORY_SEPARATOR."phpqrcode".DIRECTORY_SEPARATOR."qrlib.php";
        
        $response = new Response();
        $response->headers->set('Content-Type', 'image/png');
        $response->setContent(\QRcode::png($code, null, $ecl, $zoom, $border));
        
        return $response;
    }
}
