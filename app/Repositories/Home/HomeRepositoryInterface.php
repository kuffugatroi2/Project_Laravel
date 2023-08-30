<?php

namespace App\Repositories\Home;

interface HomeRepositoryInterface
{
    public function getAllItem();
    public function getAllBrand();
    public function getAllCategory();
    public function getAllProduct();
    public function getAllProductByItem($item_id);
    public function getAllProductByBrand($brand_id);
    public function getAllProductByCategory($category_id);
    public function getAllLaptop();
    public function getDetailLaptop($product_id);
    public function search($keywords);
    public function getAllSmartphone();
    public function getAllHeadphone();
}