<?php

namespace App\Http\Controllers;

use App\Models\ContactSettings;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function AuthLogin(){
        $admin_id = session()->get('admin_id');
        if($admin_id){
            return redirect('/admin/home');
        }
        else{
            return redirect('/admin/login')->send();
        }
    }
    public function generalsetting(){
        $this->AuthLogin();
        $settings = Settings::orderBy('id','ASC')->get();
        $contactsettings = ContactSettings::orderBy('id','ASC')->get();
        return view("BackEnd.settings.generalSetting")->with(compact('settings','contactsettings'));
    }

    public function updatesetting(Request $request){
        $this->AuthLogin();
        $setting = Settings::find($request->id);
        $setting->site_title = $request->site_title;
        $setting->site_about = $request->site_about;
        $setting->save();

        return redirect('/setting/general/settings')->with('sms','Update thành công!');
    }

    public function updatecontactsetting(Request $request){
        $this->AuthLogin();
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

        return redirect('/setting/general/settings')->with('sms','Update thành công');


    }
}
