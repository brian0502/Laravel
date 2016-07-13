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

	public function get_project_or_note( $action = NULL, $search_id = NULL, $sbustr_num = NULL )
	{
		$aData = array();
		if(!empty($action))
		{
			$aProject_Note = !empty( $search_id )?
			DB::table( $action )
			->where($action.'_id', '=', $search_id)
			->where('status', '=', 1)
			->get()
			:
			DB::table( $action )
			->where('status', '=', 1)
			->get();

			foreach($aProject_Note as $k => $v)
			{
				foreach($v as $k1 => $v1)
				{
					switch($k1)
					{
						case 'content':
							$v1 = json_decode($v1);
							if(!empty($sbustr_num)&&empty($search_id))
							{
								$v1 = PubLib::Cut_content($v1, $sbustr_num);
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

	public function add_note($aData=array())
	{
		if(!empty($aData))
		{
			foreach($aData as $key => $val)
			{
				switch($key)
				{
					case 'content':
						$aData[$key] = json_encode($val);
						break;
				}
			}
	    	DB::table('note')->insert($aData);
	    	return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}
