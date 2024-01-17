SET SQL_SAFE_UPDATES = 0;
CREATE DATABASE CAR;
USE CAR;

CREATE TABLE users
(
	user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_name VARCHAR(40) NOT NULL UNIQUE,
    user_password VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL UNIQUE,
    user_type ENUM("admin", "user"),
    booked enum("no", "yes"),
    verify enum("waiting" ,"valid", "invalid"),
    Comment VARCHAR(255)
);
update users set booked = "no" where user_id = 4;
select * from users;

CREATE TABLE users_info
(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_id INT NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    driverLicense VARCHAR(255) NOT NULL,
	birth_date DATE NOT NULL,
    phone_number INT NOT NULL,
    address VARCHAR(255) NOT NULL,
    zip_code VARCHAR(10) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
drop table users_info;
select * from users_info;

CREATE TABLE Cars (
    car_id INT AUTO_INCREMENT PRIMARY KEY,
    Brand VARCHAR(50) NOT NULL,
    Model VARCHAR(50) NOT NULL,
    Price DECIMAL(10,2),
    Year DATE,
    car_image VARCHAR(255) NOT NULL,
    LicensePlate VARCHAR(8) UNIQUE,
    Availability ENUM("no", "yes"),
    rent_buy ENUM("rent", "buy")
);
select * from Cars;

CREATE TABLE Favorite
(
	id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    car_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (car_id) REFERENCES Cars(car_id)
);
select * from Favorite;
CREATE TABLE Orders
(
	order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    car_id INT NOT NULL,
    rent_buy ENUM("rent", "buy"),
    startDate DATE,
    endDate DATE,
    comment TEXT,
    orderDate DATE NOT NULL,
    take enum("in use", "not in use"),
    paid ENUM("Has paid", "Has not paid yet") NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (car_id) REFERENCES Cars(car_id)
);
truncate table Orders;
drop table Orders;
select * from Orders;

CREATE TABLE contact
(
	contact_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(20) NOT NULL,
    email VARCHAR(60) NOT NULL,
    message VARCHAR(255) NOT NULL,
    contactDate DATE NOT NULL,
    is_read enum("no", "yes"),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
select * from contact;