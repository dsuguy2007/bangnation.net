<?php

namespace Bangnation\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SafetyController extends Controller
{    
    /**
     * @Route("/safety", name="safety")
     * @Template()
     */
    public function indexAction() {        
        return array(
        );
    }
}
