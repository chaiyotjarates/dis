<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AwardsModel;
use App\Models\PrefixModel;
use App\Models\AreasModel;
use App\Models\SchoolsModel;
use App\Models\ClustersModel;
use App\Models\DisConfigsModel;
use App\Models\ClustersOnlinesModel;

use CodeIgniter\Controller;

class ClusterController extends Controller {

    public function index() {
        $userModel = new UsersModel;
        $awardModel = new AwardsModel;
        $areaModel = new AreasModel;
        $schoolModel = new SchoolsModel;
        $clusterModel = new ClustersModel;
        $disConfigModel = new DisConfigsModel;
        $clusterOnlineModel = new ClustersOnlinesModel;

        $data = [
            'title' => [
                '1' => 'Dashboard, เขตตรวจราชการ',
            ],
            'useronline' => $clusterOnlineModel->where('checktype','dis')->countAllResults(),
        ];
        echo view('cluster/dashboard', $data);
    }

}