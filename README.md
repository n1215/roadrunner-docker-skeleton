# roadrunner-docker-skeleton
A local docker environment skeleton for [RoadRunner](https://github.com/spiral/roadrunner), the PHP application server written in golang.

## Install

```
git clone https://github.com/n1215/roadrunner-docker-skeleton.git your_app
cd your_app

# install dependencies
composer install

# copy config file
cp .rr.yaml.example .rr.yaml
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
bin/reset-workers
```

Show PHP workers' status

```
bin/show-workers
```

## Directory structure
- [bin](bin) utility commands
- [containers](containers) contains Dockerfile for RoadRunner.
- [psr-worker.php](psr-worker.php) worker's entry point file
- .rr.yaml RoadRunner config file.
