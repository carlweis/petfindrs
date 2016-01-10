# PetFindrs API
Build a REST API, which allows users to sign up and post listings of lost pets,
along with an AngularJS client-side application to consume the API. Use OAuth
token based authentication.

### Technologies
- [Laravel Homestead](https://laravel.com/docs/5.2/homestead/ "Laravel Homestead")
- [Vagrant](http://vagrantup.com/ "Vagrant")
- [VirtualBox](https://www.virtualbox.org/ "VirtualBox")
- [PHP 5.6](http://php.org/ "PHP 5.6")
- [HHVM](http://HHVM.org/ "HHVM")
- [Memcached](http://memcached.org/ "Memcached")
- [Redis](http://redis.io/ "Redis")
- [Lumen (Laravel Micro-Services Framework)](http://lumen.laravel.com/ "Lumen")
- [League Fractal](https://github.com/thephpleague/fractal "League Fractal")
- [MySQL](http://mysql.com/ "MySQL")
- [Laravel Forge](http://forge.laravel.com/ "Laravel Forge")
- [DigitalOcean](http://digitalocean.com/ "DigitalOcean")
- [AngularJS](http://angualrjs.org/ "AngularJS")
- [Twitter Boostrap 3](http://getboostrap.com "Twitter Bootstrap")
- [Gulp for automated test running](https://www.npmjs.com/package/gulp-phpunit "Gulp PHPUnit")
- [Yeoman Angular](https://github.com/yeoman/generator-angular "Yeoman Angular")


**Note**
The first version of the API will not include authentication. We will build OAuth
base token JWT authentication, in the second tutorial/video.

- Allow users to search by location...ie Country, State, City
- Allow users to search by categories...ie Dogs, Cats
- Allow users to post their listing to Facebook and Twitter.
- Allow users to respond to listings, if they found the lost pet.
- Authenticate Users using OAuth
- Build an AngularJS client application to consume the API.

## Steps to configure new project
- Configure /etc/hosts with api domain: api.petfindr.dev
- Configure /etc/hosts with app domain: petfindr.dev
- Edit Homestead.yaml && Provision Homestead
- Create Lumen API project: composer create-project laravel/lumen petfindr_api
- Initialize Git repository
- Update README.md && commit
- Enable APPEnv Facades, Eloquent, Create Domain folder (ie. PetFindr (for application code)) & commit
- Configure .env, Create Database
- Install and configure Gulp for running phpunit tests automatically
- Install league/csv for importing CSV files
- Install Faker in composer required dependencies for use in Production/Staging
- Install league/Fractal for data transformations - composer require league/fractal
- Install  "symfony/yaml" for yaml config files
- Create GitHub.com repository
- Push project to GitHub
- Create base ApiController & commit
- Setup error handling for 404 errors and any server errors, to return JSON by default.
- Setup default response for root route ('PetFindrs v1.0')
- Test Endpoint using curl: curl -i http://api.petfindrs.dev | python -mjson.tool
- Define the requirements.md for the API ( This document should be updated, as you make changes to the API. )

## Deployment using Laravel Forge and Digital Ocean
To deploy your application to production, we will use Laravel Forge and Digital Ocean.

- Setup domain on DigitalOcean
- Create droplet using Laravel Forge
- Setup site for api and app, and link GitHub repository
- Edit Deploy script to force migrations and db:seed
- Deply application
- Enable Git Push Deploy

## Resouce Steps (ie. database table and entity)
- Define resouce requirements in requirements.md ( this lives with the code and is updated as new endpoints are added/updated)
- Create table migration
- Migrate database
- Setup Domain folder
- Create domain Model
- Create model Factory
- Create table seeder
- Import CSV file  * if applicable or use Faker to seed the databse
- Create Domain Repository (Interface)
- Create Domain Eloquent Repository
- Create Domain Service Provider
- Register Service Provider in boostrap/app.php

### Process for each endpoint

Write Test to make sure **EACH** endpoint exists and return successful and invalid responses, with proper error messages and HTTP status codes.

**NOTE** This needs to be done, one at a time, so that we can insure
full test coverage for every endpoint within the API.

```
    Write failing test for endpoint (endpoint doesn't exist yet)
	run test - red
	- Define & Configure route
	run test - red **No Controller**
		- Create Controller extend ApiController
		- Inject DomainEloquentRepository via Constructor
	run test - red **No Action**
		- Create Action - add basic response
	run test - green
		- Write test for successful response
	run test - red
		- Write code to return successful response
	run test - green
	    - Write test for error response
	run test - red
	    - Write code to handle invalid response
	run test - green
	git commit and merge branch, endpoint working and tested.

	Repeat for **EVERY** endpoint within the API.

```
## Domain Specific Code
If you need to create classes, or other domain specific code, place it under
the root domain folder, inside a folder for the resource. That way each domain
object is namespaces properly. You can group resources using namespaces, as in
the example below with Locations, being a root namespace for Country, State, City
resources.

This makes it much easier to go back and work on a specific part of the API,
since everything related is in one place. It also scales better, since you
don't end up with one huge models folder, or Services folder, etc.

You also want to create a service provider for each resource or group of
resources and register it within bootstrap/app. This is how you bind up your
repository interface, to a concrete instance of a class, in this case an
Eloquent (Laravel ActiveRecord) implementation.

```
    PetFindrs
     - Accounts
        AccountServiceProvider.php
		Auth
          Proxy.php
        Profiles
          Profile.php
          ProfileRepository.php
          ProfileEloquentRepository.php
        Registration
          SendConfirmationEmail.php
          ConfirmEmail.php
          UserCreator.php
        Roles
          Role.php
          RoleRepository.php
          RoleEloquenRepository.php
        Users
          User.php
          UserRepository.php
          UserEloquentRepository.php
     - Locations
        LocationServiceProvider.php
        - Countries
            Country.php
            CountryRepository.php
            CountryEloquentRepository.php
        - States
            State.php
            StateRepository.php
            StateEloquentRepository.php
        - Cities
            City.php
            CityRepository.php
            CityEloquentRepository.php
    - Categories
        Category.php
        CategoryRepository.php
        CategoryEloquentRepository.php
        CategoryServiceProvider.php
        Subcategory.php
        SubcategoryRepository.php
        SubcategoryEloquentRepository.php
   - Listings
       Listing.php
       ListingRepository.php
       ListingEloquentRepository.php
       ListingServiceProvider.php
   - Messages
       Message.php
       MessageRepository.php
       MessageEloquentRepository.php
       MessageServiceProvider.php




