<?php
namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\BaseController;

class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        return $this->render('admin/default/index.html.twig', array());
    }
    
}
