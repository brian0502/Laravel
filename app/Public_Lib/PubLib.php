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
								'註冊' => url('home/signup'),
								'登入' => url('home/login'),
                                '作品' => url('home/project'),
                                '學習筆記' => url('home/note')
							),
						1 => array(
								'影片' => url('home/movie'),
								'登出' => url('home/logout'),
                                '作品' =>  url('home/project'),
                                '學習筆記' => url('home/note')

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

    public static function GetUrl( $request = '' )
    {
        if(!empty($request))
        {
            $request_url = $request->path();
            $request_url = explode( '/', $request_url );
            $request_url= !empty($request_url[1])? $request_url[1]:'';
        }
        return  $request_url;
    }

    /**
    *  @濾掉HTML，並且擷取設定的字數
    *  @param $html = HTML source
    *  @param $html = 顯示字元數
    */
    public static function Cut_content( $html = NULL, $num = NULL )
    {
        $content = strip_tags(stripcslashes(trim($html))); //去除HTML標籤
        $sub_content = mb_substr($content, 0, $num, 'UTF-8'); //擷取子字串
        if(strlen($content) > strlen($sub_content))
        {
            $s_content = $sub_content.'...';
        }
        else
        {
            $s_content = $sub_content;
        }
        return $s_content;
    }
}
