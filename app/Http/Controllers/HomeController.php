<?php

namespace App\Http\Controllers;

use Alert;
use App\HomeModel;
use Cache;
use Illuminate\Http\Request;
use PubLib;
use Session;
use Validator;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->HomeModel = new HomeModel;
    }

    public function index()
    {
        $aData = array(
            'title'   => 'BrianIndex',
            'content' => 'Welcome To Index!!',
            'sidebar' => PubLib::GetSidebar(),
            'data'    => $this->HomeModel->getProjectOrNote('note', 0, 100),
        );
        Cache::put('RedisCache', 'HHHHH', 60);

        // Cache::add('RedisCache', 'Test', 60);
        return view('home.index', $aData);
        // return response()->view('welcome');
    }

    public function logout()
    {
        Session::forget('login');

        return redirect('/');
    }

    public function login()
    {
        $aData = array(
            'title'   => '登入',
            'content' => 'Welcome To Index!!',
            'action'  => 'login',
            'sidebar' => PubLib::GetSidebar(),
        );

        return view('home.signup', $aData);
    }

    public function signup()
    {
        $aData = array(
            'title'   => '註冊會員',
            'content' => 'Welcome To Index!!',
            'action'  => 'signup',
            'sidebar' => PubLib::GetSidebar(),
        );

        return view('home.signup', $aData);
    }

    public function doSignup(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name'     => 'required',
            'password' => 'required',
        ]);

        if ($v->fails()) {
            Alert::error('註冊錯誤!');
            return redirect()->back()->withErrors($v->errors());
        }

        foreach ($request->input() as $k => $v) {
            switch ($k) {
                case '_method':
                    break;
                case '_token':
                    break;
                default:
                    $aData[$k] = $v;
                    break;
            }
        }

        $result = $this->HomeModel->signup($aData);

        if ($result == true) {
            Session::put('login', true);
            Alert::error('新增會員成功!');
            return redirect('/');
            exit;
        } else {
            Alert::error('此會員帳號已有人使用，請更換!');
            return redirect('home/signup');
            exit;
        }
    }

    public function doLogin(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name'     => 'required',
            'password' => 'required',
        ]);

        if ($v->fails()) {
            Alert::error('登入錯誤!');
            return redirect()->back()->withErrors($v->errors());
        }

        foreach ($request->input() as $k => $v) {
            switch ($k) {
                case '_method':
                    break;
                case '_token':
                    break;
                default:
                    $aData[$k] = $v;
                    break;
            }
        }

        $result = $this->HomeModel->login($aData);

        if ($result === true) {
            return redirect('/');
        } else {
            Alert::error('登入失敗!');
            return redirect('home/login');
            exit;
        }
    }

    public function movie()
    {
        if (PubLib::ChkLogin() == false) {
            Alert::error('請先登入!');
            return redirect('home/login');
            exit;
        }

        $aData = array(
            'title'   => 'BrianMovie',
            'content' => 'Welcome To Movie!!',
            'sidebar' => PubLib::GetSidebar(),
        );

        return view('home.movie', $aData);
    }

    public function project()
    {
        $aData = array(
            'title'   => 'BrianProject',
            'content' => 'Welcome To Project!!',
            'sidebar' => PubLib::GetSidebar(),
            'data'    => $this->HomeModel->getProjectOrNote('Project'),
        );

        return view('home.project', $aData);
    }

    public function note(Request $request, $note_id = null)
    {
        $substr_num = !empty($note_id) ? 0 : 100;
        $aData      = array(
            'title'       => 'Brian Study Note',
            'content'     => 'Welcome To Study Note!!',
            'sidebar'     => PubLib::GetSidebar(),
            'data'        => $this->HomeModel->getProjectOrNote('note', $note_id, $substr_num),
            'request_url' => PubLib::GetUrl($request),
        );

        return view('home.note', $aData);
    }

    public function addNote()
    {
        $aData = array(
            'title'   => '新增學習筆記',
            'content' => 'Welcome To Study Note!!',
            'sidebar' => PubLib::GetSidebar(),
        );

        return view('home.add_note', $aData);
    }

    public function doAddNote(Request $request)
    {
        $v = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
        ]);

        if ($v->fails()) {
            Alert::error('新增筆記失敗');
            return redirect()->back()->withErrors($v->errors());
        }

        foreach ($request->input() as $k => $v) {
            switch ($k) {
                case '_method':
                    break;
                case '_token':
                    break;
                default:
                    $aData[$k] = $v;
                    break;
            }
        }

        $result = $this->HomeModel->addNote($aData);

        if ($result === true) {
            return redirect('/');
        } else {
            Alert::error('新增筆記失敗!');
            return redirect('home/add_note');
            exit;
        }
    }
}
