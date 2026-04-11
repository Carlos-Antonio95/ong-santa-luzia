<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santa Luzia 🏠</title>

    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <header>
        <div class="container topo">

            <div class="logo">
                <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" alt="Abrigo Santa Luzia">
            </div>

            <div class="menu-toggle" onclick="toggleMenu()">☰</div>

            <nav class="menu" id="menu">
                <a href="#">Início</a>
                <a href="#Sobre">Quem Somos</a>
                <a href="#projetos">Projetos</a>
                <a href="#doacoes">Doações</a>
                <a href="#footerGrid">Contato</a>
            </nav>

        </div>
    </header>

    <main>

        <section class="hero">
            <img src="{{ asset('imagens/IMG-PRINCIPAL.jpg') }}" alt="Idosos no jardim" class="hero-img">

            <div class="hero-texto">
                <h1>Abrigo Santa Luzia - Cuidando com Amor</h1>
                <p>Instituição dedicada ao bem-estar de idosos desde 1980</p>
                <a href="#Sobre" class="botao">Conheça nosso trabalho</a>
            </div>
        </section>

        <section class="servicos">
            <img src="{{ asset('imagens/Ícone minimalista de maleta verde.png') }}" alt="Profissionais Capacitados" class="servico-img">

            <div class="container servico-texto">
                <h2>Profissionais Capacitados</h2>
                <p>
                    Equipe multidisciplinar com experiência formada por médicos, enfermeiros, nutricionistas e cuidadoras de idosos.
                </p>
            </div>
        </section>

        <section class="coração">
            <img src="{{ asset('imagens/Coração verde simétrico em destaque.png') }}" alt="Amor e Dedicação" class="coração-img">
            <div class="container coração-texto">
                <h2>Amor e Dedicação</h2>
                <p>
                    Cuidamos de cada idoso com carinho, respeito e atenção personalizada.
                </p>
            </div>
        </section>

        <section class="remedio">
            <img src="{{ asset('imagens/Ícone de cápsula verde.png') }}" alt="Cuidados de Saúde" class="remedio-img">
            <div class="container remedio-texto">
                <h2>Cuidados de Saúde</h2>
                <p>
                    Monitoramento constante da saúde, administração de medicamentos e suporte médico.
                </p>
            </div>
        </section>

        <section id="Sobre" class="Sobre">
            <div class="card sobre-card">
                <div class="texto-sobre">
                    <h2>Sobre o Abrigo Santa Luzia</h2>

                    <p>
                        O Abrigo Santa Luzia nasceu em 1980 a partir de um terreno doado com uma capelinha dedicada a Santa Luzia. Desde então, cresceu com o apoio de irmãs religiosas, voluntários e doações da comunidade para oferecer abrigo e cuidados a senhoras idosas.
                    </p>

                    <p id="sobreExtra" class="sobre-extra">
                        Em 1977, a primeira missa foi celebrada pelo Dom Plácido de Azevedo Pontes/SB. A partir de 1980, as irmãs Maria Bezerra de Lima, Odete Ribeiro dos Santos e Maria Salete Miranda de Albuquerque chegaram para iniciar o grande desafio do Abrigo. Em 1983 a capela foi ampliada e, em 1985, a comunidade passou a pertencer à Paróquia Nossa Senhora do Carmo. Desde então, o Abrigo foi registrado em conselhos assistenciais e continuou a se fortalecer com doações, benfeitores e a dedicação das irmãs e frades que assumiram a assistência espiritual e o cuidado dos moradores.
                    </p>

                    <button type="button" class="btn" id="btnSobreToggle">Saiba mais</button>
                </div>
            </div>
        </section>

        <section id="projetos" class="container projetos-card">

            <div class="cards">
                <div class="card">
                    <div class="card-texto">
                        <h2>Novo Projeto</h2>
                        <p>
                            Este projeto tem como objetivo promover atividades sociais e melhorar a qualidade de vida dos idosos através de ações recreativas e acompanhamento especializado.
                        </p>
                    </div>
                </div>
            </div>

            <div class="cards">
                <div class="card">
                    <img src="{{ asset('imagens/ATIVIDADES.jpg') }}" alt="Atividades Recreativas" class="card-img">
                    <div class="card-texto">
                        <h2>Atividades Recreativas</h2>
                        <p>Oferecemos atividades recreativas para estimular a convivência, a alegria e o bem-estar.</p>
                    </div>
                </div>

                <div class="card">
                    <img src="{{ asset('imagens/CUIDADOS.jpg') }}" alt="Cuidados Humanizados" class="card-img">
                    <div class="card-texto">
                        <h2>Cuidados Humanizados</h2>
                        <p>Atendimento com carinho, respeito e atenção às necessidades de cada residente.</p>
                    </div>
                </div>

                <div class="card">
                    <img src="{{ asset('imagens/SAUDE.jpg') }}" alt="Saúde e Bem-estar" class="card-img">
                    <div class="card-texto">
                        <h2>Saúde e Bem-estar</h2>
                        <p>Monitoramento constante da saúde com apoio de profissionais e cuidados contínuos.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="doacoes" class="container doacoes">
            <div class="card doacoes-card">
                <div class="doacoes-texto">
                    <h2>Doações</h2>
                    <p>
                        Ajude-nos a continuar nosso trabalho de amor e dedicação. Suas doações fazem a diferença na vida das nossas residentes. Você pode doar via PIX usando as informações abaixo.
                    </p>

                    <h3>Chave PIX</h3>
                    <table class="pix-table">
                        <tr>
                            <th>Nome</th>
                            <th>Banco</th>
                        </tr>
                        <tr>
                            <td>ASSOCIAÇÃO ABRIGO SANTA LUZIA</td>
                            <td>Banco do Brasil S.A.</td>
                        </tr>
                    </table>

                    <h3>QR Code para Doação</h3>

