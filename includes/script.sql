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
    id          Int Auto_increment NOT NULL,
    first_name  Varchar(50) NOT NULL,
    last_name   Varchar(50) NOT NULL,
    contact     Varchar(50) NOT NULL,
    class       Varchar(50),
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
# Table: Loan
#------------------------------------------------------------
CREATE TABLE Loan
(
    id                  Int Auto_increment NOT NULL,
    id_user             Int NOT NULL,
    id_computer         Int NOT NULL,
    date_loan           Datetime NOT NULL,
    date_restitution    Datetime,
    state               VARCHAR(255),
    comment             VARCHAR(255),
    CONSTRAINT Emprunt_PK PRIMARY KEY (id),
    CONSTRAINT Emprunt_Customer_FK FOREIGN KEY (id_user) REFERENCES Customer (id),
    CONSTRAINT Emprunt_Computer_FK FOREIGN KEY (id_computer) REFERENCES Computer (id)
)ENGINE=InnoDB;

