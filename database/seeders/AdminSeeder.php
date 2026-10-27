<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AdminSeeder extends Seeder
{
    /**
     * Cria o administrador padrão a partir de ADMIN_NAME, ADMIN_EMAIL e ADMIN_PASSWORD.
     * Idempotente: se o e-mail já existir, nada é alterado.
     */
    public function run(): void
    {
        $data = config('admin');

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', Password::defaults()],
        ])->validate();

        $user = User::firstOrCreate(
            ['email' => mb_strtolower($data['email'])],
            ['name' => $data['name'], 'password' => $data['password']],
        );

        // email_verified_at não é fillable; preenche só se ainda estiver vazio.
        if ($user->email_verified_at === null) {
            $user->forceFill(['email_verified_at' => now()])->save();
        }

        $this->command?->info(
            $user->wasRecentlyCreated
                ? "Admin {$user->email} criado."
                : "Admin {$user->email} já existia; nada alterado."
        );
    }
}
