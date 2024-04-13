<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Sửa đổi: Thêm use statement cho View

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // // Sửa đổi: Chỉnh sửa tên file view và truy vấn của bạn
        // View::composer("FrontEnd.include.product", function ($view) {
        //     $view->with("categories", Category::where('category_status', 1)->get());
        // });
    }
}
