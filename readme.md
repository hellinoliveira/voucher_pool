# PHP VOUCHERPOOL CHALLENGE #

### To run the project you need to: ###

1. run composer install
1. cp env.example .env
1. Edit .env file to set your mysql user, password and database name
1. run php artisan migrate
1. run php artisan db:seed


#### Postman Documentation ####

    You can import the PHP CHALLENGE.postman_collection.json to the Postman App to see the API documentation. 




#### The Challenge ####
##### Entities #####

- Recipient
    - Name
    - Email ​ ​(unique)
- Special ​ ​Offer
    - Name
    - fixed ​ ​percentage ​ ​discount
- Voucher ​ ​Code
    - unique ​ ​randomly ​ ​generated ​ ​Code ​ ​(at ​ ​least ​ ​8 ​ ​chars)
    - assigned ​ ​to ​ ​a ​ ​Recipient ​ ​and ​ ​a ​ ​special ​ ​offer
    - Expiration ​ ​Date
    - Can ​ ​just ​ ​be ​ ​used ​ ​once
    - Should ​ ​track ​ ​date ​ ​of ​ ​usage

##### Functionalities #####

- For ​ ​a ​ ​given ​ ​Special ​ ​Offer ​ ​and ​ ​an ​ ​expiration ​ ​date ​ ​generate ​ ​for ​ ​each ​ ​Recipient ​ ​a
Voucher ​ ​Code
- Provide ​ ​an ​ ​endpoint, ​ ​reachable ​ ​via ​ ​HTTP, ​ ​which ​ ​receives ​ ​a ​ ​Voucher ​ ​Code ​ ​and ​ ​Email
and ​ ​validates ​ ​the ​ ​Voucher ​ ​Code. ​ ​In ​ ​Case ​ ​it ​ ​is ​ ​valid, ​ ​return ​ ​the ​ ​Percentage ​ ​Discount
and ​ ​set ​ ​the ​ ​date ​ ​of ​ ​usage
- Extra: ​ ​For ​ ​a ​ ​given ​ ​Email, ​ ​return ​ ​all ​ ​his ​ ​valid ​ ​Voucher ​ ​Codes ​ ​with ​ ​the ​ ​Name ​ ​of ​ ​the
Special ​ ​Offer
Tasks
❏ Design ​ ​a ​ ​database ​ ​schema
❏ Write ​ ​an ​ ​application
❏ Add ​ ​an ​ ​API ​ ​endpoint ​ ​for ​ ​verifying ​ ​and ​ ​redeeming ​ ​vouchers
❏ The ​ ​code ​ ​should ​ ​be ​ ​covered ​ ​by ​ ​tests
❏ Write ​ ​a ​ ​documentation ​ ​with ​ ​code ​ ​examples ​ ​for ​ ​the ​ ​implemented ​ ​calls ​ ​(Postman
collection ​ ​is ​ ​a ​ ​nice-to-have)
Hints
- A ​ ​micro-framework ​ ​may ​ ​help ​ ​you ​ ​get ​ ​started ​ ​quickly
- Security ​ ​is ​ ​not ​ ​a ​ ​concern ​ ​- ​ ​look ​ ​at ​ ​this ​ ​as ​ ​an ​ ​internal ​ ​app, ​ ​no ​ ​need ​ ​for ​ ​access ​ ​control
- A ​ ​system ​ ​that ​ ​works ​ ​is ​ ​appreciated, ​ ​but ​ ​the ​ ​larger ​ ​focus ​ ​is ​ ​on ​ ​code ​ ​quality ​ ​etc.
- Tests ​ ​may ​ ​reveal ​ ​inconsistencies ​ ​or ​ ​unexpected ​ ​scenarios ​ ​in ​ ​the ​ ​original
specification
- Any ​ ​further ​ ​questions? ​ ​Feel ​ ​free ​ ​to ​ ​ask ​ ​us!


# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/lumen-framework/v/unstable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

## Official Documentation

Documentation for the framework can be found on the [Lumen website](http://lumen.laravel.com/docs).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
