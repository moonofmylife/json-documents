System for editing any json document using the PATCH method

## Requirements

###### The Laravel 5.8 framework has a few system requirements ######
> PHP >= 7.1.3   
> BCMath PHP Extension  
> Ctype PHP Extension  
> JSON PHP Extension  
> Mbstring PHP Extension  
> OpenSSL PHP Extension  
> PDO PHP Extension  
> Tokenizer PHP Extension  
> XML PHP Extension  

## Installation

Download this repo.  

Rename `.env.example` to `.env` and fill options.

Run the following commands:

```
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```

## API
- **POST** /api/v1/document/ - creating a draft document  

- **GET** /api/v1/document/{id} - get a document by id  

- **PATCH** /api/v1/document/{id} - edit a document  

- **POST** /api/v1/document/{id}/publish - publish a document  

- **GET** /api/v1/document/?page=1&perPage=20 - get a list of paginated documents that can be sorted by update date
