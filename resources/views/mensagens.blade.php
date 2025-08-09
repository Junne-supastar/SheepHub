<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mensagem.css">
    <title>Mensagens</title>
</head>
<body>
    <aside class="sidebar">
        <br>
        <div class="logo">
            <div class="ligo">
                <img src="{{ asset('img/ovelha.png') }}" alt="SheepHub Logo" class="ovelha">
                <p class="shep">SheepHub</p>
            </div>
            <hr>
        </div>
        <nav>
            <ul>
                <br><br>
                <li><img src="{{ asset('img/homebranca.png') }}" alt="" class="icones"><a href="feed2.html">Feed</a></li>
                <br>
                <li><img src="{{ asset('img/mensagempreto.png') }}" alt="" class="icones" id="tamanho"><a href="mensagens.html" id="iconescuro">Mensagens</a></li>
                <br>
                <li><img src="{{ asset('img/eventos.png') }}" alt="" class="icones"><a href="eventos.html">Eventos</a></li>
                <br>
                <li><img src="{{ asset('img/greja.png') }}" alt="" class="icones"><a href="#">Igrejas</a></li>
                <br>
                <li><img src="{{ asset('img/perfil.png') }}" alt="" class="icones"><a href="perfil.html">Meu Perfil</a></li>
                <br>
                <li><button class="postar"><a href="#">Postar</a></button></li>
                <hr>
                <br>
                <li><img src="{{ asset('img/config.png') }}" alt="" class="icones"><a href="#">Configurações</a></li>
                <br>
                <li><img src="{{ asset('img/sair.png') }}" alt="" class="icones"><a href="#">Sair</a></li>
            </ul>
        </nav>
    </aside>

    <div class="main-content">
        <header class="top-bar">
            <input type="search" placeholder="Pesquisar" class="pesquisa">
            <img src="{{ asset('img/Vector.png') }}" alt="" class="lupa">
            <div class="user-info">
                <img src="{{ asset('img/clara.png') }}" alt="User Avatar">
                <span>Clara Silva</span>
            </div>
        </header>

        <div class="container-fluid">
            <section id="member-list">
                <section id="nav-pags">
                    <ul>
                        <li><a href="" class="selected">Contatos</a></li>
                        <li><a href="">Ligações</a></li>
                        <li><a href="">Não lidos</a></li>
                        <li><a href="">Arquivados</a></li>
                        <li><a href="">Grupos</a></li>
                    </ul>
                </section>

                <h2 id="gradiente">Lista de membros</h2>

                <table>
                    {{-- Comece seus loops aqui --}}
                    <tr class="membros-linha">
                        <td class="contato" onclick="mostrarChat('chat1')">
                            <div>
                                <img src="{{ asset('img/foto1.png') }}" alt="">
                                <p>Emauelle Tomaz</p>
                            </div>
                            <div>
                                <p>10:56</p>
                                <a href="#"><img src="{{ asset('img/notification.png') }}" alt=""></a>
                            </div>
                        </td>
                    </tr>
                    {{-- Adicione mais contatos conforme necessário --}}
                </table>

                {{-- Área dos chats --}}
                <div id="chat1" class="chat-area">
                    <button class="fechar" onclick="fecharChat('chat1')">X</button>
                    <h3>Emauelle Tomaz</h3>
                    <textarea placeholder="Digite sua mensagem..." id="mensagem1"></textarea>
                    <button class="enviar" id="btnmensagem1" onclick="enviarMensagem('mensagem1')">Enviar</button>
                </div>
                {{-- Copie e edite os blocos de chat manualmente para os demais contatos --}}
            </section>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.data1Tables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    <script>
        function mostrarChat(id) {
            document.querySelectorAll('.chat-area').forEach(chat => {
                chat.style.display = 'none';
            });
            let chatSelecionado = document.getElementById(id);
            chatSelecionado.style.display = 'block';
            chatSelecionado.style.opacity = 0;
            setTimeout(() => chatSelecionado.style.opacity = 1, 100);
        }

        function fecharChat(id) {
            document.getElementById(id).style.display = 'none';
        }

        function enviarMensagem(id) {
            let campoMensagem = document.getElementById(id);
            if (campoMensagem.value.trim() !== "") {
                setTimeout(() => {
                    fecharChat(id);
                }, 200);
            } else {
                alert("Digite uma mensagem antes de enviar!");
            }
        }
    </script>
</body>
</html>
