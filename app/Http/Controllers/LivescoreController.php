<?php

namespace App\Http\Controllers;

use App\Services\GuzzleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LivescoreController extends Controller
{

    public function status(){
        $guzzleService = new GuzzleService();
        $response = $guzzleService->status();
        return $response;
    }

    public function timezone(){

        $guzzleService = new GuzzleService();
        $response = $guzzleService->timezone();
        return $response;
    }

    public function home(){
        $guzzleService = new GuzzleService();
        $fixtures = $guzzleService->fixtures();
        //ddd();
        //dd($fixtures);
        return view('livescore.home')->with('fixtures',$fixtures);
    }


    public function fixtures_local(Request $request){
        $guzzleService = new GuzzleService();
        //dd($request->get('response'));
        $fixtures = $guzzleService->fixtures_local($request->get('response'));
        //$test= json_decode(($fixtures),true);
        //dd($test);
        //dd($fixtures);
        return view('livescore.home')->with('fixtures',$fixtures);
    }

    public function showToken() {
        echo csrf_token();

    }
}
