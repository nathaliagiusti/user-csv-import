# API to import users from CSV files using PHP Lumen

## Requirements :
  - PHP 7.1
  - Composer 
  - MySQL. Credentials can be defined on /.env. 


## Setup : 
- Define the database settings on `.env`.

- Run : 
    ```
    composer install
    ```   

- Run the migrations to create the tables on the database:
    ```
    php artisan migrate
    ```

- Start PHP built-in server as following : 
   ```
   php -S localhost:8000 -t public
   ```

## Documentation

### Access the form to import users from csv : 
    GET localhost:8080/

### Endpoints :

#### Import users from csv :
``` 
POST localhost:8080/user
Content-Disposition: form-data; name="csv"; filename="sample.csv"
Content-Type: text/csv
...
```
    
"csv" file needs to be given as parameter and needs to be a valid CSV. Example : 
```    
Username;PostalCode
Jaapy;1000AA
Pieta;1000AB
Klaas;1111BB
Keesn;2222CC
Petrax;3333DD
```    

#### Get the first 100 users within the postcode 1111AH : 
```
GET localhost:8080/user?postcode=1111AH&limit=100&offset=0
```
    
You can use `limit` and `offset` for pagination. These are optional parameters. 

Default values are :

limit = 100

offset = 0

Postcode is a mandatory parameter and it should follow the format : 1111AA (four digits followed by 2 letters).
    
### Errors :

In case of error, the API is going to return the following structure:  
```    
{
    'success' => false,
    'status'  => 404,
    'message' => 'Not found',
}
```    
    
'Message' and 'status are going to change in accordance to the error code and message.

If debug is enabled (see : `APP_DEBUG=bool` on `.env`), a HTML structure is going to be returned instead in order to be able to provide more information about the error. 
    
## Todo: 
  
  - Improve test coverage;
  - Create a test database for test seeds;
  - Setup a vagrant machine (maybe to use https://laravel.com/docs/5.5/homestead) ;
  - Users are not getting the created_at/updated_at columns in database updated, since it uses query builder instead of eloquent to save the user;
  - When ValidationException is thrown, error handling does not returns the default structure;
  - Check if the API is not vulnerable to SQL injection and other hacking techniques;
  - Organize the API structure.     
