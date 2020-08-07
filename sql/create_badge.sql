CREATE TABLE col_badge (
	id_badge INT PRIMARY KEY AUTO_INCREMENT,
    nom varchar(100) NOT NULL,
    description text NOT NULL,
    image varchar(255) NOT NULL
);

CREATE TABLE col_badge_association (
	id_membre INT REFERENCES col_membre(id_membre),
    id_badge INT REFERENCES col_badge(id_badge)
);