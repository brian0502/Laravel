<?php

namespace App\PubLib;

use DB;
use Session;

/**
 *  自定義共用Function class
 */
class PubLib
{
    public function __construct()
    {

    }

    /**
     * [test 測試]
     */
    public static function test()
    {
    	// echo "<script>alert('CCCCCC');</script>";
    }

    /**
     * [ChkLogin 檢查是否登入]
     */
    public static function ChkLogin()
    {
    	$login = Session::get('login');

    	return $login;
    }

    /**
     * [str_to_md5 將字串轉為md5格式]
     * @param  string $str [欲轉換的字串]
     * @return string $md5 [轉換後的md5字串]
     */
    public static function str_to_md5($str = '')
    {
    	$md5 = md5($str);
    	return $md5;
    }

    /**
     * [GetSidebar 取得側邊攔]
     * 此處會依照登入與否來決定側邊欄
     * @return array $aData [側邊攔陣列]
     */
    public static function GetSidebar()
	{
		$login = Session::get('login')===TRUE? 1:0;

		$aSidebar = array(
						0 => array(
								'註冊' => 'http://localhost/home/signup/',
								'登入' => 'http://localhost/home/login/',
							),
						1 => array(
								'影片' => 'http://localhost/home/movie/',
								'登出' => 'http://localhost/home/logout/',
							),
					);
		foreach($aSidebar as $login_status => $sidebar_val)
		{
			if( $login === $login_status )
			{
				foreach($sidebar_val as $name => $url)
				{
					$aData[] 	= array(
									'name'	=> $name,
									'url'	=> $url,
								);
				}
			}
		}

		return $aData;
	}
}
