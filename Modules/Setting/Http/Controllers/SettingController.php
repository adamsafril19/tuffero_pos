<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Http\Requests\StoreSettingsRequest;
use Modules\Setting\Http\Requests\StoreSmtpSettingsRequest;

class SettingController extends Controller
{

    public function index() {
        abort_if(Gate::denies('access_settings'), 403);

        $settings = Setting::firstOrFail();

        return view('setting::index', compact('settings'));
    }


    public function update(StoreSettingsRequest $request) {
        Setting::firstOrFail()->update([
            'company_name' => $request->company_name,
            'company_email' => $request->company_email,
            'company_phone' => $request->company_phone,
            'notification_email' => $request->notification_email,
            'company_address' => $request->company_address,
            'default_currency_id' => $request->default_currency_id,
            'default_currency_position' => $request->default_currency_position,
        ]);

        cache()->forget('settings');

        toast('Settings Updated!', 'info');

        return redirect()->route('settings.index');
    }


    public function updateSmtp(StoreSmtpSettingsRequest $request) {
        try {
            $envPath = base_path('.env');
            $envContent = file_get_contents($envPath);

            // Update .env dengan regex yang lebih akurat
            $envContent = preg_replace([
                '/^MAIL_MAILER=.*/m',
                '/^MAIL_HOST=.*/m',
                '/^MAIL_PORT=.*/m',
                '/^MAIL_USERNAME=.*/m',
                '/^MAIL_PASSWORD=.*/m',
                '/^MAIL_ENCRYPTION=.*/m',
                '/^MAIL_FROM_ADDRESS=("?)(.*)\1/m',
                '/^MAIL_FROM_NAME=("?)(.*)\1/m'
            ], [
                'MAIL_MAILER='.$request->mail_mailer,
                'MAIL_HOST='.$request->mail_host,
                'MAIL_PORT='.$request->mail_port,
                'MAIL_USERNAME='.$request->mail_username,
                'MAIL_PASSWORD='.$request->mail_password,
                'MAIL_ENCRYPTION='.$request->mail_encryption,
                'MAIL_FROM_ADDRESS="'.$request->mail_from_address.'"',
                'MAIL_FROM_NAME="'.$request->mail_from_name.'"'
            ], $envContent);

            file_put_contents($envPath, $envContent);

            Artisan::call('config:clear');
            Artisan::call('cache:clear');

            toast('Mail Settings Updated!', 'info');
        } catch (\Exception $exception) {
            Log::error($exception);
            session()->flash('settings_smtp_message', 'Error: ' . $exception->getMessage());
        }

        return redirect()->route('settings.index');
    }
}
