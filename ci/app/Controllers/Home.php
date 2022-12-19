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

    public function manual()
    {
        // echo('dashboard');
        $logged_in = session()->get('admin_logged_in');
        $Pins = new \App\Models\Pins();
        $Vendors = new \App\Models\Vendors();
        if ($logged_in) {
            $vendor = $Vendors->where('name', session()->get('admin'))->find()[0];
            $headerdata = [
                'admin' => session()->get('admin'),
                'clear' => session()->get('clear'),
                'admin_code' => session()->get('admincode'),
            ];

            $client = \Config\Services::curlrequest();

            $response = $client->request('GET', 'https://opensheet.elk.sh/1YD3D_WsBJxO6r91A9QPWK-C1GZWkUuElziA0Z1vRAZM/pmc'.$vendor['sheet']);
            $res = json_decode($response->getBody());
            // var_dump($res);

            $data = array(
                'dels' => $res,
                'reg' => count($res),
                'link' => $vendor['log'],
                'locked' => $vendor['locked'],
                'sheet' => $vendor['sheet'],
            );

            echo view('header', $headerdata);
            echo view('manual', $data);
            echo view('footer');
        } else {
            echo view('login');
        }
    }

    public function sync($sheet)
    {
        $logged_in = session()->get('admin_logged_in');
        if ($logged_in) {
            $Vendors = new \App\Models\Vendors();
            $vend =$Vendors->where('sheet',$sheet)->find()[0];
            $vID = $vend['id'];

            if($vend['locked']){
                echo "You are locked out. Contact Registrar <a href='javascript:history.back()'>Go Back</a>";
                return redirect()->back();
            }else{

                $client = \Config\Services::curlrequest();

                $response = $client->request('GET', 'https://opensheet.elk.sh/1YD3D_WsBJxO6r91A9QPWK-C1GZWkUuElziA0Z1vRAZM/pmc'.$sheet);
                $res = json_decode($response->getBody());

                $Delegates = new \App\Models\Delegates();

                $allDel = [];
                foreach ($res as $key => $delegate){
                    $dt = [
                        'fname' =>$delegate->fname,
                        'lname' =>$delegate->lname,
                        'lb' =>$delegate->lb,
                        'phone' =>$delegate->{'phone '},
                        'email' =>$delegate->email,
                        'category' =>$delegate->category,
                        'school' =>$delegate->school,
                        'ref' =>'m',
                        'old' => 0,
                        'paid' =>'',
                        'gender' =>$delegate->gender,
                        'org' =>$delegate->org,
                    ];
                    array_push($allDel, $dt);
                }
                if(count($allDel) > 0){
                    $Delegates->insertBatch($allDel);
                }
                $Vendors->update($vID, ['locked' => 1,]);
                 echo "Data uploaded to CAMP DB. Ensure you remove these set of data from Google Spreadsheet to avoid duplication. <a href='javascript:history.back()'>Go Back</a>";
                return redirect()->back();

             }
        } else {
            echo view('login');
        }
    }


    public function lock($vID)
    {
        $logged_in = session()->get('admin_logged_in');
        if ($logged_in) {
            $Vendors = new \App\Models\Vendors();
            $vend =$Vendors->where('id',$vID)->find()[0];

            if($vend['locked']){
                $Vendors->update($vID, ['locked' => 0,]);
            }else{
                $Vendors->update($vID, ['locked' => 1,]);
             }
             return redirect()->back();
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


    public function tag()
    {
        $logged_in = session()->get('admin_logged_in');
        if ($logged_in) {
            $Pins = new \App\Models\Pins();
            $Delegates = new \App\Models\Delegates();
            $Vendors = new \App\Models\Vendors();
            $headerdata = [
                'admin' => session()->get('admin'),
                'clear' => session()->get('clear'),
                'admin_code' => session()->get('admincode'),
            ];

            $data = [
                'tdel' => $Delegates->countAll(),
                'rpin' => $Pins->where('vendor','Remo')->countAllResults(),
                'ipin' => $Pins->where('vendor','Ijebu')->countAllResults(),
                'epin' => $Pins->where('vendor','Egba')->countAllResults(),
                'aapin' => $Pins->where('vendor','AdoOdo')->countAllResults(),
                'opin' => $Pins->where('vendor','online')->countAllResults(),
                'spin' => $Pins->where('sold','1')->countAllResults(),
                'upin' => $Pins->where('used','1')->countAllResults(),
                'vendors' => $Vendors->findAll(),
                'cursor' => $Pins->where('vendor','new')->first()['id'],
                // 'locked' => 0,
            ];

            echo view('header', $headerdata);
            echo view('tag', $data);
            echo view('footer');
        } else {
            echo view('login');
        }
    }


    public function printtag()
    {
        $logged_in = session()->get('admin_logged_in');
        if ($logged_in) {
            $incoming = $this->request->getPost();
            $range = explode('-',$incoming['range']);

            $Delegates = new \App\Models\Delegates();
            $del = '';
            if(count($range)==1){
                $del = $Delegates->where('id',$range[0])->find();
            }else{
                $del = [];
                for ($i=$range[0]; $i < ($range[1]+1); $i++) {
                   array_push($del,$Delegates->where('id', $i)->find());
                }
            }

            echo view('tags', ['del'=>$del]);
        } else {
            echo view('login');
        }
    }


    // https://opensheet.elk.sh/1YD3D_WsBJxO6r91A9QPWK-C1GZWkUuElziA0Z1vRAZM/pmca

	//--------------------------------------------------------------------

}
