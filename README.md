# _Hair Stylist_

#### _An app hair stylist, March 31, 2017_

#### By _**Max Larson**_

## Description

_This is a program that will keep track of a hair stylist clients_

## Setup/Installation Requirements

* _Download or clone project files_
* _Run Composer Install terminal_
* _3.31.17->web in MAMP_
* https://github.com/MLarson90/3.31.17.git

## Specs
* _This program will get all arguments for stylist_
* _This program will set all arguments for stylist_
* _This program will save all arguments for stylist_
* _This program will get all instances of stylist_
* _This program will delete all instances of stylist_
* _This program will find a stylist_
* _This program will allow admin to update a stylist_
* _This program will allow admin to delete a stylist_
* _This program will do all those things for clients_

## MySQL commands

* _/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot_
* _CREATE DATABASE hair_saloon;_
* _USE hair_saloon;_
* _CREATE TABLE stylist(first VARCHAR(255), last VARCHAR(255), years INT, id serial PRIMARY KEY);_
* _CREATE TABLE client(first VARCHAR(255), last VARCHAR(255), stylist_id INT, id serial PRIMARY KEY);_

## Known Bugs

_This program has so few bugs it may as well be space_

## Support and contact details

_If you run into any issues or have questions, please contact Rob at 1-800-TEAM-ROB_

## Technologies Used
* _Bootstrap 3.3.7_
* _JQuery 3.2.0_
* _Silex 1.1_
* _Twig 1.0_
* _PHPUnit 4.5.*_

### License

*This project is licensed under Max Corp.*

Copyright (c) 2017 **_Max Larson_**
