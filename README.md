# Estudo de Microserviços

Este repositorio tem como proposito estudar como as linguagens se comportam com a criação de microserviços e também sobre sua comunicação.

## Comunicação entre microserviços

Vamos assumir que a cominicação entre os serviços será.

__Externa__: A comunicação externa será feita via _REST API_
__Mensageria__: A comunicação interna será preferencialmente via _mensageria_, por ser um tipo de cominucação _assincrona_ mantem os serviços menos acoplados 
__GRCP__: Quando não for possivel fazer a comunicação por mensageria será usado o grcp como comunicação interna _sincrona_

## Serviços

# User
- Linguagem: PHP

# Product
- Linguagem: C#

# Cart
- Linguagem: Python

# Order
- Linguagem: Typescript

Para rodar o api.
```sh
docker compose up -d
```

Para compilar os arquivos de typescript rode.
```sh
docker compose exec node npm run start
```

# Observações

- Este estudo não se propoe a questões de infra como loadbalance e etc...
- Os serviço usam a arquiterura DDD