# Class Development System Auction

 - Training on Youtube to develop an online auction system. Full Stack Mode (Severine's).
 - Link play list in Youtube: [LINK](https://www.youtube.com/playlist?list=PLUWz4iWfYNL0sr-fKZrTIW39hytFZ-cO-)

## Install development environment with `Docker Desktop`

In your GitBash terminal or VS Code terminal (with the Docker service active in this folder) enter the following command:

  `docker compose up`
  
This will upload the image version of one container with Laravel version 9 and another container with MariaDB (MySQL) database version 10.

![image](https://user-images.githubusercontent.com/3953157/232828228-0066e9f2-6901-4207-9ff2-8d5c94d0a1aa.png)

Executing the `docker ps` command, we will list the active containers to retrieve the IDs that we will use to enter the command line inside the machines of each service:

![image](https://user-images.githubusercontent.com/3953157/232829113-288f5fd3-96b4-4339-8715-c06cf405af9d.png)

Now, finally, we are able to enter, for example, the Docker image that is running the entire Laravel 9 service at the local URL `http://localhost:8000`:

  `docker exec -it [ID_CONTAINER] /bin/bash` or `docker exec -it app-inicial-myapp-1 /bin/bash`
 
Result:
![image](https://user-images.githubusercontent.com/3953157/232830380-b4634d0c-9ae1-41e1-9ebf-ea9fc878c986.png)

## Generating Migrations in Laravel Artisan Commands

```bash
  php artisan make:migration create_sellers_table
  php artisan make:migration create_actioneers_table
  php artisan make:migration create_particiopants_table
  php artisan make:migration create_addresses_table
  php artisan make:migration create_annoucements_table
  php artisan make:migration create_bids_table
  php artisan make:migration create_history_bids_table
  php artisan make:migration create_images_table
```

## Edit Migrations and add fiels in class tables

- users_table

 ```json
  {
    "id" : "integer primary key auto-increment",
    "name" : "string",
    "email" : "string",
    "email_verified_at" : "string",
    "password" : "string",
    "remember_token" : "string",
    "user_type_login" : "string",
    "created_at" :"datetime",
    "updated_at" : "datetime"
  }
 ```

 - sellers_table

 ```json
  {
    "id": "integer primary key auto-increment",
    "full_name": "string",
    "phone": "string",
    "user_id": "foreign key",
    "created_at" : "string",
    "updated_at" : "string"
  }
 ```

 - actioneers_table

```json
  {
    "id": "integer primary key auto-increment",
    "full_name": "string",
    "phone": "string",
    "user_id": "foreign key",
    "created_at" : "string",
    "updated_at" : "string"
  }
```

 - particiopants_table

```json
  {
    "id": "integer primary key auto-increment",
    "full_name": "string",
    "phone": "string",
    "user_id": "bigInteger foreign key",
    "created_at" : "string",
    "updated_at" : "string"
  }
```

 - addresses_table

```json
  {
    "id": "integer primary key auto-increment",
    "user_id" : "bigInteger foreign key",
    "zip_code" : "string",
    "street" : "string",
    "number" : "string",
    "district" : "string",
    "city" : "string",
    "state" : "string",
    "created_at" : "string",
    "updated_at" : "string"
  }
```

 - annoucements_table

```json
  {
    "id": "integer primary key auto-increment",
    "seller_id": "bigInteger foreign key",
<<<<<<< HEAD
=======
    "image_id": "bigInteger foreign key",
>>>>>>> 102263bb7b811625a33b3ac7a4d662733e399bba
    "title": "string",
    "product_buyer_premium": "string",
    "product_bid_increment": "string",
    "product_attribute_condition": "string",
    "product_attribute_mileage": "string",
    "product_attribute_year_fabric": "string",
    "product_attribute_engine": "string",
    "product_attribute_fuel": "string",
    "product_attribute_transmission": "string",
    "product_number_doors": "string",
    "product_color": "string",
    "description": "text",
    "date_expiration" : "string",
    "status": "string (active | inactive)",
    "created_at" : "string",
    "updated_at" : "string"
  }
```
 
 - bids_table

```json
  {
    "id": "integer primary key auto-increment",
    "seller_id": "bigInteger foreign key",
    "announcement_id": "bigInteger foreign key",
    "price_initial": "double",
    "price_incremental": "double",
    "price_now_bid": "double",
    "time_expiration": "string",
    "created_at" : "string",
    "updated_at" : "string"
  }
```
 
 - history_bids_table

```json
  {
    "id": "integer primary key auto-increment",
    "seller_id": "bigInteger foreign key",
    "announcement_id": "bigInteger foreign key",
    "particiopant_id": "bigInteger foreign key",
    "price_initial": "double",
    "price_incremental": "double",
    "price_now_bid": "double",
    "time_expiration": "string",
    "created_at" : "string",
    "updated_at" : "string"
  }
```

 - images_table

```json
  {
    "id": "integer primary key auto-increment",
    "announcement_id": "bigInteger foreign key",
    "name_archive": "string",
    "url_archive": "string",
    "created_at" : "string",
    "updated_at" : "string"
  }
```

<<<<<<< HEAD
## Criando a estrutura do Front-End do Sistema

Com base no template HTML5 já adaptado podemos iniciar a contrução estática da tela inicial do sistema ou Home.

Para isso vamos precisar primeiro de um `app\Http\Controller` responsável para exibir o conteúdo desta página inicial.  Isso será feito através de um comando do `Laravel 9 Artisan`:

```bash
  php artisan make:controller FrontEndController -r
```

Esse parâmetro -r vai criar os recursos de métodos iniciais de CRUD (Criar, Inserir, Atualizar e Apagar) padrão de todo sistema, mesmo que não venhamos a precisar disso.  Mas, caso não seja utilizado seria uma boa prática apagar os métodos que não estão sendo utilizados.

Tenho criado o _Controller_ para controlar essas _views_ vamos na pasta `resources/views/` e precisamos criar a pasta de componentes de nome `/components/`.  Dentro desta nova pasta vamos criar o arquivo `resources/views/components/layout-front.blade.php` e inserir o _HTML5_ do _template_ já criado e adaptado.

Dentro da pasta `resources/views/` vamos criar uma nova pasta de nome `frontend` onde colocaremos tudo o que vai ser exibido publicamente no site institucional do sistema.  Dentro desta pasta `resources/views/frontend` vamos criar nosso primeiro arquivo de template engine Blade, de nome `home.blade.php`



=======
>>>>>>> 102263bb7b811625a33b3ac7a4d662733e399bba
