1. git clone https://github.com/Dendydroid/booking.git or download ZIP
2. composer update
3. php artisan migrate
4. create .env file, enter DATABASE credentials, create database
5. configure apache

In .conf file

"<VirtualHost *:80>
      <Directory `PATH-TO-YOUR-PROJECT`>
              Options Indexes FollowSymLinks MultiViews
              AllowOverride All
              Require all granted
          </Directory>
          
  ServerName localhost
  ServerAdmin webmaster@localhost
  DocumentRoot `PATH-TO-YOUR-PROJECT`

</VirtualHost>"
