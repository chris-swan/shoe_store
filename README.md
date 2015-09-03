
 Shoe Store

 Chris Swan

 Description:

week 4 database assessment. An app to enter in stores and brands, to see which stores carry which brands, and which brands are located at which stores.

      Database commands used in terminal:

      CREATE DATABASE shoes;
      USE shoes;
      CREATE TABLE stores (name VARCHAR(255) id SERIAL);
      CREATE TABLE brands (name VARCHAR(255) id SERIAL);
      - in php MyAdmin - copy DB to shoes_test -  
       - in phpMyAdmin - change "name" to store_name/brand_name -
       USE shoes:
       CREATE TABLE brands_stores(id serial PRIMARY KEY, brand_id int, store_id int);
       DROP DATABASE shoes_test;
       -- in phpMyAdmin - copy database to shoes_test


 Setup

 Clone repository from GitHub.

 Run $ composer install in top level of project folder.

 in a new terminal tab. enter mysql.server start.

 Then enter mysql -uroot -proot (you now have MySql running)

 Start an apache server (another new tab in terminal) with apachectl start

 Open your browser to localhost:8888/phpmyadmin

 Start another terminal tab. Open a php server php -S localhost:8000. This is so you can view your twig sites.

 got to http://localhost:8000 to view the sites.

 Enjoy

 Technologies Used

 PHP, html, css, silex, MySQL, phpMyadmin

 Legal

 Copyright (c) 2015 Chris Swan

 This software is licensed under the MIT license.

 Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
