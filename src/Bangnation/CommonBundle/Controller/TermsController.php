<?php

namespace Bangnation\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TermsController extends Controller
{    
    /**
     * @Route("/terms", name="terms")
     * @Template()
     */
    public function indexAction() {        
        return array(
        );
    }
}
