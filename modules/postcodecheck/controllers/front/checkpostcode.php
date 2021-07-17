<?php
class postcodecheckcheckpostcodeModuleFrontController extends ModuleFrontController
{

    public static function getSellerIdByProductId($id_product)
    {
        $sql = 'Select id_seller from ' . _DB_PREFIX_ . 'kb_mp_seller_product where id_product = ' . (int)$id_product;

        return (int)DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
    }

    public static function getdistance($buyer_postcode_trimmed,$seller_postcode)
    {
        //get buyer info
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAFw8eGYOlrJ8WF7iBvD20syHjdUFCm2B4&address='.$buyer_postcode,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $buyerresponse = curl_exec($curl);

        curl_close($curl);

        $geocodebuyerinfo = json_decode($buyerresponse);
        if($geocodebuyerinfo->status == 'OK') {
            $btown = $geocodebuyerinfo->results[0]->address_components[2]->long_name;
            $blat = $geocodebuyerinfo->results[0]->geometry->location->lat;
            $blon = $geocodebuyerinfo->results[0]->geometry->location->lng;
        }

        //   echo "<br><br>The town of buyer is: ".$btown;
        //   echo "<br>The latitude of buyer is: ".$blat;
        //   echo "<br>The longitude of buyer is: ".$blon;

        // now seller
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAFw8eGYOlrJ8WF7iBvD20syHjdUFCm2B4&address='.$seller_postcode,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $sellerresponse = curl_exec($curl);

        curl_close($curl);

        $geocodesellerinfo = json_decode($sellerresponse);
        if($geocodesellerinfo->status == 'OK') {
            $stown = $geocodesellerinfo->results[0]->address_components[2]->long_name;
            $slat = $geocodesellerinfo->results[0]->geometry->location->lat;
            $slon = $geocodesellerinfo->results[0]->geometry->location->lng;
        }

        //   echo "<br><br>The town of seller is: ".$stown;
        //   echo "<br>The latitude of seller is: ".$slat;
        //   echo "<br>The longitude of seller is: ".$slon;

        //And now compare!!!

        $curl = curl_init();

        $curlurl = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$blat.','.$blon.'&destinations='.$slat.','.$slon.'&key=AIzaSyAFw8eGYOlrJ8WF7iBvD20syHjdUFCm2B4';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $curlurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

        $response = curl_exec($curl);

        curl_close($curl);

        //var_dump($response);

        $distanceinfo = json_decode($response);
        $elements = $distanceinfo->rows[0]->elements;
        $distance = $elements[0]->distance->value;
        $miles = $elements[0]->distance->text;

        //translating to miles?
        $distance = $distance * 0.000621371192;

        // return "bye";
        return $distance;

    //   echo "<br>The distance in miles: ".$distance;
    }

