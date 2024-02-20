-- Dades per a la taula Artista
INSERT INTO Artista (Nom, Cognom, NomArtistic, Datanaix, Foto, Info)
VALUES 
  ('Ramón Luis', 'Ayala Rodriguez', 'Daddy Yankee', '1977-02-03', 'Daddy_yankee.jpg', 'Reggaeton artist'),
  ('Juan', 'Carlos Ozuna', 'Ozuna', '1992-03-13', 'Ozuna.jpg', 'Reggaeton and Latin trap artist'),
  ('Karol', 'G', 'Karol G', '1991-02-14', 'Karol_g.jpg', 'Reggaeton and Latin pop artist'),
  ('J Balvin', 'Balvin', 'J Balvin', '1985-05-07', 'J_balvin.jpg', 'Reggaeton and Latin urban artist'),
  ('Orlando Javier', 'Valle Vega', 'Chencho Corleone', '1979-02-19', 'Chencho_corleone.jpg', 'Reggaeton and Latin urban artist'),
  ('Edwin', 'Vázquez Vega', 'Maldy', '1982-07-29', 'Maldy.jpg', 'Reggaeton and Latin urban artist'),
  ('William Omar', 'Landrón Rivera', 'Don Omar', '1978-02-10', 'Don_omar.jpg', 'Reggaeton and Latin urban artist'),
  ('Benito Antonio', 'Martínez Ocasio', 'Bad Bunny', '1994-3-10', 'Bad_bunny.jpg', 'Reggaeton and Latin pop artist'),
  ('Carlos Efrén', 'Reyes Rosado', 'Farruko', '1991-05-03', 'Farruko.jpg', 'Reggaeton artist'),
  ('Raúl Alejandro', 'Ocasio Ruiz', 'Rauw Alejandro', '1993-01-10', 'Rauw_alejandro.jpg', 'Reggaeton artist'),
  ('Bryan Robert', 'Rohena Pérez', 'Bryant Myers', '1998-04-05', 'Bryant_myers.jpg', 'Reggaeton artist'),
  ('Kevin Manuel', 'Rivera Allende', 'Kevvo', '1998-02-10', 'Kevvo.jpg', 'Reggaeton artist'),
  ('Pedro David', 'Daleccio Torres', 'Dalex', '1990-10-07', 'Dalex.jpg', 'Reggaeton artist'),
  ('Edgardo Rafael', 'Cuevas Feliciano', 'Lyanno', '1995-4-22', 'Lyanno.jpg', 'Reggaeton artist'),
  ('Emmanuel', 'Gazmey Santiago', 'Anuel AA', '1992-11-26', 'Anuel_aa.jpg', 'Reggaeton artist'),
  ('Belcalis', 'Marlenis Almánzar', 'Cardi B', '1992-10-11', 'Cardi_b.jpg', 'Reggaeton artist'),
  ('Manuel', 'Turizo Zapata', 'Manuel Turizo', '2000-04-12', 'Manuel_turizo.jpg', 'Reggaeton artist'),
  ('Michael Anthony', 'Torres Monge', 'Myke Towers', '1994-01-15', 'Myke_towers.jpg', 'Reggaeton artist'),
  ('José Fernando', 'Cosculluela Suárez', 'Cosculluela', '1980-10-15', 'Cardi_b.jpg', 'Reggaeton artist'),
  ('Juan Manuel', 'Magán González', 'Juan Magán', '1978-09-30', 'Cardi_b.jpg', 'Reggaeton and Latin hip hop artist'),
  ('Nick', 'Rivera Caminero', 'Nicky Jam', '1981-03-17', 'Nicky_jam.jpg', 'Reggaeton artist'),
  ('Austin', 'Santos', 'Arcángel', '1938-12-23', 'Arcángel.jpg', 'Reggaeton artist'),
  ('Rebbeca', 'Marie Gomez', 'Becky G', '1997-03-02', 'Becky_g.jpg', 'Reggaeton and Latin pop artist');

-- Dades per a la taula Album
INSERT INTO Album (ID_Artista, Titol, DataLlançament, Foto)
VALUES
  (1, 'Meet the Orphans', '2010-11-16', 'Meet the Orphans.jpg'),
  (2, 'X 100PRE', '2018-12-24', 'X 100PRE.jpg'),
  (3, 'iDon', '2009-04-28', 'iDon.jpg'),
  (4, 'The Last Don II', '2018-05-25', 'The Last Don II.jpg'),
  (5, 'Mundial', '2010-04-27', 'Mundial.jpg'),
  (6, 'The Last Don', '2003-01-01', 'The Last Don.jpg');

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