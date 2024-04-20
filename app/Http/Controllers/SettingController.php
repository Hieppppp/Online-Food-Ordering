<?php

namespace App\Http\Controllers;

use App\Models\ContactSettings;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function generalsetting(){
        $settings = Settings::orderBy('id','ASC')->get();
        $contactsettings = ContactSettings::orderBy('id','ASC')->get();
        return view("BackEnd.settings.generalSetting")->with(compact('settings','contactsettings'));
    }

    public function updatesetting(Request $request){
        $setting = Settings::find($request->id);
        $setting->site_title = $request->site_title;
        $setting->site_about = $request->site_about;
        $setting->save();

        return redirect('/setting/generalsetting')->with('sms','Update thành công!');
    }

    public function updatecontactsetting(Request $request){
        $contactset = ContactSettings::find($request->id);
        $contactset->address = $request->address;
        $contactset->gmap = $request->gmap;
        $contactset->pn1 = $request->pn1;
        $contactset->pn2 = $request->pn2;
        $contactset->email = $request->email;
        $contactset->fb = $request->fb;
        $contactset->tw = $request->tw;
        $contactset->iframe = $request->iframe;
        $contactset->save();

        return redirect('/setting/generalsetting')->with('sms','Update thành công');


    }
}
