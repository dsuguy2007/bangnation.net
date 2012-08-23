<?php

namespace Bangnation\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CommonController extends Controller
{    
    /**
     * @Route("/", name="welcome")
     * @Template()
     */
    public function indexAction() {
        $form = $this->createForm(new \Bangnation\UserBundle\Form\ProfileType());
        
        return array(
            'form' => $form->createView(),
        );
    }
}
