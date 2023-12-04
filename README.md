<h1>Projeto Primeira Agenda</h1>
<hr>

O Projeto Primeira Agenda foi desenvolvido como parte de um desafio de programação para uma vaga de estágio, onde o objetivo era criar uma agenda telefônica utilizando Laravel 10. O projeto visa atender as seguintes funcionalidades requeridas:
<br>

**Criar Contato:**
- Permite adicionar novos contatos à agenda, incluindo informações como nome, número de telefone, e outras informações relevantes.
<br>

**Editar Contato:**
- Oferece a capacidade de editar as informações de um contato existente na agenda, proporcionando uma experiência de usuário flexível.
<br><br>

**Excluir Contato:**<br>
- Permite remover contatos da agenda, garantindo a facilidade de gerenciar a lista de contatos.
<br>

**Pesquisar Contato:**
- Implementa uma funcionalidade de pesquisa que possibilita aos usuários encontrar rapidamente um contato específico na agenda.
<hr>

**Tecnologias Utilizadas**

O projeto foi construído utilizando Laravel 10, um framework PHP moderno e robusto. Laravel oferece uma estrutura elegante e eficiente para o desenvolvimento de aplicativos web, facilitando a implementação das funcionalidades requeridas.

Além dele, outras tecnologias foram utilizadas, veja abaixo algumas delas.

[![image](https://skillicons.dev/icons?i=js,html,css,php,laravel,jquery,bootstrap,mysql)]('https://www.github.com/thesckurtt')
<hr><br>

<h2>Instalar Projeto via instalador</h2>

Você pode baixar o instalador no botão abaixo 👇

<p align="left">
    <a href="https://download1511.mediafire.com/a4bskrdee1ngs14J63w5-aRpG7Vue0nDcyNXOfyEnmHoQNexP2aAFwh2APZkLFW0uiT_sroDojkesGdngf2EiYNSJAJGrcYdlHrrw1C5VSwcqhSFXs6hJnNIK33OrNGa-2xoeqyvo5OIx3r9L0q1jLLd70IhONf4ksmlMeHm6oGgTA/ahcg9gq13ieg4rp/Primeira+Agenda+Install.rar">
    <img src="https://github.com/thesckurtt/primeira_agenda_laravel_2023/assets/36058994/fe2b5c89-f7c6-4b4f-99aa-ca97e020e237" width="350" title="hover text">
    </a>
</p>

**Primeiro clique no .bat**

![image](https://github.com/thesckurtt/primeira_agenda_laravel_2023/assets/36058994/06455e57-43bd-4168-833c-1f57540d462a)

**O repositório começara a ser clonado**

![image](https://github.com/thesckurtt/primeira_agenda_laravel_2023/assets/36058994/a4bafdc5-bac0-4396-9d9e-2b26df229380)

**Coloque suas credênciais**

![image](https://github.com/thesckurtt/primeira_agenda_laravel_2023/assets/36058994/f3417c39-3641-482b-8c3f-d2ae739d18f0)

**Pressione qualquer tecla após mensagem**

![image](https://github.com/thesckurtt/primeira_agenda_laravel_2023/assets/36058994/d834ac51-0c0f-4139-9617-b6e5a2f9a30b)

**Aguarde o composer concluir a instalação(janela secundária)**

![image](https://github.com/thesckurtt/primeira_agenda_laravel_2023/assets/36058994/dac20d1b-a6e7-4f0a-baa8-976f376baf92)

**migrations e Seeders completas**

![image](https://github.com/thesckurtt/primeira_agenda_laravel_2023/assets/36058994/b9e6c278-ed44-4ee0-879c-ff765eddc242)

Pronto, agora é so acessar `http://localhost:8000`.


<h2>Instalar Projeto via terminal</h2>

**Para executar o projeto em sua máquina local, siga os passos abaixo:**
<br><br>
**Clone o Repositório:**
```bash
git clone https://github.com/thesckurtt/primeira_agenda_laravel_2023.git
```
<br>

**Instale as Dependências:**
```bash
cd primeira_agenda_laravel_2023
composer install
```
<br>

**Execute as Migrações e Seeders:**
```bash
php artisan migrate --seed
```
<br>

**Inicie o Servidor de Desenvolvimento:**
```bash
php artisan serve
```
<br>

Acesse o aplicativo no navegador em `http://localhost:8000` e comece a explorar o aplicativo!


<h2>Usando a API da aplicação </h2>

A API da aplicação busca usuários cadastrados pelo número de telefone.

**Você pode usar API da seguinte forma:**

`http://localhost:8000/api/v1/` + `54235234534`

Retorno se o numero passado pertencer a um usuário
![image](https://github.com/thesckurtt/primeira_agenda_laravel_2023/assets/36058994/0ff968cc-f162-4e3a-87be-84f4bf7aefa9)

Retorno se número passado não pertencer a nenhum usuário
![image](https://github.com/thesckurtt/primeira_agenda_laravel_2023/assets/36058994/2402d2dd-7a01-4fad-a757-e1e85e3a8822)

