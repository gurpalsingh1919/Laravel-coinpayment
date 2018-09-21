<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Config;
use Illuminate\Support\Facades\Auth;
use View;
use Sentinel;
use App\Models\Setting;
use App\Models\Withdraw;
use App\Models\Rate;
use Storage;
use Exception;
use App\CoinPaymentsAPI;
use Illuminate\Support\Facades\Log;


class Autotread extends Command
{
    protected $signature = 'command:autotread';
    protected $description = 'Command description';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
      
        try{
            $btc = json_decode(file_get_contents('https://www.bitstamp.net/api/v2/ticker/btcusd'));
            $eth = json_decode(file_get_contents('https://www.bitstamp.net/api/v2/ticker/ethusd'));
            $ltc = json_decode(file_get_contents('https://www.bitstamp.net/api/v2/ticker/ltcusd'));
            $bch = json_decode(file_get_contents('https://www.bitstamp.net/api/v2/ticker/bchusd'));
            $setting = Setting::find(1);
            $setting->btc_price = $btc->last;
            $setting->eth_price = $eth->last;
            $setting->ltc_price = $ltc->last;
            $setting->bch_price = $bch->last;
            $setting->save();
            //return $data;
        } catch (Exception $e) {

            $data1 = file_get_contents("https://api.coinmarketcap.com/v1/ticker/?limit=5");
            $data = json_decode($data1, TRUE);
            $setting = Setting::find(1);
            if($data[1]["symbol"] =="ETH")
                $eth = $data[1]["price_usd"];
            else
                $eth = $data[2]["price_usd"];
            $btc = $data[0]["price_usd"];
            $ltc = $data[4]["price_usd"];
            $bch = $data[3]["price_usd"];
            $setting->btc_price = $btc;
            $setting->eth_price = $eth;
            $setting->ltc_price = $ltc;
            $setting->bch_price = $bch;
            $setting->save();
            //return view('errors.error');

        }



       /* Log::alert('call file');

        $setting = Setting::find(1);
        $cp_helper = new CoinPaymentsAPI();
        $setup = $cp_helper->Setup($setting->private_key,$setting->public_key);
        $withdraw_data = Withdraw::get();

        foreach ($withdraw_data as $key_w)
        {
            if($key_w->withdraw_id !="" && $key_w->withdraw_id !="0")
            {
                $main_id=$key_w->withdraw_id;
                return  $result = $cp_helper->get_wdata($key_w->withdraw_id);

                if ($result['error'] == 'ok')
                {
                    if($result['status']==2)
                    {
                        return  $ww=Withdraw::find($main_id);
                        $ww->txid=$result['send_txid'];
                        $ww->save();
                    }
                }
                else
                {
                    Log::alert('call file2');

                }
            }
        }*/
    }
}
