# BlackBook- Backend

Link para API rodando na nuvem Heroku: [https://backend-bb.herokuapp.com/](https://backend-bb.herokuapp.com/)

A aplicação desenvolvida durante o Projeto Interdisciplinar segui a seguinte estratégia: 

- Criação do script SQL a partir do modelo lógico
- Construção de uma API REST com PHP
- Construção do frontend com o framework javascript Vue.js
- Conexão do backend e frontend através de protocolo HTTP coma biblioteca javascript  axios.js

As motivações para a separação de backend e frontend foram:

- Performance
- Separação do client-side e server-side
- Reutilização do backend tanto para aplicação web quanto para aplicação mobile
- Melhor manutenção
- Melhor experiência do usuário

A Arquitetura final segue o diagrama abaixo

![](https://s3.us-west-2.amazonaws.com/secure.notion-static.com/7d49813f-7dcb-408b-933c-18d41309a000/diagramaPI.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAT73L2G45O3KS52Y5%2F20200707%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20200707T232358Z&X-Amz-Expires=86400&X-Amz-Signature=179b5168cada2827d2ae79b6260f59849befd883e5267aa2ddd2154221ffcdc6&X-Amz-SignedHeaders=host&response-content-disposition=filename%20%3D%22diagramaPI.png%22)

## Construção do Backend

O backend foi desenvolvido utilizando a linguagem de programação PHP com o [microframework Slim](http://www.slimframework.com/) para construção da API Rest. O Objetivo desta API é intermediar os dados acessados no frontend com as requisições a base da dados. Utiliza dos verbos HTTP(GET, POST, PUT, DELETE) para realização de um conjunto de rotinas.

O padrão de projeto adotado nessa etapa do desenvolvimento foi o modelo MDC(Model, DAO e Controller). A Model agrupa um conjunto de classes referentes a cada tabela do Banco de dados. Os atributos representam as colunas e os métodos são apenas de leitura(getters) e escrita(setters). Já a DAO contém o conjunto de classes referentes a cada tabela do banco de dados. Possui apenas métodos que são de querys SQL. Estende a classe de Conexão com o banco de dados

## Endpoints

Os endpoint são parte das rotas da nossa aplicação. As rotas representam as requisições HTTP que serão feitas a nossa API. Possuem um verbo, uma rota e um método de uma classe dos respectivo controller. Os endpoints retornam uma resposta de acordo com o seu verbo HTTP e o controller que é chamado.

A API é pública e está hospedada em um servidor na nuvem chamado Heroku, podendo ser acessado através da URL: 

[https://backend-bb.herokuapp.com/](https://backend-bb.herokuapp.com/)

Acessando via browser vamos receber a seguinte resposta em formato JSON caso a API esteja online

```json
// 20200701150454
// https://backend-bb.herokuapp.com/

{
  "message": "A API está rodando normalmente :)"
}-
```

Via browser nós conseguimos acessar diretamente apenas as rotas do tipo GET

Caso deseje testar apenas as endpoints com seus devidos verbos HTTP, sugiro o uso do software [Insomnia](https://insomnia.rest/) ou Postman. 

Lembrando que a melhor visualização do funcionamento da API ocorre através do frontend da aplicação, desenvolvido especificamente para consumir os endpoints do backend.

Abaixo estão listados todos os endpoints da aplicação, com os parâmetro que recebem e as respostas que devolvem.

- POST '/login' -  Valida email e senha do usuário com o que está cadastrado no banco de dados

```json
Parâmetros de requisição

{
	"email": "email@example.com",
	"senha": "example123"
}

Resposta em caso de sucesso

{
	"token": "",
	"refresh_token": "",
	"usuario": "Fulano de Tal",
	"id": 1,
	"email": "email@example.com",
	"cargo": 1
}
```

- POST '/registrar' - Cria um novo usuário

```json
Parâmetros de requisição

{
	"no_usuario": "Fulano de Tal",
	"nu_cpf": "00100100100",
	"email": "email@example.com",
	"senha": "example123",
	"telefone": "61999999999",
	"fk_cargo": 1
}

Respota em caso de sucesso
{
	"message": "Dados enviados com sucesso"
}
```

- GET '/cargos'  - Lista os cargos cadastrados no banco de dados

```json
Sem parâmetros de requisição
//

Resposta em caso de sucesso

[
	{
		"pk_cargo": "1",
		"no_cargo": "administrador"
	},
	{
		"pk_cargo": "2",
		"no_cargo": "dentista"
	},
	{
		"pk_cargo": "3",
		"no_cargo": "auxiliar"
	},
	{
		"pk_cargo": "4",
		"no_cargo": "funcionario"
	}
]
```

- GET '/usuarios' - Lista todos usuários cadastrados na aplicação

```json
Sem parâmetros de requisição
//
Resposta em caso de sucesso
[
	{
		"pk_usuario": "1",
		"no_usuario": "Fulano de Tal",
		"nu_cpf": "00100100100",
		"email": "email@example.com",
		"senha": "example123",
		"telefone": "61999999999",
		"fk_cargo": 1,
		"no_cargo": "administrador"
	},
	...
]
```

- GET '/usuario' - Lista apenas o usuário do id passado como parâmetro na URL

```json
Parametro passado na url como '/usuario?id=1'
//
Resposta em caso de sucesso
[
	{
		"pk_usuario": "1",
		"no_usuario": "Fulano de Tal",
		"nu_cpf": "00100100100",
		"email": "email@example.com",
		"senha": "example123",
		"telefone": "61999999999",
		"fk_cargo": 1,
		"no_cargo": "administrador"
	}
]
```

- DELETE '/usuario' - Delete o usuário cuijo ID foi passado como parâmetro na URL

```json
Parametro passado na url como '/usuario?id=1'
//
Resposta em caso de sucesso
{
	"message": "Exclusao realizada com sucesso"
}
```

- PUT '/usuario' - Atualiza o usuário com a o id equivalente ao passado no parâmetro

```json
Parâmetros de requisição

{
	"pk_usuario": "1"
	"no_usuario": "Fulano de Tal",
	"nu_cpf": "00100100100",
	"email": "email@example.com",
	"telefone": "61999999999",
	"fk_cargo": "1",
	"senha": "example123",
}

Resposta em caso de sucesso
{
	"message": "Alteracao realizada com sucesso"
}
```

- POST '/fornecedores'  - Cadastra um fornecedor

```json
Parâmetros de requisição

{
	"no_fornecedor": "XPTO",
	"email": "xpto@example.com",
	"telefone": "61988899999"
}

Resposta em caso de sucesso
{
	"message": "Dados enviados com sucesso"
}
```

- PUT '/fornecedor' - Atualiza as informações do fornecedor

```json
Parâmetros de requisição

{
	"pk_fornecedor": "1",
	"no_fornecedor": "XPTO",
	"email": "xpto@example.com",
	"telefone": null
}

Resposta em caso de sucesso
{
	"message": "Alteracao realizada com sucesso"
}
```

- DELETE '/fornecedor' - Delete o fornecedor cujo id é passado como parâmetro na URL

```json
Parametro passado na url como '/fornecedor?id=1'
//
Resposta em caso de sucesso
{
	"message": "Exclusao realizada com sucesso"
}
```

- GET '/fornecedores' - Lista todos os fornecedores cadastrados

```json
Sem parâmetros de requisição
//
Resposta em caso de sucesso
[
	{
		"pk_fornecedor": "1",
		"no_fornecedor": "XPTO",
		"email": "xpto@example.com",
		"telefone": null
	},
	...
]
```

- GET '/fornecedor' - Lista o fornecedor cujo id é passado como parâmetro na URL

```json
Parametro passado na url como '/fornecedor?id=1'
//

Resposta em caso de sucesso
[
	{
		"pk_fornecedor": "1",
		"no_fornecedor": "XPTO",
		"email": "xpto@example.com",
		"telefone": null
	}
]
```

- POST '/categoria' - Cria uma nova categoria

```json
Parâmetros de requisição
{
	"no_categoria": "pereciveis"
}

Resposta em caso de sucesso
{
	"message": "Dados enviados com sucesso"
}
```

- DELETE '/categoria' - Deleta a categoria cujo id é passado como parâmetro na URL

```json
Parametro passado na url como '/categoria?id=1'
//
Resposta em caso de sucesso
{
	"message": "Exclusao realizada com sucesso"
}
```

- PUT '/categoria' - Atualiza a categoria

```json
Parâmetros de requisição
{
	"pk_categoria": "1",
	"no_categoria": "nao pereciveis"
}

Resposta em caso de sucesso
{
	"message": "Alteracao realizada com sucesso"
}
```

- GET '/categoria'  - Lista a categoria cujo id é passado como parâmetro na URL

```json
Parametro passado na url como '/categoria?id=1'
//
Resposta em caso de sucesso
[
	{
		"pk_categoria": "1",
		"no_categoria": "nao pereciveis"
	}
]
```

- GET '/categorias' - Lista todas as categorias cadastradas

```json
Sem parâmetros de requisição
//
Resposta em caso de sucesso
[
	{
		"pk_categoria": "1",
		"no_categoria": "nao pereciveis"
	},
	...
]
```

- POST  '/produto' - Cria um novo produto no registro do banco de dados

```json
Parâmetros de requisição
{
	"no_produto": "Luvas Cirúrgicas",
	"marca": "GlovesBR",
	"descricao": null,
	"qtd_minima": 40,
	"qtd_max": 400,
	"qtd_total": 0,
	"fk_categoria": 1
}

Resposta em caso de sucesso
{
	"message": "Dados enviados com sucesso"
}
```

- DELETE '/produto' - delete o produto cujo id é passado como parâmetro na URL

```json
Parametro passado na url como '/produto?id=1'
//
Resposta em caso de sucesso
{
	"message": "Exclusao realizada com sucesso"
}

```

- PUT '/produto' - atualiza as informações do produto

```json
Parâmetros de requisição
{
	"pk_produto": "1",
	"no_produto": "Luvas Cirúrgicas",
	"marca": "GlovesBR",
	"descricao": null,
	"qtd_minima": 40,
	"qtd_max": 400,
	"qtd_total": 0,
	"fk_categoria": 1
}

Resposta em caso de sucesso
{
	"message": "Alteracao realizada com sucesso"
}
```

- GET '/produto' - Lista o produto cujo o id é passado como parâmetro na URL

```json
Parametro passado na url como '/produto?id=1'
//
Resposta em caso de sucesso
[
	{
		"pk_produto": "1",
		"no_produto": "Luvas Cirúrgicas",
		"marca": "GlovesBR",
		"descricao": null,
		"qtd_minima": 40,
		"qtd_max": 400,
		"qtd_total": 0,
		"fk_categoria": 1,
		"no_categoria": "nao pereciveis"
	}
]
```

- GET '/produtos' - Lista todos os produtos cadastrados

```json
 Sem parâmetros de requisição
//
Resposta em caso de sucesso
[
	{
		"pk_produto": "1",
		"no_produto": "Luvas Cirúrgicas",
		"marca": "GlovesBR",
		"descricao": null,
		"qtd_minima": 40,
		"qtd_max": 400,
		"qtd_total": 0,
		"fk_categoria": 1,
		"no_categoria": "nao pereciveis"
	},
	...
]
```

- POST '/entrada' - Cria uma nova entrada de produto

```json
Parâmetros de requisição
{
	"data_entrada": "2020-07-01 17:00:00",
	"qtd_item": "90",
	"valor_item": "57.90",
	"fk_produto": 1,
	"fk_usuario": 1,
	"fk_fornecedor": 1
}

Resposta em caso de sucesso
{
	"message": "Dados enviados com sucesso"
}
```

- DELETE '/entrada' - Deleta a entrada do produto cujo id é passado como parâmetro na URL

```json
Parâmetro passado na url como '/produto?id=1'
//
Resposta em caso de sucesso
{
	"message": "Exclusao realizada com sucesso"
}

```

- PUT '/entrada'  -Atualiza a entrada do produto cujo id é passado como parâmetro na URL

```json
Parâmetros de requisição
{
	"pk_entrada": 1,
	"data_entrada": "2020-07-01 17:10:00",
	"qtd_item": "90",
	"valor_item": "57.90",
	"fk_produto": 1,
	"fk_usuario": 1,
	"fk_fornecedor": 1
}

Resposta em caso de sucesso
{
	"message": "Alteracao realizada com sucesso"
}
```

- GET '/entrada' - Lista o produto cujo o id é passado como parâmetro na URL

```json
Parâmetro passado na url como '/entrada?id=1'
//
Resposta em caso de sucesso
[
	{
		"pk_entrada": 1,
		"data_entrada": "2020-07-01 17:10:00",
		"qtd_item": "90",
		"valor_item": "57.90",
		"fk_produto": 1,
		"fk_usuario": 1,
		"fk_fornecedor": 1,
		"no_produto": "Luvas Cirúrgicas",
		"no_usuario": "Fulano de Tal",
		"no_fornecedor": "XPTO"
	}
]```json
Parâmetro passado na url como '/entrada?id=1'
//
Resposta em caso de sucesso
[
	{
		"pk_entrada": 1,
		"data_entrada": "2020-07-01 17:10:00",
		"qtd_item": "90",
		"valor_item": "57.90",
		"fk_produto": 1,
		"fk_usuario": 1,
		"fk_fornecedor": 1,
		"no_produto": "Luvas Cirúrgicas",
		"no_usuario": "Fulano de Tal",
		"no_fornecedor": "XPTO"
	}
]
```
```

- GET  '/entradas' - Lista todas as entradas cadastradas

```json
Sem parâmetros de requisição
//
Resposta em caso de sucesso
[
	{
		"pk_entrada": 1,
		"data_entrada": "2020-07-01 17:10:00",
		"qtd_item": "90",
		"valor_item": "57.90",
		"fk_produto": 1,
		"fk_usuario": 1,
		"fk_fornecedor": 1,
		"no_produto": "Luvas Cirúrgicas",
		"no_usuario": "Fulano de Tal",
		"no_fornecedor": "XPTO"
	},
	...
]
```

- POST  '/saida' - Cria uma nova saída de produto

```json
Parâmetros de requisição
{
	"qtd_item": 10,
	"data_saida": "2020-07-02 14:00:00",
	"fk_produto": 1,
	"fk_usuario": 1
}

Resposta em caso de sucesso
{
	"message": "Dados enviados com sucesso"
}
```

- DELETE '/saida'

```json
Parâmetro passado na url como '/saida?id=1'
//
Resposta em caso de sucesso
{
	"message": "Exclusao realizada com sucesso"
}
```

- PUT '/saida'

```json
Parâmetros de requisição
{
	"pk_saida": 1,
	"qtd_item": 10,
	"data_saida": "2020-07-02 14:10:00",
	"fk_produto": 1,
	"fk_usuario": 1
}

Resposta em caso de sucesso
{
	"message": "Alteracao realizada com sucesso"
}
```

- GET '/saida'

```json
Parâmetro passado na url como '/saida?id=1'
//
Resposta em caso de sucesso
[
	{
		"pk_saida": 1,
		"qtd_item": 10,
		"data_saida": "2020-07-02 14:10:00",
		"fk_produto": 1,
		"fk_usuario": 1
		"no_produto": "Luvas Cirúrgicas",
		"no_usuario": "Fulano de Tal",
	}
]
```

- GET '/saidas'

```json
Sem parâmetros de requisição
//
Resposta em caso de sucesso
[
	{
		"pk_saida": 1,
		"qtd_item": 10,
		"data_saida": "2020-07-02 14:10:00",
		"fk_produto": 1,
		"fk_usuario": 1
		"no_produto": "Luvas Cirúrgicas",
		"no_usuario": "Fulano de Tal",
	},
	...
]
```
