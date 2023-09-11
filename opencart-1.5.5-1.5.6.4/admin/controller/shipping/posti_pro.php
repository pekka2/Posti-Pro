<?php
class ControllerShippingPostiPro extends Controller {
	private $error = array();

	public function index() {
		$this->data = array();
		$this->data = array_merge($this->data,$this->load->language('shipping/posti_pro'));

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('posti_pro', $this->request->post);

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
			'href' => $this->url->link('shipping/posti_pro', 'token=' . $this->session->data['token'], true)
		);

		$this->data['action'] = $this->url->link('shipping/posti_pro', 'token=' . $this->session->data['token'], true);
		$this->data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'] . '&type=shipping', true);


		if (isset($this->request->post['posti_pro_status'])) {
			$this->data['posti_pro_status'] = $this->request->post['posti_pro_status'];
		} else {
			$this->data['posti_pro_status'] = $this->config->get('posti_pro_status');
		}

		if (isset($this->request->post['posti_pro_kotijakelu_status'])) {
			$this->data['posti_pro_kotijakelu_status'] = $this->request->post['posti_pro_kotijakelu_status'];
		} else {
			$this->data['posti_pro_kotijakelu_status'] = $this->config->get('posti_pro_kotijakelu_status');
		}

		if (isset($this->request->post['posti_pro_kotijakelu_price'])) {
			$this->data['posti_pro_kotijakelu_price'] = $this->request->post['posti_pro_kotijakelu_price'];
		} else {
			$this->data['posti_pro_kotijakelu_price'] = $this->config->get('posti_pro_kotijakelu_price');
		}

		if (isset($this->request->post['posti_pro_top'])) {
			$this->data['posti_pro_top'] = $this->request->post['posti_pro_top'];
		} else {
			$this->data['posti_pro_top'] = $this->config->get('posti_pro_top');
		}

		if (isset($this->request->post['posti_pro_sort_order'])) {
			$this->data['posti_pro_sort_order'] = $this->request->post['posti_pro_sort_order'];
		} else {
			$this->data['posti_pro_sort_order'] = $this->config->get('posti_pro_sort_order');
		}

		if (isset($this->request->post['posti_pro_weight_class_id'])) {
			$this->data['posti_pro_weight_class_id'] = $this->request->post['posti_pro_weight_class_id'];
		} else {
			$this->data['posti_pro_weight_class_id'] = $this->config->get('posti_pro_weight_class_id');
		}

		if (isset($this->request->post['posti_pro_length_class_id'])) {
			$this->data['posti_pro_length_class_id'] = $this->request->post['posti_pro_length_class_id'];
		} else {
			$this->data['posti_pro_length_class_id'] = $this->config->get('posti_pro_length_class_id');
		}

		if (isset($this->request->post['posti_pro_tax_class_id'])) {
			$this->data['posti_pro_tax_class_id'] = $this->request->post['posti_pro_tax_class_id'];
		} else {
			$this->data['posti_pro_tax_class_id'] = $this->config->get('posti_pro_tax_class_id');
		}

		if (isset($this->request->post['posti_pro_free_cargo'])) {
			$this->data['posti_pro_free_cargo'] = $this->request->post['posti_pro_free_cargo'];
		} else {
			$this->data['posti_pro_free_cargo'] = $this->config->get('posti_pro_free_cargo');
		}

		if (isset($this->request->post['posti_pro_discount_cargo'])) {
			$this->data['posti_pro_discount_cargo'] = $this->request->post['posti_pro_discount_cargo'];
		} else {
			$this->data['posti_pro_discount_cargo'] = $this->config->get('posti_pro_discount_cargo');
		}

		if (isset($this->request->post['posti_pro_cargo_sum'])) {
			$this->data['posti_pro_cargo_sum'] = $this->request->post['posti_pro_cargo_sum'];
		} else {
			$this->data['posti_pro_cargo_sum'] = $this->config->get('posti_pro_cargo_sum');
		}

