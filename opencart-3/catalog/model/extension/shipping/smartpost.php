          <?php
class ModelExtensionShippingSmartPost extends Model {
	function getQuote($address) {
		$this->load->language('extension/shipping/smartpost');

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('shipping_smartpost_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if (!$this->config->get('shipping_smartpost_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}

		$quote_data = array();
 
		$weight = $this->cart->getWeight();
		if($weight > 5){
			$status = false;
		}

         if ($status) {
         	if($this->config->get('shipping_smartpost_top')){
         		$top = $this->config->get('shipping_smartpost_top');
         	} else {
         		$top = 5;
         	}
         $products = $this->cart->getProducts();
  
         $total = 0;
		foreach($products as $product){
           $total += $product['total'];
           if($this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id')) > 55){
             $status = false;
           }
		}

        if($address['iso_code_2'] == 'FI'){

          $cost = 0;
          $cost = $this->cost($weight);
          $rahtivapaa = "";
          $ale = "";

         if($total  >= $this->config->get('shipping_smartpost_cargo_sum')){
              if($this->config->get('shipping_smartpost_free_cargo')){
                  $cost = 0;
                  $koti = 0;
                  $rahtivapaa = $this->language->get('text_free_cargo');
              }elseif($this->config->get('shipping_smartpost_discount_cargo') && $this->config->get('shipping_smartpost_discount_cargo_percent')){
                  $summa = ($cost/100)*$this->config->get('shipping_smartpost_discount_cargo_percent');
                  $cost = round($cost-$summa,2);
                  $koti = 5;
                  $ale = '(' . $this->language->get('text_discount') . ' ' . $this->config->get('shipping_smartpost_discount_cargo_percent') . '%) ';
              }
         }

         if($status){

				$url = 'https://locationservice.posti.com/location?&types=SMARTPOST&types=LOCKER&locationZipCode=' . $address['postcode'] .'&top=' . $top;

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);

				$result = curl_exec($ch);

               if(curl_exec($ch) === false)
               {
                   echo '<pre>' . $this->language->get('text_curl_error') . ': ' . curl_error($ch) . '</pre>';
               }
				curl_close($ch);

          $response = json_decode($result);

               foreach($response->locations as $place){

						$title = $place->publicName->fi . ' ' . $place->address->fi->address . ', ' . $place->address->fi->postalCode . ' ' . $place->address->fi->postalCodeName;

						$quote_data[$place->pupCode] = array(
							'code'         => 'smartpost.' . $place->pupCode,
							'title'        => $rahtivapaa.$ale . $title,
							'cost'         => $cost,           
							'tax_class_id' => $this->config->get('shipping_smartpost_tax_class_id'), 
							'text'         => $this->currency->format($this->tax->calculate($cost, $this->config->get('shipping_smartpost_tax_class_id'), $this->config->get('config_tax')), $this->session->data['currency'])
						);
                }
           }
      }
    }

		$method_data = array();

		if ($quote_data) {

			$method_data = array(
				'code'       => 'smartpost',
				'title'      => $this->language->get('text_title'),
				'quote'      => $quote_data,
				'sort_order' => $this->config->get('shipping_smartpost_sort_order'),
				'error'      => false
			);
		}
		return $method_data;
	}

	protected function length_convertion($length, $length_class_id){
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "length_class_description` WHERE length_class_id = '" . $length_class_id . "'");

		$unit = $query->row['unit'];
		if($unit == 'cm'){
			$length = $length/100;
		}
		if($unit == 'mm'){
			$length = $length/1000;
		}
		return $length;
	}

	protected function cost($weight){
		    $hinnasto = $this->config->get('shipping_smartpost_hinnasto');
		    foreach($hinnasto as $result){
			    if($weight <= $result['kg']){
				    return $result['price'];
			    }
		    }
	}
}
