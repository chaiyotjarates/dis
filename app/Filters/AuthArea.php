<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthArea implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {
        //if area not logged in
        $session = session();
        if(!session()->get('logged_in') || $session->get('checktype') != 'area') {
            return redirect()->to(base_url('/login'))->with('fail', 'คุณต้องเข้าสู่ระบบก่อน');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        //Do somthing

    }
}