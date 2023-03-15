CREATE TABLE utilisateur(
   id_user VARCHAR(50),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   image VARCHAR(50),
   ville VARCHAR(50),
   adressemail VARCHAR(50),
   mdp VARCHAR(50),
   roll VARCHAR(50),
   promo VARCHAR(50),
   datedenaissance DATE,
   description VARCHAR(50),
   pseudo VARCHAR(50),
   PRIMARY KEY(id_user)
);

CREATE TABLE post(
   id_post VARCHAR(50),
   message VARCHAR(50),
   image VARCHAR(50),
   likes VARCHAR(50),
   commantaires VARCHAR(50),
   nomcrea VARCHAR(50),
   titre VARCHAR(50),
   id_user VARCHAR(50),
   pseudo VARCHAR(50),
   publique BINARY(50),
   PRIMARY KEY(id_post)
);

CREATE TABLE message(
   id_message VARCHAR(50),
   id_receveur VARCHAR(50),
   date_mes DATETIME,
   text VARCHAR(50),
   id_envoye VARCHAR(50),
   PRIMARY KEY(id_message)
);

CREATE TABLE abonnemer(
   id_abonnement VARCHAR(50),
   id_user VARCHAR(50),
   PRIMARY KEY(id_abonnement)
);

CREATE TABLE likes(
   Id_likes COUNTER,
   id_user VARCHAR(50),
   id_post VARCHAR(50),
   likes_post BINARY(50),
   dislikes_post VARCHAR(50),
   PRIMARY KEY(Id_likes)
);

CREATE TABLE creer(
   id_user VARCHAR(50),
   id_post VARCHAR(50),
   PRIMARY KEY(id_user, id_post),
   FOREIGN KEY(id_user) REFERENCES utilisateur(id_user),
   FOREIGN KEY(id_post) REFERENCES post(id_post)
);

CREATE TABLE envoyer(
   id_user VARCHAR(50),
   id_message VARCHAR(50),
   PRIMARY KEY(id_user, id_message),
   FOREIGN KEY(id_user) REFERENCES utilisateur(id_user),
   FOREIGN KEY(id_message) REFERENCES message(id_message)
);

CREATE TABLE abonner(
   id_user VARCHAR(50),
   id_abonnement VARCHAR(50),
   PRIMARY KEY(id_user, id_abonnement),
   FOREIGN KEY(id_user) REFERENCES utilisateur(id_user),
   FOREIGN KEY(id_abonnement) REFERENCES abonnemer(id_abonnement)
);

CREATE TABLE aimer(
   id_user VARCHAR(50),
   Id_likes INT,
   PRIMARY KEY(id_user, Id_likes),
   FOREIGN KEY(id_user) REFERENCES utilisateur(id_user),
   FOREIGN KEY(Id_likes) REFERENCES likes(Id_likes)
);

CREATE TABLE appartenir(
   id_post VARCHAR(50),
   Id_likes INT,
   PRIMARY KEY(id_post, Id_likes),
   FOREIGN KEY(id_post) REFERENCES post(id_post),
   FOREIGN KEY(Id_likes) REFERENCES likes(Id_likes)
);
