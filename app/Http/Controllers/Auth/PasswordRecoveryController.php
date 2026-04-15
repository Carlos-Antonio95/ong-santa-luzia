<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\PasswordResetLinkMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordRecoveryController extends Controller
{
    public function sendResetLink(ForgotPasswordRequest $request)
    {
        $email = $request->validated()['email'];
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'Se o e-mail existir, você receberá um link de recuperação.'], 200);
        }

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            [
                'token' => Hash::make($token),
                'expires_at' => Carbon::now()->addMinutes(60),
                'user_id' => $user->id,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]
        );

        try {
            Mail::to($user->email)->send(new PasswordResetLinkMail($token, $email));
        } catch (\Throwable $e) {
            \Log::error('Falha ao enviar e-mail de recuperação de senha.', [
                'email' => $email,
                'error' => $e->getMessage(),
            ]);

            return response()->json(['message' => 'Não foi possível enviar o e-mail. Tente novamente mais tarde.'], 500);
        }

        return response()->json(['message' => 'Link de recuperação enviado para o e-mail se existir no sistema.'], 200);
    }

    public function reset(ResetPasswordRequest $request)
    {
        $data = $request->validated();
        $record = DB::table('password_resets')
            ->where('email', $data['email'])
            ->first();

        if (!$record || !Hash::check($data['token'], $record->token) || Carbon::now()->greaterThan(Carbon::parse($record->expires_at))) {
            return response()->json(['message' => 'Token inválido ou expirado.'], 422);
        }

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 422);
        }

        $user->password = Hash::make($data['password']);
        $user->save();

        DB::table('password_resets')->where('email', $data['email'])->delete();

        return response()->json(['message' => 'Senha atualizada com sucesso.'], 200);
    }
}
