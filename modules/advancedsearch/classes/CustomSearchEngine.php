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
    protected $sQuery = false;

    public function __construct($params, $string)
    {

        if ($params != null && $string != false) {
            $this->string = $string;
            $product = [];
            foreach ($params as $param) {
                $product[] = $param;
            }
            $this->products = $product;
        } elseif ($string != false) {
            $this->string = $string;
            $this->sQuery = true;
        } else {
            $this->products = [];
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
        $count = $result['total'];
        Hook::exec('actionSearch', [
            'searched_query' => $queryString,
            'total' => $count,
            // deprecated since 1.7.x
            'expr' => $queryString,
        ]);

        if($this->sQuery) {
            $new_products = new ProductSearchResult();
            $new_products->setProducts($products);
        } else {
            $prods = [];
            foreach ($products as $product) {
                $prods[] = $product["id_product"];
            }

            $prodd = [];
            foreach ($this->products as $product) {
                $prodd[] = $product["id_product"];
            }

            $sellerprods = array_intersect($prods,$prodd);

            $array_prods = [];
            foreach ($sellerprods as $prod) {
                $aprod['id_product'] = $prod;
                $array_prods[] = $aprod;
            }

            $new_products = new ProductSearchResult();
            if (!empty($array_prods)) {
                $new_products->setProducts($array_prods);
            }
        }

        return $new_products;
    }
}