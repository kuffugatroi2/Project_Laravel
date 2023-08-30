<?php

define('activeStatus', 1); // Khai báo hằng kiểu define
const unactiveStatus = 0; // Khai báo hằng kiểu const

function convertSatus($status, $id)
{
    /**
     *  Lấy url (giá sử url: http://0.0.0.0:8000/admin/items) thì sẽ lấy ra là /admin/items
     *  Sử dụng substr() để cắt chuỗi: /admin/items => kết quả: items
     *  Sử dụng strpos() kiểm tra trong url sau khi cắt chuỗi có ? hay ko (giả sử brands?page=2)
     *  Nếu có thì cắt bỏ toàn các params truyền vào sau ? => kết quả: brands
     *  Kiểm tra xem tồn tại "url" hay ko? và kiểm tra status và cutCurrentURL tương ứng để hiển thị link thay đổi status
     */

    $currentURL = $_SERVER['REQUEST_URI']; // lấy url
    $cutCurrentURL = substr($currentURL, 7); // cắt chuỗi
    if (strpos($cutCurrentURL, '?') == true) {
        $cutCurrentURL = strstr($cutCurrentURL, '?', true);
    }
    $html = '';
    if (isset($currentURL)) {
        if ($status == unactiveStatus && $cutCurrentURL == 'items') {
            // $html = '<a href="'.route('items.active_item', $id).'"><span class="fa fa-solid fa-laptop laptop"></span></a>';
            $html .= '<a onclick="if(confirm(\'Bạn có chắc muốn kích hoạt không?\')){window.location.href=\'' . route('items.status_change', $id) . '\'}"><span class="fa fa-solid fa-laptop laptop"></span></a>';
        } elseif ($status == activeStatus && $cutCurrentURL == 'items') {
            $html .= '<a onclick="if(confirm(\'Bạn có chắc muốn tắt kích hoạt không?\')){window.location.href=\'' . route('items.status_change', $id) . '\'}"><span class="fa fa-solid fa-laptop laptop-crack"></span></a>';
        } elseif ($status == unactiveStatus && $cutCurrentURL == 'brands') {
            $html .= '<a onclick="if(confirm(\'Bạn có chắc muốn kích hoạt không?\')){window.location.href=\'' . route('brands.status_change', $id) . '\'}"><span class="fa fa-solid fa-laptop laptop"></span></a>';
        } elseif ($status == activeStatus && $cutCurrentURL == 'brands') {
            $html .= '<a onclick="if(confirm(\'Bạn có chắc muốn tắt kích hoạt không?\')){window.location.href=\'' . route('brands.status_change', $id) . '\'}"><span class="fa fa-solid fa-laptop laptop-crack"></span></a>';
        } elseif ($status == unactiveStatus && $cutCurrentURL == 'categories') {
            $html .= '<a onclick="if(confirm(\'Bạn có chắc muốn kích hoạt không?\')){window.location.href=\'' . route('categories.active_category', $id) . '\'}"><span class="fa fa-solid fa-laptop laptop"></span></a>';
        } elseif ($status == activeStatus && $cutCurrentURL == 'categories') {
            $html .= '<a onclick="if(confirm(\'Bạn có chắc muốn tắt kích hoạt không?\')){window.location.href=\'' . route('categories.unactive_category', $id) . '\'}"><span class="fa fa-solid fa-laptop laptop-crack"></span></a>';
        } elseif ($status == unactiveStatus && $cutCurrentURL == 'products') {
            $html .= '<a onclick="if(confirm(\'Bạn có chắc muốn kích hoạt không?\')){window.location.href=\'' . route('products.active_product', $id) . '\'}"><span class="fa fa-solid fa-laptop laptop"></span></a>';
        } elseif ($status == activeStatus && $cutCurrentURL == 'products') {
            $html .= '<a onclick="if(confirm(\'Bạn có chắc muốn tắt kích hoạt không?\')){window.location.href=\'' . route('products.unactive_product', $id) . '\'}"><span class="fa fa-solid fa-laptop laptop-crack"></span></a>';
        } elseif ($status == unactiveStatus && $cutCurrentURL == 'payments') {
            $html .= '<a onclick="if(confirm(\'Bạn có chắc muốn kích hoạt không?\')){window.location.href=\'' . route('payments.active_payment', $id) . '\'}"><span class="fa fa-solid fa-dollar laptop"></span></a>';
        } elseif ($status == activeStatus && $cutCurrentURL == 'payments') {
            $html .= '<a onclick="if(confirm(\'Bạn có chắc muốn tắt kích hoạt không?\')){window.location.href=\'' . route('payments.unactive_payment', $id) . '\'}"><span class="fa fa-solid fa-dollar laptop-crack"></span></a>';
        }
    }
    return $html;
}
