# 🚀 GEO-SAPIENS-FORM-API

<p>
  <img alt="Version" src="https://img.shields.io/badge/php-^8.1-blue.svg?cacheSeconds=2592000" />
  <img alt="Version" src="https://img.shields.io/badge/laravel-^10.10-red.svg?cacheSeconds=2592000" />
  <a href="https://documenter.getpostman.com/view/13040502/UzBjrney#c3212110-5be6-45bd-b000-95c6538746ca" target="_blank">
    <img alt="Documentation" src="https://img.shields.io/badge/documentation-yes-brightgreen.svg" />
  </a>
  <a href="#" target="_blank">
    <img alt="License: MIT" src="https://img.shields.io/badge/License-MIT-yellow.svg" />
  </a>
</p>

> Teste prático com o objetivo de avaliar a capacidade técnica de desenvolvimento de uma API RESTful utilizando o framework Laravel. O desafio consiste em desenvolver uma API basica para gerenciar formulários dinâmicos e os dados preenchidos por usuários. O teste avalia habilidades de arquitetura, desenvolvimento e boas práticas no contexto de APIs RESTful.

## Instalação

1- Clone o repositório

```sh
git clone https://github.com/edvaldotorres/geo-sapiens-form-api.git
```

2- Acesse a pasta do projeto

```sh
cd geo-sapiens-form-api
```

3- Execute o script para instalar as dependências com docker

```sh
sh script-start-docker-compose.sh
```

Obs: Isso pode demorar um pouco, pois o docker irá baixar as imagens necessárias para rodar o projeto.

4- Instale as dependências do projeto

```sh
docker-compose exec php composer install
```

```sh
docker-compose exec php php artisan key:generate
```

5- Rodar as migrações

```sh
docker-compose exec php php artisan migrate
```

## Documentação da API

#### Inserir

- [POST] [/api/v1/forms/{form_id}/fillings](http://localhost:8080/api/v1/forms/form-1/fillings)

Parametros de entrada:

```json
{
  "data": {
    "field-1-1": "John Doe",
    "field-1-2": 22,
    "field-1-3": "Sim"
  }
}
```

Resposta de sucesso:

```json
{
  "form_id": "form-1",
  "data": {
    "field-1-1": "John Doe",
    "field-1-2": 22,
    "field-1-3": "Sim"
  },
  "updated_at": "2024-11-19T15:09:51.000000Z",
  "created_at": "2024-11-19T15:09:51.000000Z",
  "id": 8
}
```

#### Recuperar

- [GET] [/api/v1/forms/{form_id}/fillings](http://localhost:8080/api/v1/forms/form-1/fillings)

Resposta de sucesso:

```json
{
  "id": 1,
  "form_id": "form-1",
  "data": {
    "field-1-1": "John Doe",
    "field-1-2": 25,
    "field-1-3": "Sim"
  },
  "created_at": "2024-11-19T12:16:19.000000Z",
  "updated_at": "2024-11-19T12:16:19.000000Z",
  "deleted_at": null
}
```

## Autor

👤 **Edvaldo Torres de Souza**

- Website: [edvaldotorres.com.br](https://edvaldotorres.com.br/)
- Github: [@edvaldotorres](https://github.com/edvaldotorres)
- LinkedIn: [Edvaldo Torres](https://www.linkedin.com/in/edvaldo-torres-189894150/)
