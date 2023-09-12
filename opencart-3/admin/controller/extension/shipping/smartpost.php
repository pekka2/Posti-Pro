<?php
class ControllerExtensionShippingSmartpost extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/shipping/smartpost');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('shipping_smartpost', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=shipping', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=shipping', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/shipping/smartpost', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/shipping/smartpost', 'user_token=' . $this->session->data['user_token'], true);
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=shipping', true);

		if (isset($this->request->post['shipping_smartpost_status'])) {
			$data['shipping_smartpost_status'] = $this->request->post['shipping_smartpost_status'];
		} else {
			$data['shipping_smartpost_status'] = $this->config->get('shipping_smartpost_status');
		}

		if (isset($this->request->post['shipping_smartpost_top'])) {
			$data['shipping_smartpost_top'] = $this->request->post['shipping_smartpost_top'];
		} else {
			$data['shipping_smartpost_top'] = $this->config->get('shipping_smartpost_top');
		}

		if (isset($this->request->post['shipping_smartpost_sort_order'])) {
			$data['shipping_smartpost_sort_order'] = $this->request->post['shipping_smartpost_sort_order'];
		} else {
			$data['shipping_smartpost_sort_order'] = $this->config->get('shipping_smartpost_sort_order');
		}

		if (isset($this->request->post['shipping_smartpost_weight_class_id'])) {
			$data['shipping_smartpost_weight_class_id'] = $this->request->post['shipping_smartpost_weight_class_id'];
		} else {
			$data['shipping_smartpost_weight_class_id'] = $this->config->get('shipping_smartpost_weight_class_id');
		}

		if (isset($this->request->post['shipping_smartpost_length_class_id'])) {
			$data['shipping_smartpost_length_class_id'] = $this->request->post['shipping_smartpost_length_class_id'];
		} else {
			$data['shipping_smartpost_length_class_id'] = $this->config->get('shipping_smartpost_length_class_id');
		}

		if (isset($this->request->post['shipping_smartpost_tax_class_id'])) {
			$data['shipping_smartpost_tax_class_id'] = $this->request->post['shipping_smartpost_tax_class_id'];
		} else {
			$data['shipping_smartpost_tax_class_id'] = $this->config->get('shipping_smartpost_tax_class_id');
		}

		if (isset($this->request->post['shipping_smartpost_free_cargo'])) {
			$data['shipping_smartpost_free_cargo'] = $this->request->post['shipping_smartpost_free_cargo'];
		} else {
			$data['shipping_smartpost_free_cargo'] = $this->config->get('shipping_smartpost_free_cargo');
		}

		if (isset($this->request->post['shipping_smartpost_discount_cargo'])) {
			$data['shipping_smartpost_discount_cargo'] = $this->request->post['shipping_smartpost_discount_cargo'];
		} else {
			$data['shipping_smartpost_discount_cargo'] = $this->config->get('shipping_smartpost_discount_cargo');
		}

		if (isset($this->request->post['shipping_smartpost_cargo_sum'])) {
			$data['shipping_smartpost_cargo_sum'] = $this->request->post['shipping_smartpost_cargo_sum'];
		} else {
			$data['shipping_smartpost_cargo_sum'] = $this->config->get('shipping_smartpost_cargo_sum');
		}

		if (isset($this->request->post['shipping_smartpost_discount_cargo_percent'])) {
			$data['shipping_smartpost_discount_cargo_percent'] = $this->request->post['shipping_smartpost_discount_cargo_percent'];
		} else {
			$data['shipping_smartpost_discount_cargo_percent'] = $this->config->get('shipping_smartpost_discount_cargo_percent');
		}

		if (isset($this->request->post['shipping_smartpost_hinnasto'])) {
			$data['shipping_smartpost_hinnasto'] = $this->request->post['shipping_smartpost_hinnasto'];
		} else {
			$data['shipping_smartpost_hinnasto'] = $this->config->get('shipping_smartpost_hinnasto');
		}

		if (isset($this->error['shipping_smartpost_hinnasto'])) {
			foreach($this->error['shipping_smartpost_hinnasto'] as $key=>$hinnasto){
			   	  $data['shipping_smartpost_hinnasto'][$key]['error'] = $this->language->get('error_decimale_point');
			}
		}

		$this->load->model('localisation/tax_class');

		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		if (isset($this->request->post['shipping_smartpost_geo_zone_id'])) {
			$data['shipping_smartpost_geo_zone_id'] = $this->request->post['shipping_smartpost_geo_zone_id'];
		} else {
			$data['shipping_smartpost_geo_zone_id'] = $this->config->get('shipping_smartpost_geo_zone_id');
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

		$this->response->setOutput($this->load->view('extension/shipping/smartpost', $data));
	}

	public function install(){

        // Hinnastot
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`, `code`, `key`, `value`, `serialized`) VALUES
        (0, 'shipping_smartpost', 'shipping_smartpost_hinnasto', '[{\"kg\":\"1\",\"price\":\"5.20\"},{\"kg\":\"3\",\"price\":\"6.50\"},{\"kg\":\"5\",\"price\":\"9.80\"}]', 1)");
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/shipping/smartpost')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if($this->request->post['shipping_smartpost_hinnasto']){
			foreach($this->request->post['shipping_smartpost_hinnasto'] as $key=>$hinnasto){
			   if(strpos($hinnasto['price'],',')){
			      $this->error['warning'] = $this->language->get('error_warning');
			   	  $this->error['shipping_smartpost_hinnasto'][$key]['error'] = $this->language->get('error_decimale_point');
			   }
			}
		}

		return !$this->error;
	}
}