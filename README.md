## CMS opensource untuk website pesantren

Cara Install :

1. Clone repository
    
    ```bash
    git clone https://github.com/brynwibowo/larablog.git 
    ```
2. Masuk ke direktori hasil clone, kemudian install npm

    ```bash
    npm install && npm run dev
    ```
3. copy file .env.example

    ```bash
    cp .env.example .env
    ```
    
5. Buat database MySQL/MariaDB
6. Edit file .env
7. Jalankan migrate

    ```bash
    php artisan migrate
    ```
8. Buat akun user dengan edit file /database/seeders/UserSeeder.php
9. Jalankan
    ```bash
    php artisan db:seed --class=UserSeeder
    ```
    
10. Jalankan php artisan serve


## Demo [disini](https://148.100.77.191)
