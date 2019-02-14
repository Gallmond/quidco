<?php
/**
 * Created by PhpStorm.
 * User: ImpulsePay
 * Date: 2019-02-14
 * Time: 19:57
 */

namespace App\Entity;

use GuzzleHttp\Client;

use Symfony\Component\Console\Output\ConsoleOutput;

class findGif
{

	// giphy stuff
	private $GIPHY_API_TOKEN;
	private $API_DOMAIN = "api.giphy.com";

	private $debug = false;


	public function __construct()
	{

		// create a problem if env not setup
		if(!isset($_SERVER['GIPHY_API_TOKEN'])){
			throw new \Exception("Missing GIPHY_API_TOKEN from .env");
		}

		$this->GIPHY_API_TOKEN = $_SERVER['GIPHY_API_TOKEN'];

		$this->console = new ConsoleOutput();

	}

	private function out($_str){
		if($this->debug){
			$this->console->writeln($_str);
		}
	}

	// https://developers.giphy.com/docs/
	public function getRandomGif(String $_searchTerm = "false"){

		$url = "http://" . $this->API_DOMAIN . "/v1/gifs/random";

		$client = new Client(['http_errors'=>false]);

		$query = [
			"api_key" => $this->GIPHY_API_TOKEN,
		];

		if($_searchTerm != "false"){
			$query["tag"] = $_searchTerm;
		}

		$requestOptions = [
			"query"           => $query,
			"connect_timeout" => 10,
			"timeout"         => 10
		];

		$alertRequest = $client->request('GET', $url, $requestOptions);
		$responseStatus = (string)$alertRequest->getStatusCode();
		$responseBody = (string)$alertRequest->getBody();

		$this->out("responseStatus: $responseStatus");

		if( $responseStatus != "200" ){
			$this->out("responseBody: $responseBody");
			return false;
		}else{
			return $this->parseGif( $responseBody );
		}
	}

	private function parseGif(string $_responseBody){

		$parsedJSON = json_decode($_responseBody, true);
		if( !$parsedJSON ){
			$this->out("couldn't parse body: ".PHP_EOL.$_responseBody);
			return false;
		}else{

			$gif = $parsedJSON["data"]["images"]["fixed_height"];
			/*
				"url":"https:\/\/media3.giphy.com\/media\/e920gt7lI36Ug\/200_s.gif",
                "width":"150",
                "height":"200"
			*/
			return $gif;
		}

	}

}