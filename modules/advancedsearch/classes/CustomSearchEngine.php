<?php

use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchProviderInterface;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchResult;

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
        $query->setSearchString(true);

//        var_dump($this->string);
        if (($string = $query->getSearchString())) {
            $queryString = Tools::replaceAccentedChars(urldecode($this->string));

            //esta acá el problema.
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
            $count = $result['total'];

            Hook::exec('actionSearch', [ 'searched_query' => $queryString, 'total' => $count, ]);
        }

        $prods = [];
        foreach($products as $product){
            $prds["id_product"] = $product["id_product"];
            $prods[] = $prds;
        }

//        var_dump($products);
//
//        var_dump($this->products);
        $sellerprods = array_intersect($this->products,$prods);

        $new_products = new ProductSearchResult();
        if (!empty($this->products)) {
            $array_list = $sellerprods;
            $new_products->setProducts($array_list);
        }

        return $new_products;
    }
}