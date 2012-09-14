<?php

namespace Bangnation\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HelpTicketController extends Controller
{    
    /**
     * @Route("/help/ticket", name="help_ticket")
     * @Template()
     */
    public function indexAction() {        
        return array(
        );
    }
}
