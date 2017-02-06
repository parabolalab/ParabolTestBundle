<?php

namespace Parabol\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ParabolTestBundle:Default:index.html.twig');
    }
}
