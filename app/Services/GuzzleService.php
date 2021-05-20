<?php

namespace App\Services;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Cast\Object_;

class GuzzleService
{

    private $client;

    public function __construct(){

        $this->client = new Client(['base_uri' => 'https://api-football-v1.p.rapidapi.com/v3/',
            'headers' => [
                'x-rapidapi-key' => getenv('API_KEY'),
                'x-rapidapi-host' => getenv('X_Rapid_APIHost')
            ]
        ]);
}


    public function status(){

        $response = $this->client->request('GET','status');
        return $response->getBody()->getContents();
    }

    public function timezone(){
        //dd($this->client);
        $response = $this->client->request('GET','timezone');
        return $response->getBody()->getContents();
    }

    public function fixtures(){
        $response = $this->client->request('GET','fixtures',[
            'query' => [
                'live' => 'all'
            ]
        ]);
        $fixtures = $this->fixtures_builder($response);
        return $fixtures;
    }


    public function fixtures_local($request){
        //dd(json_encode($request));
//        $response = $this->client->request('GET','fixtures',[
//            'query' => [
//                'live' => 'all'
//            ]
//        ]);
        $fixtures = $this->fixtures_builder_local($request);
        //dd($fixtures);
        return $fixtures;
    }

    /*
     *array:1 [▼
  "Czech-Republic" => array:2 [▼
    "nation" => "Czech-Republic"
    "leagues" => array:1 [▼
      "league" => "Czech Liga"
    ]
  ]
]
     */

    public function fixtures_builder($fixtures){

        $fixtures = json_decode($fixtures->getbody()->getContents())->response;
        //dd($fixtures);
        $result = array();
        foreach ($fixtures as $key => $fixture){

            $single_fixture = array();
            if (!isset($result[$fixture->league->country])){
                $result[$fixture->league->country] = array('nation' => $fixture->league->country);

                if (!isset($result[$fixture->league->country]['leagues'])){
                    //$result[$fixture->league->country]['leagues']['league'] = $fixture->league->name;
                    //dd($fixture);
                    //dd($result);
                    $result[$fixture->league->country]['leagues'][$fixture->league->name]['logo'] = isset($fixture->league->logo) ? $fixture->league->logo : "";
                    $result[$fixture->league->country]['flag'] =isset($fixture->league->flag) ?  $fixture->league->flag : "";
                    $result[$fixture->league->country]['leagues'][$fixture->league->name]['season'] = $fixture->league->season;
                    $result[$fixture->league->country]['leagues'][$fixture->league->name]['round'] = $fixture->league->round;
                    //dd($result);
                }
            }
            //dd($result);
            //$single_fixture_object =  array();
            $single_fixture = array('fixture' => $fixture->fixture);
            $single_fixture['teams']= $fixture->teams;
            $single_fixture['goals'] = $fixture->goals;
            $single_fixture['score'] = $fixture->score;
            $single_fixture['events'] = $fixture->events;
            //$single_fixture[$fixture->league->country]['fixtures'][$key] = $single_fixture_object;
            //dd($result);
            $index = isset($result[$fixture->league->country]['leagues'][$fixture->league->name]['matches']) ? sizeof($result[$fixture->league->country]['leagues'][$fixture->league->name]['matches']): 0;
            $result[$fixture->league->country]['leagues'][$fixture->league->name]['matches'][$index] = $single_fixture;
        }
        ksort($result);
        //dd($result);
        return $result;

    }

    public function fixtures_builder_local($fixtures){
        //dd($fixtures);
        $result = array();
        foreach ($fixtures as $key => $fixture){
            //Log::info(print_r($fixture));
            $single_fixture = array();
            if (!isset($result[$fixture['league']['country']])){
                $result[$fixture['league']['country']] = array('nation' => $fixture['league']['country']);

                if (!isset($result[$fixture['league']['country']]['leagues'])){
//                    $result[$fixture['league']['country']]['leagues']['league'] = $fixture['league']['name'];
                    //dd($fixture);
                    //dd($result);
                    //$result
                    $result[$fixture['league']['country']]['leagues'][$fixture['league']['name']]['logo'] = isset($fixture['league']['logo']) ? $fixture['league']['logo'] : "";
                    $result[$fixture['league']['country']]['flag'] =isset($fixture['league']['flag']) ?  $fixture['league']['flag'] : "";
                    $result[$fixture['league']['country']]['leagues'][$fixture['league']['name']]['season'] = $fixture['league']['season'];
                    $result[$fixture['league']['country']]['leagues'][$fixture['league']['name']]['round'] = $fixture['league']['round'];
                    //dd($result);
                }
            }
            //dd($result);
            //$single_fixture_object =  array();
            $single_fixture = array('fixture' => $fixture['fixture']);
            $single_fixture['teams']= $fixture['teams'];
            $single_fixture['goals'] = $fixture['goals'];
            $single_fixture['score'] = $fixture['score'];
            $single_fixture['events'] = $fixture['events'];
            //$single_fixture[$fixture->league->country]['fixtures'][$key] = $single_fixture_object;
            //dd($result);

            $index = isset($result[$fixture['league']['country']]['leagues'][$fixture['league']['name']]['matches']) ? sizeof($result[$fixture['league']['country']]['leagues'][$fixture['league']['name']]['matches']): 0;
            $result[$fixture['league']['country']]['leagues'][$fixture['league']['name']]['matches'][$index] = $single_fixture;
        }
        ksort($result);
        //dd($result);
        return $result;

    }

}
