<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserSettingsRequest;
use App\Models\UserSetting;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        $settings = UserSetting::where('user_id', $user->id)->get()->pluck('value', 'key');

        return response()->json(['data' => $settings]);
    }

    public function update(UpdateUserSettingsRequest $request)
    {
        $user = $request->user();

        $map = [
            'theme' => $request->input('theme', 'light'),
            'notifications_enabled' => $request->input('notifications_enabled', true),
            'language' => $request->input('language', 'pt_BR'),
            'preferences' => json_encode($request->input('preferences', [])),
        ];

        foreach ($map as $key => $value) {
            if ($request->has($key)) {
                UserSetting::updateOrCreate(
                    ['user_id' => $user->id, 'key' => $key],
                    ['value' => is_bool($value) ? json_encode($value) : (string) $value]
                );
            }
        }

        return response()->json(['message' => 'Configurações do usuário atualizadas com sucesso.']);
    }
}
