<?php namespace App\Http\Controllers;

use App\services\Pintlabs_Service_Brewerydb;
use Cache;
//use Illuminate\Routing\Controller;

class BeersController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| BeersController
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
        private $beers;

	public function __construct()
	{
                $apikey = '923d037cc620a7900e6972674c61962d';

		$bdb = new Pintlabs_Service_Brewerydb($apikey);

                $bdb->setFormat('json'); // if you want to get php back.  'xml' and 'json' are also valid options.

                //Then you can call the API:
                //$params = array('name' => 'coors light', 'withBreweries' => 'Y');
                //$params = array('styleId' => '1', 'withBreweries' => 'Y');
                $params = array('availableId' => '1', 'withBreweries' => 'Y');

                // The first parameter to the method is the key,a string used to identify the cached data. The second parameter is the data itself

                 if (! Cache::has('mydata')) {
                        try {
                                // The first argument to request() is the endpoint you want to call
                                // 'brewery/BrvKTz', 'beers', etc.
                                // The third parameter is the HTTP method to use (GET, PUT, POST, or DELETE)
                            
                                $results = $bdb->request('beers', $params, 'GET'); // where $params is a keyed array of parameters to send with the API call.
                                Cache::forever('mydata', $results);

                        } catch (Exception $e) {
                                $results = array('error' => $e->getMessage());
                        }
                }

                $this->beers = Cache::get('mydata');
                //$allBeers = $data::paginate(20);
    
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
                echo '<pre>';
                print_r($this->beers);
                echo '</pre>';
                $beers = $this->beers;

                return view('beers.index', compact('beers'));
	}

}