		if (isset($this->request->post['posti_pro_discount_cargo_percent'])) {
			$this->data['posti_pro_discount_cargo_percent'] = $this->request->post['posti_pro_discount_cargo_percent'];
		} else {
			$this->data['posti_pro_discount_cargo_percent'] = $this->config->get('posti_pro_discount_cargo_percent');
		}

		if (isset($this->request->post['posti_pro_discount_foreign_countries'])) {
			$this->data['posti_pro_discount_foreign_countries'] = $this->request->post['posti_pro_discount_foreign_countries'];
		} else {
			$this->data['posti_pro_discount_foreign_countries'] = $this->config->get('posti_pro_discount_foreign_countries');
		}

		if (isset($this->request->post['posti_pro_cargo_foreign_countries_sum'])) {
			$this->data['posti_pro_cargo_foreign_countries_sum'] = $this->request->post['posti_pro_cargo_foreign_countries_sum'];
		} else {
			$this->data['posti_pro_cargo_foreign_countries_sum'] = $this->config->get('posti_pro_cargo_foreign_countries_sum');
		}

		if (isset($this->request->post['posti_pro_discount_foreign_countries_percent'])) {
			$this->data['posti_pro_discount_foreign_countries_percent'] = $this->request->post['posti_pro_discount_foreign_countries_percent'];
		} else {
			$this->data['posti_pro_discount_foreign_countries_percent'] = $this->config->get('posti_pro_discount_foreign_countries_percent');
		}

		if (isset($this->request->post['posti_pro_hinnasto'])) {
			$this->data['posti_pro_hinnasto'] = $this->request->post['posti_pro_hinnasto'];
		} else {
			$this->data['posti_pro_hinnasto'] = $this->config->get('posti_pro_hinnasto');
		}

		if (isset($this->request->post['posti_pro_hinnasto'])) {
			$this->data['posti_pro_hinnasto'] = $this->request->post['posti_pro_hinnasto'];
		} else {
			$this->data['posti_pro_hinnasto'] = $this->config->get('posti_pro_hinnasto');
		}

		if (isset($this->request->post['posti_pro_hinnasto_countrygroup_1'])) {
			$this->data['posti_pro_hinnasto_countrygroup_1'] = $this->request->post['posti_pro_hinnasto_countrygroup_1'];
		} else {
			$this->data['posti_pro_hinnasto_countrygroup_1'] = $this->config->get('posti_pro_hinnasto_countrygroup_1');
		}

		if (isset($this->request->post['posti_pro_hinnasto_countrygroup_2'])) {
			$this->data['posti_pro_hinnasto_countrygroup_2'] = $this->request->post['posti_pro_hinnasto_countrygroup_2'];
		} else {
			$this->data['posti_pro_hinnasto_countrygroup_2'] = $this->config->get('posti_pro_hinnasto_countrygroup_2');
		}

		if (isset($this->request->post['posti_pro_hinnasto_countrygroup_3'])) {
			$this->data['posti_pro_hinnasto_countrygroup_3'] = $this->request->post['posti_pro_hinnasto_countrygroup_3'];
		} else {
			$this->data['posti_pro_hinnasto_countrygroup_3'] = $this->config->get('posti_pro_hinnasto_countrygroup_3');
		}

		if (isset($this->request->post['posti_pro_hinnasto_countrygroup_4'])) {
			$this->data['posti_pro_hinnasto_countrygroup_4'] = $this->request->post['posti_pro_hinnasto_countrygroup_4'];
		} else {
			$this->data['posti_pro_hinnasto_countrygroup_4'] = $this->config->get('posti_pro_hinnasto_countrygroup_4');
		}


		if (isset($this->error['posti_pro_hinnasto'])) {
			foreach($this->error['posti_pro_hinnasto'] as $key=>$hinnasto){
			   	  $this->data['posti_pro_hinnasto'][$key]['error'] = $this->language->get('error_decimale_point');
			}
		}

