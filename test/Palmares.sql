CREATE TABLE palmares (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_membre INT,
    competition VARCHAR(100) NOT NULL,
    resultat VARCHAR(100) NOT NULL,
    annee INT NOT NULL,
    FOREIGN KEY (id_membre) REFERENCES membres(id)
);
