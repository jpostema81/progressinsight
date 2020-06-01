## PROJECT DESCRIPTION

The goal of this application is to implement a platform where participants can join and track their individual progress. Progress of learninggoals can be tracked and learninggoals can be individually assigned to users.

## FUTURE FUNCTIONAL GOALS

1. implement timing aspect so a timepath can be created for each individual participant
2. create custom learninggoals 'packages' to be assigned to individuals

## INSTALLATION STEPS

In order to get this softwareproject running please execute the following steps:

-   `npm install`
-   `composer install`
-   create .env file based on .env.example
-   `php artisan key:generate` to generate app key
-   `php artisan jwt:secret` to generate jwt secret
-   `php artisan migrate:fresh --seed`
-   `npm run watch` to generate main.js and to autobuild after changes
-   `php artisan serve`

## GPL3 LICENSE SYNOPSIS

Here's what the license entails:

1. Anyone can copy, modify and distribute this software.
2. You have to include the license and copyright notice with each and every distribution.
3. You can use this software privately.
4. You can use this software for commercial purposes.
5. If you dare build your business solely from this code, you risk open-sourcing the whole code base.
6. If you modify it, you have to indicate changes made to the code.
7. Any modifications of this code base MUST be distributed with the same license, GPLv3.
8. This software is provided without warranty.
9. The software author or license can not be held liable for any damages inflicted by the software.