<?php

namespace App\Http\Controllers;

use App\Models\Lokasitoko;
use App\Models\LokasitokoModel;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    function lokasi(Request $request)
    {
        $search = urlencode($request->search);
        $curl = curl_init();
        //         curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=" . $search,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 6f236992378c17b751f3b051fbe73779"
            )
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        }
        $array_response = json_decode($response, TRUE);
        $result = [];
        foreach ($array_response['data'] as $key => $res) {
            $result[$key] = [
                'id' => $res['id'] . '|' . $res['city_name'],
                'text' => $res['label']
            ];
        }
        $data['results'] = $result;
        echo json_encode($data);
    }
    function cost(Request $request)
    {
        $destination = $request->destination;
        $arr = explode('|', $destination);
        $location = $arr[0];
        $city_name = $arr[1];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_POSTFIELDS => array(
                'origin' => '36962',
                'destination' => $location,
                'weight' => 1000,
                'courier' => 'lion'
            ),
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "key: 6f236992378c17b751f3b051fbe73779"
            )
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        }
        $array_response = json_decode($response, TRUE);
        // $result = [];
        // foreach ($array_response['data'] as $key => $res) {
        //     $result[$key] = [
        //         'id' => $res['id'],
        //         'text' => $res['label']
        //     ];
        // }
        // $data['results'] = $result;
        $lokasi = Lokasitoko::first();
        if ($lokasi->city_name == $city_name) {
            $array_response['data'][] = [
                'cost' => 10000,
                'etd' => '0 day',
                'name' => 'Jasa Kirim Toko',
                'description' => 'Berlaku dalam kota yang sama',
            ];
        }
        echo json_encode($array_response['data']);
    }

    function notifPelanggan()
    {
        $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();
        $count = Transaksi::where('pelanggan_id', $pelanggan->pelanggan_id)->where('read', 0)->count();
        echo json_encode($count);
    }
}
