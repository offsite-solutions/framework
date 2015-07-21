Offsite Framework
=================

A Yii 2 starter project based on Yii2 Advanced template and the following starter templates:

* [Trntv's Yii 2 Starter Kit](https://github.com/trntv/yii2-starter-kit)
* [Vova07's Yii 2 Start](https://github.com/vova07/yii2-start)
* [Nenad Zivkovic's Yii 2 Advanced Template](https://github.com/nenad-zivkovic/yii2-advanced-template)
* [Kartik's Practical Template](https://github.com/kartik-v/yii2-app-practical-a)

Offsite Framework Project Template
==================================

Offsite Framework Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes four tiers: front end, back end, storage and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Configuration
=============
- Copy or rename the provided `.env.dist` file to `.env` and set the configuration parameters. Alternatively, you can 
also set all parameters as environment variables, they will not be overridden by paramters set in the `.env` file

Modules
=======
* [VLucas'es PHP DotEnv](https://github.com/vlucas/phpdotenv) implementation for loading environment variables from `.env` file


DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```
