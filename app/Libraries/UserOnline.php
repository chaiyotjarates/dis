<?php

namespace App\Libraries;
use CodeIgniter\HTTP\Request; 

use App\Models\UsersOnlinesModel;
use App\Models\AdminsOnlinesModel;
use App\Models\AreasOnlinesModel;
use App\Models\ClustersOnlinesModel;
use App\Models\GuestsOnlinesModel;

class UserOnline
{

	function online()
	{
			$session = session(); 
			$userOnlineModel = new UsersOnlinesModel;
			$adminOnlineModel = new AdminsOnlinesModel;
			$areaOnlineModel = new AreasOnlinesModel;
			$clusterOnlineModel = new ClustersOnlinesModel;
			$guestOnlineModel = new GuestsOnlinesModel;

            $timeoutseconds = 7200;
            $timeout = time() - $timeoutseconds;

            $userOnlineModel->query("DELETE FROM users_online WHERE last_activity < ".$timeout);
			$adminOnlineModel->query("DELETE FROM admin_online WHERE last_activity < ".$timeout);
	        $guestOnlineModel->query("DELETE FROM guest_online WHERE last_activity < ".$timeout);
	        $areaOnlineModel->query("DELETE FROM area_online WHERE last_activity < ".$timeout);
	        $clusterOnlineModel->query("DELETE FROM cluster_online WHERE last_activity < ".$timeout);

            if ( $session->get('checktype') !=''){

            if ($session->get('checktype')=='school')
            {
                $this->User_insert_data();
            } 
			if ($session->get('checktype')=='admin')
            {
                $this->Admin_insert_data();
            } 
			if ($session->get('checktype')=='area')
            {
                $this->Area_insert_data();
            } 
			if ($session->get('checktype')=='cluster')
            {
                $this->Cluster_insert_data();
            } 
			} else {

//			if (isset($dataGuest['ip'])){
				$this->Guest_insert_data();
//			}

			}
	}

	function Guest_insert_data()
	{
		$session = session(); 
		$guestOnlineModel = new GuestsOnlinesModel;

		$arrayGuest = array(
            'ip_address' => $session->get('REMOTE_ADDR'),
            'user_agent' => $session->get('HTTP_USER_AGENT'),
            'last_activity' => time(),
            'uri' => $session->get('REQUEST_URI')
         );
		$count = $guestOnlineModel->where('ip_address', $session->get('REMOTE_ADDR'))->countAllResults();
		if ($count === 0)
		{
			$guestOnlineModel->insert($arrayGuest); 
		}
		else
		{
			$guestOnlineModel
			->where('last_activity', time())
			->where('uri' , $session->get('REQUEST_URI'))
			->where('ip_address' , $session->get('REMOTE_ADDR'))
			//->where('uid' , $session->get('user_id'))
			//->where('checktype' , 'kuru')
			->set($arrayGuest)->update();			
			
		}
	}

	function User_insert_data()
	{
		$session = session(); 
		$userOnlineModel = new UsersOnlinesModel;
		$arrayUser = array(
            'uid' => $session->get('user_id') ,
			'checktype' => "dis",
            'username' => $session->get('user_idcard'),
            'clus' => $session->get('cluster'),
            'area' => $session->get('area'),
            'school' => $session->get('school'),
            'ip_address' => $session->get('REMOTE_ADDR'),
            'user_agent' => $session->get('HTTP_USER_AGENT'),
            'last_activity' => time(),
            'uri' => $session->get('REQUEST_URI')
         );
		$count = $userOnlineModel->where(['uid' => $session->get('user_id'),'checktype' => 'dis'])->countAllResults();
		if ($count === 0)
		{
			$userOnlineModel->insert($arrayUser); 
		}
		else
		{
			$userOnlineModel
			->where('last_activity', time())
			//->where('uri' , $session->get('REQUEST_URI'))
			//->where('ip_address' , $session->get('REMOTE_ADDR'))
			->where('uid' , $session->get('user_id'))
			->where('checktype' , 'dis')
			->set($arrayUser)->update();

		}
	}

	function Admin_insert_data()
	{
		$session = session(); 
		$adminOnlineModel = new AdminsOnlinesModel;
		$arrayAdmin= array(
            'uid' => $session->get('user_id') ,
			'checktype' => "dis",
            'username' => $session->get('user_idcard'),
            'ip_address' => $session->get('REMOTE_ADDR'),
            'user_agent' => $session->get('HTTP_USER_AGENT'),
            'last_activity' => time(),
            'uri' => $session->get('REQUEST_URI')
         );
		$count = $adminOnlineModel->where(['uid' => $session->get('user_id'),'checktype' => 'dis'])->countAllResults();
		if ($count === 0)
		{
			$adminOnlineModel->insert($arrayAdmin); 
		}
		else
		{
			$adminOnlineModel
			->where('last_activity', time())
			//->where('uri' , $session->get('REQUEST_URI'))
			//->where('ip_address' , $session->get('REMOTE_ADDR'))
			->where('uid' , $session->get('user_id'))
			->where('checktype' , 'dis')
			->set($arrayAdmin)->update();
		}
	}

	function Cluster_insert_data()
	{
		$session = session(); 
		$clusterOnlineModel = new ClustersOnlinesModel;

		$arrayCluster= array(
            'uid' => $session->get('user_id') ,
			'checktype' => "dis",
            'username' => $session->get('user_idcard'),
            'clus' => $session->get('clus'),
            'ip_address' => $session->get('REMOTE_ADDR'),
            'user_agent' => $session->get('HTTP_USER_AGENT'),
            'last_activity' => time(),
            'uri' => $session->get('REQUEST_URI')
         );
		$count = $clusterOnlineModel->where(['uid' => $session->get('user_id'),'checktype' => 'dis'])->countAllResults();
		if ($count === 0)
		{
			$clusterOnlineModel->insert($arrayCluster); 
		}
		else
		{
			$clusterOnlineModel
			->where('last_activity', time())
			//->where('uri' , $session->get('REQUEST_URI'))
			//->where('ip_address' , $session->get('REMOTE_ADDR'))
			->where('uid' , $session->get('user_id'))
			->where('checktype' , 'dis')
			->set($arrayCluster)->update();
		}
	}

	function Area_insert_data()
	{
		$session = session(); 
		$areaOnlineModel = new AreasOnlinesModel;
		$arrayArea= array(
            'uid' => $session->get('user_id') ,
			'checktype' => "dis",
            'username' => $session->get('user_idcard'),
            'clus' => $session->get('clus'),
            'area' => $session->get('area') ,
            'ip_address' => $session->get('REMOTE_ADDR'),
            'user_agent' => $session->get('HTTP_USER_AGENT'),
            'last_activity' => time(),
            'uri' => $session->get('REQUEST_URI')
         );
		$count = $areaOnlineModel->where(['uid' => $session->get('user_id'),'checktype' => 'dis'])->countAllResults();
		if ($count === 0)
		{
			$areaOnlineModel->insert($arrayArea); 
		}
		else
		{
			$areaOnlineModel
			->where('last_activity', time())
			//->where('uri' , $session->get('REQUEST_URI'))
			//->where('ip_address' , $session->get('REMOTE_ADDR'))
			->where('uid' , $session->get('user_id'))
			->where('checktype' , 'dis')
			->set($arrayArea)->update();
		}
	}

}

/* End of file users_online.php */
/* Location: ./application/hooks/user_online.php */