
CREATE TABLE "User" (
    "id" int   NOT NULL,
    "email" VARCHAR(180)   NOT NULL,
    "roles" JSON   NOT NULL,
    "password" VARCHAR(255)   NOT NULL,
    "nom" VARCHAR(255)?   NOT NULL,
    "prenom" VARCHAR(255)?   NOT NULL,
    "api_token" VARCHAR(255)   NOT NULL,
    CONSTRAINT "pk_User" PRIMARY KEY (
        "id"
     ),
    CONSTRAINT "uc_User_email" UNIQUE (
        "email"
    )
);

CREATE TABLE "Race" (
    "id" int   NOT NULL,
    "nom" VARCHAR(255)   NOT NULL,
    CONSTRAINT "pk_Race" PRIMARY KEY (
        "id"
     )
);

CREATE TABLE "Habitat" (
    "id" int   NOT NULL,
    "nom" VARCHAR(255)   NOT NULL,
    "description" LONGTEXT   NOT NULL,
    CONSTRAINT "pk_Habitat" PRIMARY KEY (
        "id"
     )
);

CREATE TABLE "Animal" (
    "id" int   NOT NULL,
    "prenom" VARCHAR(255)   NOT NULL,
    "description" LONGTEXT   NOT NULL,
    "race_id" int   NOT NULL,
    "habitat_id" int   NOT NULL,
    CONSTRAINT "pk_Animal" PRIMARY KEY (
        "id"
     )
);

CREATE TABLE "Image" (
    "id" int   NOT NULL,
    "url" string   NOT NULL,
    "animal_id" int   NOT NULL,
    "habitat_id" int   NOT NULL,
    CONSTRAINT "pk_Image" PRIMARY KEY (
        "id"
     )
);

CREATE TABLE "RapportVeterinaire" (
    "id" int   NOT NULL,
    "etat" LONGTEXT   NOT NULL,
    "date" datetime   NOT NULL,
    "description" LONGTEXT?   NOT NULL,
    "animal_id" int   NOT NULL,
    CONSTRAINT "pk_RapportVeterinaire" PRIMARY KEY (
        "id"
     ),
    CONSTRAINT "uc_RapportVeterinaire_animal_id" UNIQUE (
        "animal_id"
    )
);

CREATE TABLE "Avis" (
    "id" int   NOT NULL,
    "pseudo" VARCHAR(255)   NOT NULL,
    "commentaire" LONGTEXT   NOT NULL,
    "is_validated" boolean   NOT NULL,
    "created_at" datetime   NOT NULL,
    CONSTRAINT "pk_Avis" PRIMARY KEY (
        "id"
     )
);

CREATE TABLE "Service" (
    "id" int   NOT NULL,
    "nom" string!   NOT NULL,
    "description" text   NOT NULL,
    "image_id" int   NOT NULL,
    CONSTRAINT "pk_Service" PRIMARY KEY (
        "id"
     )
);

CREATE TABLE "ContactRequest" (
    "id" int   NOT NULL,
    "email" VARCHAR(255)   NOT NULL,
    "titre" VARCHAR(255)   NOT NULL,
    "description" LONGTEXT   NOT NULL,
    "created_at" datetime?   NOT NULL,
    CONSTRAINT "pk_ContactRequest" PRIMARY KEY (
        "id"
     )
);

ALTER TABLE "Animal" ADD CONSTRAINT "fk_Animal_race_id" FOREIGN KEY("race_id")
REFERENCES "Race" ("id");

ALTER TABLE "Animal" ADD CONSTRAINT "fk_Animal_habitat_id" FOREIGN KEY("habitat_id")
REFERENCES "Habitat" ("id");

ALTER TABLE "Image" ADD CONSTRAINT "fk_Image_animal_id" FOREIGN KEY("animal_id")
REFERENCES "Animal" ("id");

ALTER TABLE "Image" ADD CONSTRAINT "fk_Image_habitat_id" FOREIGN KEY("habitat_id")
REFERENCES "Habitat" ("id");

ALTER TABLE "RapportVeterinaire" ADD CONSTRAINT "fk_RapportVeterinaire_animal_id" FOREIGN KEY("animal_id")
REFERENCES "Animal" ("id");

ALTER TABLE "Service" ADD CONSTRAINT "fk_Service_image_id" FOREIGN KEY("image_id")
REFERENCES "Image" ("id");





--  INSERTS EXEMPLES


-- UTILISATEURS (USER)
INSERT INTO "user" (email, roles, password, nom, prenom, api_token) VALUES
('admin@zoo.fr', '["ROLE_ADMIN"]', '$2y$13$hashadmin', 'Dubois', 'José', 'tokenadmin123'),
('employe1@zoo.fr', '["ROLE_EMPLOYEE"]', '$2y$13$hashemp1', 'Martin', 'Sophie', 'tokenemp456'),
('vet2@zoo.fr', '["ROLE_VET"]', '$2y$13$hashemp2', 'Bernard', 'Luc', 'tokenvet789');

-- RACES
INSERT INTO race (nom) VALUES
('Lion'),
('Tigre'),
('Girafe');

-- HABITATS
INSERT INTO habitat (nom, description) VALUES
('Savane', 'Grande plaine pour les animaux africains.'),
('Jungle', 'Zone humide les tigres et les singes.');

-- ANIMAUX
INSERT INTO animal (prenom, description, habitat_id, race_id) VALUES
('Simba', 'Jeune lion courageux.', 1, 1),
('Shere Khan', 'Tigre majestueux.', 2, 2),
('Zazie', 'Girafe très curieuse.', 1, 3);

-- IMAGES (verknüpft zu animal und habitat, die URLs sind Beispiele)
INSERT INTO image (url, animal_id, habitat_id) VALUES
('/uploads/lion1.jpg', 1, 1),
('/uploads/tigre1.jpg', 2, 2),
('/uploads/girafe1.jpg', 3, 1);

-- RAPPORT VÉTÉRINAIRE
INSERT INTO rapport_veterinaire (etat, date, description, animal_id) VALUES
('En bonne santé', '2024-06-01 10:00:00', 'Contrôle complet, aucun problème détecté.', 1),
('Blessure mineure', '2024-06-02 14:00:00', 'Petite coupure à la patte soignée.', 2);

-- AVIS
INSERT INTO avis (pseudo, commentaire, is_validated) VALUES
('Claire', 'Superbe visite, les animaux sont magnifiques !', TRUE),
('Mathieu', 'Trop de monde ce week-end.', FALSE);

-- SERVICES
INSERT INTO service (nom, description) VALUES
('Snack', 'Restauration rapide pour les visiteurs.'),
('Boutique', 'Souvenirs et peluches du zoo.');

-- CONTACT_REQUEST
INSERT INTO contact_request (email, titre, description) VALUES
('julien.visiteur@mail.com', 'Horaires d\'ouverture', 'Bonjour, le zoo est-il ouvert les jours fériés ?'),
('amelie@gmail.com', 'Perte d\'objet', 'J\'ai perdu mon chapeau près du snack, l\'avez-vous retrouvé ?');

