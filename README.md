# TechnoBureau Blog

<a href="https://packagist.org/packages/technobureau/blog"><img src="https://img.shields.io/packagist/dt/technobureau/blog" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/technobureau/blog"><img src="https://img.shields.io/packagist/v/technobureau/blog" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/technobureau/blog"><img src="https://img.shields.io/packagist/l/technobureau/blog" alt="License"></a>


## Official Documentation

### Supported Versions

Only the latest major version of TechnoBureau UI receives bug fixes. The table below lists compatible Laravel versions:

| Version | Laravel Version |
|---- |----|
| [1.x](https://github.com/TechnoBureau/Blog/tree/1.x) | 8.x |

### Installation

Installing Blog template and related backend packages for laravel framework.

```bash
composer require technobureau/blog
```

Initially execute laravel/ui , technobureau/ui authentication commands for initialization
```bash
php artisan ui bootstrap --auth
php artisan ui technobureau --auth
```

Once the `technobureau/blog` package has been installed, you may install the frontend scaffolding using the `ui` Artisan command:

```bash
// Generate blog scaffolding...
php artisan ui tb-blog
```

## License

Laravel UI is open-sourced software licensed under the [MIT license](LICENSE.md).
