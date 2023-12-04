<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class DashboardController extends Controller
{
public function index (){ 
    $jumlah_product=Product::count();
    $kategori_product=Category::count();
    $total_harga_semua_product=Product::sum('price');
    $stok_semua_product=Product::sum('stok_barang');

    $produk_kategori = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->selectRaw('product_categories.category_name, COUNT(products.category_id) as total_produk')
        ->groupBy('product_categories.category_name')
        ->pluck('total_produk', 'category_name');
$chartData = [];
foreach ($produk_kategori as $kategori => $total_produk) {
            $chartData[] = ['name' => $kategori, 'y' => $total_produk];
        }

    /*dd($chartData);*/
    return view ('dashboard', compact('jumlah_product', 'kategori_product', 'total_harga_semua_product', 'stok_semua_product'))->with([
        'chart_product'=>json_encode($chartData)
    ]);
    

}
}
