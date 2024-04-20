<?php

namespace App\Http\Controllers;
use App\Models\ContactSettings;
use App\Models\Settings;
use Illuminate\Support\Facades\View;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function shareSettingsAndContactSet()
    {
        $settings = Settings::first();
        $contactset = ContactSettings::first();
        View::share('settings', $settings);
        View::share('contactset', $contactset);
    }
}
