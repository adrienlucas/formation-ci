<?php

namespace AppBundle\Controller;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PDFController extends Controller
{
    /**
     * @Route("/get-pdf", name="pdf_get_pdf")
     */
    public function getPDFAction(Request $request)
    {
        $html = $this->renderView('default/index.html.twig', array(
            'base_dir'  => 'Whoooho this is a PDF !!'
        ));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'smile.pdf'
        );
    }

}
