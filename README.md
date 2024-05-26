# VintageVolumes
<img src="VintageVolumesLogo.jpg" alt="VintageVolumesLogo" width="100"/>

VintageVolumes is a web platform designed for students to buy and sell secondhand textbooks within their college. The goal of this project is to create a convenient and cost-effective solution for students to exchange textbooks, helping them save money and reduce waste.


## Features

- **User Authentication:** Secure user accounts with login and registration functionality.
- **Book Listings:** Allow users to list their textbooks for sale, including details such as title, author, condition, and price.
- **Transaction History:** Provide users with a record of their past transactions for reference.

## Getting Started
The following are instructions on setting up the applicaion and database.
<details>
  <summary>Setting up the Applicaion</summary>
  
1. Clone the repository or download the zip folder.
2. Make sure you have xampp if not here how to install it: [Installing XAMPP](https://www.youtube.com/watch?v=aYA7B6xQC3Q)
3. Once downloaded move the cloned/unzipped folder into the htdocs folder. Following is the file htdocs file locaion:
  ```
C:\xampp\htdocs
  ```
 4. Open xampp application and start “Apache” and “MySQL”.
 5. Once started paste the following in the browser URL to run the application :
```
    http://localhost/VintageVolumes/index.php.
```
  6. The application will now run and at the top left it will say **"Connection Error"** as we have not yet created the database.

</details>

<details>
  <summary>Setting up the Database</summary>
  
  1.  Now go to phpmyadmin in xampp by clicking Admin of “MySQL” by the Actions section or paste the following into the browser URL: 
  
```
  http://localhost/phpmyadmin/
```
  2. Now that phpMyAdmin is open click the tab at the top that says SQL and paste the following and click the ‘Go’ button at the bottom in the blue background:
```
  CREATE DATABASE bookstore;
```
  3. You should now be able to see you new ‘bookstore’ database in the side panel on the left. Now click and navigate into that database.

  4.  Now click on the SQL tab again and paste the following to create the necessary tables:
```
CREATE TABLE tbluser(
ID int primary key AUTO_INCREMENT,
FName varchar(255),
LName varchar(255),
Email varchar(255),
Password varchar(255),
ULevel varchar(10)
);

CREATE TABLE cart(
    id int primary key AUTO_INCREMENT ,
    user_email text(100),
    title text(100),
    price int(100),
    image text(100),
    quantity int(100),
    author text(100),
    isbn text(100)
);

CREATE TABLE tblorder(
    id int primary key AUTO_INCREMENT ,
    user_email text(100),
    title text(100),
    price int(100),
    image text(100),
    quantity int(100),
    author text(100),
    isbn text(100)
);

CREATE TABLE newbooks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    img VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    isbn VARCHAR(13) NOT NULL,
    quantity INT NOT NULL,
    added_by INT NOT NULL
);
```
  
  5.  Now navigate into the 'tbluser' table in the sidebar to the left and the table will be empty.
  
  6.  Now redirect back to the application and click on the “Create an account” which will direct us to the Register page.
 
  7.  Enter the following details and click register:
```
Name: Kyle

Surname: Doe

Email: KyleDoe@gitam.in

Password: test123
```
  8.  You will be redirected to the Login page. Now lets go back to the database in phpmyadmin, when you refresh the page you will now see that our new person have been recorded:

  9.  Click the edit button by their name, we need to make their ULevel as admin
  
  10.  Change the ULevel from ‘pending’ to ‘admin’ and click go:

  11.  Good job! The applicaion is now ready, you can now watch the video on how to use the application.



</details>


## Video Demo


Click the image above 👆🏽 to watch a demo of VintageVolumes in action.

### Languages & Tools:

![Static Badge](https://img.shields.io/badge/HTML-orange?style=for-the-badge&logoColor=orange)
![Static Badge](https://img.shields.io/badge/CSS-purple?style=for-the-badge&logoColor=purple)
![Static Badge](https://img.shields.io/badge/PHP-darkblue?style=for-the-badge&logoColor=darkblue)
