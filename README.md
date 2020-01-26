## INSTALLATION STEPS

1. install JWT: composer require tymon/jwt-auth:dev-develop --prefer-source
2. publish JWT package configuration php artisan vendor:publish
3. choose option #8 in step #2
4. create secret key (stored in .env) used to sign the JWT tokens: php artisan jwt:secret
