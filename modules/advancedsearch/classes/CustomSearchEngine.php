<?php

use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchProviderInterface;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchResult;

class CustomSearchEngine implements ProductSearchProviderInterface{

    protected $products;

    public function __construct($params)
    {
        $this->products = $params["products"];
    }

    public function runQuery(ProductSearchContext $context, ProductSearchQuery $query){
        var_dump($this->products);die();
        $new_products = new ProductSearchResult();
        $array_list = array(array('id_product' => 23),array('id_product' => 25));
        $new_products->setProducts($array_list);
        return $new_products;
    }
}