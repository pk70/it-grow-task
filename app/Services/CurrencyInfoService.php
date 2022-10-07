<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Models\CurrencyInformation;

class CurrencyInfoService
{

    private $url="https://www.cbr.ru/scripts/XML_daily.asp?date_req=02/09/2002";
    private $currencyCollection;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrencyInfoByUrl($url)
    {
        try {
            $client = new Client;
        $results = $client->request('GET', $url);

        $xml = simplexml_load_string($results->getBody());
        $json= json_encode($xml, JSON_PRETTY_PRINT);
        $array = json_decode($json, true);
        $collection = collect($array);
        $this->currencyCollection= $collection['Valute'];
        return $collection['Valute'];
        } catch (\Throwable $th) {
            throw $th;
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($data)
    {

        try {
            foreach ($data as $key => $value) {
                CurrencyInformation::updateOrCreate([
                    'name'=>$value['Name'],
                    'num_code'=>$value['NumCode'],
                    'char_code'=>$value['CharCode'],
                    'nominal'=>$value['Nominal'],
                ],[
                    'name'=>$value['Name'],
                    'num_code'=>$value['NumCode'],
                    'char_code'=>$value['CharCode'],
                    'nominal'=>$value['Nominal'],
                    'value'=>$value['Value']
                ]);

            }
            return true;
        } catch (\Throwable $th) {
            return throw $th;
        }


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  $redirectPath string
     * @return \Illuminate\Http\Response
     */
    public function updateWithRedirect(string $redirectRoute)
    {
        $this->create($this->getCurrencyInfoByUrl($this->url));
        return redirect()->route($redirectRoute)->with(['message'=>'successfully syncronized with latest data']);
    }


}
