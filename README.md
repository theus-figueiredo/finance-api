# API de controle de finanças

Projeto controle de finanças em laravel 10

## Funções

- Armazenar entradas e saídas monetárias
- Categorizar os tipos de entrada e saída para ter um controle das mesmas


o username e senha do mysql no container em questão são respectivamente `sail` e `password`

No projeto há um arquivo .env.example com um exemplo do .env, pode usa-lo como base.

## Instalando projeto e preparando ambiente:

- Clonar o repositório para uma pasta local:

```bash
git git@github.com:theus-figueiredo/finance-api.git
```

- Acessar a pasta do projeto e instalar as dependências:

```bash
cd finance-api
composer install
```

- Iniciar os containers:
```bash
vendor/bin/sail up -d
```

- Executar as migrations:

```bash
vendor/bin/sail exec laravel.test php artisan migrate
```

## Variáveis de ambiente

Para executar o projeto é preciso adicionar algumas variais de ambiente:

`APP_PORT` -> irá definir a porta local em que a aplicação será executada

`FORWARD_DB_PORT` -> irá definir a porta local para qual será mapeado o container com o mysql

`JWT_SECRET` -> para fazer uso das funções do JWT 
```bash
vendor/bin/sail exec app php artisan jwt secret
```

`APP_KEY` -> para armazenar a chave de criptografia usada para proteger os dados sensíveis do aplicativo 
```bash
vendor/bin/sail exec app php artisan key:generate
```


# Mais informações sobre os endpoins virão de acordo com o andar do desenvolvimento