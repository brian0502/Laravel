<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use PubLib;
use Session;

class HomeModel extends Model
{
    public function __construct()
    {

    }

    public function login($aData = array())
    {
        $chk = DB::table('member')
            ->where('name', '=', $aData['name'])
            ->where('password', '=', PubLib::strToMd5($aData['password']))
            ->get();
        if (!empty($chk)) {
            Session::put('login', true);
            return true;
        } else {
            return false;
        }
    }

    public function signup($aData = array())
    {
        $chk = DB::table('member')
            ->where('name', '=', $aData['name'])
            ->get();
        if (empty($chk)) {
            foreach ($aData as $key => $val) {
                switch ($key) {
                    case 'password':
                        $aData[$key] = PubLib::strToMd5($val);
                        break;
                }
            }
            $time                = time();
            $aData['created_at'] = $aData['updated_at'] = date('Y-m-d H:i:s', $time);
            DB::table('member')->insert($aData);
            return true;
        } else {
            return false;
        }
    }

    public function getMovie()
    {
        return true;
    }

    public function getProjectOrNote($action = null, $search_id = null, $sbustr_num = null)
    {
        $aData = array();
        if (!empty($action)) {
            $aProject_Note = !empty($search_id) ?
            DB::table($action)
                ->where($action . '_id', '=', $search_id)
                ->where('status', '=', 1)
                ->orderBy($action . '_id', 'DESC')
                ->get()
            :
            DB::table($action)
                ->where('status', '=', 1)
                ->orderBy($action . '_id', 'DESC')
                ->get();

            foreach ($aProject_Note as $k => $v) {
                foreach ($v as $k1 => $v1) {
                    switch ($k1) {
                        case 'content' :
                            $v1 = json_decode($v1);
                            if (!empty($sbustr_num) && empty($search_id)) {
                                $v1 = PubLib::cutContent($v1, $sbustr_num);
                            }
                            $aData[$k][$k1] = nl2br($v1);
                            break;
                        default:
                            $aData[$k][$k1] = $v1;
                            break;
                    }
                }
            }
        }

        return $aData;
    }

    public function addNote($aData = array())
    {
        if (!empty($aData)) {
            foreach ($aData as $key => $val) {
                switch ($key) {
                    case 'content':
                        $aData[$key] = json_encode($val);
                        break;
                }
            }
            DB::table('note')->insert($aData);
            return true;
        } else {
            return false;
        }
    }

}
