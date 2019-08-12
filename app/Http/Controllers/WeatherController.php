<?php

namespace App\Http\Controllers;

use App\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{

    public function index(Request $request)
    {
        $weathers = Weather::all();
        return $weathers->map(function($item)use($request) {
            return $this->formatData($item, $request);
        });
    }

    public function show(Request $request, $city)
    {
          $weather = Weather::where('city',$city) -> first();
          return $this->formatData($weather, $request);
    }

    public function store(Request $request){
          $weather = Weather::create($request->all());
          return response()->json($weather, 201);
    }

    private function celsiusToFahrenheit($value){
        return $value * 9/5 + 32;
    }
    private function meterPerSecondToKilometerPerHour($value){
        return $value * 3.6;
    }
    private function millimetersOfMercuryToHectopascals($value){
        return $value * 1.33322;
    }

    private function formatData($object, Request $request){
        if(mb_strtolower($request->tempSystem) == 'f'){
            $object->temperature = $this->celsiusToFahrenheit($object->temperature);
        }
        if(mb_strtolower($request->speedSystem) == 'km'){
            $object->wind_speed = $this->meterPerSecondToKilometerPerHour($object->wind_speed);
        }
        if(mb_strtolower($request->pressureSystem) == 'hpa'){
            $object->pressure = $this->millimetersOfMercuryToHectopascals($object->pressure);
        }
        return $object;
    }
}
