<h1>Step Configuration CMS Laravel</h1>

## Setting .env

1. `create database`

2. `import all table`

## Open PHP Folder and Open php.ini file

3. `php.ini -> active extension: exif & gd2`

## Open Terminal or Command Prompt, type:

4. `composer install`

== Generate Role, User Table & Dummy Data ==

For Generate All
<br>

`php artisan db:seed --class=DatabaseSeeder`

or

Generate One by One
<br>

First : `php artisan db:seed --class=UserTableSeeder`
<br>

Second: `php artisan db:seed --class=PermissionTableSeeder`

6. `php artisan key:generate`

7. `php artisan storage:link`

## Step configuration email smtp

1. `first login to your gmail account and under My account > Sign In And Security > Sign In to google, enable two step verification, then you can generate app password, and you can use that app password in .env file.`

## Step configuration .env

2.  `MAIL_DRIVER=smtp`
    <br>
    `MAIL_HOST=smtp.gmail.com`
     <br>
    `MAIL_PORT=587`
     <br>
    `MAIL_USERNAME=myemail@gmail.com`
     <br>
    `MAIL_PASSWORD=apppassword`
     <br>
    `MAIL_ENCRYPTION=tls`
    
3. `Don't forget to run php artisan config:cache after you make changes in your .env file.`