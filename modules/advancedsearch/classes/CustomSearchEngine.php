<?php

use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchProviderInterface;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchResult;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

class CustomSearchEngine implements ProductSearchProviderInterface{

    protected $products;
    protected $string;

    public function __construct($params,$string)
    {
        if($params != null && $string != false){
            $this->string = $string;
            $product = [];
            foreach($params as $param){
                foreach($param as $prod){
                    $product[] = $prod;
                }
            }
            $this->products = $product;
        }
        else{
            $this->products = [];
        }
    }

    /**
     * @param ProductSearchContext $context
     * @param ProductSearchQuery $query
     * @return ProductSearchResult
     * @throws PrestaShopException
     */
    public function runQuery(ProductSearchContext $context, ProductSearchQuery $query){

        $products = [];
        $count = 0;
        $query->setSearchString($this->string);

        $queryString = Tools::replaceAccentedChars(urldecode($this->string));

        $result = Search::find(
            $context->getIdLang(),
            $queryString,
            $query->getPage(),
            $query->getResultsPerPage(),
            $query->getSortOrder()->toLegacyOrderBy(),
            $query->getSortOrder()->toLegacyOrderWay(),
            false, // ajax, what's the link?
            false, // $use_cookie, ignored anyway
            null
        );


        $products = $result['result'];

        var_dump($products);

        $count = $result['total'];

        Hook::exec('actionSearch', [
            'searched_query' => $queryString,
            'total' => $count,

            // deprecated since 1.7.x
            'expr' => $queryString,
        ]);
        
        $prods = [];
        foreach($products as $product){
            $prds["id_product"] = $product["id_product"];
            $prods[] = $prds;
        }

        $sellerprods = array_intersect($prods,$this->products);

        $new_products = new ProductSearchResult();
        if (!empty($this->products)) {
            $array_list = $sellerprods;
            $new_products->setProducts($array_list);
        }

        return $new_products;
    }
}