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

INSERT INTO users values(null,'user','Juan','Callejón','JuapiCallejon','Juan@callejon','admin',null,CURTIME(),CURTIME(),null);
INSERT INTO users values(null,'user','Pedro','Callejón','pedrito','pedro@callejon','admin',null,CURTIME(),CURTIME(),null);
INSERT INTO users values(null,'user','Paco','Callejón','paquito','paco@callejon','admin',null,CURTIME(),CURTIME(),null);
INSERT INTO users values(null,'user','Mercedes','Camacho','mc','mc@camacho','admin',null,CURTIME(),CURTIME(),null);

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

INSERT INTO images values(null,1,'test.jpg','registro de prueba',CURDATE(),CURDATE());
INSERT INTO images values(null,1,'test2.jpg','registro de prueba2',CURDATE(),CURDATE());
INSERT INTO images values(null,4,'test3.jpg','registro de prueba3',CURDATE(),CURDATE());
INSERT INTO images values(null,2,'test4.jpg','registro de prueba4',CURDATE(),CURDATE());

CREATE TABLE IF NOT EXISTS comments(
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

INSERT INTO comments values(null,1,4,'Buena foto!',CURDATE(),CURDATE());
INSERT INTO comments values(null,3,2,'Buena foto!2',CURDATE(),CURDATE());
INSERT INTO comments values(null,2,2,'Buena foto!3',CURDATE(),CURDATE());
INSERT INTO comments values(null,4,1,'Buena foto!4',CURDATE(),CURDATE());


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

INSERT INTO likes values(null,1,3,curdate(),curdate());

INSERT INTO likes values(null,2,3,curdate(),curdate());

INSERT INTO likes values(null,3,3,curdate(),curdate());

INSERT INTO likes values(null,4,3,curdate(),curdate());