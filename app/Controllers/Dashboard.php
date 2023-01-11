<?php namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class Dashboard extends Controller {
    public function index() {
        return redirect()->to(base_url('/login'));
    }
}