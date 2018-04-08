# Zine

This is a local instance of WordPress, which we'll use to avoid editing files live on the site. You'll have to download xampp and WordPress for this to work.

xampp - https://www.apachefriends.org/index.html
WordPress - https://wordpress.org/download/

Once you've downloaded xampp, click on the file to begin the installation process. It'll ask you which components you want to add to xampp, you can check them all if you want, but since we'll be working with WordPress, you only need to check MySQL and phpMyAdmin. Next, you select where you want to install xampp. To avoid administration issues in windows, do not install it under C:\Program Files\xampp. You don't have to install bitnami or any of the other installers.

Open xampp and click start on Apache and MySQL. Type http://localhost in your browser to see if the server is working. 

Click the admin button on MySQL to create a new database. It'll open a new tab on your browser. Click on the top-left tab called "databases" and it'll prompt you to create a database. Name it "WP" and click create.

Now you need to install WordPress. Go to xampp's installation folder, then to a folder called 'htdocs'. Unzip WordPress into its own folder in htdocs and name it WordPress. Open the folder and edit the file 'wp-config-sample.php'.

With the file opened, replace "database_name_here" with WP (the name of the database you created). Replace "username_here" with "root" and leave “password_here” blank. Save the file and close it. Type http://localhost/wordpress in your browser (or replace wordpress with the name of the folder you unzipped WordPress in). It'll take you to the installation process and that's that.