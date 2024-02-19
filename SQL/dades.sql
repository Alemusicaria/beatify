-- Dades per a la taula Artista
INSERT INTO Artista (Nom, Cognom, NomArtistic, Datanaix, Foto, Info)
VALUES 
  ('Ramón', 'Ayala', 'Daddy Yankee', '1977-02-03', 'daddy_yankee.jpg', 'Reggaeton artist'),
  ('Juan', 'Carlos Ozuna', 'Ozuna', '1992-03-13', 'ozuna.jpg', 'Reggaeton and Latin trap artist'),
  ('Karol', 'G', 'Karol G', '1991-02-14', 'karol_g.jpg', 'Reggaeton and Latin pop artist'),
  ('J Balvin', 'Balvin', 'J Balvin', '1985-05-07', 'j_balvin.jpg', 'Reggaeton and Latin urban artist'),
  ('Becky', 'Gomez', 'Becky G', '1997-03-02', 'becky_g.jpg', 'Reggaeton and Latin pop artist');

-- Dades per a la taula Album
INSERT INTO Album (ID_Artista, Titol, DataLlançament, Foto)
VALUES
  (1, 'Barrio Fino', '2004-07-13', 'barrio_fino.jpg'),
  (2, 'Odisea', '2017-08-25', 'odisea.jpg'),
  (3, 'Ocean', '2019-05-03', 'ocean.jpg'),
  (4, 'Vibras', '2018-05-25', 'vibras.jpg'),
  (5, 'Mala Santa', '2018-10-17', 'mala_santa.jpg');

-- Dades per a la taula Canco
INSERT INTO Canco (ID_Album, Titol, Ruta, Img)
VALUES
  (1, 'gasolina', 'gasolina.mp3', 'gasolina.jpg'),
  (2, 'criminal', 'criminal.mp3', 'criminal.jpg'),
  (3, 'tusa' , 'tusa.mp3', 'tusa.jpg'),
  (4, 'mi gente', 'mi_gente.mp3', 'mi_gente.jpg'),
  (5, 'sin pijama', 'sin_pijama.mp3', 'sin_pijama.jpg');
  
-- Dades per a la taula Crea_musica
INSERT INTO Crea_musica (ID_Canco, ID_Artista)
VALUES
  (1, 1),
  (2, 2),
  (3, 3),
  (4, 4),
  (5, 5);

-- Dades per a la taula Usuari
INSERT INTO Usuari (Contrasenya, Nom, Email, Cognom, NomUsuari, Foto, Premium)
VALUES
  ('contrasenya1', 'Maria', 'maria@email.com', 'Gomez', 'maria_g', 'maria.jpg', true),
  ('contrasenya2', 'Pablo', 'pablo@email.com', 'Fernandez', 'pablo_f', 'pablo.jpg', false),
  ('contrasenya3', 'Eva', 'eva@email.com', 'Lopez', 'eva_l', 'eva.jpg', true),
  ('contrasenya4', 'Carlos', 'carlos@email.com', 'Martinez', 'carlos_m', 'carlos.jpg', false),
  ('contrasenya5', 'Laura', 'laura@email.com', 'Rodriguez', 'laura_r', 'laura.jpg', true);

-- Dades per a la taula Llista_Reproduccio
INSERT INTO Llista_Reproduccio (ID_Usuari, Nom)
VALUES
  (1, 'Favorits'),
  (2, 'Reggaeton Mix'),
  (3, 'Latin Hits'),
  (4, 'Top Charts'),
  (5, 'Party Playlist');

-- Dades per a la taula Afegeix
INSERT INTO Afegeix (ID_Canco, ID_LlistaReproduccio)
VALUES
  (1, 1),
  (2, 2),
  (3, 3),
  (4, 4),
  (5, 5);

-- Dades per a la taula Genere
INSERT INTO Genere (ID_Canco, Nom)
VALUES
  (1, 'Reggaeton'),
  (2, 'Reggaeton'),
  (3, 'Reggaeton'),
  (4, 'Reggaeton'),
  (5, 'Reggaeton');