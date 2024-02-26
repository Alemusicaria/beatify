CREATE TABLE Artista (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(255),
    Cognom VARCHAR(255),
    NomArtistic VARCHAR(255),
    Datanaix DATE,
    Foto VARCHAR(255),
    Info TEXT
);

CREATE TABLE Album (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    ID_Artista INT,
    Titol VARCHAR(255),
    DataLlançament DATE,
    Foto VARCHAR(255),
    FOREIGN KEY (ID_Artista) REFERENCES Artista(ID)
);

CREATE TABLE Genere (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(255)
);

CREATE TABLE Canco (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    ID_Album INT,
    Titol VARCHAR(255),
    Ruta VARCHAR(255),
    Img VARCHAR(255),
    ID_Genere INT,
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
    Contrasenya VARCHAR(255),
    Nom VARCHAR(255),
    Email VARCHAR(255),
    Cognom VARCHAR(255),
    NomUsuari VARCHAR(255),
    Foto VARCHAR(255),
    Premium BOOLEAN
);

CREATE TABLE Llista_Reproduccio (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    ID_Usuari INT,
    Nom VARCHAR(255),
    FOREIGN KEY (ID_Usuari) REFERENCES Usuari(ID)
);

CREATE TABLE Afegeix (
    ID_Canco INT,
    ID_LlistaReproduccio INT,
    PRIMARY KEY (ID_Canco, ID_LlistaReproduccio),
    FOREIGN KEY (ID_Canco) REFERENCES Canco(ID),
    FOREIGN KEY (ID_LlistaReproduccio) REFERENCES Llista_Reproduccio(ID)
);
