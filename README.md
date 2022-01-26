# roadrunner-docker-skeleton
A local docker environment skeleton for [RoadRunner](https://github.com/roadrunner-server/roadrunner), the PHP application server written in golang.

HTTP Server and PHP Workers are enabled by default.

[![Latest Stable Version](https://poser.pugx.org/n1215/roadrunner-docker-skeleton/v/stable)](https://packagist.org/packages/n1215/roadrunner-docker-skeleton)
[![License](https://poser.pugx.org/n1215/roadrunner-docker-skeleton/license)](https://packagist.org/packages/n1215/roadrunner-docker-skeleton)
[![Travis build status](https://travis-ci.org/n1215/roadrunner-docker-skeleton.svg?branch=master)](https://travis-ci.org/n1215/roadrunner-docker-skeleton)


## Requirements
- Bash
- Docker Compose

## Install

### via Git
```
git clone https://github.com/n1215/roadrunner-docker-skeleton.git your_app
cd your_app

./task init
```

### via Composer
```
composer create-project --prefer-dist n1215/roadrunner-docker-skeleton your_app
cd your_app

./task init
```

## Commands

### Start the container

```
./task up

# with rebuilding image
# ./task up --build
```

and access http://localhost:8080

### Stop the container

```
./task down
```

### Login into the container
```
./task login
```

### Show container log
```
./task logs
```

### Execute RoadRunner commands

```
./task rr {command}
# ex) ./task rr help
```

## Change RoadRunner version

### 1. change .env file

```
- RR_VERSION=2.x.y
+ RR_VERSION=2.z.w
```

### 2. run the initialization script
rebuild the RoadRunner image and update composer dependencies.
```
./task init
```

## Auto-Reloading
Auto reloading is enabled by default. RoadRunner detects PHP file changes and reload connected services.
To turn off this feature, remove the `reload` section in [.rr.yaml](containers/roadrunner/config/.rr.yaml).

see: [Roadrunner : Auto-Reloading](https://roadrunner.dev/docs/beep-beep-reload)

## Directory structure
- [containers](containers) contains Dockerfile and the config file for RoadRunner.
- [worker.php](worker.php) worker's entry point file
