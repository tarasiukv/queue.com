<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/tarasiukv/queue.com"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://github.com/tarasiukv/queue.com"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
</p>

# Explanatory project `QUEUE` | Laravel

- Test task
    * [What's inside](#What's_inside)
    * [Commands](#commands)
    * [Mail](#mail)

# What's inside

Contains: 
 - Laravel, Vue.js, vite
 - design paterns: Facade | Factory | Builder | Observer | Singleton
 - Echo server
 - Job
 - Event
 - Listener
 - native gmail sender

## COMMANDS:

    laravel-echo-server start

### QUEUE: 

    php artisan queue:work

    php artisan queue:work --queue=registration

    php artisan queue:work --queue=payment

## MAIL

add app password for sending email
https://myaccount.google.com/apppasswords
