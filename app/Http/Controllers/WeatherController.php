<?php

namespace App\Http\Controllers;

use App\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{

    public function index(Request $request)
    {
        return Weather::all();
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

    public function show(Request $request, $city)
    {
          $weather = Weather::where('city',$city) -> first();

          if(mb_strtolower($request->tempSystem) == 'f'){
              $weather->temperature = $this->celsiusToFahrenheit($weather->temperature);
          }
          if(mb_strtolower($request->speedSystem) == 'km'){
              $weather->wind_speed = $this->meterPerSecondToKilometerPerHour($weather->wind_speed);
          }
          if(mb_strtolower($request->pressureSystem) == 'hpa'){
              $weather->pressure = $this->millimetersOfMercuryToHectopascals($weather->pressure);
          }

          return $weather;
    }
}
