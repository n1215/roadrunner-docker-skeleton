# roadrunner-docker-skeleton
A local docker environment skeleton for [RoadRunner](https://github.com/spiral/roadrunner), the PHP application server written in golang.

[![Latest Stable Version](https://poser.pugx.org/n1215/roadrunner-docker-skeleton/v/stable)](https://packagist.org/packages/n1215/roadrunner-docker-skeleton)
[![License](https://poser.pugx.org/n1215/roadrunner-docker-skeleton/license)](https://packagist.org/packages/n1215/roadrunner-docker-skeleton)
[![Travis build status](https://travis-ci.org/n1215/roadrunner-docker-skeleton.svg?branch=master)](https://travis-ci.org/n1215/roadrunner-docker-skeleton)

## Install

### via Composer
```
composer create-project --prefer-dist n1215/roadrunner-docker-skeleton your_app
```

### via Git
```
git clone https://github.com/n1215/roadrunner-docker-skeleton.git your_app
cd your_app

# install dependencies
composer install

# init config
composer init-config
```

## Start/Stop the docker container

### Start

```
docker-compose up -d
```

and access http://localhost:8080

### Stop

```
docker-compose down
```

## Utils

Reset PHP workers in the container. (to reload your PHP source code)

```
composer reset-workers
```

Show PHP workers' status

```
composer show-workers
```

## Auto-Reloading
Auto reloading is enabled by default. RoadRunner detects PHP file changes and reload connected services.
To turn off this feature, remove the `reload` section in .rr.yaml.

see: [Roadrunner : Auto-Reloading](https://roadrunner.dev/docs/beep-beep-reload)

## Directory structure
- [containers](containers) contains Dockerfile for RoadRunner.
- etc/roadrunner contains RoadRunner config files.
- [worker.php](worker.php) worker's entry point file
