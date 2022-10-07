<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\CurrencyInformation;
use App\Services\CurrencyInfoService;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\GuzzleException;

class CurrencyInformationController extends Controller
{

    private $currencyService;
    public function __construct(CurrencyInfoService $currencyInfoService)
    {
        $this->currencyService=$currencyInfoService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->currencyService->getCurrencyInfoByUrl('https://www.cbr.ru/scripts/XML_daily.asp?date_req=02/09/2002');
    }

}
