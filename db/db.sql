CREATE DATABASE cinema_management;
CREATE DATABASE IF NOT EXISTS cinema_management;

CREATE TABLE IF NOT EXISTS users(
    id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    address varchar(255) NOT NULL,
    phone varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL
    );

CREATE TABLE IF NOT EXISTS movies(
    id int PRIMARY KEY AUTO_INCREMENT,
    movie_name varchar(255) NOT NULL,
    description varchar(255) NOT NULL,
    image varchar(500) NOT NULL,
    time int NOT NULL,
    user_id int,
    FOREIGN KEY (user_id) REFERENCES users(id)
    );

CREATE TABLE IF NOT EXISTS categories(
    id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    description varchar(255) NOT NULL
    );

CREATE TABLE rooms(
    id int PRIMARY KEY AUTO_INCREMENT,
    room_name varchar(255) NOT NULL,
    number_of_seats varchar(255) NOT NULL,
    row_of_seats varchar(255) NOT NULL
);

CREATE TABLE movie_schedule(
    id int PRIMARY KEY AUTO_INCREMENT,
    time time NOT NULL,
    date date NOT NULL,
    movie_id int,
    room_id int,
    FOREIGN KEY(movie_id) REFERENCES movies(id),
    FOREIGN KEY(room_id) REFERENCES rooms(id)
);

CREATE TABLE IF NOT EXISTS category_movie(
    id int PRIMARY KEY AUTO_INCREMENT,
    movie_id int,
    category_id int,
    FOREIGN KEY(movie_id) REFERENCES movies(id),
    FOREIGN KEY(category_id) REFERENCES categories(id)
);

