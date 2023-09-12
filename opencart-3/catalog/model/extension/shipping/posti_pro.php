 <?php
class ModelExtensionShippingPostiPro extends Model {
	function getQuote($address) {
		$this->load->language('extension/shipping/posti_pro');

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('shipping_posti_pro_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if (!$this->config->get('shipping_posti_pro_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}
		$quote_data = array();
 
		$weight = $this->cart->getWeight();

       
         if ($status) {

         	if($this->config->get('shipping_posti_pro_top')){
         		$top = $this->config->get('shipping_posti_pro_top');
         	} else {
         		$top = 5;
         	}

        $cost = 0;

        $cost = $this->cost($weight, $address['iso_code_2']);

		$products = $this->cart->getProducts();
  
         $total = 0;

         $ale = '';
         $rahtivapaa = '';

         if($address['iso_code_2'] == 'FI'){
             $cost =  trim($cost);
         }


		foreach($products as $product){
           $total += $product['total'];

           if($product['quantity'] > 1){
          	$product['weight'] = $product['weight']/$product['quantity'];
           }
           
           if($this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id')) > 34.99){
              $status = false;
           }
		}

            
       if($status){
            if($address['iso_code_2'] == 'FI'){

                // Kotiinkuljetus
                if($status && trim($this->config->get('shipping_posti_pro_kotijakelu_status')) > 0){

                    $lisahinta = trim($this->config->get('shipping_posti_pro_kotijakelu_price'));
                    if(!$lisahinta) $lisahinta = 0;

                $summaus = trim($cost+$lisahinta);
                    
         	    $quote_data['posti_pro'] = array(
							'code'         => 'posti_pro.posti_pro',
							'title'        => $this->language->get('text_kotijakelu'),
							'cost'         => trim($summaus),
							'tax_class_id' => $this->config->get('shipping_posti_pro_tax_class_id'),
							'text'         => $this->currency->format($this->tax->calculate(trim($summaus), $this->config->get('shipping_posti_pro_tax_class_id'), $this->config->get('config_tax')), $this->session->data['currency'])
						);

               }

				$url = 'https://locationservice.posti.com/location?&types=POSTOFFICE&types=PICKUPPOINT&locationZipCode=' . $address['postcode'] . '&top=' . $top;

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

                $error = false;

                if($weight > 35){
         	        $error = true;
                }


                if(!$error){
                    if($total  >= $this->config->get('shipping_posti_pro_cargo_sum')){
                        if($this->config->get('shipping_posti_pro_free_cargo')){
                             $cost = 0;
                             $koti = 0;
                             $rahtivapaa = $this->language->get('text_free_cargo');
                        } elseif($this->config->get('shipping_posti_pro_discount_cargo') && $this->config->get('shipping_posti_pro_discount_cargo_percent')){
                             $summa = ($cost/100)*$this->config->get('shipping_posti_pro_discount_cargo_percent');
                             $cost = round($cost-$summa,2);
                             $koti = 5;
                             $ale = '(Alennus ' . $this->config->get('shipping_posti_pro_discount_cargo_percent') . '%)';
                        }
                    }
                    if(!empty($result)){

                        $response = json_decode($result);

                        foreach($response->locations as $place){

						    $title = $place->publicName->fi . ' ' . $place->address->fi->address . ', ' . $place->address->fi->postalCode . ' ' . $place->address->fi->postalCodeName;

						    $quote_data[$place->pupCode] = array(
							    'code'         => 'posti_pro.' . $place->pupCode,
						  	    'title'        => $rahtivapaa.$ale . ' ' . $title,
							    'cost'         => trim($cost),
							    'tax_class_id' => $this->config->get('shipping_posti_pro_tax_class_id'),
							    'text'         => $this->currency->format($this->tax->calculate(trim($cost), $this->config->get('shipping_posti_pro_tax_class_id'), $this->config->get('config_tax')), $this->session->data['currency'])
						    );
                        }
                    }
                } 
            } elseif (!empty($address['iso_code_2'])) {

                if($total  >= $this->config->get('shipping_posti_pro_cargo_foreign_countries_sum')){
                    if($this->config->get('shipping_posti_pro_free_cargo')){
                        $cost = 0;
                        $koti = 0;
                        $rahtivapaa = $this->language->get('text_free_cargo');
                   } elseif($this->config->get('shipping_posti_pro_discount_foreign_countries') && $this->config->get('shipping_posti_pro_discount_foreign_countries_percent')){
                        $summa = ($cost/100)*$this->config->get('shipping_posti_pro_discount_foreign_countries_percent');
                        $cost = round($cost-$summa,2);
                        $koti = 5;
                        $ale = '(Alennus ' . $this->config->get('shipping_posti_pro_discount_foreign_countries_percent') . '%)';
                    }
                }
                    $price = trim($cost[1]);
					$quote_data['world'] = array(
						'code'         => 'posti_pro.world',
						'title'        => $rahtivapaa.$ale . ' ' . $this->language->get('text_to_world') . ' ' . $cost[0],
						'cost'         => $price,
						'tax_class_id' => $this->config->get('shipping_posti_pro_tax_class_id'),
						'text'         => $this->currency->format($this->tax->calculate($price, $this->config->get('shipping_posti_pro_tax_class_id'), $this->config->get('config_tax')), $this->session->data['currency'])
					);
            }
        }
    }

			$method_data = array();

		if ($quote_data) {

			$method_data = array(
				'code'       => 'posti_pro',
				'title'      => $this->language->get('text_title'),
				'quote'      => $quote_data,
				'sort_order' => $this->config->get('shipping_posti_pro_sort_order'),
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

	protected function cost($weight, $iso_code){
		if($iso_code == "FI"){
			$hinnasto = $this->config->get('shipping_posti_pro_hinnasto');
		    foreach($hinnasto as $result){
			    if($weight <= $result['kg']){
				    return $result['price'];
			    }
		    }
		 } elseif ($iso_code !='') {
		 	$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE `iso_code_2` = '" . $iso_code . "'");
		 	if($query->row['group'] > 0){
		 		$group = $query->row['group']; 
		 		$country = array(ucwords(strtolower($query->row['name'])));
		 		if($this->config->get('shipping_posti_pro_hinnasto_countrygroup_' . $group)){
		 			$hinnasto = $this->config->get('shipping_posti_pro_hinnasto_countrygroup_' . $group);
		            foreach($hinnasto as $result){
			            if($weight <= $result['kg']){
			                array_push($country, $result['price']);
				            return $country;
			            }
		            }
		       }
		   }

		}
	}
}
