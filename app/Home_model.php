<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use PubLib;

class Home_model extends Model
{
    public function __construct()
    {

    }

	public function login($aData=array())
	{
		$chk = DB::table('member')
						->where('name', '=', $aData['name'])
						->where('password', '=', PubLib::str_to_md5($aData['password']))
		                ->get();
		if(!empty($chk))
		{
			Session::put('login', TRUE);
	    	return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function signup($aData=array())
	{
		$chk = DB::table('member')
						->where('name', '=', $aData['name'])
		                ->get();
		if(empty($chk))
		{
			foreach($aData as $key => $val)
			{
				switch($key)
				{
					case 'password':
						$aData[$key] = PubLib::str_to_md5($val);
						break;
				}
			}
			$time = time();
			$aData['created_at'] = $aData['updated_at'] = date('Y-m-d H:i:s',$time);
	    	DB::table('member')->insert($aData);
	    	return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function get_movie()
	{
		return TRUE;
	}
}
