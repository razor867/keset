<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data['title_page'] = 'Dashboard';
		$data['content'] = 'Anda berada di halaman dashboard';
		$data['menu'] = 'dashboard';
		$data['submenu'] = '';
		return view('home/home', $data);
	}

	public function profile()
	{
		$data['title_page'] = 'Profile';
		$data['content'] = '';
		$data['menu'] = 'profile';
		$data['submenu'] = '';
		return view('home/profile', $data);
	}
}
