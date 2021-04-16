
# Prova Uniasselvi

### Tecnologias
O site foi construído com utilizando o framework Laravel e MySQL como banco de dados.

### Requisitos

 - Composer ~2.0.x.

### Após baixar

#### Caso não tenha o laravel no seu computador, siga esses passos

 1. No terminal do seu computador execute o seguinte comando: `composer global require laravel/installer` ele irá fazer a instalação do Laravel e assim executar a aplicação sem problemas

#### Prosseguindo com a instalação
2. Vá no arquivo **.env** e faça as alterações pertinentes sobre o banco de dados.

3. Abra o terminal do projeto e rode o seguinte comando: `npm i`. Ele irá instalar todos os arquivos necessários para rodar o projeto;

4. Na pasta **bkp_banco** estão os scripts do banco de dados para fazer os testes e criações (aconselhável a utilização do DBeaver CE para a manipulação do banco);

5. No terminal do projeto execute o comando `php artisan serve` para executar a aplicação e rodar em localhost;
