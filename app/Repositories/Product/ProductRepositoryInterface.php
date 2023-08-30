<?php

namespace App\Repositories\Product;

use App\Repositories\AbstractRepositoryInterface;

interface ProductRepositoryInterface extends AbstractRepositoryInterface
{
    public function show($id);
    public function getArrayNameProduct();
    public function activeProduct($id);
    public function unactiveProduct($id);
    public function saveProductDetail($request, $idProduct, $today);
    public function updateProductDetail($request, $idDetailProduct, $today);
}