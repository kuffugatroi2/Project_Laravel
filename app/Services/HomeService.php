<?php

namespace App\Services;

use App\Repositories\Home\HomeRepositoryInterface;
use Exception;

class HomeService
{
    protected $homeRepository;

    public function __construct(HomeRepositoryInterface $homeRepository)
    {
        $this->homeRepository = $homeRepository;

    }

    public function getAllItem()
    {
        try {
            $item_type['data'] = $this->homeRepository->getAllItem();
            return [
                'status' => 200,
                'data' => $item_type['data']
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAllBrand()
    {
        try {
            $brand_product['data'] = $this->homeRepository->getAllBrand();
            return [
                'status' => 200,
                'data' => $brand_product['data']
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAllCategory()
    {
        try {
            $cate_product['data'] = $this->homeRepository->getAllCategory();
            return [
                'status' => 200,
                'data' => $cate_product['data']
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAllProduct()
    {
        try {
            $all_product['data'] = $this->homeRepository->getAllProduct();
            return [
                'status' => 200,
                'data' => $all_product['data']
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAllProductByItem($item_id)
    {
        try {
            $all_product_by_item['data'] = $this->homeRepository->getAllProductByItem($item_id);
            return [
                'status' => 200,
                'data' => $all_product_by_item['data']
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAllProductByBrand($brand_id)
    {
        try {
            $all_product_by_brand['data'] = $this->homeRepository->getAllProductByBrand($brand_id);
            return [
                'status' => 200,
                'data' => $all_product_by_brand['data']
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAllProductByCategory($category_id)
    {
        try {
            $all_product_by_category['data'] = $this->homeRepository->getAllProductByCategory($category_id);
            return [
                'status' => 200,
                'data' => $all_product_by_category['data']
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAllLaptop()
    {
        try {
            $all_laptop['data'] = $this->homeRepository->getAllLaptop();
            return [
                'status' => 200,
                'data' => $all_laptop['data']
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getDetailLaptop($product_id)
    {
        try {
            $details['data'] = $this->homeRepository->getDetailLaptop($product_id);
            return [
                'status' => 200,
                'data' => $details['data']
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function search($keywords)
    {
        try {
            $search_product['data'] = $this->homeRepository->search($keywords);
            return [
                'status' => 200,
                'data' => $search_product['data']
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAllSmartphone()
    {
        try {
            $allSmartphone = $this->homeRepository->getAllSmartphone();
            return [
                'status' => 200,
                'data' => $allSmartphone
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAllHeadphone()
    {
        try {
            $allHeadphone = $this->homeRepository->getAllHeadphone();
            return [
                'status' => 200,
                'data' => $allHeadphone
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }
}