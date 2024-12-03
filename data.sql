
create database ecommerce;
use ecommerce;

CREATE TABLE Remise(
  CodeRemise int  PRIMARY KEY,
  Taux int,
  CodeC varchar(10) ,
 FOREIGN KEY (CodeC) REFERENCES categorieclients (CodeC)
);

select * from  Remise;


CREATE TABLE Categorieclients (
  CodeC varchar(10)  PRIMARY KEY ,
  Libelle varchar(40),
  Remise int 
);
insert into Categorieclients (CodeC,Libelle,Remise)
values ('P','Client Prestige ',10);
insert into Categorieclients (CodeC,Libelle,Remise)
values ('F','Client Fidèle ',5);
insert into Categorieclients (CodeC,Libelle,Remise)
values ('O','Client Ordinaire ',0);
select * from  Categorieclients;


CREATE TABLE Categorie(
  CodeCateg int PRIMARY KEY,
  Libelle varchar(40) 
);

select * from  Categorie;

CREATE TABLE Client(
  CIN varchar(20) PRIMARY KEY,
  Nom varchar(30) ,
  Pernom varchar(20) ,
  email varchar(40) ,
  mdp varchar(20) ,
  Adresse varchar(30),
  Tel int ,
  CodeC int 
);

select * from  Client;


CREATE TABLE Commande(
  CodeCde int PRIMARY KEY  AUTO_INCREMENT,
  Montant decimal(6,2) ,
  DateC date ,
  Client varchar(20) ,
  FOREIGN KEY (Client) REFERENCES Client (CIN)
);

alter table Commande
add valide int default 0;

select * from  Commande;


CREATE TABLE Detailcde (
  CodeCde int,
  CodePrd int ,
  Prix decimal(6,2) ,
  Quantite int,
  total decimal(6,2) ,
  FOREIGN KEY (CodeCde) REFERENCES Commande (CodeCde),
  FOREIGN KEY (CodePrd) REFERENCES produits (Codeproduit)
);

select * from  Detailcde;


CREATE TABLE Gestionnaire (
  CodeGes varchar(30) PRIMARY KEY,
  Nom varchar(30) ,
  Prenom varchar(40) ,
  mdp varchar(40) 
) ;

select * from  Gestionnaire;





CREATE TABLE Panier (
  Client varchar(20),
  CodePrd int ,
 FOREIGN KEY (Client) REFERENCES Client (CIN),
  FOREIGN KEY (CodePrd) REFERENCES Produits(Codeproduit)
) ;

select * from  Panier;


CREATE TABLE Produits (
  Codeproduit int PRIMARY KEY,
  Libelle varchar(30) ,
  Descritption varchar(100) ,
  Prix decimal(6,2) ,
  PrixPromo decimal(6,2) ,
  Stock varchar(50) ,
  CodeCateg int,
  image varchar(100) ,
  FOREIGN KEY (CodeCateg) REFERENCES categorie (CodeCateg)
) 


select * from  Produits;

CREATE TABLE Livraison (
  CodeCde int,
  DateL date ,
 FOREIGN KEY (CodeCde) REFERENCES Commande (CodeCde)
) ;

select * from  Livraison;




