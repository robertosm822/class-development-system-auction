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

## Creating the System Front-End structure

Based on the already adapted HTML5 template, we can start the static construction of the system's initial screen or Home.

For this we will first need an `app\Http\Controller` responsible for displaying the contents of this home page. This will be done through a command from the `Laravel 9 Artisan`:

```bash
  php artisan make:controller FrontEndController -r
```

This -r parameter will create the default CRUD (Create, Insert, Update, Delete) initial method resources throughout the system, even if we don't need them. But, if not used, it would be a good practice to delete methods that are not being used.

I have created the _Controller_ to control these _views_ let's go in the folder `resources/views/` and we need to create the component folder named `/components/`. Inside this new folder we will create the file `resources/views/components/layout-front.blade.php` and insert the _HTML5_ of the _template_ already created and adapted.

Inside the `resources/views/` folder, we will create a new folder named `frontend` where we will place everything that will be publicly displayed on the institutional website of the system. Inside this `resources/views/frontend` folder we will create our first Blade template engine file, named `home.blade.php`



