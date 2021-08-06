<?php

class AdvancedSearchCollection extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->context->smarty->assign(array(
            'postcode' => '',
            'idSeller' => '',
            'idCustomer' => '',
        ));
        $this->setTemplate('collection.tpl');
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
        $url = getUrlMaps($postcode, $address, $key);
        //llamo al api
        return [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];
    }

    public function getURLMap($postcode, $address, $key):string
    {
        $address= $address.''
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key='.urlencode($key).''
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




}
