CREATE TABLE historique_grade (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_membre INT,
    ceinture VARCHAR(50) NOT NULL,
    date_passage DATE NOT NULL,
    document VARCHAR(255),
    FOREIGN KEY (id_membre) REFERENCES membres(id)
);
