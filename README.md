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
- **NOTE** Use the file [db.connect.php](./util/db.connect.php) in the util folder to connect to the database. This will ensure that everyone is using the .env to configure how to log into mysql.

## Responsibilities
### Elle 
   - [x] Add latitude and longitude of launch site for satellites waiting to be lauched
    - For satellites in orbit
        - [x] Add latitude and longitude of launch site
        - [x] Add radius satellite is orbiting at (must be less than 2000 km)
        - [x] Add inclination (degrees between -60 and 60)
- [ ] Help Annika with Update satellite page

### Yamin
- [x] Create database with the name Satellite
- [x] Create tables as described in the ER diagram
- [x] Add password field to company table
- [x] Create Insert satellite page
    - [ ] Only allow companites logged in to insert new satellites
    - [x] Insert sateliite waiting to be lauched
    - [x] Insert satellite's initial orbit of launched satellite

### Annika 
- [ ] Create Update satellite page
    - [ ] Only allow companites logged in to update satellites
    - [ ] Update status and pending launch date of satellites waiting to be launched
    - [ ] Update orbitial position of satellite in orbit

### Hunter 
- [x] Create main page (index.php)
- [x] Show satellites on map
- [x] Create table to show list of satellites owned by a company

### Shea
- [x] Create Company register page
    - [ ] Add cookie of the company's cid when they register
- [x] Create Company login page
    - [ ] Add cookie of the company's cid when they login
- [ ] Redirect users to login page if they are not logged in
