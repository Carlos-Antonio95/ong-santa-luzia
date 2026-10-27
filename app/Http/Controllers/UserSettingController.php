<?php

namespace App\Http\Controllers;

use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSettingController extends Controller
{
    public function index()
    {
        $settings = UserSetting::where('user_id', Auth::id())->get()->pluck('value', 'key');
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'string|nullable',
        ]);

        foreach ($request->settings as $key => $value) {
            UserSetting::setSetting(Auth::id(), $key, $value);
        }

        return redirect()->back()->with('success', 'Configurações atualizadas com sucesso.');
    }
}
