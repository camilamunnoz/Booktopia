INSERT INTO roles(id_rol, nombre_rol) VALUES(1, 'Administrador');
INSERT INTO roles(id_rol, nombre_rol) VALUES(2, 'Cliente');
INSERT INTO roles(id_rol, nombre_rol) VALUES(3, 'Autor');
INSERT INTO roles(id_rol, nombre_rol) VALUES(4, 'Visitante');

INSERT INTO usuarios(id_usuario, nombre_completo, correo, clave, id_rol) 
VALUES(1, 'Administrador', 'admin@outlook.com', 'admin1234', 1);