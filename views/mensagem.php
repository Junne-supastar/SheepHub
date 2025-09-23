<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mensagem.css">
    <title>Mensagens</title>
</head>
<body>
<?php include __DIR__ . '/includes/sidebar.php'; ?>

  <div class="main-content">
    <header class="top-bar">
      <input type="search" placeholder="Pesquisar" class="pesquisa">
      <img src="imgfeed/Vector.png" alt="" class="lupa">
      <div class="user-info">
        <img src="imgfeed/clara.png" alt="User Avatar">
        <span>Clara Silva</span>
      </div>
    </header>
    

    <!-- Begin Page Content -->
                <div class="container-fluid">
            

                    <!-- Page Heading -->
                    
                        
                    <!-- <p class="mb-4">O gerenciamento de membros do SheepHub permite que você adicione um membro a uma escala, verifique seus dados e conheça melhor a sua igreja.</p> -->

                    <!-- DataTales Example -->
                    <section id="member-list">
                        <section id="nav-pags">
                            <ul>
                                <li><a href="" class="selected">Contatos</a></li>
                                <li><a href=""> Ligações</a></li>
                                <li><a href=""> Não lidos</a></li>
                                <li><a href=""> Arquivados</a></li>
                                <li><a href=""> Grupos</a></li>
                            </ul>
                        </section>

                        <h2 id="gradiente">Lista de membros</h2>
            
                        <table>
                            
                            <tr class="membros-linha">
                                <td class="contato" onclick="mostrarChat('chat1')">
                                    <div>
                                        <img src="img/foto1.png" alt="">
                                        <p>Emauelle Tomaz</p>
                                    </div>
                                    
                                    <div>
                                        <p>10:56</p>
                                        <a href=""><img src="img/notification.png" alt=""></a>
                                    </div>
                                </td>
                            </tr>

                            <tr class="membros-linha">
                                <td class="contato" onclick="mostrarChat('chat2')">
                                    <div>
                                        <img src="img/Ellipse 81 (6).png" alt="">
                                        <p>Gustavo Silva</p>
                                    </div>
                                    
                                    <div>
                                        <p>08:23</p>
                                        <a href=""><img src="img/notification.png" alt=""></a>
                                    </div>
                                </td>
                            </tr>

                            <tr class="membros-linha">
                                <td class="contato" onclick="mostrarChat('chat3')">
                                    <div>
                                        <img src="img/Ellipse 81 (7).png" alt="">
                                        <p>Julianne Parga</p>
                                    </div>
                                    
                                    <div>
                                        <p>Ontem</p>
                                        <a href=""><img src="img/notification.png" alt=""></a>
                                    </div>
                                </td>
                            </tr>

                            <tr class="membros-linha">
                                <td class="contato" onclick="mostrarChat('chat4')">
                                    <div>
                                        <img src="img/Ellipse 81 (8).png" alt="">
                                        <p>Breno Pessôa</p>
                                    </div>
                                    
                                    <div>
                                        <p>Sábado</p>
                                        <a href=""><img src="img/notification.png" alt=""></a>
                                    </div>
                                </td>
                            </tr>

                            <tr class="membros-linha">
                                <td class="contato" onclick="mostrarChat('chat5')">
                                    <div>
                                        <img src="img/Ellipse 81 (9).png" alt="">
                                        <p>Jonathas Oliveira</p>
                                    </div>
                                    
                                    <div>
                                        <p>07/04/24</p>
                                        <a href=""><img src="img/notification.png" alt=""></a>
                                    </div>
                                </td>
                            </tr>

                            <tr class="membros-linha">
                                <td class="contato" onclick="mostrarChat('chat6')">
                                    <div>
                                        <img src="img/Ellipse 81 (10).png" alt="">
                                        <p>Geovanna Silva</p>
                                    </div>
                                    
                                    <div>
                                        <p>11/02/2020</p>
                                        <a href=""><img src="img/notification.png" alt=""></a>
                                    </div>
                                </td>
                            </tr>
                            
                            <div id="chat1" class="chat-area">
                            <button class="fechar" onclick="fecharChat('chat1')">X</button>
                            <h3>Emauelle Tomaz</h3>
                            <textarea placeholder="Digite sua mensagem..." id="mensagem1"></textarea>
                            <button class="enviar" id="btnmensagem1" onclick="enviarMensagem('mensagem1')">Enviar</button>
                            </div>
    
                            <div id="chat2" class="chat-area">
                            <button class="fechar" onclick="fecharChat('chat2')">X</button>
                            <h3>Gustavo Silva</h3>
                            <textarea placeholder="Digite sua mensagem..." id="mensagem2"></textarea>
                            <button class="enviar" id="btnmensagem2" onclick="enviarMensagem('mensagem2')">Enviar</button>
                            </div>
    
                            <div id="chat3" class="chat-area">
                            <button class="fechar" onclick="fecharChat('chat3')">X</button>
                            <h3>Julianne Parga</h3>
                            <textarea placeholder="Digite sua mensagem..." id="mensagem3"></textarea>
                            <button class="enviar" id="btnmensagem3" onclick="enviarMensagem('mensagem3')">Enviar</button>
                            </div>
    
                            <div id="chat4" class="chat-area">
                            <button class="fechar" onclick="fecharChat('chat4')">X</button>
                            <h3>Breno Pessôa</h3>
                            <textarea placeholder="Digite sua mensagem..." id="mensagem4"></textarea>
                            <button class="enviar" id="btnmensagem4" onclick="enviarMensagem('mensagem4')">Enviar</button>
                            </div>
    
                            <div id="chat5" class="chat-area">
                            <button class="fechar" onclick="fecharChat('chat5')">X</button>
                            <h3>Jonathas Oliveira</h3>
                            <textarea placeholder="Digite sua mensagem..." id="mensagem5"></textarea>
                            <button class="enviar" id="btnmensagem5" onclick="enviarMensagem('mensagem5')">Enviar</button>
                            </div>
    
                            <div id="chat6" class="chat-area">
                            <button class="fechar" onclick="fecharChat('chat6')">X</button>
                            <h3>Geovanna Silva</h3>
                            <textarea placeholder="Digite sua mensagem..." id="mensagem6"></textarea>
                            <button class="enviar" id="btnmensagem6" onclick="enviarMensagem('mensagem6')">Enviar</button>
                            </div>

     </div>
                        </table>
                        
                    </section>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->  
             
               <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.data1Tables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
    
   function mostrarChat(id) {
    document.querySelectorAll('.chat-area').forEach(chat => {
        chat.style.display = 'none';
    });

    let chatSelecionado = document.getElementById(id);
    chatSelecionado.style.display = 'block';
    chatSelecionado.style.opacity = 0; // Começa transparente
    setTimeout(() => chatSelecionado.style.opacity = 1, 100); // Suaviza a entrada
}
    function fecharChat(id) {
        document.getElementById(id).style.display = 'none';
    }

    function enviarMensagem(id) {
        let campoMensagem = document.querySelector(`#${id} textarea`); // Seleciona a textarea dentro do chat
        if (campoMensagem.value.trim() !== "") {
        setTimeout(() => {
            fecharChat(id); // Fecha a aba do chat automaticamente após um breve intervalo
        }, 200); // Pequeno delay para suavizar
    } 
    else {
        alert("Digite uma mensagem antes de enviar!");
    }
    }
</script>

</body>
</html>