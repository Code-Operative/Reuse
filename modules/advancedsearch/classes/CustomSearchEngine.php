<?php

use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchProviderInterface;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchResult;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

class CustomSearchEngine implements ProductSearchProviderInterface
{

    protected $products;
    protected $string;

    public function __construct($params, $string)
    {
        if ($params != null && $string !== false) {
            $this->string = $string;
            $product = [];
            foreach ($params as $param) {
                $product[] = $param;
            }
            $this->products = $product;
        } else {
            $this->products = [];
            $this->string = null;
        }
    }

    /**
     * @param ProductSearchContext $context
     * @param ProductSearchQuery $query
     * @return ProductSearchResult
     * @throws PrestaShopException
     */
    public function runQuery(ProductSearchContext $context, ProductSearchQuery $query)
    {

        $products = [];
        $count = 0;
        
        //$queryString = Tools::replaceAccentedChars(urldecode($this->string));

        if ($this->string != null){
            $query->setSearchString($this->string);
        }
        
        if (($string = $query->getSearchString())) {
            $queryString = Tools::replaceAccentedChars(urldecode($string));

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

            Hook::exec('actionSearch', [ 
                'searched_query' => $queryString,
                'total' => $count, 
                // deprecated since 1.7.x
                'expr' => $queryString,
            ]);
        
        } elseif (($tag = $query->getSearchTag())) {
            $queryString = urldecode($tag);

            $products = Search::searchTag(
                $context->getIdLang(),
                $queryString,
                false,
                $query->getPage(),
                $query->getResultsPerPage(),
                $query->getSortOrder()->toLegacyOrderBy(true),
                $query->getSortOrder()->toLegacyOrderWay(),
                false,
                null
            );

            $count = Search::searchTag(
                $context->getIdLang(),
                $queryString,
                true,
                $query->getPage(),
                $query->getResultsPerPage(),
                $query->getSortOrder()->toLegacyOrderBy(true),
                $query->getSortOrder()->toLegacyOrderWay(),
                false,
                null
            );

            Hook::exec('actionSearch', [
                'searched_query' => $queryString,
                'total' => $count,

                // deprecated since 1.7.x
                'expr' => $queryString,
            ]);
        }

        if (is_null($this->string)){

            $result = new ProductSearchResult();

            if (!empty($products)) {
                $result
                    ->setProducts($products)
                    ->setTotalProductsCount($count);

               // $result->setAvailableSortOrders(
               //     $this->sortOrderFactory->getDefaultSortOrders()
               // );
            }
        } else {

            $prods = [];
            foreach ($products as $product) {
                $prods[] = $product["id_product"];
            }

            $prodd = [];
            foreach ($this->products as $product) {
                $prodd[] = $product["id_product"];
            }

            if(empty($this->string)){
                $sellerprods = $prodd;
            }
            else{
                $sellerprods = array_intersect($prods,$prodd);
            }

            $array_prods = [];
            foreach ($sellerprods as $prod) {
                $aprod['id_product'] = $prod;
                $array_prods[] = $aprod; 
            }

            $new_products = new ProductSearchResult();
            if (!empty($array_prods)) {
                $new_products->setProducts($array_prods);
            }

            $result = $new_products;
        }

        return $result;
    }
}