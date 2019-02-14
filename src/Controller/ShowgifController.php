<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\findGif;

/**
 * Class ShowgifController
 * @package App\Controller
 */
class ShowgifController extends AbstractController
{
    /**
     * @Route("/showgif", name="showgif")
     */
    public function index(Request $_request)
    {

    	// is this a request with a form submission?
		$searchterm = $_request->query->get('search_term');
		if(isset( $searchterm ) && $searchterm!=""){

			// create and get the first random gif from a search term
			$gifGetter = new findGif();
			$gif_info = $gifGetter->getRandomGif($searchterm);

			$renderParams = array();
			if($gif_info){
				$renderParams["gif_info"] = $gif_info;
			}else{
				$renderParams["error_info"] = "could not return gif";
			}

			return $this->render('showgif/index.html.twig', $renderParams);

		}else{

			return $this->render('showgif/index.html.twig', [
				'controller_name' => 'ShowgifController',
			]);

		}

    }


}
