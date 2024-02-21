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
  ('Rebbeca', 'Marie Gomez', 'Becky G', '1997-03-02', 'Becky_g.jpg', 'Reggaeton and Latin pop artist'),
  ('Ibai', 'Llanos', 'Ibai', '1995-04-26', 'Ibai.jpg', 'Idolo');

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
  (1, 'Amanece', 'Amanece.mp3', 'Amanece.jpg'),
  (1, 'Asesina Remix', 'Asesina Remix.mp3', 'Asesina Remix.jpg'),
  (1, 'Baila Morena', 'Baila Morena.mp3', 'Baila Morena.jpg'),
  (1, 'Bandoleros', 'Bandoleros.mp3', 'Bandoleros.jpg'),
  (2, 'Candy', 'Candy.mp3', 'Candy.jpg'),
  (1, 'Coco Chanel', 'Coco Chanel.mp3', 'Coco Chanel.jpg'),
  (1, 'CÓMO SE SIENTE Remix', 'CÓMO SE SIENTE Remix.mp3', 'CÓMO SE SIENTE Remix.jpg'),
  (3, 'Dale Don Dale' , 'Dale Don Dale.mp3', 'Dale Don Dale.jpg'),
  (4, 'Danza Kuduro', 'Danza Kuduro.mp3', 'Danza Kuduro.jpg'),
  (4, 'Delincuente', 'Delincuente.mp3', 'Delincuente.jpg'),
  (4, 'Dembow y Reggaeton', 'Dembow y Reggaeton.mp3', 'Dembow y Reggaeton.jpg'),
  (5, 'Diles', 'Diles.mp3', 'Diles.jpg'),
  (6, 'Diva virtual', 'Diva virtual.mp3', 'Diva virtual.jpg'),
  (6, 'El Efecto' , 'El Efecto.mp3', 'El Efecto.jpg'),
  (6, 'El Farsante' , 'El Farsante.mp3', 'El Farsante.jpg'),
  (6, 'Es un secreto', 'Es un secreto.mp3', 'Es un secreto.jpg'),
  (6, 'Guaya Guaya', 'Guaya Guaya.mp3', 'Guaya Guaya.jpg'),
  (6, 'Hasta Que Dios Diga', 'Hasta Que Dios Diga.mp3', 'Hasta Que Dios Diga.jpg'),
  (6, 'Hey Mor', 'Hey Mor.mp3', 'Hey Mor.jpg'),
  (6, 'Kemba Walker', 'Kemba Walker.mp3', 'Kemba Walker.jpg'),
  (6, 'La Curiosidad', 'La Curiosidad.mp3', 'La Curiosidad.jpg'),
  (6, 'La Despedida', 'La Despedida.mp3', 'La Despedida.jpg'),
  (6, 'La Modelo' , 'La Modelo.mp3', 'La Modelo.jpg'),
  (6, 'La Nota', 'La Nota.mp3', 'La Nota.jpg'),
  (6, 'LA ROMANA', 'LA ROMANA.mp3', 'LA ROMANA.jpg'),
  (6, 'La Rompe Corazones', 'La Rompe Corazones.mp3', 'La Rompe Corazones.jpg'),
  (6, 'Manicomio', 'Manicomio.mp3', 'Manicomio.jpg'),
  (6, 'Mayor Que Yo', 'Mayor Que Yo.mp3', 'Mayor Que Yo.jpg'),
  (6, 'No Me Conoce Remix', 'No Me Conoce Remix.mp3', 'No Me Conoce Remix.jpg'),
  (6, 'PASIEMPRE', 'PASIEMPRE.mp3', 'PASIEMPRE.jpg'),
  (6, 'PERRO NEGRO' , 'PERRO NEGRO.mp3', 'PERRO NEGRO.jpg'),
  (6, 'Prrrum', 'Prrrum.mp3', 'Prrrum.jpg'),
  (6, 'Pa Que Retozen', 'Pa Que Retozen.mp3', 'Pa Que Retozen.jpg'),
  (6, 'Rakata', 'Rakata.mp3', 'Rakata.jpg'),
  (6, 'Rompe', 'Rompe.mp3', 'Rompe.jpg'),
  (6, 'Sábado Rebelde', 'Sábado Rebelde.mp3', 'Sábado Rebelde.jpg'),
  (6, 'SANDUNGA', 'SANDUNGA.mp3', 'SANDUNGA.jpg'),
  (6, 'Se Preparo', 'Se Preparo', 'Se Preparo.jpg'),
  (6, 'Si No Te Quisiera', 'Si No Te Quisiera.mp3', 'Si No Te Quisiera.jpg'),
  (6, 'Si Se Da Remix', 'Si Se Da Remix.mp3', 'Si Se Da Remix.jpg'),
  (6, 'Si Tu Novio Te Deja Sola', 'Si Tu Novio Te Deja Sola.mp3', 'Si Tu Novio Te Deja Sola.jpg'),
  (6, 'Sigueme y Te Sigo', 'Sigueme y Te Sigo.mp3', 'Sigueme y Te Sigo.jpg'),
  (6, 'Sola Remix', 'Sola Remix.mp3', 'Sola Remix.jpg'),
  (6, 'Travesuras', 'Travesuras.mp3', 'Travesuras.jpg'),
  (6, 'Tu Foto', 'Tu Foto.mp3', 'Tu Foto.jpg'),
  (6, 'Tu No Vive Asi', 'Tu No Vive Asi.mp3', 'Tu No Vive Asi.jpg'),
  (NULL, 'Tu madre tiene una polla', 'Tu madre tiene una polla.mp3', 'Tu madre tiene una polla.jpg'),
  (6, 'Vuelve', 'Vuelve.mp3', 'Vuelve.jpg'),
  (6, 'Yandel 150', 'Yandel 150.mp3', 'Yandel 150.jpg'),
  (6, 'Dile', 'Dile.mp3', 'Dile.jpg'),
  (6, 'Yo No Soy Tu Marido', 'Yo No Soy Tu Marido.mp3', 'Yo No Soy Tu Marido.jpg'),
  (6, 'Donde Estan Las Gatas', 'Donde Estan Las Gatas.mp3', 'Donde Estan Las Gatas.jpg'),
  (6, 'Cancion Con Yandel', 'Cancion Con Yandel.mp3', 'Cancion Con Yandel.jpg'),
  (6, 'El Telefono', 'El Telefono.mp3', 'El Telefono.jpg'),
  (6, 'La Forma En Que Me Miras', 'La Forma En Que Me Miras.mp3', 'La Forma En Que Me Miras.jpg')
  ;

  
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