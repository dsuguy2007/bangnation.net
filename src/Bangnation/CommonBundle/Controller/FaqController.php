<?php

namespace Bangnation\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FaqController extends Controller
{    
    /**
     * @Route("/faq", name="faq")
     * @Template()
     */
    public function indexAction() {        
        return array(
        );
    }
}
