#------------------------------------------------------------
# Table: Computer
#------------------------------------------------------------

CREATE TABLE Computer
(
    id     Int Auto_increment NOT NULL,
    serial Varchar(36) NOT NULL,
    brand  Varchar(50) NOT NULL,
    os     Varchar(50) NOT NULL,
    cpu    Varchar(50) NOT NULL,
    ram    Varchar(50) NOT NULL,
    CONSTRAINT Computer_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Customer
#------------------------------------------------------------
CREATE TABLE Customer
(
    id     Int Auto_increment NOT NULL,
    nom    Varchar(50) NOT NULL,
    prenom Varchar(50) NOT NULL,
    coord  Varchar(50) NOT NULL,
    classe Varchar(50),
    CONSTRAINT Customer_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------
CREATE TABLE User
(
    id          Int Auto_increment NOT NULL,
    username    Varchar(255) NOT NULL,
    password    Varchar(255) NOT NULL,
    CONSTRAINT User_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: emprunt
#------------------------------------------------------------
CREATE TABLE Emprunt
(
    id_user         Int         NOT NULL,
    id_computer     Int         NOT NULL,
    date_emprunt        Datetime    NOT NULL,
    date_restitution    Datetime    NOT NULL,
    etat            VARCHAR(255),
    commentaire     VARCHAR(255),
    CONSTRAINT emprunt_Customer_FK FOREIGN KEY (id_user) REFERENCES Customer (id),
    CONSTRAINT emprunt_Computer_FK FOREIGN KEY (id_computer) REFERENCES Computer (id)
)ENGINE=InnoDB;

