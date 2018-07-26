<?php

namespace App\Extensions;

use be\kunstmaan\multichain\MultichainClient;
use be\kunstmaan\multichain\MultichainHelper;

class ExtendedMultichainClient extends MultichainClient{
    
    public function getStreams($streams='*'){
        return $this->jsonRPCClient
            ->execute(
                'liststreams',
                [$streams]
            );
    }

    public function subscribe($list){
        if(gettype($list) != 'array'){
            $list = [$list];
        }
        return $this->jsonRPCClient
            ->execute(
                'subscribe',
                $list
            );
    }

    public function createStream($stream,$open=true){
        return $this->jsonRPCClient
            ->execute(
                'create',
                array('stream',$stream,$open)
            );
    }

    public function publishFrom($from,$stream,$key,$data){
        return $this->jsonRPCClient
            ->execute(
                'publishfrom',
                [$from,$stream,$key,bin2Hex($data)]
            );
    }

    public function listStreamItems($stream,$count=10){
        return $this->jsonRPCClient
            ->execute(
                'liststreamitems',
                [$stream,false,$count]
            );
    }
}