		if (isset($this->error['posti_pro_hinnasto_countrygroup_1'])) {
			foreach($this->error['posti_pro_hinnasto_countrygroup_1'] as $key=>$hinnasto){
			   	  $this->data['posti_pro_hinnasto_countrygroup_1'][$key]['error'] = $this->language->get('error_decimale_point');
			}
		}

		if (isset($this->error['posti_pro_hinnasto_countrygroup_2'])) {
			foreach($this->error['posti_pro_hinnasto_countrygroup_2'] as $key=>$hinnasto){
			   	  $this->data['posti_pro_hinnasto_countrygroup_2'][$key]['error'] = $this->language->get('error_decimale_point');
			}
		}

		if (isset($this->error['posti_pro_hinnasto_countrygroup_3'])) {
			foreach($this->error['posti_pro_hinnasto_countrygroup_3'] as $key=>$hinnasto){
			   	  $this->data['posti_pro_hinnasto_countrygroup_3'][$key]['error'] = $this->language->get('error_decimale_point');
			}
		}

		if (isset($this->error['posti_pro_hinnasto_countrygroup_4'])) {
			foreach($this->error['posti_pro_hinnasto_countrygroup_4'] as $key=>$hinnasto){
			   	  $this->data['posti_pro_hinnasto_countrygroup_4'][$key]['error'] = $this->language->get('error_decimale_point');
			}
		}

		$this->load->model('localisation/tax_class');

		$this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		if (isset($this->request->post['posti_pro_geo_zone_id'])) {
			$this->data['posti_pro_geo_zone_id'] = $this->request->post['posti_pro_geo_zone_id'];
		} else {
			$this->data['posti_pro_geo_zone_id'] = $this->config->get('posti_pro_geo_zone_id');
		}

		$this->load->model('localisation/weight_class');
		$this->load->model('localisation/length_class');

		$this->data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();
		$this->data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();

		$this->load->model('localisation/geo_zone');

		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		$this->template = 'shipping/posti_pro.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);


