<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use App\Models\MailConfiguration;
use App\Models\PusherSettings;
use App\Traits\upload_file;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    use upload_file;
    function index()
    {
        $pusher = PusherSettings::first();
        $logoSetting = LogoSetting::first();
        $mailSettings = MailConfiguration::first();
        $generalSettings = GeneralSetting::first();
        return view('admin.settings.index', compact('generalSettings', 'mailSettings','logoSetting','pusher'));
    }

    function GeneralSettingUpdate(Request $request)
    {
        $request->validate(
            [
                'site_name' => ['required', 'max:200'],
                'layout' => ['required', 'max:200'],
                'contact_mail' => ['required', 'max:200'],
                'contact_phone' => ['required', 'max:200'],
                'contact_address' => ['required', 'max:200'],
                'currency_name' => ['required', 'max:200'],
                'currency_icon' => ['required', 'max:200'],
                'time_zone' => ['required', 'max:200'],
            ]
        );
        GeneralSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => $request->site_name,
                'layout' => $request->layout,
                'contact_mail' => $request->contact_mail,
                'contact_phone' => $request->contact_phone,
                'contact_address' => $request->contact_address,
                'currency_name' => $request->currency_name,
                'currency_icon' => $request->currency_icon,
                'time_zone' => $request->time_zone,
            ],
        );
        toastr('Data Saved Successfully');
        return redirect()->back();
    }

    function MailConfigurationUpdate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'host' => ['required', 'max:200'],
            'username' => ['required', 'max:200'],
            'password' => ['required', 'max:200'],
            'port' => ['required', 'max:200'],
            'encryption' => ['required', 'max:200'],
        ]);

        MailConfiguration::updateOrCreate(
            ['id' => 1],
            [
                'email' => $request->email,
                'host' => $request->host,
                'username' => $request->username,
                'password' => $request->password,
                'port' => $request->port,
                'encryption' => $request->encryption,
            ]
        );

        toastr('Updates successfully!', 'success', 'success');
        return redirect()->back();
    }

    function UpdateLogoSettings(Request $request) {
        $request->validate([
            'logo' => ['image', 'max:3000'],
            'favicon' => ['image', 'max:3000'],
        ]);

        $logoPath = $this->uploadFile($request, 'logo', $request->old_logo);
        $favicon = $this->uploadFile($request, 'favicon',$request->old_favicon);

       LogoSetting::updateOrCreate(
            ['id' => 1],
            [
                'logo' =>  (!empty($logoPath)) ? $logoPath : $request->old_logo,
                'favicon' => (!empty($favicon)) ? $favicon : $request->old_favicon
            ]
        );

        toastr('Updated successfully!', 'success', 'success');

        return redirect()->back();
    }

    function PusherSettings(Request $request){
        $request->validate([
            'app_id' => ['required','max:200'],
            'key' => ['required','max:200'],
            'secret' => ['required','max:200'],
            'cluster' => ['required','max:200'],
        ]);

        PusherSettings::updateOrCreate(
            ['id' => 1],
            [
                'app_id' => $request->app_id,
                'key' => $request->key,
                'secret' => $request->secret,
                'cluster' => $request->cluster,
            ]
        );
        toastr('Updated successfully!', 'success', 'success');
        return redirect()->back();
    }
}
