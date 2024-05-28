
Steps to run the library management system on another device.
1)	Download VS code and Install Vs code.
 


2)	Search for PHP extension and install it on VS code.
 
3)	Download the composer and install it.
 

4)	Download and install XAMMP in default settings.
 

5)	Go to C Drive open XAMMP folder and search for php folder.


6)	Open php file and copy its path and past on system environment variables.

Copy the php path and open environment variables from control pannel. 

Click on Path in system variables.
 


Click on New and past the PHP path.






7)	Again, open XAMMP folder from C drive and search htdocs folder.



8)	 Open the htdocs folder create a folder named “project” and past the library management system” inside project folder.








9)	Open the project folder from htdocs in Vs code.

            

10)	 After that open XAMMP and run Apache and MySQL
 

11)	 Then run this command in Vs code terminal.
a)	php artisan migrate
b)	php artisan serve

12)	 Then click the server link in Vs Code by ctrl + right click.
 
            Then library management system with 3d content will run on web.


13)	 To access the database and to create admin users.
a)	First register one “user” in the system and logout account then open database by clicking Admin.
b)	Get access to MySQL database and select plibraray. Then select users from plibrary.

c)	Select user type, edit it, and type admin to make that user admin of the system.


When user type is set as admin refresh the system and login again. Then the user will be an admin and can use all the admin features.









