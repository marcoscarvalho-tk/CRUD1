CRUD 09-02-2020

Funcionalidade: registro de cadastros (nome, email, senha) com opção para
gerenciador e usuario comum, registro e pesquisa de logs, recuperação de senha.

Tectnologias empregadas: PHP, JS, JQuery, Bootstrap.
  
CONFIGURAÇÕES

É necessário a criação de um DB com duas TABLES.
Uma "cadastro" contendo: id, nome, email, senha, status (para ADMIN set 1 ou 0 para usuário).
Outra "log" contendo: id, id_usuario, date_action, action.