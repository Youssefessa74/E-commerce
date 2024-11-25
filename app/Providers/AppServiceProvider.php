<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use App\Models\MailConfiguration;
use App\Models\PusherSettings;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        /* Use Bootstrap Pagination */
        \Illuminate\Pagination\Paginator::useBootstrap();

        /* Use My Custom Time Zone */
        $generalSettings = GeneralSetting::first();
        Config::set('app.timezone',$generalSettings->time_zone);
        /* Set generalSettings To be Global For all The views Of The Project */
        View::share('settings',$generalSettings);

        /* Set Mail Configurations */
        $mailSettings = MailConfiguration::first();
        Config::set('mail.mailers.smtp.host',$mailSettings->host);
        Config::set('mail.mailers.smtp.port',$mailSettings->port);
        Config::set('mail.mailers.smtp.encryption',$mailSettings->encryption);
        Config::set('mail.mailers.smtp.username',$mailSettings->username);
        Config::set('mail.mailers.smtp.password',$mailSettings->password);
        // Site Settings
        $logo = LogoSetting::first();
        View::share('logo',$logo);
        // Live Chat using Pusher
        $pusherSettings  = PusherSettings::first();
        Config::set('broadcasting.connections.pusher.key',$pusherSettings->key);
        Config::set('broadcasting.connections.pusher.app_id',$pusherSettings->app_id);
        Config::set('broadcasting.connections.pusher.secret',$pusherSettings->secret);
        Config::set('broadcasting.connections.pusher.options.cluster',$pusherSettings->cluster);
        Config::set('broadcasting.connections.pusher.options.host','api-'.$pusherSettings->cluster.'.pusher.com');
        View::share('pusherSettings',$pusherSettings);
    }
}
