
create database booktopia;

use booktopia;

create table usuarios (

 id_usuario int not null primary key auto_increment,
 nombre_completo varchar(500) not null,
 correo varchar(500) not null,
 clave varchar(250) not null,
 id_rol int not null

);

create table roles (

id_rol int not null primary key auto_increment,
nombre_rol varchar(200) not null

);

create table libro (

id_libro int not null primary key auto_increment,
titulo varchar(200) not null,
id_autor int not null,
id_genero int not null,
id_categoria int not null,
precio decimal(10,2) not null,
formato int not null,
sinopsis varchar(12000) not null

);


create table carrito (

id_carrito int not null primary key auto_increment,
id_usuario int not null, 
fecha_creacion datetime not null,
total decimal(10,2)

);


create table libros_carrito(

id_libros_carrito int not null primary key auto_increment,
id_carrito int not null,
id_libro int not null,
cantidad_libro int not null

);


create table pedido (

id_pedido int not null primary key auto_increment,
id_usuario int not null,
fecha_pedido datetime not null,
estado_pedido int not null,
metodo_pago int not null

);

create table resena (

id_resena int not null primary key auto_increment,
id_usuario int not null,
id_libro int not null,
calificacion int null,
comentario varchar(12000) null 

);

create table foro (

id_foro int not null primary key auto_increment,
tema varchar(200) not null,
fecha_creacion datetime not null

);

create table publicaciones (

id_publicaciones int not null primary key auto_increment,
id_usuario int not null, 
id_foro int not null,
contenido varchar(12000) not null,
fecha_publicacion datetime not null

);

create table generos (

id_genero int not null primary key auto_increment,
nombre_genero varchar(1200) not null,
descripcion varchar(12000) null

);

create table categorias (

id_categoria int not null primary key auto_increment,
nombre_categoria varchar(1200) not null,
descripcion varchar (12000)
 
);

create table libros_pedido (

id_libros_pedido int not null primary key auto_increment,
id_pedido int not null,
id_libro int not null,
cantidad int not null,
precio_unitario decimal(10,2) not null

);


2. Creación de las llaves foraneas

ALTER TABLE usuarios 
ADD CONSTRAINT fk_usuarios_roles_1 
FOREIGN KEY (id_rol) 
REFERENCES roles (id_rol);


ALTER TABLE libro 
ADD CONSTRAINT fk_libros_autor_1
FOREIGN KEY (id_autor)
REFERENCES usuarios (id_usuario);


ALTER TABLE libro 
ADD CONSTRAINT fk_libros_genero_1
FOREIGN KEY (id_genero)
REFERENCES generos (id_genero);


ALTER TABLE libro 
ADD CONSTRAINT fk_libros_categorias_1
FOREIGN KEY (id_categoria)
REFERENCES categorias (id_categoria);


ALTER TABLE carrito 
ADD CONSTRAINT fk_carrito_usuario_1
FOREIGN KEY (id_usuario)
REFERENCES usuarios (id_usuario);


ALTER TABLE pedido 
ADD CONSTRAINT fk_pedido_usuario_1
FOREIGN KEY (id_usuario)
REFERENCES  usuarios (id_usuario);


ALTER TABLE libros_carrito 
ADD CONSTRAINT fk_libros_carrito_carrito_1
FOREIGN KEY (id_carrito)
REFERENCES carrito (id_carrito);


ALTER TABLE libros_carrito 
ADD CONSTRAINT fk_libros_carrito_libro_1
FOREIGN KEY (id_libro)mu
REFERENCES libro (id_libro);


ALTER TABLE resena 
ADD CONSTRAINT fk_resena_usuario_1
FOREIGN KEY (id_usuario)
REFERENCES  usuarios (id_usuario);


ALTER TABLE publicaciones 
ADD CONSTRAINT fk_publicaciones_usuario_1
FOREIGN KEY (id_usuario)
REFERENCES  usuarios (id_usuario);


ALTER TABLE libros_pedido
ADD CONSTRAINT fk_libros_pedido_pedido_1
FOREIGN KEY (id_pedido)
REFERENCES  pedido (id_pedido);


ALTER TABLE libros_pedido
ADD CONSTRAINT fk_libros_pedido_libros_1
FOREIGN KEY (id_libro)
REFERENCES  libro (id_libro);



ALTER TABLE libro
ADD COLUMN img varchar(2000) null;

ALTER TABLE libro
MODIFY img varchar(2000) null;