-- Dades per a la taula Artista
INSERT INTO Artista (ID, Nom, Cognom, NomArtistic, Datanaix, Foto, Info)
VALUES 
  (1, 'Ramón', 'Ayala', 'Daddy Yankee', '1977-02-03', 'daddy_yankee.jpg', 'Reggaeton artist'),
  (2, 'Juan', 'Carlos Ozuna', 'Ozuna', '1992-03-13', 'ozuna.jpg', 'Reggaeton and Latin trap artist'),
  (3, 'Karol', 'G', 'Karol G', '1991-02-14', 'karol_g.jpg', 'Reggaeton and Latin pop artist'),
  (4, 'J Balvin', 'Balvin', 'J Balvin', '1985-05-07', 'j_balvin.jpg', 'Reggaeton and Latin urban artist'),
  (5, 'Becky', 'Gomez', 'Becky G', '1997-03-02', 'becky_g.jpg', 'Reggaeton and Latin pop artist');

-- Dades per a la taula Album
INSERT INTO Album (ID, ID_Artista, Titol, DataLlançament, Foto)
VALUES
  (1, 1, 'Barrio Fino', '2004-07-13', 'barrio_fino.jpg'),
  (2, 2, 'Odisea', '2017-08-25', 'odisea.jpg'),
  (3, 3, 'Ocean', '2019-05-03', 'ocean.jpg'),
  (4, 4, 'Vibras', '2018-05-25', 'vibras.jpg'),
  (5, 5, 'Mala Santa', '2018-10-17', 'mala_santa.jpg');

-- Dades per a la taula Canco
INSERT INTO Canco (ID, ID_Album, ID_Titol, Ruta, Img)
VALUES
  (1, 1, 1, 'gasolina.mp3', 'gasolina.jpg'),
  (2, 2, 1, 'criminal.mp3', 'criminal.jpg'),
  (3, 3, 1, 'tusa.mp3', 'tusa.jpg'),
  (4, 4, 1, 'mi_gente.mp3', 'mi_gente.jpg'),
  (5, 5, 1, 'sin_pijama.mp3', 'sin_pijama.jpg');

-- Dades per a la taula Crea_musica
INSERT INTO Crea_musica (ID_Canco, ID_Artista)
VALUES
  (1, 1),
  (2, 2),
  (3, 3),
  (4, 4),
  (5, 5);

-- Dades per a la taula Usuari
INSERT INTO Usuari (ID, Contrasenya, Nom, Email, Cognom, NomUsuari, Foto, Premium)
VALUES
  (1, 'contrasenya1', 'Maria', 'maria@email.com', 'Gomez', 'maria_g', 'maria.jpg', true),
  (2, 'contrasenya2', 'Pablo', 'pablo@email.com', 'Fernandez', 'pablo_f', 'pablo.jpg', false),
  (3, 'contrasenya3', 'Eva', 'eva@email.com', 'Lopez', 'eva_l', 'eva.jpg', true),
  (4, 'contrasenya4', 'Carlos', 'carlos@email.com', 'Martinez', 'carlos_m', 'carlos.jpg', false),
  (5, 'contrasenya5', 'Laura', 'laura@email.com', 'Rodriguez', 'laura_r', 'laura.jpg', true);

-- Dades per a la taula Llista_Reproduccio
INSERT INTO Llista_Reproduccio (ID, ID_Usuari, Nom)
VALUES
  (1, 1, 'Favorits'),
  (2, 2, 'Reggaeton Mix'),
  (3, 3, 'Latin Hits'),
  (4, 4, 'Top Charts'),
  (5, 5, 'Party Playlist');

-- Dades per a la taula Afegeix
INSERT INTO Afegeix (ID_Canco, ID_LlistaReproduccio)
VALUES
  (1, 1),
  (2, 2),
  (3, 3),
  (4, 4),
  (5, 5);

-- Dades per a la taula Genere
INSERT INTO Genere (ID, ID_Canco, Nom)
VALUES
  (1, 1, 'Reggaeton'),
  (2, 2, 'Reggaeton'),
  (3, 3, 'Reggaeton'),
  (4, 4, 'Reggaeton'),
  (5, 5, 'Reggaeton');