# Setting Up Project

- git clone https://github.com/techcodex/tendex.git

After Cloning the project into your local machine go to the project folder and open
terminal into your project folder and run these Commands

1. composer install
2. Run this command in your terminal for getting new .env configuration file 
**cp .env.example .env**
3. Now Run **php artisan key:generate**
4. Run this command **composer dump-autoload**
5. Open localhost/phpmyadmin
6. Create new Database With any name you want.


## Setting Project Configurations

Open your project in any **IDE** such as Visual Code, Php Storm, Netbeans. Edit **.env**
file and update your project configuration

1. Change **APP_URL** value with the url you access your project with. If you are using **XAMPP**
   then URL might be **http://localhost/project_name** , if you are using laragon then **APP_URL** will be **http://project_name.test**
2. Replace **DB_DATABASE** constant value with the name of the database you created in phpmyadmin
3. Replace **DB_USERNAME** constant with the name of your phpMyAdmin User Name e.g (root).
4. If your Database is using any password then change **DB_PASSWORD** constant value with
   your database password if your database is not using any password then leave it empty.
7. Then Run this Command in your terminal **php artisan migrate**
8. If the **php artisan migrate** run successfully you are done with your setup
9. Add these 3 param in your .env file and then run the project you will get this param from twilio because I cannot publicaly expose that paramters.

   - ##### TWILIO_SID
   - ##### TWILIO_TOKEN
   - ##### TWILIO_FROM

10. If you are using xampp then open project on browser with http://localhost/project_name or if 
   you are using laragon then the url will be http://project_name.test
