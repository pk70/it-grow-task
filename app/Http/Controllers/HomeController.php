<?php

namespace App\Http\Controllers;

use App\Models\CurrencyInformation;
use App\Services\CurrencyInfoService;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data=$this->getCurrencyData();

        return view('dashboard')->with(['data'=>$data]);
    }

    /**
     * Show the currency data.
     *
     */

    public function getCurrencyData(){
        return CurrencyInformation::simplePaginate(5);
    }

    /**
     * Update the currency data from CurrencyInfoService service.
     *
     */

    public function updateCurrencyData(){
        $currencyInfoService=new CurrencyInfoService();
       return $currencyInfoService->updateWithRedirect('home');
    }
}
