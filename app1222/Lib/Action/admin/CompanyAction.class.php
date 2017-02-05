<?php
class CompanyAction extends backendAction
{
    public $token;
    public $isBranch;
    public $company_model;
    public function _initialize()
    {
        parent::_initialize();
        $this->token = 1;
        $this->assign('token', $this->token);
        //权限
        //if ($this->token != $_GET['token']) {
        //    exit();
        //}
        //是否是分店
        $this->isBranch = 0;
        if (isset($_GET['isBranch']) && intval($_GET['isBranch'])) {
            $this->isBranch = 1;
        }
        $this->assign('isBranch', $this->isBranch);
        $this->company_model = M('Company');
    }
	public function branch_add() {
		$this->display();
	}
	public function branch_add_save() {
		$this->company_model->create();
		$_POST["isbranch"] = 1;
		$this->company_model->add($_POST);
		$this->success('增加成功', U('Company/branches', array(
			'isBranch' => $this->isBranch
		)));
	}
    public function index()
    {
        $where = array();
		$isUpdate = 0;
        if ($this->isBranch) {
            $id                = intval($_GET['id']);
            $where['id']       = $id;
            $where['isBranch']       = 1;
			$this->assign('isUpdate', 1);
			$isUpdate = 1;
        } else {
             $where['isBranch']       = 0;
        }
		if(isset($_POST["id"])) {
			$where["id"] = $_POST["id"];
			$this->assign('isUpdate', 1);
			$isUpdate = 1;
		}
		//
        $thisCompany = $this->company_model->where($where)->find();
        if (IS_POST) {
            if ($_FILES['logourl']['name']) {
                $img              = $this->_upload($_FILES['logourl'],"company_index");
				if($img["error"] == 1) {
					$this->error($img["info"]);
					return;
				}
				//print_r($img);exit;
				//Array ( [error] => 0 [info] => Array ( [0] => Array ( [name] => 200.jpg [type] => image/jpeg [size] => 6071 [extension] => jpg [savepath] => data/upload/company_index/ [savename] => 53c67f517b2b4.jpg [hash] => 411ed81639f2e9fc23cad40df2679841 ) ) )
                $_POST['logourl'] = $img["info"][0]['savepath'] . $img["info"][0]['savename'];
            }
            if (!$thisCompany) {   
				$_POST['isBranch'] = $this->isBranch;
				$this->company_model->create();
				if($isUpdate == 1) {
					$where2 = array();
					$where2["id"] = $_POST["id"];
					$this->company_model->where($where2)->save($_POST);
					
				} else {
					$this->company_model->add($_POST);
					
				}
				if ($this->isBranch) {
					$this->success('修改成功', U('Company/branches', array(
						'isBranch' => $this->isBranch
					)));
				} else {
					$this->success('修改成功', U('Company/index', array(
						'isBranch' => $this->isBranch
					)));
				}
            } else {
                if ($this->company_model->create()) {
					$where2 = array();
					$where2["id"] = $thisCompany["id"];
                    $this->company_model->where($where2)->save($_POST);
					//echo $this->company_model->getLastSql();
					//exit();
					if ($this->isBranch) {
						$this->success('修改成功', U('Company/branches', array(
							'isBranch' => $this->isBranch
						)));
					} else {
						$this->success('修改成功', U('Company/branches', array(
							'isBranch' => $this->isBranch
						)));
					}
                    
                } else {
                    $this->error($this->company_model->getError());
                }
            }
            
        } else {
			//print_r($thisCompany);exit;
            $this->assign('set', $thisCompany);
            $this->display();
        }
    }
    public function branches()
    {
        $branches = $this->company_model->where(array(
            'isbranch' => 1
        ))->order('taxis ASC')->select();
		//print_r();
        $this->assign('branches', $branches);
        $this->display();
    }
    public function delete()
    {
        $where = array(
            'isbranch' => 1,
            'id' => intval($_GET['id'])
        );
        $rt    = $this->company_model->where($where)->delete();
        if ($rt == true) {
            $this->success('删除成功', U('Company/branches', array(
                'isBranch' => 1
            )));
        } else {
            $this->error('服务器繁忙,请稍后再试', U('Company/branches', array(
                'isBranch' => 1
            )));
        }
    }
}
?>