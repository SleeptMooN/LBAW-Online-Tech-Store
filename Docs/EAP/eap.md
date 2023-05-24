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


Link to the `a7_openapi.yaml`: https://git.fe.up.pt/lbaw/lbaw2223/Lbaw22114/-/blob/main/Docs/EAP/a7_openapi.yaml


```yaml
openapi: 3.0.0

info:
 version: '1.0'
 title: 'LBAW OnlyT3ch Web API'
 description: 'Web Resources Specification (A7) for OnlyT3ch'

servers:
- url: http://lbaw.fe.up.pt
  description: Production server

externalDocs:
 description: Find more info here.
 url: https://git.fe.up.pt/lbaw/lbaw2223/Lbaw22114/-/wikis/eap

tags:
  - name: 'M01: Authentication'
  - name: 'M02: User Profiles'
  - name: 'M03: Products'
  - name: 'M04: Orders and Shopping Cart'
  - name: 'M05: Static Pages'


paths:

# ------------------------------------ M01 ------------------------------------

  /login: ####### Login ########

    get:
      operationId: R101
      summary: 'R101: Login Form'
      description: 'Provide login form. Access: PUB'
      tags:
        - 'M01: Authentication'
      responses:
        '200':
          description: 'Ok. Show log-in UI08'
    post:
      operationId: R102
      summary: 'R102: Login Action'
      description: 'Processes the login form submission. Access: PUB'
      tags:
        - 'M01: Authentication'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:
                  type: string
                password:
                  type: string
                  description: 'URI to return when login is successful.'
              required:
                - email
                - password
      responses:
       '302':
         description: 'Redirect after processing the login credentials.'
         headers:
           Location:
             schema:
               type: string
             examples:
               302Success:
                 description: 'Successful authentication. Redirect to homepage.'
                 value: '/'
               302Error:
                 description: 'Failed authentication. Redirect to login form.'
                 value: '/login'

  /logout: ####### Logout ########

   post:
     operationId: R103
     summary: 'R103: Logout'
     description: 'Logout the current authenticated user. Access: USR, ADM'
     tags:
       - 'M01: Authentication'
     responses:
       '302':
         description: 'Redirect after processing logout.'
         headers:
           Location:
             schema:
               type: string
             examples:
               302Success:
                 description: 'Successful logout. Redirect to homepage.'
                 value: '/'
          
  /register: ####### Register ########
   get:
     operationId: R104
     summary: 'R104: Register Form'
     description: 'Provide new user registration form. Access: PUB'
     tags:
       - 'M01: Authentication'
     responses:
       '200':
         description: 'Ok. Show Sign-Up UI'

   post:
     operationId: R105
     summary: 'R105: Register'
     description: 'Processes the new user registration form submission. Access: PUB'
     tags:
       - 'M01: Authentication'

     requestBody:
       required: true
       content:
         application/x-www-form-urlencoded:
           schema:
             type: object
             properties:
               name:
                 type: string
               email:
                 type: string
               password:
                 type: string
             required:
                      - email
                      - password

     responses:
       '302':
         description: 'Redirect after processing the new user information.'
         headers:
           Location:
             schema:
               type: string
             examples:
               302Success:
                 description: 'Successful authentication. Redirect to user profile.'
                 value: '/users/{id}'
               302Failure:
                 description: 'Failed authentication. Redirect to login form.'
                 value: '/login'
              
  /deleteaccount:  ####### Delete account ########
    post:
      operationId: R106
      summary: "R106: Delete User Account"
      description: 'Delete User account. Access: OWN'
      tags:
        - 'M01: Authentication'

      responses:
        '200':
          description: 'Ok. Account Deleted UI'

# ------------------------------------ M02 ------------------------------------

  /users: ####### view profile ########
   get:
     operationId: R201
     summary: 'R201: View user profile'
     description: 'Show the individual user profile. Access: USR'
     tags:
       - 'M02: User Profiles'

     parameters:
       - in: path
         name: id
         schema:
           type: integer
         required: true

     responses:
       '200':
         description: 'Ok. Show User Profile UI07'

  /users/edit:   
   put:
      operationId: R202
      summary: 'R202: Edit Profile Action'
      description: 'Processes the new user edition form submission. Access: PUB'
      tags:
        - 'M02: User Profiles'
      
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:
                  type: string
                phone:
                  type: integer
                email:
                  type: string

      responses:
        '302':
          description: 'Redirect after processing the user new information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful profile edition. Redirect to user profile.'
                  value: '/users/{id}'
                302Failure:
                  description: 'Failed to edit. Redirect to user profile.'
                  value: '/users/{id}'


# ------------------------------------ M03 ------------------------------------
  
  /products/{id}:  ####### Products ########
    get:  
      operationId: R301
      summary: 'R301: View product'
      description: 'Show product page. Access: PUB'
      tags:
        - 'M03: Products'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
            minimum: 1
          required: true

      responses:
        '200':
          description: 'Ok. Show Product Info Page UI12'

  /api/products:   
    get:
      operationId: R302
      summary: 'R302: Search Products API'
      description: 'Return products information as JSON. Access: PUB'
      tags:
        - 'M03: Products'

      parameters:
        - in: query
          name: text
          description: String to use for full-text search
          schema:
            type: string
          required: false
        - in: query
          name: item
          description: Category of the product
          schema:
            type: string
          required: false
        - in: query
          name: brand
          description: brand of the product
          schema:
            type: string
          required: false

      responses:
        '200':
          description: 'Success'
          content:
            application/json:
              schema:
                type: array
                items:
                  type: object
                  properties:
                    id:
                      type: number
                    name:
                      type: string
                    price:
                      type: number
                    description:
                      type: string
                    quantity:
                      type: number
                    score:
                      type: number
                    photo:
                      type: string
                  example:
                    - id: 1
                      name: Apple iPhone 14 - 512GB - Black
                      price: 1399.99
                      description: lorem ipsum
                      quantity: 7
                      score: 4.7
                      photo: picture1/defaultPicture.png
                    - id: 2
                      name: Apple iPhone 14 Pro Max - 256GB - White
                      price: 1629.99
                      description: lorem ipsum
                      quantity: 9
                      score: 4.9
                      photo: picture2/defaultPicture.png


  /admin/products/create:   ####### Create Products ########
    post:
      operationId: R303
      summary: 'R303: Create product Action'
      description: 'Processes the creation product form. Access: ADM'
      tags:
        - 'M03: Products'
      requestBody:
        required: true
        content:
          application/json:
            schema:
              type: object
              properties:
                    id:
                      type: number
                    name:
                      type: string
                    price:
                      type: number
                    description:
                      type: string
                    quantity:
                      type: number
                    score:
                      type: number
                    photo:
                      type: string
              required:
                 - id
                 - name
                 - price
                 - description
                 - quantity
                 - photo
 
              example:
                    - id: 1
                      name: Apple iPhone 14 - 512GB - Black
                      price: 1399.99
                      description: lorem ipsum
                      quantity: 7
                      score: 4.7
                      photo: picture1/defaultPicture.png
      responses:
        '201':
          description: 'Product was created succesfully'

        '403':
          description: "User doesn't have privileges"

  
  /admin/products/{id}/edit:
    get:
      operationId: R304
      summary: 'R304: View product edit page'
      description: 'Show product edit page. Access: ADM'
      tags:
        - 'M03: Products'
      
      parameters:
        - in: path
          name: id
          schema:
            type: integer
            minimum: 1
          required: true

      responses:
        '200':
          description: 'Ok. Show Edit Product Page UI'
        '403':
          description: 'Forbidden. Not an admin.'


# ------------------------------------ M04 ------------------------------------

  /cart:  ####### Cart ########
    get:
      operationId: R401
      summary: 'R401: View Shopping Cart'
      description: 'Show Shopping Cart. Access: PUB'
      tags:
        - 'M04: Orders and Shopping Cart'

      responses:
        '200':
          description: "Ok. Show Shopping Cart UI"
        '302':
          description: 'User not logged in. Redirect to Home Page'
          headers:
            Location:
              schema:
                type: string
                example: '/'
        '404':
          description: 'Not Found. Show Not Found Page if it is an admin'

  /api/cart/:
    get:
      operationId: R402
      summary: 'R402: Get cart api'
      description: "Return products in user's cart as JSON. Access: OWN"
      tags:
        - 'M04: Orders and Shopping Cart'

      responses:
        '200':
          description: 'Success'
          content:
            application/json:
              schema:
                type: object
                properties:
                  total:
                    type: number
                  items:
                    type: array
                    items:
                      type: object
                      properties:
                        id:
                          type: number
                        name:
                          type: string
                        price:
                          type: number
                        description:
                          type: string
                        quantity:
                          type: number
                        score:
                          type: number
                        photo:
                          type: string
                        amount:
                          type: number
                      example:
                      - id: 1
                        name: Apple iPhone 14 - 512GB - Black
                        price: 1399.99
                        description: lorem ipsum
                        quantity: 7
                        score: 4.7
                        photo: picture1/defaultPicture.png
                        amount: 1
                      - id: 2
                        name: Apple iPhone 14 Pro Max - 256GB - White
                        price: 1629.99
                        description: lorem ipsum
                        quantity: 9
                        score: 4.9
                        photo: picture2/defaultPicture.png
                        amount: 1

        '404':
          description: "User not logged in or is logged in as an admin"


  /product/removeCart:
    delete:
      operationId: R403
      summary: 'R403: Remove a product from cart API'
      description: "Remove a product from the cart. Access: OWN"
      tags:
        - 'M04: Orders and Shopping Cart'
      parameters:
        - in: path
          name: id_Product
          schema:
            type: integer
            minimum: 1
          required: true

      responses:
        '200': 
          description: "Ok. Product was removed from cart"
        '403':
          description: "User not logged in or is logged in as an admin"
        '422':
          description: "Product does not exist or is not in cart."

            
  /product/updateCartItem:
    post:
      operationId: R404
      summary: 'R404: Set product amount on cart API'
      description: "Set product amount on cart. Access: OWN"
      tags:
        - 'M04: Orders and Shopping Cart'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                product_id:
                  type: integer
                  minimum: 1
                amount:
                  type: integer
                  minimum: 1
              required:
                - product_id
                - amount
      responses:
        '200': 
          description: "Ok. Product amount was modified to cart"
        '401':
          description: "User not logged in"
        '403':
          description: "User is logged in as an admin"
        '422':
          description: "Product does not exist, or there is not enough stock."

  /product/addCart:
    post:
      operationId: R405
      summary: 'R405 Add product amount to cart API'
      description: "Add product amount to cart. Access: OWN"
      tags:
        - 'M04: Orders and Shopping Cart'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                product_id:
                  type: integer
                  minimum: 1
                amount:
                  type: integer
                  minimum: 1
              required:
                - product_id
                - amount
      responses:
        '200': 
          description: "Ok. Product amount was added to cart"
        '401':
          description: "User not logged in"
        '403':
          description: "User is logged in as an admin"
        '422':
          description: "Product does not exist, or there is not enough stock."


  /users/orders:   ####### Orders ########
    get:
      operationId: R406
      summary: 'R406: View Profile Purchase History page'
      description: 'Show Profile Purchase History page. Access: OWN'
      tags:
        - 'M04: Orders and Shopping Cart'

      responses:
        '200':
          description: 'Ok. Show Profile Purchase History UI'
        '403':
          description: 'Forbidden. Not the owner.'


    
  /orders/{id}:
    get:
      operationId: R407
      summary: 'R407: View Order page'
      description: 'Show Order page. Access: OWN, ADM'
      tags:
        - 'M04: Orders and Shopping Cart'
      
      parameters:
        - in: path
          name: id
          schema:
            type: integer
            minimum: 1
          required: true

      responses:
        '200':
          description: 'Ok. Show Order UI'
        '403':
          description: 'Forbidden. Not an admin or the owner.'


  /users/checkout:
    post:
      operationId: R408
      summary: 'R408: Checkout current cart action'
      description: 'Checkout the current user cart. Access: USR'
      tags:
        - 'M04: Orders and Shopping Cart'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties: 
                address_id: 
                  type: integer
                  description: ID of the address to send the order.
              required:
                - address_id


      responses:
        '302':
          description: 'Checkout successful, redirect to order page R406 OR User not authenticated and redirect to Login page R101'
          headers:
            Location:
              schema:
                type: string
                example: '/'
              examples:
                302Success:
                  description: 'Successful checkout. Redirect to order page R406'
                  value: '/orders/{id}'
                302Auth:
                  description: 'Failed authentication. Redirect to Login Page'
                  value: '/login'
        '403':
          description: 'User is not a Buyer'

# ------------------------------------ M05 ------------------------------------


  /:          ####### Static Pages ########
    get:
      operationId: R501
      summary: 'R501: See the HomePage'
      description: 'Show HomePage. Access: PUB'
      tags:
        - 'M05: Static Pages'

      responses:
        '200':
          description: 'Ok. Show HomePage UI01'

  /FAQ:
    get:
      operationId: R502
      summary: 'R502: View FAQ Page'
      description: 'Provide frequently asked questions about our app. Access: PUB'
      tags:
        - 'M05: Static Pages'

      responses:
        '200':
          description: 'Ok. Show FAQ Page UI02'

  /Terms and conditions:
    get:
      operationId: R503
      summary: 'R503: View Terms and conditions Page'
      description: 'Show Terms and conditions page. Access: PUB'
      tags:
        - 'M05: Static Pages'

      responses:
        '200':
          description: 'Ok. Show Terms and conditions Page UI03' 

  /about-us:
    get:
      operationId: R504
      summary: 'R504: See About Us'
      description: 'Provide description about website and its creators. Access: PUB'
      tags:
      - 'M05: Static Pages'
      responses:
        '200':
          description: 'Ok. Show About Us page UI04' 

  /contact-us:
    get:
      operationId: R505
      summary: 'R505: See About Us'
      description: 'Show contacts page. Access: PUB'
      tags:
      - 'M05: Static Pages'
      responses:
        '200':
          description: 'Ok. Show Contact Us page UI05' 
...
```

