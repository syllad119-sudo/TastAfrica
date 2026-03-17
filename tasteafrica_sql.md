# Réponses aux Missions

## Mission 1 : Modelisation avec looping

Merise: MCD
(![MCD sur looping](capture_looping/mcd_pixelbaysql.png))

Merise: MLD
(![MLD sur looping](capture_looping/mld_pixelbaysql.png))


---
# Création de la base de donnees et les tables 

```sql
CREATE DATABASE IF NOT EXISTS taste_africa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE taste_africa;

DROP TABLE IF EXISTS taste_africa_category;
DROP TABLE IF EXISTS taste_africa_comment;
DROP TABLE IF EXISTS tasteafrica_product;
DROP TABLE IF EXISTS taste_africa_category;
DROP TABLE IF EXISTS taste_africa_user;
DROP TABLE IF EXISTS taste_africa_comment;
DROP TABLE IF EXISTS taste_africa_contact;

---
## Mission 2 : Création des tables 

CREATE TABLE taste_africa_user(
user_id INT auto_increment,
email VARCHAR(255) NOT NULL UNIQUE, /*Contrainte "Unique" ajouter directement dans phpmyadmin -> structure -> more -> unique*/
name VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
role VARCHAR(255) NOT NULL DEFAULT 'client',
date_time  DATE NOT NULL,
PRIMARY KEY(user_id),
UNIQUE(email)
);

CREATE TABLE taste_africa_order(
order_id INT auto_increment,
order_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, /*Perfectionnenment => on peut mettre "DEFAULT 
    ON UPDATE CURRENT_TIMESTAMP" a la place de datetime pour que le fuseau horaire soit pris en compte et donc la valeur et plus précise qu'un simple datetime*/
status  ENUM('en attente','expédiée','livrée','annulée') NOT NULL, /* On preferera enum à boolean car il y a plus de 2 réponses possibles, le not null doit etre APRES enum*/
user_id INT NOT NULL,
PRIMARY KEY(order_id ),
FOREIGN KEY(user_id) REFERENCES taste_africa_user(user_id) on delete cascade
);

CREATE TABLE taste_africa_category (
category_id INT auto_increment ,
name VARCHAR(50),
PRIMARY KEY(category_id )
);

CREATE TABLE product (
product_id INT auto_increment ,
name VARCHAR(255) NOT NULL,
price DECIMAL(5,2) NOT NULL,
in_stock boolean NOT NULL DEFAULT true, /*Attention, la valeur par defaut n'est pas une chaine de caractere donc il ne faut pas mettre sa valeur entre guillemets*/
created_at_DATE NOT nULL,
image Varchar(50) not null,
category_id INT NOT NULL,
PRIMARY KEY(product_id ),
FOREIGN KEY(category_id ) REFERENCES category (category_id ) on delete cascade
);

CREATE TABLE px_order_product (
order_id INT,
product_id INT,
PRIMARY KEY(order_id , product_id ),
FOREIGN KEY(order_id ) REFERENCES px_order(order_id ) on delete cascade ,
FOREIGN KEY(product_id ) REFERENCES product (product_id ) on delete cascade
);

CREATE TABLE taste_africa_comment(
   id_comment VARCHAR(50),
   contenu_text VARCHAR(50) NOT NULL,
   created_at DATE,
   name VARCHAR(50) NOT NULL,
   product_id  INT NOT NULL,
   user_id INT NOT NULL,
   PRIMARY KEY(id_comment),
   FOREIGN KEY(product_id ) REFERENCES tasteafrica_product (product_id ),
   FOREIGN KEY(user_id) REFERENCES taste_africa_user(user_id)
);

CREATE TABLE taste_africa_contact(
   id_contact_ VARCHAR(50),
   last_name  VARCHAR(50) NOT NULL,
   first_name  VARCHAR(50) NOT NULL,
   email VARCHAR(50) NOT NULL,
   message_ TEXT NOT NULL,
   date_time  DATE NOT NULL,
   PRIMARY KEY(id_contact_),
   UNIQUE(email)
);

### Insertion des donnees 
INSERT INTO taste_africa_category (name) VALUES

('Plats'),
('Boissons'),
('Desserts');


INSERT INTO tasteafrica_product (name, desc_, price, image, in_stock, category_id) VALUES
('Poulet Yassa',  'Poulet mariné aux oignons et citron',       12.50, 'yassapoulet.png',  10, 1),
('Thieb Poisson', 'Riz cuisiné avec poisson et légumes',       15.00, 'tieb.png',         8,  1),
('Dibi Viande',   'Viande grillée accompagnée de riz rouge',   13.00, 'dibi.png',         5,  1),
('Jus de Bissap', 'Jus de fleurs d hibiscus',                  4.00,  'Bissap.png',       20, 2),
('Jus Gingembre', 'Jus de gingembre frais',                    4.00,  'Gingembre.png',    20, 2),
('Fondant Choco', 'Fondant au chocolat noir',                  6.00,  'Fondantchoco.png', 15, 3);


INSERT INTO taste_africa_user (email, name, password, role, date_creation) VALUES
(
  'mine@tasteafrica.com','mine','$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9lIC/.og/at2.uheWG/igi', -- password: secret
  'user',
  NOW()
),
(
  'moussa@tasteafrica.com','David','$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9lIC/.og/at2.uheWG/igi', -- password: secret
'user',
  NOW()
),
(
  'admin2@tasteafrica.com','Admin2','$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9lIC/.og/at2.uheWG/igi', -- password: secret
  'admin',
  NOW()