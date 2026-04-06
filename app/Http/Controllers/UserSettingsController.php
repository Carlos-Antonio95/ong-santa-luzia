<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserSettingsRequest;
use App\Models\UserSetting;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    public function update(UpdateUserSettingsRequest $request)
    {
        $user = $request->user();

        $map = [
            'theme' => $request->input('settings.theme', 'light'),
            'email_notifications' => $request->input('settings.email_notifications', '1'),
            'language' => $request->input('settings.language', 'pt'),
        ];

        foreach ($map as $key => $value) {
            UserSetting::updateOrCreate(
                ['user_id' => $user->id, 'key' => $key],
                ['value' => (string) $value]
            );
        }

        return redirect()
            ->route('dashboard')
            ->with('success_config', 'Configurações atualizadas com sucesso.');
    }
}