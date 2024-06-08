<p align="left"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# SAIS 改
## Overview
The UPM Enrollment System is a web-based application designed to streamline the enrollment process for students and professors at the University of the Philippines Manila (UPM). It provides a user-friendly interface for students to enroll in subjects and for professors to manage their classes and student enrollments.

## Features
#### Student-Professor Features
    1. Account Creation
        - Create Account: Students can create an account by providing necessary details and setting a password.
            - Details: Name, Email, Role (Student / Professor), password
    2. Login
        - Students can log in using their email and password.
        - Forgot Password Feature

#### Student-Specific Features
    1. Search Subjects
        - Subjects can be searched using keywords or subject name.
    2. Manage Cart
        - Can add and remove subjects in their Cart -> For Enrollment

#### Professor-Specific Features
    1. Manage Subjects
        - Professors can add new subjects and specify class size.
        - View Class List
        - Remove enrolled student in a class.


## Setup Instructions
### Prerequisites
- IDE (IntelliJ or Visual Studio Code)
- Laravel
- PHP 7.4 or higher
- MySQL or PostgreSQL Database
- Composer (For PHP Dependencies)
- Node.js and npm (For Frontend Dependencies and Build Tools)

### Installation Links
- Visual Studio Code: https://code.visualstudio.com/download
- PostgreSQL: https://www.postgresql.org/download/
- XAMPP: https://www.apachefriends.org/download.html
- Composer: https://getcomposer.org/download/


## Running The Program
##### 1. Clone Repository
    git clone https://github.com/krispybataa/machine-problem.git


##### 2. Install Backend Dependencies
    composer install

##### 3. Install Frontend Dependencies
    npm install
    npm run build

##### 4. Set Up Environmental Variables
    Edit .env Files
    Note: Make sure to correctly fill up Database Credentials

##### 5. Run Database Migrations
    php artisan migrate

##### 6. Serve The Application
    php artisan serve


## Using The Program
##### 1. Access The Application
    Open Web Browser and type in the provided local host link in Terminal

##### 2. Student Workflow
    - Create an account using the "Register" link.
    - Log in with your new account.
    - Search for subjects and add them to your cart.
    - Checkout to finalize your enrollment.

##### 3. Professor Workflow
    - Create an account using the "Register" link.
    - Log in with your new account.
    - Add new subjects and specify the available slots.
    - View the list of students enrolled in your subjects.
    - Remove students from your subjects if necessary.


## Entity Relationship Diagram
<p align="LEFT">
    <a href="https://github.com/krispybataa/machine-problem" target="_blank">
        <img src="https://raw.githubusercontent.com/krispybataa/machine-problem/a45d6e68eeff9c0c63622c280f61a6997ee080d1/resources/images/erd.png" width="400" alt="ERD">
    </a>
</p>


## Contact Us
- RODRIGUEZ, Augustus Clark Raphael P.  | aprodriguez7@up.edu.ph
- ACOSTA II, Harry William R. | hracosta@up.edu.ph
- BALMACEDA, Gabriel Angelo S.  | gsbalmaceda@up.edu.ph
- PERILLO, Jasper Anthony G. | jgperillo@up.edu.ph
- SURBAN, Alyssa Nicole J. | ajsurban@up.edu.ph
