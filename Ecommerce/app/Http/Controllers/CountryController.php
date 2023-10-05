<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\states;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class CountryController extends Controller
{
    public function getCountry()
    {
        $country = new Country();
        $data = $country->all();
        return view('country_city_state_dropdown.dropdown')->with('country', $data);
    }
    public function getCity($country_id = null)
    {
        $cityData = DB::table('cities')->where('country_id', $country_id)->get();
        return response()->json(['status' => 200, 'cityData' => $cityData, 'message' => 'getting city Data list']);
    }
    public function getState($city_id=null){
       
        $stateData=states::where('city_id',$city_id)->get();
      return response()->json(['status'=>200,'state'=>$stateData,'message'=>'getting states data']);

    }
    public function getVillage($state_id=null){
        $vallageData=DB::table('villages')->where('state_id',$state_id)->get();
       return response()->json(['status'=>200,'village'=>$vallageData,'message'=>'village data getting successfully']);
    }
}
