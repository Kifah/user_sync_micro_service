# Integrating microservices in a monlothic architecture

This project is a proof of concept, on how to effectively integrated new mirco-services into an existing monolithic 
infrastructure. The microservice``` included are:
* `user_service` responsible for creating and handling user processes
* `log_service` for logging any information
* `legacy_user_service` for handling syncing calls between the old legacy DB and the new mirco-services
* possible further micro-services like a search service or an accounting services are shown, but not yet implemented.

## General Concept


![general concept](https://preview.ibb.co/nqCTuS/Bildschirmfoto_2018_05_09_um_08_17_26.png "communication amongst services")

This project uses the following technologies:

* docker/docker-compose
* Kafka
* php 7.2
* MySql


It includes the following architecture and software concepts:
* separation of concerns (through small loosly coupled services)
* Publish/Subscribe and Messaging system, through Kafka
* Async processing, for better performance




## Getting Started:
you need to have [docker-compose installed](https://docs.docker.com/compose/install/)

then simply run `docker-compose up`


## Todo
* unit testing
* concrete CRUD processes in the `user_service`
* more complex processing in the `legacy_user_service`
* integrate CI/CD through Jenkins or travis-ci