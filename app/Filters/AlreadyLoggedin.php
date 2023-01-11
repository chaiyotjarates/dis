<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AlreadyLoggedin implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {
        //if user not logged in
        if(session()->get('logged_in')) {
            if (session()->get('checktype') == "admin") {
				return redirect()->to(base_url('admin'));
			}

			if (session()->get('checktype') == "obec") {
				return redirect()->to(base_url('obec'));
			}

			if (session()->get('checktype') == "cluster") {
				return redirect()->to(base_url('cluster'));
			}

			if (session()->get('checktype') == "area") {
				return redirect()->to(base_url('area'));
			}

			if (session()->get('checktype') == "school") {
				return redirect()->to(base_url('school'));
			}

			if (session()->get('checktype') == "teacher") {
				return redirect()->to(base_url('teacher'));
			}

        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        //Do somthing

    }
}