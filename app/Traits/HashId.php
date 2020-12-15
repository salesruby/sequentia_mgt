<?php
/**
 * Created by PhpStorm.
 * User: tujailer
 * Date: 11/23/20
 * Time: 5:14 PM
 */

namespace App\Traits;

use Hashids\Hashids;

trait HashId
{

    private function key(){
        return new Hashids('Sequentia Management', 62);
    }

    public function encrypt($id){
        $data = ['status' => 'error', 'message' => 'Data id is invalid'];
        if(is_numeric($id)){
            $data = [
                'status' => 'error',
                'message' => 'Data id is invalid',
                'data_token' => $this->key()->encode($id)
            ];
        }
        return $data;
    }

    public function decrypt($id){
        $data = ['status' => 'error', 'message' => 'Data does not exist'];
        $result = $this->key()->decode($id);
        if($result !== null){
            $data = ['status' => 'success', 'message' => 'Data exist', 'data_id'=> $result[0]];
        }
        return $data ;
    }
}