---


## A8: Vertical prototype

Neste artefacto foram implementadas as funcionalidades mais básicas do projeto.

### 1. Implemented Features

#### 1.1. Implemented User Stories


| User Story reference | Name                   | Priority                   | Description                   |
| -------------------- | ---------------------- | -------------------------- | ----------------------------- |
| US01       | Ver a lista de produtos | Alta | Como *User*, quero ver a lista de produtos, para saber o que poderei adquirir |
| US02       | Ver os detalhes dos produtos | Alta | Como *User*, quero ver os detalhes dos produtos, para me ajudar na escolha dos mesmos |
| US03       | Adicionar produtos ao cesto de compras | Alta | Como *User*, quero adicionar produtos ao cesto de compras, para os poder adquirir |
| US04       | Gerir cesto de compras | Alta | Como *User*, quero gerir o cesto de compras, para poder gerir as minhas opções de compra|
 US11       | Sign-in | Alta | Como *Unauthenticated User*, quero autenticar-me no sistema, para poder aceder a informação privilegiada |
| US12       | Sign-up | Alta | Como *Unauthenticated User*, quero inscrever-me no sistema, para me poder autenticar-me no sistema  |
| US21       | Ver perfil | Alta | Como *Authenticated User*, quero ver o meu perfil, para poder ver aceder às minhas informações e verificar se tudo está correto |
| US22       | Editar perfil | Alta | Como *Authenticated User*, quero editar o meu perfil, para poder atualizar a minha informação |


#### 1.2. Implemented Web Resources
 

 Module M01: Authentication  

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R101: Login Form | GET /login |
| R102: Login Action | POST /login |
| R103: Logout Action | GET /logout |
| R104: Register Form | GET /register |
| R105: Register Action| POST /register |

 Module M02: User Profiles  

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R101: Access User Profile | GET /users |
| R202: Edit User Profile Form | GET /users/edit |
| R203: Edit User Profile Action | POST /users/edit |

 Module M03: Products  

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R301: Access Pruduct | GET /product/{id} |

 Module M04: Orders and Shopping Cart  

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R401: Add a product to cart | POST /product/addCart |
| R402: remove product from cart | POST /product/removeCart |




### 2. Prototype

 [Link to prototype](https://lbaw22114.lbaw.fe.up.pt/login)

  Email: example@example.com Password: 1234

---


## Revision history

Changes made to the first submission:
1. Item 1
1. ..

***
GROUP22114, 21/11/2022

* António Pedro Cabral dos Santos, up201907156 up201907156@up.pt
* João Margato Borlido Pereira, up201907007 up201907007@up.pt (editor)
* Miguel Ângelo Pacheco Valente, up201704608 up201704608@up.pt