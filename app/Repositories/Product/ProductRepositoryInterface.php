<?php

namespace App\Repositories\Product;

use App\Repositories\AbstractRepositoryInterface;

interface ProductRepositoryInterface extends AbstractRepositoryInterface
{
    public function show($id);
    public function getArrayNameProduct();
    public function statusChange($id, $itemStatus);
    public function saveProductDetail($request, $idProduct, $today);
    public function updateProductDetail($request, $idDetailProduct, $today);
}
