# Database Management CSCI 4370 Final Project
## Product description
For our project, we plan on creating a satellite tracker. We will track the statuses of satellites, waiting to be launched or in orbit, and their positions from various companies. The purpose for our product is to allow companies a web interface to view and track their satellites.

## Clients
Our clients are satellite companies that have satellites in orbit or are waiting to be launched. I.e. NASA, SpaceX’s Starlink, and Intelsat.

## Queries
All users will be able to view the satellites owned by a company that are in orbit or waiting to be lauched. Companites must create an account to insert or update the position of a satellite they own.

## Requirments
- PhpMyAdmin
- MySQL

## How to setup
- Clone this repo into your htdocs folder
- Copy [.env.example](./.env.example) to .env and change username and password to your mysql username and password
- Import data from [mysql_data/Satellite.sql](./.mysql_data/Satellite.sql) to phpMyAdmin

## Responsibilities
### Elle 
- [ ] Create database with the name Satellite
- [ ] Create tables as described in the ER diagram
    - [ ] Add password field to company table
    - [ ] Add latitude and longitude of launch site for satellites waiting to be lauched
    - For satellites in orbit
        - [ ] Add latitude and longitude of launch site
        - [ ] Add radius satellite is orbiting at (must be less than 2000 km)
        - [ ] Add inclination (degrees between -60 and 60)
- [ ] Help Anna with Update satellite page

### Yamin 
- [ ] Create Insert satellite page
    - [ ] Only allow companites logged in to insert new satellites
    - [ ] Insert sateliite waiting to be lauched
    - [ ] Insert satellite's initial orbit of launched satellite

### Anna 
- [ ] Create Update satellite page
    - [ ] Only allow companites logged in to update satellites
    - [ ] Update status and pending launch date of satellites waiting to be launched
    - [ ] Update orbitial position of satellite in orbit

### Hunter 
- [ ] Create main page (index.php)
- [ ] Show satellites on map
- [ ] Create table to show list of satellites owned by a company

### Shay
- [ ] Create Company register page
    - [ ] Add cookie of the company's cid when they register
- [ ] Create Company login page
    - [ ] Add cookie of the company's cid when they login
- [ ] Redirect users to login page if they are not logged in
