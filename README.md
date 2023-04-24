# GrowME Web Application Template
This is a template web application built with VueJS and Laravel. Feel free to contribute.

Before you begin with the setup, make sure you have [NodeJS](https://nodejs.org/en/download) and [Composer](https://getcomposer.org/download/) installed on your machine.

Assume that you have also run the XAMPP server (or similar local server with mySQL module) on your machine.

### Begin Installation

```
git clone https://github.com/younghandsome31/growme.git
```

## On Windows

### Begin Setup for API side (Laravel)
Go to the project root directory ("growme" folder) and run the commands:

```
cd api
composer install
```

Wait until the laravel installation is complete. While waiting, go to your windows' "hosts" file and add the following line at the bottom of the file:

```
127.0.0.1 growmeapi.local
```

Also, update the laravel ".env" file at the "api" root folder:

```
APP_URL=http://growmeapi.local:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=growmeapi
DB_USERNAME=root
DB_PASSWORD=
```

Create a database on XAMPP's phpmyadmin and name it `growmeapi`.

After laravel installation, run the commands below:

```
php artisan migrate
php artisan passport:install
php aritsan db:seed
```

To start the API endpoint host, run the command below:

```
php artisan serve --host=growmeapi.local
```

It will show message similar to the below:

```
 INFO  Server running on [http://growmeapi.local:8000]
```

You're done with the back-end side.

### Begin Setup for UI side (VueJS)
Open a new terminal. Enter to the `growme` folder and run the commands:

```
cd app
npm install
```

Done. You need to run the `npm run dev` command to start the VueJS application.

It will show message similar to the below:

```
VITE v4.1.1  ready in 988 ms
  ➜  Local:   http://localhost:5173/
  ➜  Network: use --host to expose
  ➜  press h to show help
```

Access the VueJS application in your browser by going to `http://localhost:5173/admin-login`.
```
Username: tarek@growmemarketing.ca
Password: awesomeness
```

If you can login, You're all done!
