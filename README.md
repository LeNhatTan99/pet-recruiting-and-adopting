I, Document Install Project
1. Install Composer and PHP(Xampp or Laragon)
2. Run migrate
Step 1: In project, open git bash or terminal
Step 2: composer install
Step 3: rename .env.example -> .env then change connect to database
Step 4: php artisan key:generate
Step 5: Run commandline
- php artisan migrate
- php artisan migrate --path=/database/migrations

3. Run db seeders
- php artisan db:seed

4. Start serve
-php artisan serve

5. Login Rescuer Dashboard
 - Access http://127.0.0.1:8000/rescuer/login
 - Check account in database\seeders\RescuerSeeder.php
 [username: rescuer1   
  pass    : 123123123]
7. Login User
 - Access http://127.0.0.1:8000/login or rigister

 (if the image is not displayed then run the command: php artisan storage:link)
 To test payment via momo, download momo test at https://developers.momo.vn/v3/download/