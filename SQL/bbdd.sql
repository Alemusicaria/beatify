CREATE TABLE Artista (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(255),
    Cognom VARCHAR(255),
    NomArtistic VARCHAR(255),
    Datanaix DATE,
    Info TEXT
);

CREATE TABLE Album (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    ID_Artista INT,
    Titol VARCHAR(255),
    DataLlançament DATE,
    FOREIGN KEY (ID_Artista) REFERENCES Artista(ID)
);

CREATE TABLE Genere (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(255)
);

CREATE TABLE Canco (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    ID_Album INT,
    ID_Genere INT,
    Titol VARCHAR(255),
    FOREIGN KEY (ID_Album) REFERENCES Album(ID),
    FOREIGN KEY (ID_Genere) REFERENCES Genere(ID)
);

CREATE TABLE Crea_musica (
    ID_Canco INT,
    ID_Artista INT,
    PRIMARY KEY (ID_Canco, ID_Artista),
    FOREIGN KEY (ID_Canco) REFERENCES Canco(ID),
    FOREIGN KEY (ID_Artista) REFERENCES Artista(ID)
);

CREATE TABLE Usuari (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NomUsuari VARCHAR(255),
    Contrasenya VARCHAR(255),
    Nom VARCHAR(255),
    Cognom VARCHAR(255),
    Email VARCHAR(255),
    Foto VARCHAR(255),
    Premium BOOLEAN,
    Admin BOOLEAN
);

CREATE TABLE Llista_Reproduccio (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    ID_Usuari INT,
    Nom VARCHAR(255),
    Img VARCHAR(255),
    FOREIGN KEY (ID_Usuari) REFERENCES Usuari(ID)
);

CREATE TABLE Afegeix (
    ID_LlistaReproduccio INT,
    ID_Canco INT,
    PRIMARY KEY (ID_LlistaReproduccio, ID_Canco),
    FOREIGN KEY (ID_LlistaReproduccio) REFERENCES Llista_Reproduccio(ID),
    FOREIGN KEY (ID_Canco) REFERENCES Canco(ID)
);


CREATE TABLE Pagament (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(255),
    Cognom VARCHAR(255),
    NomUsuari VARCHAR(255),
    Email VARCHAR(255),
    Adreca VARCHAR(255),
    Adreca2 VARCHAR(255),
    Pais VARCHAR(255),
    CP INT(20),
    Tipus VARCHAR(255),
    Nom_tarjeta VARCHAR(255),
    Num_tarjeta VARCHAR(255),
    Expiracio VARCHAR(255),
    CVV INT(3)
);