CREATE DATABASE IF NOT EXISTS fotogramdb;
Use fotogramdb;
CREATE TABLE IF NOT EXISTS users(
    id int(255) AUTO_INCREMENT NOT NULL ,
    role VARCHAR (20),
    name VARCHAR (255),
    surname VARCHAR (255),
    nick VARCHAR (255),
    email VARCHAR (255),
    password VARCHAR (255),
    image VARCHAR (255)
    created_at DATETIME, 
    updated_at DATETIME, 
    remember_token VARCHAR (255),
    CONSTRAINT pk_users PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS images(
    id int(255) AUTO_INCREMENT NOT NULL ,
    user_id int(255) NOT NULL ,
    image_path VARCHAR (255),
    description text,
    created_at DATETIME, 
    updated_at DATETIME,
    CONSTRAINT pk_images PRIMARY KEY (id),
    CONSTRAINT fk_images_users FOREIGN KEY (user_id) references users(id) 
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS coments(
    id int(255) AUTO_INCREMENT NOT NULL,
    user_id int(255),
    image_id int(255),
    content text,
    created_at DATETIME, 
    updated_at DATETIME, 
    CONSTRAINT pk_coments PRIMARY KEY (id),
    CONSTRAINT fk_coments_users FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_coments_images FOREIGN KEY (image_id) REFERENCES images(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS likes(
    id int(255) AUTO_INCREMENT NOT NULL,
    user_id int(255),
    image_id int(255),
    created_at DATETIME, 
    updated_at DATETIME, 
    CONSTRAINT pk_likes PRIMARY KEY (id),
    CONSTRAINT fk_likes_users FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_images FOREIGN KEY (image_id) REFERENCES images(id)
)ENGINE=InnoDb;