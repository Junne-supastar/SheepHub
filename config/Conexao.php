 <?php

if (!class_exists('Conexao')) {
    class Conexao {
        private static $instancia;

        public static function getConexao() {
            if (!isset(self::$instancia)) {
                try {
                    self::$instancia = new PDO(
                        'mysql:host=localhost;dbname=sheephub;charset=utf8', 
                        'root', // seu usuário do MySQL
                        ''      // sua senha do MySQL
                    );
                    self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die('Erro de conexão: ' . $e->getMessage());
                }
            }
            return self::$instancia;
        }
    }
}

/*if (!class_exists('Conexao')) {
    class Conexao {
        private static $instancia;

        public static function getConexao() {
            if (!isset(self::$instancia)) {
                try {
                    self::$instancia = new PDO('mysql:host=localhost;dbname=sheephub;charset=utf8', 'root', '');
                    self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die('Erro de conexão: ' . $e->getMessage());
                }
            }
            return self::$instancia;
        }
    }
}*/
