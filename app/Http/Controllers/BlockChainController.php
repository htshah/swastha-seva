<?php

namespace App\Http\Controllers;

use Faker\Factory as Faker;
use Illuminate\Http\Request;
use \App\Extensions\ExtendedMultichainClient;

class BlockChainController extends Controller
{
    private $multichain;

    public function __construct()
    {
        $this->multichain = new ExtendedMultichainClient(
            env('CHAIN_URL'), // 'http://192.168.137.32:8000',
            env('CHAIN_USR'),
            env('CHAIN_PWD')
        );

        $this->multichain->setDebug(true);
    }

    public function getInfo()
    {
        return $this->multichain->getInfo();
    }

    public function generateAddress(Request $request)
    {
        $user = \App\Users::find($request->session()->get('user_id'))
            ->first();

        $user->block_address = $this->multichain->getNewAddress();
        $user->save();

        //Grant permission to this address
        $this->multichain->grant(
            $request->session()->get('uid'),
            'connect,send,receive,create'
        );

        return [
            'user' => $user->name,
            'adderss' => $user->block_address,
        ];
    }

    public function grantPermissions(Request $request, $permissions)
    {

        $this->multichain->grant(
            $request->session()->get('uid'),
            $permissions
        );

        return 'Permissions granted';
    }

    public function getStream()
    {
        return [
            'streams' => $this->multichain->getStreams(),
        ];
    }

    public function newStream(Request $request, $stream)
    {
        $this->multichain->createStream($stream);

        return [
            'streams' => $this->multichain->getStreams(),
        ];
    }

    public function subscribeStream(Request $request, $stream)
    {
        $this->multichain->subscribe($stream);
        return [
            'streams' => $this->multichain->getStreams($stream),
        ];
    }

    public function publishStream(Request $request)
    {
        $from = $request->key;
        $stream = $request->stream;
        $key = $request->session()->get('uid');
        $data = $request->data;
        $this->multichain->publishFrom($from, $stream, $key, $data);
        return [
            'stream_items' => $this->multichain->listStreamItems($stream),
        ];
    }

    public function viewStreamItems(Request $request, $stream)
    {
        $items = $this->multichain->listStreamItems($stream, 30);
        $filter = [
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'pincode' => $request->input('pincode'),
            'gender' => $request->input('gender'),
            'disease' => $request->input('disease'),
        ];
        foreach ($filter as $rule => $val) {
            if ($val == '*' || empty($val)) {
                unset($filter[$rule]);
            }
        }
        $filterCount = count($filter);
        //Convert hex data to text form
        $finalArr = [];
        foreach ($items as $i => $item) {
            $items[$i]['data_text'] = hex2bin($item['data']);
            $data = json_decode($items[$i]['data_text'], true);
            $items[$i]['publishers'] = $item['publishers'][0];

            $arr = array_intersect_assoc($data, $filter);
            if (count($arr) == $filterCount) {
                $finalArr[] = $items[$i];
            }
        }
        return [
            'stream_items' => $finalArr,
        ];
    }

    public function fakeStream(Request $request, $stream)
    {
        $faker = Faker::create('en_IN');
        $key = $request->session()->get('uid');
        $from = $key;

        $disease = ['cancer', 'aids', 'malaria'];
        $gender = ['male', 'female'];
        for ($i = 0; $i < 100; $i++) {
            $data = json_encode([
                'disease' => $disease[array_rand($disease)],
                'gender' => $gender[array_rand($gender)],
                'pincode' => mt_rand(400001, 400096),
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
            ]);

            $this->multichain->publishFrom($from, $stream, $key, $data);

        }

        return 'Added fake data';
    }
}
