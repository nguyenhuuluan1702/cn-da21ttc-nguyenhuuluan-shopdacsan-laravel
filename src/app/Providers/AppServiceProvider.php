<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\News;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view) {

            $news_footer = News::where('cate_news_id', 6)->get();

            $min_price = Product::min('product_price');
            $max_price = Product::max('product_price');
        
            $min_price_range = $min_price + 500000;
            $max_price_range = $max_price + 1000000;
        
            $product_dem = Product::all()->count();
            $news_dem = News::all()->count();
            $order_dem = Order::all()->count();
            $customer_dem = Customer::all()->count();
        
            $view->with('min_price', $min_price)
                 ->with('max_price', $max_price)
                 ->with('min_price_range', $min_price_range)
                 ->with('max_price_range', $max_price_range)
                 ->with('product_dem', $product_dem)
                 ->with('news_dem', $news_dem)
                 ->with('order_dem', $order_dem)
                 ->with('customer_dem', $customer_dem)
                 ->with('news_footer', $news_footer);
        });
        
    }
}
