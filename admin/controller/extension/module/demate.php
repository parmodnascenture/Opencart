<?php
class ControllerExtensionModuleDemate extends Controller {
	
	private $error = array();

	public function index() {

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('extension/module/demate',$data));

	}
		 
	protected function validate() {
		 
	}


	public function install() {
	  $this->load->model('setting/setting');
	    $this->model_setting_setting->editSetting('module_demate', ['module_demate_status'=>1]);
	}

	public function uninstall() {
	 	$this->load->model('setting/setting');
	 	$this->model_setting_setting->deleteSetting('module_demate');
	
	}



}