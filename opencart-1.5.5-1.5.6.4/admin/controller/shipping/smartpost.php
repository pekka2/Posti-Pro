<?php
class ControllerShippingSmartpost extends Controller {
	private $error = array();

	public function index() {
		$this->data = array();
		$this->data = array_merge($this->data,$this->load->language('shipping/smartpost'));

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('smartpost', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'] . '&type=shipping', true));
		}

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		
		$this->document->addStyle('view/javascript/bootstrap/opencart/opencart.css');
		$this->document->addStyle('view/javascript/font-awesome/css/font-awesome.min.css');

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], true)
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'] . '&type=shipping', true)
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('shipping/smartpost', 'token=' . $this->session->data['token'], true)
		);

		$this->data['action'] = $this->url->link('shipping/smartpost', 'token=' . $this->session->data['token'], true);
		$this->data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'] . '&type=shipping', true);

		if (isset($this->request->post['smartpost_status'])) {
			$this->data['smartpost_status'] = $this->request->post['smartpost_status'];
		} else {
			$this->data['smartpost_status'] = $this->config->get('smartpost_status');
		}

		if (isset($this->request->post['smartpost_top'])) {
			$this->data['smartpost_top'] = $this->request->post['smartpost_top'];
		} else {
			$this->data['smartpost_top'] = $this->config->get('smartpost_top');
		}

		if (isset($this->request->post['smartpost_sort_order'])) {
			$this->data['smartpost_sort_order'] = $this->request->post['smartpost_sort_order'];
		} else {
			$this->data['smartpost_sort_order'] = $this->config->get('smartpost_sort_order');
		}

		if (isset($this->request->post['smartpost_weight_class_id'])) {
			$this->data['smartpost_weight_class_id'] = $this->request->post['smartpost_weight_class_id'];
		} else {
			$this->data['smartpost_weight_class_id'] = $this->config->get('smartpost_weight_class_id');
		}

		if (isset($this->request->post['smartpost_length_class_id'])) {
			$this->data['smartpost_length_class_id'] = $this->request->post['smartpost_length_class_id'];
		} else {
			$this->data['smartpost_length_class_id'] = $this->config->get('smartpost_length_class_id');
		}

		if (isset($this->request->post['smartpost_tax_class_id'])) {
			$this->data['smartpost_tax_class_id'] = $this->request->post['smartpost_tax_class_id'];
		} else {
			$this->data['smartpost_tax_class_id'] = $this->config->get('smartpost_tax_class_id');
		}

		if (isset($this->request->post['smartpost_free_cargo'])) {
			$this->data['smartpost_free_cargo'] = $this->request->post['smartpost_free_cargo'];
		} else {
			$this->data['smartpost_free_cargo'] = $this->config->get('smartpost_free_cargo');
		}

		if (isset($this->request->post['smartpost_discount_cargo'])) {
			$this->data['smartpost_discount_cargo'] = $this->request->post['smartpost_discount_cargo'];
		} else {
			$this->data['smartpost_discount_cargo'] = $this->config->get('smartpost_discount_cargo');
		}

		if (isset($this->request->post['smartpost_cargo_sum'])) {
			$this->data['smartpost_cargo_sum'] = $this->request->post['smartpost_cargo_sum'];
		} else {
			$this->data['smartpost_cargo_sum'] = $this->config->get('smartpost_cargo_sum');
		}

		if (isset($this->request->post['smartpost_discount_cargo_percent'])) {
			$this->data['smartpost_discount_cargo_percent'] = $this->request->post['smartpost_discount_cargo_percent'];
		} else {
			$this->data['smartpost_discount_cargo_percent'] = $this->config->get('smartpost_discount_cargo_percent');
		}

		if (isset($this->request->post['smartpost_hinnasto'])) {
			$this->data['smartpost_hinnasto'] = $this->request->post['smartpost_hinnasto'];
		} else {
			$this->data['smartpost_hinnasto'] = $this->config->get('smartpost_hinnasto');
		}

		if (isset($this->error['smartpost_hinnasto'])) {
			foreach($this->error['smartpost_hinnasto'] as $key=>$hinnasto){
			   	  $this->data['smartpost_hinnasto'][$key]['error'] = $this->language->get('error_decimale_point');
			}
		}

		$this->load->model('localisation/tax_class');

		$this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		if (isset($this->request->post['smartpost_geo_zone_id'])) {
			$this->data['smartpost_geo_zone_id'] = $this->request->post['smartpost_geo_zone_id'];
		} else {
			$this->data['smartpost_geo_zone_id'] = $this->config->get('smartpost_geo_zone_id');
		}

		$this->load->model('localisation/weight_class');
		$this->load->model('localisation/length_class');

		$this->data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();
		$this->data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();

		$this->load->model('localisation/geo_zone');

		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		$this->template = 'shipping/smartpost.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	public function install(){

        // Hinnastot
         $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`, `group`, `key`, `value`, `serialized`) VALUES
        (0, 'smartpost', 'smartpost_hinnasto', '" . $this->db->escape('a:5:{i:0;a:2:{s:2:"kg";s:1:"1";s:5:"price";s:3:"3.5";}i:1;a:2:{s:2:"kg";s:1:"2";s:5:"price";s:1:"5";}i:2;a:2:{s:2:"kg";s:1:"4";s:5:"price";s:1:"6";}i:3;a:2:{s:2:"kg";s:1:"5";s:5:"price";s:4:"6.50";}i:4;a:2:{s:2:"kg";s:1:"7";s:5:"price";s:1:"9";}}') ."', 1)");
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'shipping/smartpost')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if(isset($this->request->post['smartpost_hinnasto'])){
			foreach($this->request->post['smartpost_hinnasto'] as $key=>$hinnasto){
			   if(strpos($hinnasto['price'],',')){
			      $this->error['warning'] = $this->language->get('error_warning');
			   	  $this->error['smartpost_hinnasto'][$key]['error'] = $this->language->get('error_decimale_point');
			   }
			}
		}

		return !$this->error;
	}
}