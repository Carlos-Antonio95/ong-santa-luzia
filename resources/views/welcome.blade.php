<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santa Luzia 🏠</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
</head>

<body>

    <header>
        <div class="container topo">
            <div class="logo">
                <img src="{{ asset('imagens/Logo Abrigo Santa Luzia.png') }}" alt="Abrigo Santa Luzia" class="logo">
            </div>
            <nav class="menu">
                <a href="#">Início</a>
                <a href="#Sobre">Quem Somos</a>
                <a href="#projetos">Projetos</a>
                <a href="#doacoes">Doações</a>
                <a href="#footerGrid">Contato</a>
            </nav>
        </div>
    </header>

    <!-- HEADER -->


    <!-- CONTEÚDO PRINCIPAL -->
    <main>

        <!-- HERO (primeira seção) -->
        <section class="hero">
            <img src="{{ asset('imagens/Amigos na luz do jardim.png') }}" alt="Idosos no jardim" class="hero-img">

            <div class="hero-texto">
                <h1>Abrigo Santa Luzia - Cuidando com Amor</h1>
                <p>Instituição dedicada ao bem-estar de idosos desde 1980</p>
                <a href="#" class="botao">Conheça nosso trabalho</a>
            </div>
        </section>

        <!-- SOBRE / SERVIÇOS -->
        <section class="servicos">
            <img src="{{ asset('imagens/Ícone minimalista de maleta verde.png') }}" alt="Equipe de profissionais do abrigo" class="servico-img">

            <div class="container servico-texto">
                <h2>Profissionais Capacitados</h2>
                <p>
                    Equipe multidisciplinar com experiência formada por médicos,
                    enfermeiros, nutricionistas e cuidadoras de idosos.
                </p>
            </div>
        </section>

        <section class="coração">
            <img src="{{ asset('imagens/Coração verde simétrico em destaque.png') }}" alt="Ícone de cuidado e solidariedade" class="coração-img">
            <div class="container coração-texto">
                <h2>Amor e Dedicação</h2>
                <p>
                    Cuidamos de cada idoso com carinho, respeito e atenção personalizada.
                </p>
            </div>
        </section>

        <section class="remedio">
            <img src="{{ asset('imagens/Ícone de cápsula verde.png') }}" alt="Ícone de medicação e cuidado com a saúde" class="remedio-img">
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
                        O Abrigo Santa Luzia nasceu em 1980 a partir de um terreno doado com uma capelinha dedicada a
                        Santa Luzia. Desde então, cresceu com o apoio de irmãs religiosas, voluntários e doações da
                        comunidade para oferecer abrigo e cuidados a senhoras idosas.
                    </p>
                    <p id="sobreExtra" class="sobre-extra">
                        Em 1977, a primeira missa foi celebrada pelo Dom Plácido de Azevedo Pontes/SB. A partir de 1980,
                        as irmãs Maria Bezerra de Lima, Odete Ribeiro dos Santos e Maria Salete Miranda de Albuquerque
                        chegaram para iniciar o grande desafio do Abrigo. Em 1983 a capela foi ampliada e, em 1985, a
                        comunidade passou a pertencer à Paróquia Nossa Senhora do Carmo. Desde então, o Abrigo foi
                        registrado em conselhos assistenciais e continuou a se fortalecer com doações, benfeitores e a
                        dedicação das irmãs e frades que assumiram a assistência espiritual e o cuidado dos moradores.
                    </p>
                    <button type="button" class="btn" id="btnSobreToggle">Saiba mais</button>
                </div>
            </div>
        </section>

        <section id="projetos" class="container projetos-card">
            <div class="texto-projetos">
                <h2>Projetos</h2>
                <p>No Abrigo Santa Luzia, desenvolvemos diversos projetos para enriquecer a vida das nossas residentes.
                    Oferecemos atividades recreativas como dança, culinária em grupo e brincadeiras, além de cuidados de
                    saúde especializados, incluindo acompanhamento médico e terapias. Nossos projetos visam promover o
                    bem-estar físico, emocional e social, garantindo um ambiente de amor e dedicação contínua.</p>
            </div>

            <div class="cards">

                <div class="card">
                    <img src="{{ asset('imagens/brincando.jpg') }}" alt="Atividade recreativa com residentes" class="card-img">
                    <div class="card-texto">
                        <h2>Atividades Recreativas</h2>
                        <p>
                            Oferecemos atividades como música, artesanato e passeios para estimular o bem-estar.
                        </p>

                    </div>
                </div>

                <div class="card">
                    <img src="{{ asset('imagens/mão de velho.png') }}" alt="Mãos de uma pessoa idosa em destaque" class="card-img">
                    <div class="card-texto">
                        <h2>Cuidados Humanizados</h2>
                        <p>
                            Atendimento com carinho e respeito, focado na dignidade de cada idoso.
                        </p>

                    </div>
                </div>

                <div class="card">
                    <img src="{{ asset('imagens/vó e neto.jpg') }}" alt="Encontro entre avó e neto" class="card-img">
                    <div class="card-texto">
                        <h2>Saúde e Bem-estar</h2>
                        <p>
                            Monitoramento constante da saúde com suporte profissional especializado.
                        </p>

                </div>
            </div>

        </section>

        <section id="doacoes" class="container doacoes">
            <div class="card doacoes-card">
                <div class="doacoes-texto">
                    <h2>Doações</h2>
                    <p>Ajude-nos a continuar nosso trabalho de amor e dedicação. Suas doações fazem a diferença na vida
                        das
                        nossas residentes. Você pode doar via PIX usando as informações abaixo.</p>

                    <h3>Chave PIX</h3>
                    <table class="pix-table">
                        <tr>
                            <th>Tipo</th>
                            <th>Chave</th>
                        </tr>
                        <tr>
                            <td>CNPJ</td>
                            <td>12.345.678/0001-90</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>doacoes@abrigosantaluzia.org</td>
                        </tr>
                    </table>

                    <h3>QR Code para Doação</h3>
                    <table class="qrcode-table">
                        <tr>
                            <th>QR Code PIX</th>
                        </tr>
                        <tr>
                            <td><img src="data:image/png;base64,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"
                                    alt="QR Code PIX"></td>
                        </tr>
                    </table>
        </section>

    </main>

    <footer class="footer">
        <div id="footerGrid" class="container footer-grid">
            <div class="footer-col footer-contact">
                <h4>Contato</h4>
                <p>📞 (11) 1234-5678</p>
                <p>✉ contato@abrigosantaluzia.org</p>
                <p>📍Rua Santa Luzia, 123 - São Paulo, SP</p>
                <p>Localização Exata do Local</p>
                <a href="https://www.google.com/maps/place/Abrigo+Santa+Luzia/@-8.2095747,-34.954532,3a,90y,349.09h,77.5t/data=!3m7!1e1!3m5!1sBzfxBG4bXg_4ch6Nwrks-A!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fcb_client%3Dmaps_sv.tactile%26w%3D900%26h%3D600%26pitch%3D12.497911746468631%26panoid%3DBzfxBG4bXg_4ch6Nwrks-A%26yaw%3D349.0860517837542!7i16384!8i8192!4m10!1m2!2m1!1song+santa+luzia!3m6!1s0x7aae3a7e74f18d5:0xce70b6e3fe587fc0!8m2!3d-8.209556!4d-34.954554!15sCg9vbmcgc2FudGEgbHV6aWFaESIPb25nIHNhbnRhIGx1emlhkgEHc2hlbHRlcpoBRENpOURRVWxSUVVOdlpFTm9kSGxqUmpsdlQycFNkVmxzVWpaa1YzUXdXbXhPU21OVVJuQk1WVTVVVmpJMVVWUkdSUkFC4AEA-gEECAAQKQ!16s%2Fg%2F11h4mrwhjl?entry=ttu&g_ep=EgoyMDI2MDMyMi4wIKXMDSoASAFQAw%3D%3D"
                    target="_blank" class="btn footer-btn">CLICK AQUI</a>
            </div>

            <div class="footer-col footer-social">
                <h4>Siga Nossas Redes</h4>
                <div class="sociais">
                    <a href="#" class="social-link facebook" aria-label="Facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22 12C22 6.48 17.52 2 12 2S2 6.48 2 12c0 5 3.66 9.13 8.44 9.88v-6.99H7.9v-2.89h2.54V9.62c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.87h2.78l-.44 2.89h-2.34V22C18.34 21.13 22 17 22 12Z" />
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/abrigo_santaluzia/" target="_blank" class="social-link instagram"
                        aria-label="Instagram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7Zm10 2c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3h10Zm-5 2.3a5.7 5.7 0 1 0 0 11.4 5.7 5.7 0 0 0 0-11.4Zm0 2a3.7 3.7 0 1 1 0 7.4 3.7 3.7 0 0 1 0-7.4Zm4.8-.5a1.3 1.3 0 1 1 0 2.6 1.3 1.3 0 0 1 0-2.6Z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="footer-col footer-links">
                <h4>Links Rápidos</h4>
                <ul class="footer-links">
                    <li><a href="#quem-somos">Quem Somos</a></li>
                    <li><a href="#projetos">Projetos</a></li>
                    <li><a href="#doacoes">Doações</a></li>
                    <li><a href="{{ route('dashboard') }}">Admin</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <div class="copyright">
        <p>&copy; 2024 Abrigo Santa Luzia. Todos os direitos reservados. | Desenvolvido com ❤️ para um futuro
            melhor.
        </p>
    </div>
    <div></div>

    <script src="{{ asset('js/config.js') }}"></script>
    <script>
        const btnSobreToggle = document.getElementById('btnSobreToggle');
        const sobreExtra = document.getElementById('sobreExtra');
        if (btnSobreToggle && sobreExtra) {
            btnSobreToggle.addEventListener('click', () => {
                const expanded = sobreExtra.classList.toggle('expanded');
                btnSobreToggle.textContent = expanded ? 'Ver menos' : 'Saiba mais';
            });
        }
    </script>
    <x-accessibility-feedback />
</body>

</html>