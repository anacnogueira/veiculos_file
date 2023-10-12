# Busca de Veículos Tabela FIPE

Formulário para busca de veículos na tabela FIPE, permitindo a pesquisa por marca, modelo e ano. Desenvolvido em Laravel 10.

## Como instalar

-   Faça o clone do repositório

ˋ git clone https://github.com/anacnogueira/veiculos_fipe.git <nome_projeto>ˋ

** É necessário instalar o Docker antes da execuatr o projeto **
[Como instalar o Docker](https://docs.docker.com/engine/install/)

-   \*\* Dentro da pasta do projeto, execute o seguinte comando no terminal para subir as imagens do porjeto

´´´
docker run --rm --interactive --tty \
 --volume $PWD:/app \
    --user $(id -u):$(id -g) \
 composer install --ignore-platform-req=ext-gd

```

Rode o seguinte comando para execuatr o projeto

´´´
./vendor/bin/sail up -d
´´´

Abra o brownser e emseguida digite http://localhost para abrir o formulario do projeto

**_ Observação _**
Em caso de erro na Application key, gere uma nova chave através do comandao no terminal:

´´´
./vendor/bin/sail artisan key:generate
´´´

-   \*\* Configure um alias de Shell para o Sail

O projeto vem com um container em Docker próprio do Laravel, que facilita a instalção do projeto, rodar comandos do artisan e composer entre outros comodidades, sem a necessidade instalar o PHP, Mysql e extensões em sua maquina.

Por padrão, os comandos Sail são invocados usando o script vendor/bin/sail que está incluído em todas as novas aplicações Laravel:

´´´
./vendor/bin/sail up

```

No entanto, em vez de digitar repetidamente vendor/bin/sail para executar comandos do Sail, você pode querer configurar um alias de shell que permita executar os comandos do Sail com mais facilidade:

´´´
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

```

Para garantir que isso esteja sempre disponível, você pode adicioná-lo ao arquivo de configuração do shell em seu diretório inicial, como ~/.zshrc ou ~/.bashrc, e então reiniciar o shell.

Depois que o alias do shell tiver sido configurado, você poderá executar comandos Sail simplesmente digitando ´´´sail´´´. A partir de agora você pode digitar o comando baixo para subir o container:

´´´
sail up -d
´´´
Esse comando faŕa o mesmo efeito que ´´´ docker-compose up -d ´´´

```

```

```
