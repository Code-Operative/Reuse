<?php
class AdvancedsearchaSearchModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('module:advancedsearch/views/templates/front/display.tpl');
    }

    public function getLatAndLog($postcode, $idSeller, $idCustomer, $key):array
    {
        //busco la direcciòn si existe
        if($idSeller)
        {
            $address = getAdddresSeller($idSeller);
        }elseif(idCustomer){
            $address = getAddresCustomer($idCustomer);
        }

        //armo la url
        //https://maps.googleapis.com/maps/api/geocode/json?address=SW5+0RQ&sensor=false&components=country:UK
        $url = getUrlMaps($postcode, $key);
        //llamo al api
        return [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];
    }

    public function getURLMap($address, $key):string
    {
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key='.urlencode($key);
        return $url;

    }

    public function getAdddresSeller($idSeller):string
    {
        $db = \Db::getInstance();

        //TODO query
        $request = '';
        return $db->executeS($request);
    }

    public function getAddresCustomer($idCustomer):string
    {
        $db = \Db::getInstance();

        //TODO query
        $request = '';
        return $db->executeS($request);
    }

    public function collectionSearch($parameters)
    {
        $customerpostcode = getCustomerPostcode();

        if(uppercase(trim($postcodeform)) == uppercase(trim($customerpostcode))){
            $latYlon = getLatYLonCustomer();
        }
        else{
            $latYlon = calculateLatYLongBuGoogle();
        }

        $sellers = getSellerByDistance($latYLon);

        $products = getProductBySellers($productform,$distanceform,$seller);

        showresult($products);
        
    }

    public function postProcess() {
        //var_dump($_POST);
        //AIzaSyAFw8eGYOlrJ8WF7iBvD20syHjdUFCm2B4
        if(isset($_POST["retrieve"]) && $_POST["retrieve"] == "collection"){
            $this->collectionSearch($_POST);
        }


    }
}
