# Website for Musician / Band


[![forthebadge](http://forthebadge.com/images/badges/built-with-love.svg)](http://forthebadge.com)  [![forthebadge](http://forthebadge.com/images/badges/powered-by-electricity.svg)](http://forthebadge.com)

This a website made for a musician / band. It can manage tour date, Audio / Video, Members, News, etc.

## Get Started

This website is based on symfony 5.4, with mysql BDD...

### Pre-requisites

- Symfony Cli >= 5.4.*
- PHP 8.1.*
- Node >= 14.18.*
- Twig
- Composer >= 2.1.*
- Docker >= 20.10 (for dev environment)

You can check your dev environment by running

```bash
symfony check:requirements
```

### Installation

1. Run bdd
    ```bash
    docker-compose up -d --build
    ```
2. Installation:
    ```bash
    make install
    ```

3. Run the server
    ```bash
    symfony server:start -d
   ```
## Testing & Coding Standards

- Testing:
    ```bash
    make tests
    ```
- Analyze basecode (Update / Composer validation / Doctrine Mapping / PHP Static analyze)
    ```bash
    make analyze
    ```
- Coding Standards:

  we use a tool named Rector to maintain our code standards & quality.
    ```bash
    make fix
    ```

## Made with

* [Symfony](https://symfony.com/) - Framework PHP
* [Intellij Idea](https://www.jetbrains.com/fr-fr/idea/) - IDE
* TBA :)

## Contributing

Here are some choices to facilitate the development and maintenance of the application.


1. Use PHP 8 Attribute (example to define routes) like this:

```php
#[Route("/hello/{name}")]
```

2. Gitflow dev - feature - release - hotfix with semver like vX.xx.xx

TODO: Write contributing file




