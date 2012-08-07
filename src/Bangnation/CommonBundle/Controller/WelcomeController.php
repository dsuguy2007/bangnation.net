<?php

namespace Bangnation\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WelcomeController extends Controller
{    
    /**
     * @Route("/welcome", name="welcome")
     * @Template()
     */
    public function indexAction() {        
        return array(
        );
    }
}
