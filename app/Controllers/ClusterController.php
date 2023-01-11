<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AwardsModel;
use App\Models\PrefixModel;
use App\Models\AreasModel;
use App\Models\SchoolsModel;
use App\Models\ClustersModel;
use App\Models\KurusConfigsModel;
use App\Models\ClustersOnlinesModel;

use CodeIgniter\Controller;

class ClusterController extends Controller {

    public function index() {
        $userModel = new UsersModel;
        $awardModel = new AwardsModel;
        $areaModel = new AreasModel;
        $schoolModel = new SchoolsModel;
        $clusterModel = new ClustersModel;
        $kuruConfigModel = new KurusConfigsModel;
        $clusterOnlineModel = new ClustersOnlinesModel;

        $data = [
            'title' => [
                '1' => 'Dashboard, เขตตรวจราชการ',
            ],
            'useronline' => $clusterOnlineModel->where('checktype','kuru')->countAllResults(),
        ];
        echo view('cluster/dashboard', $data);
    }

}