<div style="text-align:center; margin-top:20px;">

    <canvas id="qrcode" style="cursor:pointer;"></canvas>

    <p id="pix-copia" style="margin-top:10px; font-size:14px; word-break:break-all;">
        00020126430014br.gov.bcb.pix0114087973420001960203Pix5204000053039865802BR5925ASSOCIACAO ABRIGO SANTA L6015JABOATAO DOS GU62140510Doacoesite63048A77
    </p>

    <button onclick="copiarPix()" class="botao" style="margin-top:10px;cursor: pointer;">
        Copiar chave PIX
    </button>

    <p id="feedbackPix" style="color:green; margin-top:10px; display:none;">
        ✅ Copiado com sucesso!
    </p>

</div>
            </div>
        </section>

    </main>

    <footer class="footer">
        <div id="footerGrid" class="container footer-grid">

            <div class="footer-col">
                <h4>Contato</h4>
                <p>📞 (81) 3479-2212</p>
                <p>✉ contato@abrigosantaluzia.org</p>
                <p>📍 Avenida josé da Câmara Veira,81</p>
                <p>Jaboatão Dos Guararapes - PE</p>
            </div>

            <div class="footer-col">
                <h4>Links</h4>
                <ul class="footer-links">
                    <li><a href="#">Início</a></li>
                    <li><a href="#Sobre">Quem Somos</a></li>
                    <li><a href="#projetos">Projetos</a></li>
                    <li><a href="#doacoes">Doações</a></li>
                    <li><a href="{{ route('dashboard') }}">Admin</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Localização</h4>

                <div class="footer-mapa">
                    <iframe src="https://www.google.com/maps?q=-8.209556,-34.954554&hl=pt&z=14&output=embed" loading="lazy"></iframe>
                </div>

                <div class="sociais">
                    <a href="#" class="social-link" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a href="https://www.instagram.com/abrigo_santaluzia/" target="_blank" class="social-link" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© 2024 Abrigo Santa Luzia</p>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const menu = document.getElementById("menu");
            menu.classList.toggle("active");
        }

        const btnSobreToggle = document.getElementById('btnSobreToggle');
        const sobreExtra = document.getElementById('sobreExtra');

        if (btnSobreToggle && sobreExtra) {
            btnSobreToggle.addEventListener('click', () => {
                const expanded = sobreExtra.classList.toggle('expanded');
                btnSobreToggle.textContent = expanded ? 'Ver menos' : 'Saiba mais';
            });
        }
    </script>

<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>

<script>
const pixCode = "00020126430014br.gov.bcb.pix0114087973420001960203Pix5204000053039865802BR5925ASSOCIACAO ABRIGO SANTA L6015JABOATAO DOS GU62140510Doacoesite63048A77";

// GERAR QR CODE
QRCode.toCanvas(document.getElementById('qrcode'), pixCode, {
    width: 220
});

// COPIAR FUNÇÃO
function copiarPix() {
    navigator.clipboard.writeText(pixCode).then(() => {
        mostrarFeedback();
    });
}

// CLIQUE NO QR CODE TAMBÉM COPIA
document.getElementById("qrcode").addEventListener("click", copiarPix);

// FEEDBACK VISUAL
function mostrarFeedback() {
    const msg = document.getElementById("feedbackPix");
    msg.style.display = "block";

    setTimeout(() => {
        msg.style.display = "none";
    }, 2000);
}
</script>
</body>

</html>