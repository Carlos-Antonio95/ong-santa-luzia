<?php

namespace Database\Seeders;

use App\Models\Doacao;
use App\Models\Doador;
use App\Models\Idosa;
use App\Models\PlanoIndividual;
use App\Models\Responsavel;
use App\Models\TermoAbrigamento;
use App\Models\Voluntario;
use Carbon\CarbonImmutable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Dados FICTÍCIOS para demonstração (portfólio). Não é chamado pelo DatabaseSeeder.
 *
 *   php artisan db:seed --class=DemoSeeder [--force]
 *
 * - Idempotente: cada registro tem uma chave natural (CPF, e-mail, idosa,
 *   descrição da doação) e é atualizado em vez de duplicado.
 * - CPFs com dígitos verificadores propositalmente inválidos, telefones com
 *   DDD 00 e e-mails em example.org: nada coincide com pessoas reais.
 * - As datas das doações são relativas a hoje (do início do ano passado até
 *   hoje), então rodar de novo mantém o gráfico do dashboard preenchido.
 */
class DemoSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::transaction(function () {
            $responsaveis = $this->responsaveis();
            $this->idosas($responsaveis);
            $this->doadoresEDoacoes();
            $this->voluntarios();
        });

        $this->command?->info('Dados de demonstração criados/atualizados.');
    }

    /**
     * @return array<int, Responsavel>
     */
    private function responsaveis(): array
    {
        $dados = [
            ['Carlos Eduardo Lima', '99900001100', '99000011', 'SSP/MG', '00987650011', 'Rua das Acácias, 120 - Centro'],
            ['Fernanda Souza Rocha', '99900001280', '99000012', 'SSP/MG', '00987650012', 'Av. Brasil, 845 - São Geraldo'],
            ['Ricardo Alves Moreira', '99900001361', '99000013', 'SSP/BA', '00987650013', 'Rua Sete de Setembro, 33 - Bom Jesus'],
            ['Patrícia Gomes Ferreira', '99900001450', '99000014', 'SSP/MG', '00987650014', 'Rua Ipê Amarelo, 77 - Jardim das Flores'],
            ['Marcelo Henrique Dias', '99900001533', '99000015', 'SSP/SP', '00987650015', 'Travessa da Paz, 9 - Vila Nova'],
            ['Juliana Martins Costa', '99900001614', '99000016', 'SSP/MG', '00987650016', 'Rua Tiradentes, 410 - Centro'],
            ['André Luiz Barbosa', '99900001795', '99000017', 'SSP/RJ', '00987650017', 'Rua do Rosário, 58 - Boa Vista'],
            ['Luciana Ribeiro Santos', '99900001876', '99000018', 'SSP/MG', '00987650018', 'Av. Santa Luzia, 1500 - Industrial'],
        ];

        $responsaveis = [];

        foreach ($dados as [$nome, $cpf, $rg, $orgao, $telefone, $endereco]) {
            $responsavel = Responsavel::withTrashed()->updateOrCreate(
                ['cpf' => $cpf],
                [
                    'nome' => $nome,
                    'rg' => $rg,
                    'orgao_emissor' => $orgao,
                    'telefone' => $telefone,
                    'endereco' => $endereco,
                ]
            );

            if ($responsavel->trashed()) {
                $responsavel->restore();
            }

            $responsaveis[] = $responsavel;
        }

        return $responsaveis;
    }

    /**
     * @param  array<int, Responsavel>  $responsaveis
     */
    private function idosas(array $responsaveis): void
    {
        // Índice do responsável de cada idosa: dois responsáveis cuidam de duas idosas.
        $responsavelDe = [0, 1, 2, 3, 4, 5, 6, 7, 0, 3];

        $dados = [
            [
                'nome' => 'Maria das Graças Lima', 'data_nascimento' => '1941-03-15', 'estado_civil' => 'Viúva',
                'rg' => '99000001', 'orgao_emissor' => 'SSP/MG', 'cpf' => '99900000138',
                'filiacao' => 'José Lima e Ana Pereira Lima', 'naturalidade' => 'Belo Horizonte/MG',
                'deficiencia' => 'Mobilidade reduzida', 'data_abrigamento' => '2021-02-10',
                'bairro' => 'Centro', 'cidade' => 'Santa Luzia', 'apelido' => 'Dona Graça',
            ],
            [
                'nome' => 'Joana Souza Rocha', 'data_nascimento' => '1938-07-22', 'estado_civil' => 'Solteira',
                'rg' => '99000002', 'orgao_emissor' => 'SSP/MG', 'cpf' => '99900000219',
                'filiacao' => 'Antônio Rocha e Maria Souza', 'naturalidade' => 'Sabará/MG',
                'deficiencia' => 'Baixa visão', 'data_abrigamento' => '2020-05-20',
                'bairro' => 'São Geraldo', 'cidade' => 'Santa Luzia', 'apelido' => 'Tia Joana',
            ],
            [
                'nome' => 'Rosa Alves Moreira', 'data_nascimento' => '1945-11-30', 'estado_civil' => 'Divorciada',
                'rg' => '99000003', 'orgao_emissor' => 'SSP/BA', 'cpf' => '99900000390',
                'filiacao' => 'Pedro Moreira e Lúcia Alves', 'naturalidade' => 'Vitória da Conquista/BA',
                'deficiencia' => 'Perda auditiva parcial', 'data_abrigamento' => '2022-08-01',
                'bairro' => 'Bom Jesus', 'cidade' => 'Santa Luzia', 'apelido' => null,
            ],
            [
                'nome' => 'Terezinha Gomes Ferreira', 'data_nascimento' => '1936-01-08', 'estado_civil' => 'Viúva',
                'rg' => '99000004', 'orgao_emissor' => 'SSP/MG', 'cpf' => '99900000470',
                'filiacao' => 'Sebastião Ferreira e Rita Gomes', 'naturalidade' => 'Santa Luzia/MG',
                'deficiencia' => null, 'data_abrigamento' => '2019-11-12',
                'bairro' => 'Jardim das Flores', 'cidade' => 'Santa Luzia', 'apelido' => 'Dona Teré',
            ],
            [
                'nome' => 'Aparecida Dias Nogueira', 'data_nascimento' => '1949-04-27', 'estado_civil' => 'Separada',
                'rg' => '99000005', 'orgao_emissor' => 'SSP/SP', 'cpf' => '99900000551',
                'filiacao' => 'Benedito Nogueira e Aparecida Dias', 'naturalidade' => 'Campinas/SP',
                'deficiencia' => 'Usa cadeira de rodas', 'data_abrigamento' => '2023-03-05',
                'bairro' => 'Vila Nova', 'cidade' => 'Santa Luzia', 'apelido' => 'Cida',
            ],
            [
                'nome' => 'Benedita Martins Costa', 'data_nascimento' => '1940-09-14', 'estado_civil' => 'Casada',
                'rg' => '99000006', 'orgao_emissor' => 'SSP/MG', 'cpf' => '99900000642',
                'filiacao' => 'Joaquim Costa e Benedita Martins', 'naturalidade' => 'Lagoa Santa/MG',
                'deficiencia' => null, 'data_abrigamento' => '2022-01-18',
                'bairro' => 'Centro', 'cidade' => 'Santa Luzia', 'apelido' => 'Dita',
            ],
            [
                'nome' => 'Helena Barbosa Pinto', 'data_nascimento' => '1943-12-02', 'estado_civil' => 'Viúva',
                'rg' => '99000007', 'orgao_emissor' => 'SSP/RJ', 'cpf' => '99900000723',
                'filiacao' => 'Manoel Pinto e Helena Barbosa', 'naturalidade' => 'Niterói/RJ',
                'deficiencia' => 'Alzheimer em estágio inicial', 'data_abrigamento' => '2024-06-03',
                'bairro' => 'Boa Vista', 'cidade' => 'Santa Luzia', 'apelido' => null,
            ],
            [
                'nome' => 'Francisca Ribeiro Santos', 'data_nascimento' => '1935-05-19', 'estado_civil' => 'Viúva',
                'rg' => '99000008', 'orgao_emissor' => 'SSP/MG', 'cpf' => '99900000804',
                'filiacao' => 'Raimundo Santos e Francisca Ribeiro', 'naturalidade' => 'Montes Claros/MG',
                'deficiencia' => 'Mobilidade reduzida', 'data_abrigamento' => '2020-10-22',
                'bairro' => 'Industrial', 'cidade' => 'Santa Luzia', 'apelido' => 'Dona Chica',
            ],
            [
                'nome' => 'Odete Lima Carvalho', 'data_nascimento' => '1947-08-09', 'estado_civil' => 'Solteira',
                'rg' => '99000009', 'orgao_emissor' => 'SSP/MG', 'cpf' => '99900000985',
                'filiacao' => 'Geraldo Carvalho e Odete Lima', 'naturalidade' => 'Belo Horizonte/MG',
                'deficiencia' => null, 'data_abrigamento' => '2025-02-14',
                'bairro' => 'Centro', 'cidade' => 'Santa Luzia', 'apelido' => null,
            ],
            [
                'nome' => 'Iracema Ferreira Gomes', 'data_nascimento' => '1939-02-25', 'estado_civil' => 'União Estável',
                'rg' => '99000010', 'orgao_emissor' => 'SSP/MG', 'cpf' => '99900001029',
                'filiacao' => 'Luiz Gomes e Iracema Ferreira', 'naturalidade' => 'Caeté/MG',
                'deficiencia' => 'Baixa visão', 'data_abrigamento' => '2023-09-30',
                'bairro' => 'Jardim das Flores', 'cidade' => 'Santa Luzia', 'apelido' => 'Cema',
            ],
        ];

        $planos = [
            ['Residência de familiares', 'Ausência de familiares com condições de prestar cuidados', 1518.00, 'Fundamental incompleto', 'Costureira', 'Católica', 'Hipertensão arterial', 'Parcialmente dependente', true, 'Losartana 50 mg (manhã)', 'Restrição de sal'],
            ['Residência própria', 'Vivia sozinha; quedas recorrentes', 1518.00, 'Sem instrução', 'Lavradora', 'Católica', 'Catarata bilateral', 'Parcialmente dependente', false, 'Colírio lubrificante 3x ao dia', null],
            ['Encaminhada pelo CRAS', 'Situação de vulnerabilidade social', 0.00, 'Fundamental completo', 'Doméstica', 'Evangélica', 'Diabetes tipo 2', 'Independente', false, 'Metformina 850 mg (almoço e jantar)', 'Dieta para diabéticos'],
            ['Residência de familiares', 'Família sem condições de oferecer cuidados contínuos', 1518.00, 'Sem instrução', 'Do lar', 'Católica', 'Osteoporose', 'Totalmente dependente', true, 'Cálcio + vitamina D (manhã)', null],
            ['Hospital regional', 'Alta hospitalar sem retaguarda familiar', 1518.00, 'Médio completo', 'Professora', 'Espírita', 'Sequela de AVC', 'Totalmente dependente', false, 'AAS 100 mg; sinvastatina 20 mg', 'Dieta pastosa'],
            ['Residência própria', 'Solicitação da família', 2200.00, 'Fundamental completo', 'Comerciante', 'Católica', 'Hipertensão arterial', 'Independente', true, 'Anlodipino 5 mg', 'Restrição de sal'],
            ['Residência de familiares', 'Necessidade de supervisão constante', 1518.00, 'Médio completo', 'Bancária', 'Católica', 'Doença de Alzheimer (fase inicial)', 'Parcialmente dependente', true, 'Donepezila 5 mg (noite)', null],
            ['Encaminhada pelo CREAS', 'Situação de abandono', 1518.00, 'Sem instrução', 'Lavradora', 'Evangélica', 'Artrose de joelhos', 'Parcialmente dependente', false, 'Paracetamol se dor', null],
            ['Residência própria', 'Vivia sozinha; dificuldade com atividades diárias', 1518.00, 'Médio incompleto', 'Costureira', 'Católica', 'Hipotireoidismo', 'Independente', false, 'Levotiroxina 50 mcg (jejum)', 'Sem lactose'],
            ['Residência de familiares', 'Família mudou de cidade', 1518.00, 'Fundamental incompleto', 'Cozinheira', 'Católica', 'Glaucoma', 'Parcialmente dependente', false, 'Colírio de timolol 2x ao dia', null],
        ];

        foreach ($dados as $i => $dadosIdosa) {
            $cpf = $dadosIdosa['cpf'];
            unset($dadosIdosa['cpf']);

            $idosa = Idosa::withTrashed()->updateOrCreate(
                ['cpf' => $cpf],
                $dadosIdosa + [
                    'telefone' => null,
                    'endereco' => 'Rua do Abrigo, 100',
                    'nome_social' => null,
                ]
            );

            if ($idosa->trashed()) {
                $idosa->restore();
            }

            [$origem, $motivo, $renda, $escolaridade, $profissao, $religiao, $diagnostico, $grau, $planoSaude, $medicacao, $restricao] = $planos[$i];

            PlanoIndividual::updateOrCreate(
                ['idosa_id' => $idosa->id],
                [
                    'data_ingresso' => $dadosIdosa['data_abrigamento'],
                    'numero_prontuario' => sprintf('DEMO-%03d', $i + 1),
                    'origem_residencia' => $origem,
                    'motivo_institucionalizacao' => $motivo,
                    'renda' => $renda,
                    'administra_financeiro' => $grau === 'Independente',
                    'escolaridade' => $escolaridade,
                    'profissao' => $profissao,
                    'religiao' => $religiao,
                    'diagnostico_medico' => $diagnostico,
                    'grau_dependencia' => $grau,
                    'possui_plano_saude' => $planoSaude,
                    'descricao_medicacao' => $medicacao,
                    'restricao_alimentar' => $restricao,
                    'rotina' => 'Café às 7h, atividades recreativas pela manhã, repouso após o almoço e visitas aos fins de semana.',
                ]
            );

            // Três termos ficam com assinaturas pendentes para o painel mostrar os dois estados.
            $completo = $i % 4 !== 3;

            TermoAbrigamento::updateOrCreate(
                ['idosa_id' => $idosa->id, 'responsavel_id' => $responsaveis[$responsavelDe[$i]]->id],
                [
                    'data_inicio' => $dadosIdosa['data_abrigamento'],
                    'observacoes' => $completo ? null : 'Aguardando assinatura da equipe técnica.',
                    'assinado_responsavel' => true,
                    'assinado_psicologo' => $completo,
                    'assinado_assistente_social' => $completo,
                ]
            );
        }
    }

    private function doadoresEDoacoes(): void
    {
        $dados = [
            ['Paulo Roberto Andrade', '999.100.001-63', '(00) 98888-0001', 'paulo.andrade@example.org', 'Pessoa Física', 'Doador mensal.'],
            ['Sandra Regina Teixeira', '999.100.002-52', '(00) 98888-0002', 'sandra.teixeira@example.org', 'Pessoa Física', null],
            ['José Carlos Mendes', '999.100.003-35', '(00) 98888-0003', 'jose.mendes@example.org', 'Pessoa Física', 'Prefere contato por e-mail.'],
            ['Cláudia Fernandes Melo', '999.100.004-16', '(00) 98888-0004', 'claudia.melo@example.org', 'Pessoa Física', null],
            ['Roberto Nunes Araújo', '999.100.005-97', '(00) 98888-0005', 'roberto.araujo@example.org', 'Pessoa Física', null],
            ['Padaria Pão da Serra (fictícia)', null, '(00) 3333-0001', 'contato@padaria.example.org', 'Empresa', 'Doa pães às segundas e quintas.'],
            ['Farmácia Bem Viver (fictícia)', null, '(00) 3333-0002', 'contato@farmacia.example.org', 'Empresa', 'Doações de medicamentos e fraldas.'],
            ['Supermercado Boa Compra (fictício)', null, '(00) 3333-0003', 'contato@mercado.example.org', 'Empresa', null],
        ];

        $doadores = [];

        foreach ($dados as [$nome, $cpf, $telefone, $email, $tipo, $observacoes]) {
            $doadores[] = Doador::updateOrCreate(
                ['email' => $email],
                compact('nome', 'cpf', 'telefone', 'tipo', 'observacoes')
            );
        }

        // 35 doações espalhadas do início do ano passado até hoje.
        $hoje = CarbonImmutable::today();
        $inicio = $hoje->subYear()->startOfYear();
        $meses = 12 + $hoje->month;

        $valores = [50, 100, 150, 200, 80, 250, 120, 300, 60, 500, 90, 180, 75, 400];
        $formas = ['Pix', 'Transferência', 'Dinheiro', 'Boleto'];
        $tiposNaoFinanceiros = ['Alimentos', 'Roupas', 'Medicamentos', 'Higiene'];

        for ($i = 0; $i < 35; $i++) {
            $mes = $inicio->addMonths(intdiv($i * $meses, 35));
            $data = $mes->setDay(min(1 + ($i * 11) % 28, $mes->daysInMonth));

            if ($data->greaterThan($hoje)) {
                $data = $hoje;
            }

            $doador = $doadores[$i % count($doadores)];
            $financeira = $doador->tipo === 'Pessoa Física' || $i % 2 === 0;

            Doacao::updateOrCreate(
                ['doador_id' => $doador->id, 'descricao' => sprintf('Doação de demonstração #%02d', $i + 1)],
                [
                    'valor' => $valores[$i % count($valores)],
                    'data_doacao' => $data->toDateString(),
                    'forma_pagamento' => $financeira ? $formas[$i % count($formas)] : null,
                    'tipo_doacao' => $financeira ? 'Financeira' : $tiposNaoFinanceiros[$i % count($tiposNaoFinanceiros)],
                ]
            );
        }
    }

    private function voluntarios(): void
    {
        $dados = [
            ['Beatriz Campos Oliveira', 'beatriz.campos@example.org', '(00) 97777-0001', '1998-04-12', 'Enfermagem, aferição de pressão', 'Disponível aos sábados pela manhã.'],
            ['Lucas Pereira Matos', 'lucas.matos@example.org', '(00) 97777-0002', '2001-09-03', 'Música (violão), recreação', null],
            ['Camila Duarte Freitas', 'camila.freitas@example.org', '(00) 97777-0003', '1990-12-20', 'Fisioterapia, alongamento em grupo', 'Atende às terças e quintas.'],
            ['Rafael Souza Prado', 'rafael.prado@example.org', '(00) 97777-0004', '1985-06-17', 'Manutenção predial, pequenos reparos', null],
            ['Mariana Lopes Vieira', 'mariana.vieira@example.org', '(00) 97777-0005', '1995-02-28', 'Psicologia, rodas de conversa', 'Voluntária desde 2024.'],
            ['Thiago Ramos Cunha', 'thiago.cunha@example.org', '(00) 97777-0006', '2003-08-09', 'Informática, chamadas de vídeo com familiares', null],
        ];

        foreach ($dados as [$nome, $email, $telefone, $nascimento, $skills, $observacoes]) {
            Voluntario::updateOrCreate(
                ['email' => $email],
                [
                    'nome' => $nome,
                    'telefone' => $telefone,
                    'data_nascimento' => $nascimento,
                    'skills' => $skills,
                    'observacoes' => $observacoes,
                ]
            );
        }
    }
}