    public static function checkdelivery()
    // public function initContent()
    {
        // parent::initContent();
        //  $this->setTemplate('module:postcodecheck/views/templates/front/postcodecheck.tpl');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //get required information
            // $sellerid = $_POST['seller_id1'];
            $buyer_postcode_full = $_POST['postcode'];
            $product_id = $_POST["product_id"];

            //get seller name, postcode and postcode prefix
            $db = \Db::getInstance();
            $sql = "select `id_customer`, `id_seller`, `id_field`, `value` from `psrn_kb_mp_custom_field_seller_mapping` where `id_field` IN (1,15,16,20) AND `id_seller` = (select `id_seller` from `psrn_kb_mp_seller_product` where `id_product` = ".$product_id.")";
            $result = $db->executeS($sql);

            foreach ($result as $field){

                $id_field = $field['id_field'];

                switch($id_field) {
                    case '1':
                        $seller_name = $field['value'];
                        break;
                    case '15':
                        $seller_postcode = $field['value'];
                        $seller_postcode = str_replace(' ', '', $seller_postcode);
                        break;
                    case '16':
                        $seller_radius = $field['value'];
                        break;
                    case '20':
                        $seller_prefix_postcode_list = $field['value'];
                        break;
                    }

            }

            //get carrier id
            $sql_carrier = " select `id_carrier_reference` from `psrn_product_carrier` where `id_product` = ".$product_id;
            $carrier_query_result = $db->executeS($sql_carrier);
            $carrier_id = $carrier_query_result[0]["id_carrier_reference"];

            //transformation of information
            $buyer_postcode_trimmed = str_replace(' ', '+', $_POST['postcode']);
            //cut string to compare
            $buyer_postcode_prefix = substr($buyer_postcode_full, 0, strrpos($buyer_postcode_full, ' '));
            //default the string comes with <p>seller;postcode;here</p> so to remove the <p> & </p>
            $postcode_substracted = substr($seller_prefix_postcode_list, 3, -4);
            //convert all postcode to lower case
            $buyer_postcode_prefix_lower = strtolower($buyer_postcode_prefix);
            $seller_postcodeprefix_array_lowercase = array_map('strtolower', explode(';', $postcode_substracted));


            // $distance = getdistance($buyer_postcode_trimmed,$seller_postcode);
            // // return "bye";
            // return $distance;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAFw8eGYOlrJ8WF7iBvD20syHjdUFCm2B4&address='.$buyer_postcode_trimmed,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $buyerresponse = curl_exec($curl);
            // return 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAFw8eGYOlrJ8WF7iBvD20syHjdUFCm2B4&address='.$buyer_postcode_trimmed;

            curl_close($curl);

            $geocodebuyerinfo = json_decode($buyerresponse);
            if($geocodebuyerinfo->status == 'OK') {
                $btown = $geocodebuyerinfo->results[0]->address_components[2]->long_name;
                $blat = $geocodebuyerinfo->results[0]->geometry->location->lat;
                $blon = $geocodebuyerinfo->results[0]->geometry->location->lng;
            }


            // now seller
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAFw8eGYOlrJ8WF7iBvD20syHjdUFCm2B4&address='.$seller_postcode,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $sellerresponse = curl_exec($curl);

            curl_close($curl);

            $geocodesellerinfo = json_decode($sellerresponse);
            if($geocodesellerinfo->status == 'OK') {
                $stown = $geocodesellerinfo->results[0]->address_components[2]->long_name;
                $slat = $geocodesellerinfo->results[0]->geometry->location->lat;
                $slon = $geocodesellerinfo->results[0]->geometry->location->lng;
            }

                    //And now compare!!!

            $curl = curl_init();

            $curlurl = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$blat.','.$blon.'&destinations='.$slat.','.$slon.'&key=AIzaSyAFw8eGYOlrJ8WF7iBvD20syHjdUFCm2B4';

            curl_setopt_array($curl, array(
                CURLOPT_URL => $curlurl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                ));

            $response = curl_exec($curl);

            curl_close($curl);

            $distanceinfo = json_decode($response);
            $elements = $distanceinfo->rows[0]->elements;
            $distance = $elements[0]->distance->value;
            $miles = $elements[0]->distance->text;
            $distance_text = $elements[0]->distance->text; //in miles

            //translating to miles?
            // $distance = $distance * 0.000621371192;

            //get carrier_id for default shipping of seller
            $carrier_name_query = " select `name` from `psrn_carrier` where `id_carrier` = ".$carrier_id;
            $carrier_name_result = $db->executeS($carrier_name_query);
            $carrier_name = $carrier_name_result[0]["name"];
            // // $carrier_name_cut = substr($carrier_name_cut,0);
            // return $carrier_name;

            //logic
            // if ($carrier_id ==43) {
            //     return "collection only";
            // }
            // else {
                $returnObj = new stdClass;
                if (in_array($buyer_postcode_prefix_lower, $seller_postcodeprefix_array_lowercase)) {
                  $returnObj->id = 1;
                  $returnObj->msg = "This product can be delivered to your address.";
                  $returnJSON = json_encode($returnObj);
                  return $returnJSON;
                }
                else {
                  $returnObj->id = 2;
                  $returnObj->msg = "This product is not available for delivery at that address. Collection available at $distance_text miles.";
                  $returnJSON = json_encode($returnObj);
                  return $returnJSON;
                }
            // }

            //the comparison itself

            // if ($distance > $seller_radius) {

            //     $var = "No sorry, I can only cover ".$seller_radius." miles and the distance is ".$distance.". miles... collect pls?!";
            //     $msg = "Yes, we are able to delivery to".$buyer_postcode;

            // } else {
            //     $var = "Why aye man, ".$distance." miles is within my ".$seller_radius." miles radius.";
            //     $msg = "sorry, we aren't able to delivery this item to".$buyer_postcode.". Only collection available.";
            // }

            // return [$seller_postcode, $distance, $msg];

               //$var_to_assign = Tools::htmlentitiesUTF8($var);
            //    echo "<br><br>So can ".$seller_name." ship to ".$buyer_postcode."?!".$theactionhere;

            //    $this->context->smarty->assign(
            //     [
            //         'my_module_name' => Configuration::get('postcodecheck'),
            //         'my_module_link' => $this->context->link->getModuleLink('postcodecheck', 'display'),
            //         'my_module_message' => $this->l('This is a simple text message') // Do not forget to enclose your strings in the l() translation method
            //     ]
            //     );

            //var_dump($result[0]['value']);

            // $sql = new DbQuery();
            // $sql->select('id_customer, id_seller, id_field, value');
            // $sql->from('kb_mp_custom_field_seller_mapping');
            // $sql->where('id_field in (1,15,16) AND id_seller='.$sellerid);
            // var_dump($sql);
            // return Db::getInstance()->executeS($sql);
            //echo "<br>End of file :)";
        }
    }

    public function postProcess() {
        $deliveryCheckRes = $this->checkdelivery();
        $this->ajaxDie(json_encode([
            // "postcode" => "hello!"
            "postcode" => $deliveryCheckRes
            // "postcode" => $_POST["postcode"]
        ]));
    }
}
