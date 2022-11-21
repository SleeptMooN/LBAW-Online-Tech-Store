# EAP: Architecture Specification and Prototype

 OnlyT3ch é uma plataforma web de compras online que permite aos seus utlizadores acesso a um vasto catálogo de produtos informáticos.

## A7: Web Resources Specification

O objetivo deste artefacto é apresentar como a arquitetura da aplicação web a desenvolver é documentada, indicando o catálogo de recursos e as propriedades de cada recurso, incluindo: referências às interfaces gráficas, e o formato das respostas JSON.

### 1. Overview

Esta secção apresenta uma visão geral da aplicação web a implementar, onde são identificados os módulos e brevemente descritos.  

| Módulo | Documentação |
| ---  | ------ |
| **M01: Authentication** | Recursos de Web associados autenticação dos utilizadores. Inclui as seguintes funcionalidades: login/logout, registo.  |
| **M02: User Profiles** | Recursos de Web associados com a gestão de perfil de cada utilizador. Inclui as seguintes funcionalidades: ver e editar a informação do perfil de utilizador. |
| **M03: Products** | Recursos de Web associados com os produtos da loja. Inclui as seguintes funcionalidades: Procurar e ver produto/s, informação do produto. |
| **M04: Orders and Shopping Cart** | Recursos de Web associados com as encomendas ,inclui as seguintes funcionalidades:ver histórico de compras, ver encomenda e realizar checkout. Recursos de Web associados com o carrinho de compras, inclui as seguintes funcionalidades: adicionar, remover produtos e ver carrinho de compras.
| **M05: Static Pages** | Recursos de Web associados com as páginas estáticas: about, contact,terms and conditions ,FAQ.|

### 2. Permissions

Esta secção apresenta as permissões usadas nos módulos para estabelecer as condições de acesso aos recursos.

| Sigla de permissão | Permissão | Descrição |
| ------------------ | --------- | --------- |
| PUB                | Public    | Utilizadores sem qualquer privilégio |
| USR                | User      | Utilizadores autênticados |
| ADM                | Administrator | Administradores do sistema | 
| OWN                | Owner | Utilizador dono da informação | 

### 3. OpenAPI Specification

OpenAPI specification in YAML format to describe the web application's web resources.

Link to the `a7_openapi.yaml` file in the group's repository: https://git.fe.up.pt/lbaw/lbaw2223/Lbaw22114/-/blob/main/Docs/EAP/a7_openapi.yaml


```yaml
openapi: 3.0.0

...
```

---


## A8: Vertical prototype

> Brief presentation of the artefact goals.

### 1. Implemented Features

#### 1.1. Implemented User Stories

> Identify the user stories that were implemented in the prototype.  

| User Story reference | Name                   | Priority                   | Description                   |
| -------------------- | ---------------------- | -------------------------- | ----------------------------- |
| US01                 | Name of the user story | Priority of the user story | Description of the user story |

...

#### 1.2. Implemented Web Resources

> Identify the web resources that were implemented in the prototype.  

> Module M01: Module Name  

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R01: Web resource name | URL to access the web resource |

...

> Module M02: Module Name  

...

### 2. Prototype

> URL of the prototype plus user credentials necessary to test all features.  
> Link to the prototype source code in the group's git repository.  


---


## Revision history

Changes made to the first submission:
1. Item 1
1. ..

***
GROUP22114, 20/11/2022

* António Pedro Cabral dos Santos, up201907156 up201907156@up.pt
* João Margato Borlido Pereira, up201907007 up201907007@up.pt (editor)
* Miguel Ângelo Pacheco Valente, up201704608 up201704608@up.pt