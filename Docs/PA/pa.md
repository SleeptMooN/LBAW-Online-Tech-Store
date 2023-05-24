# PA: Product and Presentation

OnlyT3ch é uma plataforma web de compras online que permite aos seus utlizadores acesso a um vasto catálogo de produtos informáticos.

## A9: Product

O presente projeto teve como objetivo o desenvolvimento de uma aplicação web para uma loja online. No site é possível encontrar uma variedade de produtos informáticos incluindo computadores,smartphones,tablets e acessórios para ajudar a melhorar a experiência com a tecnologia.

### 1. Installation

Link to the release with the final version of the source code in the group's Git repository:  https://git.fe.up.pt/lbaw/lbaw2223/Lbaw22114

> docker run -it -p 8000:80 --name=lbaw22114 -e DB_DATABASE="lbaw22114" -e DB_SCHEMA="lbaw22114" -e DB_USERNAME="lbaw22114" -e DB_PASSWORD="qFewKdxK" git.fe.up.pt:5050/lbaw/lbaw2223/lbaw2223  

### 2. Usage

URL to the product: http://lbaw22114.lbaw.fe.up.pt/  

#### 2.1. Administration Credentials


| Username | Password |
| -------- | -------- |
| admin@admin.com    | 1234 |

#### 2.2. User Credentials

| Type          | Username  | Password |
| ------------- | --------- | -------- |
| basic account | example@example.com    | 1234 |

### 3. Application Help

Esta secção foi abordada nas paginas estáticas FAQ e About, no entanto todos os inputs mostram indicação de erros e sugestões.  

### 4. Input Validation

Exemplo de um caso onde o input é validado,quando o user preenche os campos da order estes requesitos terão de ser cumpridos.s

```
        $request->validate([
            'name'=>'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|int',
            'house' => 'required|int',
            'postal' => 'required|int',
            'city' => 'required|string',
            'country' => 'required|string',
        ]);

``` 

### 5. Check Accessibility and Usability

> Provide the results of accessibility and usability tests using the following checklists. Include the results as PDF files in the group's repository. Add individual links to those files here.
>
> Accessibility: https://ux.sapo.pt/checklists/acessibilidade/  
> Usability: https://ux.sapo.pt/checklists/usabilidade/  

### 6. HTML & CSS Validation

> Provide the results of the validation of the HTML and CSS code using the following tools. Include the results as PDF files in the group's repository. Add individual links to those files here.
>   
> HTML: https://validator.w3.org/nu/  
> CSS: https://jigsaw.w3.org/css-validator/  

### 7. Revisions to the Project

> Describe the revisions made to the project since the requirements specification stage.  


### 8. Web Resources Specification

> Updated OpenAPI specification in YAML format to describe the final product's web resources.

> Link to the `a9_openapi.yaml` file in the group's repository.


```yaml
openapi: 3.0.0

...
```

### 9. Implementation Details

#### 9.1. Libraries Used

> Include reference to all the libraries and frameworks used in the product.  
> Include library name and reference, description of the use, and link to the example where it's used in the product.  

#### 9.2 User Stories

> This subsection should include all high and medium priority user stories, sorted by order of implementation. Implementation should be sequential according to the order identified below. 
>
> If there are new user stories, also include them in this table. 
> The owner of the user story should have the name in **bold**.
> This table should be updated when a user story is completed and another one started. 

| US Identifier | Name    | Module | Priority                       | Team Members               | State  |
| ------------- | ------- | ------ | ------------------------------ | -------------------------- | ------ |
|  US01          | US Name 1 | Module A | High | **John Silva**, Ana Alice   |  100%  |
|  US02          | US Name 2 | Module A | Medium | **Ana Alice**, John Silva                 |   75%  | 
|  US03          | US Name 3 | Module B | Low | **Francisco Alves**                 |   5%  | 
|  US04          | US Name 4 | Module A | Low | -                 |   0%  | 


---


## A10: Presentation
 
> This artifact corresponds to the presentation of the product.

### 1. Product presentation

> Brief presentation of the product and its main features (2 paragraphs max).  
>
> URL to the product: http://lbawYYgg.lbaw.fe.up.pt  
>
> Slides used during the presentation should be added, as a PDF file, to the group's repository and linked to here.


### 2. Video presentation

> Screenshot of the video plus the link to the lbawYYgg.mp4 file.

> - Upload the lbawYYgg.mp4 file to Moodle.
> - The video must not exceed 2 minutes.


---


## Revision history

Changes made to the first submission:
1. Item 1
1. ..

***
GROUPYYgg, DD/MM/20YY

* Group member 1 name, email (Editor)
* Group member 2 name, email
* ...