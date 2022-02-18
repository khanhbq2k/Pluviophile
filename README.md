# WebProject20211
Special thanks to Dr., Assoc. Prof. Trung Kien Dao for your teaching and 
guidance in the 20211 Web Course.

Follow these steps to install a local version:
1. Clone project from github

&nbsp;&nbsp;&nbsp;&nbsp; > ```git clone https://github.com/c0lydxMas/Pluviophile```

2. Install XAMPP: https://www.apachefriends.org/download.html

3. Copy and paste project folder to ```%YOUR_XAMPP_LOCATION%/xampp/htdocs/```

4. Start XAMPP Apache and MySQL <br/>
> **Warning**:Make sure that Apache Server starts on port 80

5. Open PHPMyAmin Control Panel in localhost:80/phpmyadmin <br/>
Import the pluviophile.sql file inside the project folder to phpmyadmin

6. Open with any text editor, change the credentials in <br/>
```Pluviophile/app/database/connect.php``` with your own phpmyadmin username and password and <br/>
```Pluviophile/public/path.php``` with your corresponding root path.

7. Open localhost:80/Pluviophile and enjoy!

Live demo: http://pluviophile.eastasia.cloudapp.azure.com/ <br/>
(The link above may not work properly due to financial shortage, i only got $100 free for my edu account)
