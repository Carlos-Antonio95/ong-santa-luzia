<?php

namespace Database\Seeders;

use App\Models\Idosa;
use Illuminate\Database\Seeder;

class IdosaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $idosas = [
            [
                'nome' => 'Maria Silva',
                'data_nascimento' => '1945-03-15',
                'estado_civil' => 'Viúva',
                'rg' => '12345678-9',
                'orgao_emissor' => 'SSP/SP',
                'cpf' => '123.456.789-00',
                'filiacao' => 'João Silva e Ana Pereira',
                'naturalidade' => 'São Paulo/SP',
                'deficiencia' => 'Mobilidade reduzida',
                'data_abrigamento' => '2023-01-10',
                'telefone' => '(11) 99999-0001',
                'endereco' => 'Rua das Flores, 123',
                'bairro' => 'Centro',
                'cidade' => 'São Paulo',
                'nome_social' => null,
                'apelido' => 'Dona Maria',
            ],
            [
                'nome' => 'Joana Oliveira',
                'data_nascimento' => '1938-07-22',
                'estado_civil' => 'Solteira',
                'rg' => '98765432-1',
                'orgao_emissor' => 'SSP/RJ',
                'cpf' => '987.654.321-00',
                'filiacao' => 'Carlos Oliveira e Maria Santos',
                'naturalidade' => 'Rio de Janeiro/RJ',
                'deficiencia' => 'Visão reduzida',
                'data_abrigamento' => '2022-05-20',
                'telefone' => '(21) 88888-0002',
                'endereco' => 'Av. Brasil, 456',
                'bairro' => 'Copacabana',
                'cidade' => 'Rio de Janeiro',
                'nome_social' => null,
                'apelido' => 'Tia Joana',
            ],
            [
                'nome' => 'Rosa Pereira',
                'data_nascimento' => '1942-11-30',
                'estado_civil' => 'Casada',
                'rg' => '45678912-3',
                'orgao_emissor' => 'SSP/MG',
                'cpf' => '456.789.123-00',
                'filiacao' => 'Pedro Pereira e Lucia Costa',
                'naturalidade' => 'Belo Horizonte/MG',
                'deficiencia' => 'Auditiva',
                'data_abrigamento' => '2021-12-15',
                'telefone' => '(31) 77777-0003',
                'endereco' => 'Rua Minas Gerais, 789',
                'bairro' => 'Savassi',
                'cidade' => 'Belo Horizonte',
                'nome_social' => null,
                'apelido' => 'Rosa',
            ],
        ];

        foreach ($idosas as $idosa) {
            Idosa::create($idosa);
        }
    }
}