<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$session = session();
		$logged_in = $session->get('admin_logged_in');
		if ($logged_in) {
			return redirect()->to(base_url('dashboard'));
		} else {
			echo view('login');
		}
	}

	public function auth()
	{
		$session = session();
		$Vendors = new \App\Models\Vendors();
		$uname = $this->request->getPost('username');

		if ($res = $Vendors->where('access_code', $uname)->find()) {
			$newdata = array(
				'admin' => $res[0]['name'],
				'admincode' => $uname,
				'clear' => $res[0]['clearance'],
				'admin_logged_in' => TRUE
			);
			$session->set($newdata);
			return redirect()->to(base_url('dashboard'));
		} else {
			return redirect()->to(base_url('/'));
		}
	}

	public function logout()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {
			session()->destroy();
			return redirect()->to(base_url('/'));
		} else {
			echo view('login');
		}
	}

	public function dashboard()
	{
		// echo('dashboard');	
		$logged_in = session()->get('admin_logged_in');
		$Pins = new \App\Models\Pins();
		$Vendors = new \App\Models\Vendors();
		if ($logged_in) {
			$headerdata = [
				'admin' => session()->get('admin'),
				'clear' => session()->get('clear'),
				'admin_code' => session()->get('admincode'),
			];

			$data = array(
				'pins' => $Pins->where('vendor', session()->get('admin'))->find(),
				'log' => $Vendors->where('name', session()->get('admin'))->find()[0]['log']
			);

			echo view('header', $headerdata);
			echo view('dashboard', $data);
			echo view('footer');
		} else {
			echo view('login');
		}
	}

	public function sellpin()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {
			$incoming = $this->request->getGet('pn');
			$Pins = new \App\Models\Pins();

			$Pins->update($incoming, ['sold' => '1']);
			return redirect()->back();
		} else {
			echo view('login');
		}
	}

	public function sharepin()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {
			$incoming = $this->request->getPost();
			$range = explode('-',$incoming['range']);
			$user = $incoming['user'];
			
			$Pins = new \App\Models\Pins();
			$Vendors = new \App\Models\Vendors();
			for ($i=$range[0]; $i < ($range[1]+1); $i++) { 
				$Pins->update($i, ['vendor' => $user]);
			}
			$vend = $Vendors->where('name', $user)->find()[0];
			$vendID = $vend['id'];
			$vendedPin = $vend['pins'];
			$val = ($range[1] - $range[0]) + 1;
			$Vendors->update($vendID, ['pins' => ($vendedPin + $val)]);
			return redirect()->back();
		} else {
			echo view('login');
		}
	}

	public function logupdate()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {
			$incoming = $this->request->getPost();
			$user = $incoming['user'];
			
			$Vendors = new \App\Models\Vendors();
			$vendID = $Vendors->where('name', $user)->find()[0]['id'];
			$Vendors->update($vendID, ['log' => $incoming['log']]);
			return redirect()->back();
		} else {
			echo view('login');
		}
	}

	public function resetPin()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {
			$Pins = new \App\Models\Pins();
			for ($i=0; $i < 1001; $i++) { 
				$Pins->update($i+1, ['used' => 'no']);
			}
			return redirect()->back();
		} else {
			echo view('login');
		}
	}

	public function calibrate()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {
			$Pins = new \App\Models\Pins();
			$Delegates = new \App\Models\Delegates();

			$allPined = $Delegates->findAll();
			$allPins = $Pins->findAll();
			foreach ($allPined as $key => $alp) {
				// $Pins->where('pin',$alp['ref'])->update(['used' => 'yes']);
				var_dump($alp);
				$pinID = $Pins->where('pin',$alp['ref'])->find()[0]['id'];
				var_dump($pinID);
				$Pins->update($pinID,['used' => 'yes']);
			}
			return redirect()->back();
		} else {
			echo view('login');
		}
	}


	public function special()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {
			$Pins = new \App\Models\Pins();
			$Vendors = new \App\Models\Vendors();
			$headerdata = [
				'admin' => session()->get('admin'),
				'clear' => session()->get('clear'),
				'admin_code' => session()->get('admincode'),
			];

			$data = [
				'tpin' => $Pins->countAll(),
				'spin' => $Pins->where('sold','1')->countAllResults(),
				'upin' => $Pins->where('used','yes')->countAllResults(),
				'vendors' => $Vendors->findAll(),
				'cursor' => $Pins->where('vendor','new')->first()['id']
			];

			echo view('header', $headerdata);
			echo view('special', $data);
			echo view('footer');
		} else {
			echo view('login');
		}
	}

	//--------------------------------------------------------------------

}