		$this->response->setOutput($this->render());
	}

	public function install(){

  	    $schema = $this->db->query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '" . DB_DATABASE . "' AND
  	                                                                               TABLE_NAME = '" . DB_PREFIX . "country' AND
		                                                                           COLUMN_NAME = 'group'");

        if(!$schema->num_rows){
            $this->db->query("ALTER TABLE `" . DB_PREFIX . "country` ADD `group` INT(3) AFTER `iso_code_2`");
         }
  
         // group 1
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '1' WHERE `iso_code_2` = 'BE'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '1' WHERE `iso_code_2` = 'LU'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '1' WHERE `iso_code_2` = 'DK'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '1' WHERE `iso_code_2` = 'SE'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '1' WHERE `iso_code_2` = 'NL'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '1' WHERE `iso_code_2` = 'EE'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '1' WHERE `iso_code_2` = 'DE'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '1' WHERE `iso_code_2` = 'LV'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '1' WHERE `iso_code_2` = 'LT'");
         // group 2
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'AT'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'BG'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'HR'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'CY'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'FR'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'GR'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'IS'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'HU'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'IE'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'IT'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'MT'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'MC'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'PL'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'PT'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'RO'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'SK'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'SI'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'ES'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '2' WHERE `iso_code_2` = 'GB'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'JE'");
         // group 3
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'AL'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'DZ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'AD'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'FO'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'CA'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'BY'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'GI'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'GL'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'IR'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'IQ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'IL'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'JO'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'KW'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'LB'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'MK'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'NO'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'MD'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'RU'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'SA'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'CH'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'TR'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'US'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'VA'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'RS'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'ME'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'IC'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'XK'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'IM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '3' WHERE `iso_code_2` = 'GG'");
         // group 4
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'AO'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'AI'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'AG'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'AR'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'AM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'AU'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'AF'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'AZ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BS'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BH'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BD'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BB'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BZ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BJ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BT'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BO'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BA'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BW'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BN'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BR'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BF'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BI'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'KH'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'CM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'CV'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'KY'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TD'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'CL'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'CN'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'CO'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'CG'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'CK'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'CR'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'CU'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'CZ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'DJ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'DM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'DO'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TL'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'EC'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'EG'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'GQ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'ER'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'ET'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'FK'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'FJ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'GF'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'PF'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'GA'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'GM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'GE'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'GH'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'GD'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'GP'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'GU'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'GT'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'GN'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'GW'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'GY'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'HT'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'HN'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'HK'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'IN'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'ID'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'JM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'JP'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'KZ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'KE'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'KI'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'KP'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'KG'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'LA'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'LS'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'LR'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'LY'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'LI'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MO'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MG'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MW'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MY'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MV'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'ML'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MH'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MQ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MR'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MU'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'YT'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MX'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'FM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MN'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MS'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MA'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MZ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'NA'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'NR'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'NP'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'AN'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'NC'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'NZ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'NI'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'NE'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'NG'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'NU'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'NF'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MP'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'OM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'PK'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'PW'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'PA'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'PG'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'PY'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'PE'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'PH'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'PN'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'PR'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'QA'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'RE'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'RW'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'KN'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'LC'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'VC'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'WS'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'SM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'ST'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'SN'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'SC'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'SL'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'SB'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'SO'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'ZA'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'GS'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'LK'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'SH'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'PM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'SD'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'SR'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'SJ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'SZ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TW'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TJ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TZ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TH'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TG'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TK'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TO'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TT'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TN'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TC'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TV'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'UA'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'AE'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'UM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'UY'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'UZ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'VU'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'VE'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'VN'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'VG'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'VI'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'WF'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'EH'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'YE'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'CD'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'ZM'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'ZW'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BQ'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'CW'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'PS'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'SS'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'BL'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'MF'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'AC'");
        $this->db->query("UPDATE `" . DB_PREFIX . "country` SET `group` = '4' WHERE `iso_code_2` = 'TA'");

        // Hinnastot
       $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`, `group`, `key`, `value`, `serialized`) VALUES
          ('0', 
           'posti_pro', 
           'posti_pro_hinnasto', 
           '" . $this->db->escape('a:9:{i:0;a:2:{s:2:"kg";s:1:"2";s:5:"price";s:4:"5.90";}i:1;a:2:{s:2:"kg";s:1:"4";s:5:"price";s:4:"9.90";}i:2;a:2:{s:2:"kg";s:2:"10";s:5:"price";s:5:"11.90";}i:3;a:2:{s:2:"kg";s:2:"15";s:5:"price";s:5:"14.90";}i:4;a:2:{s:2:"kg";s:2:"35";s:5:"price";s:5:"20.90";}i:5;a:2:{s:2:"kg";s:2:"45";s:5:"price";s:2:"22";}i:6;a:2:{s:2:"kg";s:2:"53";s:5:"price";s:5:"25.90";}i:7;a:2:{s:2:"kg";s:2:"60";s:5:"price";s:2:"29";}i:8;a:2:{s:2:"kg";s:2:"70";s:5:"price";s:2:"35";}}') ."',
           '1'),
          ('0', 
           'posti_pro',
           'posti_pro_hinnasto_countrygroup_1',
           '" . $this->db->escape('a:5:{i:0;a:2:{s:2:"kg";s:1:"1";s:5:"price";s:1:"7";}i:1;a:2:{s:2:"kg";s:1:"2";s:5:"price";s:2:"21";}i:2;a:2:{s:2:"kg";s:1:"6";s:5:"price";s:2:"27";}i:3;a:2:{s:2:"kg";s:1:"9";s:5:"price";s:2:"32";}i:4;a:2:{s:2:"kg";s:2:"30";s:5:"price";s:2:"70";}}') ."',
           '1'),
          ('0',
           'posti_pro',
           'posti_pro_hinnasto_countrygroup_2', '" . $this->db->escape('a:5:{i:0;a:2:{s:2:"kg";s:1:"1";s:5:"price";s:1:"7";}i:1;a:2:{s:2:"kg";s:1:"3";s:5:"price";s:2:"11";}i:2;a:2:{s:2:"kg";s:1:"5";s:5:"price";s:2:"22";}i:3;a:2:{s:2:"kg";s:1:"7";s:5:"price";s:2:"29";}i:4;a:2:{s:2:"kg";s:1:"8";s:5:"price";s:2:"39";}}') ."',
           '1'),
          ('0',
           'posti_pro',
           'posti_pro_hinnasto_countrygroup_3', '" . $this->db->escape('a:4:{i:0;a:2:{s:2:"kg";s:1:"2";s:5:"price";s:2:"12";}i:1;a:2:{s:2:"kg";s:1:"3";s:5:"price";s:2:"19";}i:2;a:2:{s:2:"kg";s:1:"5";s:5:"price";s:2:"41";}i:3;a:2:{s:2:"kg";s:1:"6";s:5:"price";s:2:"55";}}') ."',
           '1'),
          ('0',
           'posti_pro',
           'posti_pro_hinnasto_countrygroup_4', '" . $this->db->escape('a:4:{i:0;a:2:{s:2:"kg";s:1:"1";s:5:"price";s:2:"17";}i:1;a:2:{s:2:"kg";s:1:"3";s:5:"price";s:2:"27";}i:2;a:2:{s:2:"kg";s:1:"4";s:5:"price";s:2:"41";}i:3;a:2:{s:2:"kg";s:1:"5";s:5:"price";s:2:"52";}}') ."',
           '1')");

	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'shipping/posti_pro')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if(isset($this->request->post['posti_pro_hinnasto'])){
			foreach($this->request->post['posti_pro_hinnasto'] as $key=>$hinnasto){
			   if(strpos($hinnasto['price'],',')){
			      $this->error['warning'] = $this->language->get('error_warning');
			   	  $this->error['posti_pro_hinnasto'][$key]['error'] = $this->language->get('error_decimale_point');
			   }
			}
		}
		if(isset($this->request->post['posti_pro_hinnasto_countrygroup_1'])){
			foreach($this->request->post['posti_pro_hinnasto_countrygroup_1'] as $key=>$hinnasto){
			   if(strpos($hinnasto['price'],',')){
			      $this->error['warning'] = $this->language->get('error_warning');
			   	  $this->error['posti_pro_hinnasto_countrygroup_1'][$key]['error'] = $this->language->get('error_decimale_point');
			   }
			}
		}
		if(isset($this->request->post['posti_pro_hinnasto_countrygroup_2'])){
			foreach($this->request->post['posti_pro_hinnasto_countrygroup_2'] as $key=>$hinnasto){
			   if(strpos($hinnasto['price'],',')){
			      $this->error['warning'] = $this->language->get('error_warning');
			   	  $this->error['posti_pro_hinnasto_countrygroup_2'][$key]['error'] = $this->language->get('error_decimale_point');
			   }
			}
		}
		if(isset($this->request->post['posti_pro_hinnasto_countrygroup_3'])){
			foreach($this->request->post['posti_pro_hinnasto_countrygroup_3'] as $key=>$hinnasto){
			   if(strpos($hinnasto['price'],',')){
			      $this->error['warning'] = $this->language->get('error_warning');
			   	  $this->error['posti_pro_hinnasto_countrygroup_3'][$key]['error'] = $this->language->get('error_decimale_point');
			   }
			}
		}
		if(isset($this->request->post['posti_pro_hinnasto_countrygroup_4'])){
			foreach($this->request->post['posti_pro_hinnasto_countrygroup_4'] as $key=>$hinnasto){
			   if(strpos($hinnasto['price'],',')){
			      $this->error['warning'] = $this->language->get('error_warning');
			   	  $this->error['posti_pro_hinnasto_countrygroup_4'][$key]['error'] = $this->language->get('error_decimale_point');
			   }
			}
		}

		return !$this->error;
	}
}
