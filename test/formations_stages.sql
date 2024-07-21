CREATE TABLE formations_stages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_membre INT,
    formation_stage VARCHAR(100) NOT NULL,
    annee INT NOT NULL,
    lieux VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_membre) REFERENCES membres(id)
);
