<?php

namespace Bangnation\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PrivacyController extends Controller
{    
    /**
     * @Route("/privacy", name="privacy")
     * @Template()
     */
    public function indexAction() {        
        return array(
        );
    }
}
