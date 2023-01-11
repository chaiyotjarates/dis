<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AwardsModel;
use App\Models\PrefixModel;
use App\Models\AreasModel;
use App\Models\SchoolsModel;
use App\Models\ClustersModel;
use App\Models\KurusConfigsModel;
use App\Models\AreasOnlinesModel;

use CodeIgniter\Controller;

class AreaController extends Controller {

    public function index() {
        $userModel = new UsersModel;
        $awardModel = new AwardsModel;
        $areaModel = new AreasModel;
        $schoolModel = new SchoolsModel;
        $clusterModel = new ClustersModel;
        $kuruConfigModel = new KurusConfigsModel;
        $areaOnlineModel = new AreasOnlinesModel;
        $data = [
            'title' => [
                '1' => 'Dashboard,เขตพื้นที่ฯ'
            ],
            'useronline' => $areaOnlineModel->where('checktype','kuru')->countAllResults(),
        ];
        echo view('area/dashboard', $data);
    }

}