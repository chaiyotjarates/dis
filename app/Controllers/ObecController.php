<?php namespace App\Controllers;

use CodeIgniter\Controller;

class ObecController extends Controller {

    public function index() {
        $data = [
            'title' => [
                '1' => 'Dashboard,'.session()->get('firstname')
            ]
        ];
        echo view('obec/dashboard', $data);
    }

}