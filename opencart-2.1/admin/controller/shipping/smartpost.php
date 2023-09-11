<?php
class ControllerShippingSmartpost extends Controller {
	private $error = array();

	public function index() {
		$data = array();
		$data = array_merge($data,$this->load->language('shipping/smartpost'));

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('smartpost', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'] . '&type=shipping', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'] . '&type=shipping', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('shipping/smartpost', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('shipping/smartpost', 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('shipping', 'token=' . $this->session->data['token'] . '&type=shipping', true);

		if (isset($this->request->post['smartpost_status'])) {
			$data['smartpost_status'] = $this->request->post['smartpost_status'];
		} else {
			$data['smartpost_status'] = $this->config->get('smartpost_status');
		}

		if (isset($this->request->post['smartpost_top'])) {
			$data['smartpost_top'] = $this->request->post['smartpost_top'];
		} else {
			$data['smartpost_top'] = $this->config->get('smartpost_top');
		}

		if (isset($this->request->post['smartpost_sort_order'])) {
			$data['smartpost_sort_order'] = $this->request->post['smartpost_sort_order'];
		} else {
			$data['smartpost_sort_order'] = $this->config->get('smartpost_sort_order');
		}

		if (isset($this->request->post['smartpost_weight_class_id'])) {
			$data['smartpost_weight_class_id'] = $this->request->post['smartpost_weight_class_id'];
		} else {
			$data['smartpost_weight_class_id'] = $this->config->get('smartpost_weight_class_id');
		}

		if (isset($this->request->post['smartpost_length_class_id'])) {
			$data['smartpost_length_class_id'] = $this->request->post['smartpost_length_class_id'];
		} else {
			$data['smartpost_length_class_id'] = $this->config->get('smartpost_length_class_id');
		}

		if (isset($this->request->post['smartpost_tax_class_id'])) {
			$data['smartpost_tax_class_id'] = $this->request->post['smartpost_tax_class_id'];
		} else {
			$data['smartpost_tax_class_id'] = $this->config->get('smartpost_tax_class_id');
		}

		if (isset($this->request->post['smartpost_free_cargo'])) {
			$data['smartpost_free_cargo'] = $this->request->post['smartpost_free_cargo'];
		} else {
			$data['smartpost_free_cargo'] = $this->config->get('smartpost_free_cargo');
		}

		if (isset($this->request->post['smartpost_discount_cargo'])) {
			$data['smartpost_discount_cargo'] = $this->request->post['smartpost_discount_cargo'];
		} else {
			$data['smartpost_discount_cargo'] = $this->config->get('smartpost_discount_cargo');
		}

		if (isset($this->request->post['smartpost_cargo_sum'])) {
			$data['smartpost_cargo_sum'] = $this->request->post['smartpost_cargo_sum'];
		} else {
			$data['smartpost_cargo_sum'] = $this->config->get('smartpost_cargo_sum');
		}

		if (isset($this->request->post['smartpost_discount_cargo_percent'])) {
			$data['smartpost_discount_cargo_percent'] = $this->request->post['smartpost_discount_cargo_percent'];
		} else {
			$data['smartpost_discount_cargo_percent'] = $this->config->get('smartpost_discount_cargo_percent');
		}

		if (isset($this->request->post['smartpost_hinnasto'])) {
			$data['smartpost_hinnasto'] = $this->request->post['smartpost_hinnasto'];
		} else {
			$data['smartpost_hinnasto'] = $this->config->get('smartpost_hinnasto');
		}

		if (isset($this->error['smartpost_hinnasto'])) {
			foreach($this->error['smartpost_hinnasto'] as $key=>$hinnasto){
			   	  $data['smartpost_hinnasto'][$key]['error'] = $this->language->get('error_decimale_point');
			}
		}

		$this->load->model('localisation/tax_class');

		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		if (isset($this->request->post['smartpost_geo_zone_id'])) {
			$data['smartpost_geo_zone_id'] = $this->request->post['smartpost_geo_zone_id'];
		} else {
			$data['smartpost_geo_zone_id'] = $this->config->get('smartpost_geo_zone_id');
		}

		$this->load->model('localisation/weight_class');
		$this->load->model('localisation/length_class');

		$data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();
		$data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('shipping/smartpost.tpl', $data));
	}

	public function install(){

        // Hinnastot
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`, `code`, `key`, `value`, `serialized`) VALUES
        (0, 'smartpost', 'smartpost_hinnasto', '[{\"kg\":\"1\",\"price\":\"5.20\"},{\"kg\":\"3\",\"price\":\"6.50\"},{\"kg\":\"5\",\"price\":\"9.80\"}]', 1)");
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