# PHP Router
PHP Router is a simply and usefull php router created by [monarch studio](https://www.monarchstudio.fr) and hosted on [.creative](https://creative.monarchstudio.fr).

Manage easily your routes and catch errors in one class.

## Installation

PHP Router uses composer to autoload class.

Download [composer](https://getcomposer.org/download/) here and check [documentation](https://getcomposer.org/doc/). After installation, run composer :

```bash
php composer-setup.php --install-dir=bin --filename=composer
php composer.phar
```

## Usage

All routes are defined in index.php. You can call POST, GET, PUT or DELETE HTTP verb. You can add most in Router.php if you want.

Here call a controller with 'CONTROLLER#METHOD' schema.
```bash
$router->get('/', 'Example#show');
```
Some example with other verbs and callable directly in function.
```bash
$router->post('/route-to-post', function(){ echo "Something to show"; });
$router->put('/route-to-put', function(){ echo "Something to show"; });
$router->delete('/route-to-delete', function(){ echo "Something to show"; });
```

### Dynamic values
You can passed dynamic values in routes with :key schema.

Here call a controller with 'CONTROLLER#METHO' schema and retrieve the id in $id parameter.
```bash
$router->get('/article/:id', 'Example#show');
```

You can add multiple variables in one route
```bash
$router->get('/article/:id/:slug', function($id, $slug){ echo "My article " . $slug; });
$router->put('/article/:userId/:id', function($userId, $id){ echo "Article updated !"; });
```

## Twig

PHP Router include Twig if you want to use it. If you don't know what it is, [visit the website](https://twig.symfony.com/).

This is exactly the same callables.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
Free for all.