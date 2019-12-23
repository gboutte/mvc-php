# MVC PHP
## Requirements
- php 7+
- php mod rewrite
## Installation

Virtual host example for apache2
```
<VirtualHost *:80>
     ServerName domain.loc
 
     DocumentRoot /var/www/mvc-php/public
     <Directory /var/www/mvc-php/public>
         AllowOverride All
         Order Allow,Deny
         Allow from All
     </Directory>
 </VirtualHost> 
```

## Renderer class

This will define a block that can be used when it's rendered
```php
$renderer = new Renderer();

$renderer->setBlock('body', 'index.php');
```

In `layout.php` you will have access to a variable called `$body` 
```php
$renderer->render('layout.php');
```

## Response class
You can pass the content to the constructor or call a function later
```php
$response = new Response("The content");
$response->setContent("The content set later");
```

You can set headers like that
```php
$response->setHeader('Content-Type', 'application/json');
```
## Router class



## Controller class
In the controller each function defined as a route must return a response object
```
public function index()
{
    $renderer = new Renderer();
    $renderer->setBlock('body', 'index.php');
    return new Response($renderer->render('layout.php'));
}
```