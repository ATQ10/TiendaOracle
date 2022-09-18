-- Servidor: 25.10.253.194 en Hamachi
-- Versión del servidor: Oracle

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE carrito (
  idp varchar2(10) NOT NULL,
  idu varchar2(10) NOT NULL,
  cantidad number(10) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE categoria (
  idcat number(10) NOT NULL,
  categoria varchar2(250) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentar`
--

CREATE TABLE comentar (
  idu varchar2(10) NOT NULL,
  idp varchar2(10) NOT NULL,
  comentario varchar2(250) DEFAULT NULL,
  fecha_hora timestamp NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE compra (
  idc number(10) NOT NULL,
  idu varchar2(10) NOT NULL,
  monto float NOT NULL,
  cantidad number(10) NOT NULL,
  fecha_hora timestamp NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contener`
--

CREATE TABLE contener (
  idc number(10) NOT NULL,
  idp varchar2(10) NOT NULL,
  cantidad number(10) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE domicilio (
  idu varchar2(10) NOT NULL,
  cp number(10) DEFAULT NULL,
  calle varchar2(250) DEFAULT NULL,
  n_ext number(10) DEFAULT NULL,
  n_int number(10) DEFAULT NULL,
  colonia varchar2(250) DEFAULT NULL,
  ciudad varchar2(250) DEFAULT NULL,
  estado varchar2(250) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE mensaje (
  idm number(10) NOT NULL,
  idu varchar2(10) NOT NULL,
  mensaje varchar2(250) NOT NULL,
  fecha_hora timestamp NOT NULL,
  estado number(10) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidad`
--

CREATE TABLE origen (
  idn varchar2(5) NOT NULL,
  nacionalidad varchar2(250) NOT NULL,
  pais varchar2(250) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE producto (
  idp varchar2(10) NOT NULL,
  idcat number(10) NOT NULL,
  nombre varchar2(250) DEFAULT NULL,
  descripcion varchar2(250) DEFAULT NULL,
  precio float NOT NULL,
  existencia number(10) NOT NULL,
  promedio float NOT NULL,
  imagen varchar2(250) NOT NULL,
  idprov varchar2(10) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE proveedor (
  idprov varchar2(10) NOT NULL,
  nombre varchar2(250) NOT NULL,
  descripcion varchar2(250) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE usuario (
  idu varchar2(10) NOT NULL,
  nombre varchar2(250) DEFAULT NULL,
  ape_pat varchar2(250) DEFAULT NULL,
  ape_mat varchar2(250) DEFAULT NULL,
  fecha date NOT NULL,
  email varchar2(250) DEFAULT NULL,
  telefono varchar2(250) DEFAULT NULL,
  tipo varchar2(250) DEFAULT NULL,
  password varchar2(250) DEFAULT NULL,
  gustos varchar2(250) DEFAULT NULL,
  idnac varchar2(5) NOT NULL
);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE categoria
  ADD PRIMARY KEY (idcat);

--
-- Indices de la tabla `compra`
--
ALTER TABLE compra
  ADD PRIMARY KEY (idc);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE mensaje
  ADD PRIMARY KEY (idm);

--
-- Indices de la tabla `nacionalidad`
--
ALTER TABLE origen
  ADD PRIMARY KEY (idn);

--
-- Indices de la tabla `producto`
--
ALTER TABLE producto
  ADD PRIMARY KEY (idp);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE proveedor
  ADD PRIMARY KEY (idprov);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE usuario
  ADD PRIMARY KEY (idu);

--
-- SECUENCIAS PARA las tablas volcadas
--

--
-- SECUENCIAS PARA la tabla `categoria`
--
create sequence sec_categoria
  start with 1
  increment by 1
  maxvalue 10000
  minvalue 0
  cycle;

--
-- SECUENCIAS PARA la tabla `compra`
--
create sequence sec_compra
  start with 0
  increment by 1
  maxvalue 10000
  minvalue 0
  cycle;
--
-- SECUENCIAS PARA la tabla `mensaje`
--
create sequence sec_mensaje
  start with 0
  increment by 1
  maxvalue 10000
  minvalue 0
  cycle;
-- ----------------------------------------------------------
-- SECUENCIAS PARA `producto`, `proveedor` y `usuario`
-- ----------------------------------------------------------
create sequence sec_producto
  start with 0
  increment by 1
  maxvalue 1000
  minvalue 0
  cycle;

create sequence sec_proveedor
  start with 0
  increment by 1
  maxvalue 100
  minvalue 0
  cycle;

create sequence sec_usuario
  start with 0
  increment by 1
  maxvalue 1000
  minvalue 0
  cycle;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE carrito
  ADD CONSTRAINT carrito_ibfk_1 FOREIGN KEY (idu) REFERENCES usuario(idu);
ALTER TABLE carrito
  ADD CONSTRAINT carrito_ibfk_2 FOREIGN KEY (idp) REFERENCES producto(idp);
--
-- Filtros para la tabla `comentar`
--
ALTER TABLE comentar
  ADD CONSTRAINT comentar_ibfk_1 FOREIGN KEY (idu) REFERENCES usuario(idu);
ALTER TABLE comentar
  ADD CONSTRAINT comentar_ibfk_2 FOREIGN KEY (idp) REFERENCES producto(idp);
--
-- Filtros para la tabla `compra`
--
ALTER TABLE compra
  ADD CONSTRAINT compra_ibfk_1 FOREIGN KEY (idu) REFERENCES usuario(idu);

--
-- Filtros para la tabla `contener`
--
ALTER TABLE contener
  ADD CONSTRAINT contener_ibfk_1 FOREIGN KEY (idc) REFERENCES compra(idc) ON DELETE CASCADE;
ALTER TABLE contener
  ADD CONSTRAINT contener_ibfk_2 FOREIGN KEY (idp) REFERENCES producto(idp) ON DELETE CASCADE;

--
-- Filtros para la tabla `domicilio`
--
ALTER TABLE domicilio
  ADD CONSTRAINT domicilio_ibfk_1 FOREIGN KEY (idu) REFERENCES usuario(idu) ON DELETE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE mensaje
  ADD CONSTRAINT mensaje_ibfk_1 FOREIGN KEY (idu) REFERENCES usuario(idu) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE producto
  ADD CONSTRAINT producto_ibfk_1 FOREIGN KEY (idcat) REFERENCES categoria(idcat) ON DELETE CASCADE;
ALTER TABLE producto
  ADD CONSTRAINT producto_ibfk_2 FOREIGN KEY (idprov) REFERENCES proveedor(idprov) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE usuario
  ADD CONSTRAINT usuario_ibfk_1 FOREIGN KEY (idnac) REFERENCES origen(idn) ON DELETE CASCADE;

COMMIT;

-- ------------------------------------------------------------
-- VERIFICAR CON DESCRIBE
-- ------------------------------------------------------------

describe carrito;
describe categoria;
describe comentar;
describe compra;
describe contener;
describe domicilio;
describe mensaje;
describe origen;
describe producto;
describe proveedor;
describe usuario;

-- ------------------------------------------------------------
-- HERRAMIENTA PARA BORRAR TODO  (No descomentar si desconoce el motivo)
-- -----------------------------------------------------------
/*
DROP TABLE carrito;
DROP TABLE categoria;
DROP TABLE comentar;
DROP TABLE compra;
DROP TABLE contener;
DROP TABLE domicilio;
DROP TABLE mensaje;
DROP TABLE origen;
DROP TABLE producto;
DROP TABLE proveedor;
DROP TABLE usuario;

DROP sequence sec_categoria;
DROP sequence sec_compra;
DROP sequence sec_mensaje;
DROP sequence sec_producto;
DROP sequence sec_proveedor;
DROP sequence sec_usuario;
*/


-- -----------------------------------------------------------
-- *********************** INSERCIONES ***********************
-- -----------------------------------------------------------

-- -----------------------------------------------------------
-- Origen
-- De 4 a 5 nacionalidades.
-- -----------------------------------------------------------

INSERT INTO origen(idn, nacionalidad, pais) VALUES ('ESP','Español','España');
INSERT INTO origen(idn, nacionalidad, pais) VALUES ('MEX','Mexicano','México');
INSERT INTO origen(idn, nacionalidad, pais) VALUES ('CAN','Canadiense','Canadá');
INSERT INTO origen(idn, nacionalidad, pais) VALUES ('JPN','Japonés','Japón');
INSERT INTO origen(idn, nacionalidad, pais) VALUES ('USA','Estadounidense','Estados Unidos');
INSERT INTO origen(idn, nacionalidad, pais) VALUES ('COL','Colombiano','Colombia');

-- -----------------------------------------------------------
-- Usuario
-- 15 a 20 registros en total
-- Dejar una nacionalidad sin utilizar. 
-- -----------------------------------------------------------

INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Berenice','Rivera','Alvarez',to_date('14/02/1994', 'dd/mm/yyyy'),'berenice_14@outlook.com','(492)-1024480','normal','usuario',null,'COL');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Valeria','Gutierrez','Escoto',to_date('26/08/2001', 'dd/mm/yyyy'),'valery98@hotmail.com','(604)-2430976','normal','usuario',null,'CAN');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Gian','Nakamura',null,to_date('10/10/1969', 'dd/mm/yyyy'),'giancarlo@yopmail.com','(081)-0984628','normal','usuario',null,'JPN');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Edgar','Martinez','Fernandez',to_date('04/12/2002', 'dd/mm/yyyy'),'edward10@gmail.com','(034)-3456572','normal','usuario',null,'ESP');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Gerardo','Torres','Montante',to_date('15/07/1994', 'dd/mm/yyyy'),'geramxm70@outlook.com','(423)-4520959','normal','usuario',null,'MEX');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Sofia','Vera','Mora',to_date('30/06/1983', 'dd/mm/yyyy'),'sofi30@hotmail.com','(057)-8640625','normal','usuario',null,'COL');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Robin','Charles','Scherbatsky',to_date('23/07/1980', 'dd/mm/yyyy'),'sparkles33@yopmail.com','(604)-3312502','normal','usuario',null,'CAN');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Masashi','Kishimoto',null,to_date('08/11/1974', 'dd/mm/yyyy'),'mfl_k12@gmail.com','(081)-8750924','normal','usuario',null,'JPN');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Maria','Expósito','Robles',to_date('29/01/2000', 'dd/mm/yyyy'),'exposito652@outlook.com','(034)-1114075','normal','usuario',null,'ESP');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Alfonso','Castro','Valenzuela',to_date('20/12/1986', 'dd/mm/yyyy'),'caloncho_334@hotmail.com','(052)-2702485','normal','usuario',null,'MEX');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Leticia','Martinez','Moreno',to_date('03/10/2000', 'dd/mm/yyyy'),'gu4dalupe@yopmail.com','(052)-8390210','normal','usuario',null,'MEX');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Damiano','David','Romanoli',to_date('08/01/1999', 'dd/mm/yyyy'),'damiano80@gmail.com','(034)-0056894','normal','usuario',null,'ESP');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Tanjiro','Kamado',null,to_date('14/07/2003', 'dd/mm/yyyy'),'tanjirop0@gmail.com','(081)-5430624','normal','usuario',null,'JPN');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Phoebe','Jane','Tonkin',to_date('12/07/1989', 'dd/mm/yyyy'),'phoebe11@yopmail.com','(604)-1010307','normal','usuario',null,'CAN');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Samuel','Mena','Davalos',to_date('01/02/1998', 'dd/mm/yyyy'),'samuel@yopmail.com','(057)-6830693','admin','admin',null,'COL');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Loredana','Ocampo','Calderón',to_date('15/10/2000', 'dd/mm/yyyy'),'loredana@yopmail.com','(081)-9057597','admin','admin',null,'JPN');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Ian','Axel','Oropeza',to_date('01/02/1994', 'dd/mm/yyyy'),'ian@yopmail.com','(034)-6303054','admin','admin',null,'ESP');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Arnoldo','Tejeda','Quezada',to_date('05/12/1999', 'dd/mm/yyyy'),'arnoldo@yopmail.com','(052)-5205611','admin','admin',null,'MEX');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Yamile','Gutierrez','Mayorga',to_date('08/06/2000', 'dd/mm/yyyy'),'yamile@yopmail.com','(604)-9224560','admin','admin',null,'CAN');
INSERT INTO usuario(idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval),'Arantxa','Melchor','Delgadillo',to_date('01/02/2002', 'dd/mm/yyyy'),'arantxa@yopmail.com','(057)-0204567','admin','admin',null,'COL');

-- -----------------------------------------------------------
-- Domicilio
-- 15 a 20 registros en total (igual de registros que usuario)
-- -----------------------------------------------------------

INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('0','20800','Franciasco Villa','448','0','Zona Centro','Calvillo','Aguascalientes');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('1','815','Parkwood Dr','434','12','Sydney River','Sydney','Nueva Escocia');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('2','75203','W Colorado Blvd','234','0','Kessler','Dallas','Texas');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('3','08005','Pasadena','2223','395','Pasadena','Barranquilla','Atlántico');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('4','20677','María de Luna','1357','321','Plutarco Elías Calles','Pabellón de Arteaga','Aguascalientes');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('5','91300','Fidel Cruz Martínez','732','023','Salvador Díaz Mirón','Banderilla','Veracruz');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('6','15546','Front St','6543','095','Jenners','Jenners','Pensilvania');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('7','01080','Morelos','104','0','Progreso Tizapan','Ciudad de México','Ciudad de México');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('8','31004','Av. Carlos III','0280','103','Milagrosa','Pamplona','Navarra');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('9','13002','Viaduc de Storione','352','0','Arenc','Marseille 02','Provenza-Alpes-Costa Azul');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('10','20100','Los lirios','1230','122','Los Vergeles','Aguascalientes','Aguascalientes');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('11','01200','Mexicanos','1006','509','Arturo Martínez','Ciudad de México','Ciudad de México');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('12','124','Suehiro Shopping St.','865','0','Shinkoiwa','Minamisenju','Tokyo Prefecture');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('13','414','Trans-Canada Hwy','345','022','Central St. Johns','San Juan de Terranova','Terranova y Labrador');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('14','20198','Av. Tecnológico','211','0','Ejido Ojocaliente','Aguascalientes','Aguascalientes');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('15','20000','Pedro Parga','022','0','Zona Centro','Aguascalientes','Aguascalientes');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('16','47204','Niños Héroes','423','0','Los Arcos','Teocaltiche','Jalisco');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('17','47206','Juárez','111','0','Juárez','Teocaltiche','Jalisco');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('18','20126','Memo Lara','302','0','Cartagena 1947','Aguascalientes','Aguascalientes');
INSERT INTO domicilio(idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('19','20130','San Jose de los Reynoso','240','0','Fátima','Aguascalientes','Aguascalientes');
commit;

-- -----------------------------------------------------------
-- Categoria
-- De 5 a 8 categorías
-- -----------------------------------------------------------

INSERT INTO categoria VALUES(sec_categoria.nextval,'Productos Alimenticios');
INSERT INTO categoria VALUES(sec_categoria.nextval,'Higiene Personal');
INSERT INTO categoria VALUES(sec_categoria.nextval,'Limpieza del hogar');
INSERT INTO categoria VALUES(sec_categoria.nextval,'Papelería');
INSERT INTO categoria VALUES(sec_categoria.nextval,'Línea Blanca');
INSERT INTO categoria VALUES(sec_categoria.nextval,'Vinos y Licores');
INSERT INTO categoria VALUES(sec_categoria.nextval,'Mascotas');
INSERT INTO categoria VALUES(sec_categoria.nextval,'Deportes');

-- -----------------------------------------------------------
-- Proveedor
-- De 5 a 7 registros en total.
-- -----------------------------------------------------------

insert into proveedor values(sec_proveedor.nextval,'Bimbo','pan de caja fresco y congelado, bollos, galletas, pastelitos');
insert into proveedor values(sec_proveedor.nextval,'LG','Produccion de electrodomesticos, equipos de computo, celulares');
insert into proveedor values(sec_proveedor.nextval,'SCJohnson','Produccion de quipos de limpieza para el hogar, control de plagas,calzado');
insert into proveedor values(sec_proveedor.nextval,'Colgate','Productos para la higiene buscal como cepillos, cremas, etc.');
insert into proveedor values(sec_proveedor.nextval,'LAMODERNA','Productos como pastas, galletas, salas, etc.');
insert into proveedor values(sec_proveedor.nextval,'COCA-COLA','Produccion de refrescos, bebidas deportivas, jugo,lacteos');
insert into proveedor values(sec_proveedor.nextval,'BIC','Productos de papelerias, encendedores y rasuradores');

-- -----------------------------------------------------------
-- Producto
-- De 20 a 25 registros en total.
-- Dejar 2 categorías sin productos.
-- Dejar 1 proveedor sin producto.
-- -----------------------------------------------------------
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 2, 'Colgate','Pasta dental sabor a menta','16.50','50','5','Colgate.png','3');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 3, 'Fabuloso','Detergente con olor a naranja de 1L','35','15','7','Fabuloso.png','2');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 1, 'Bimboñuelos','Buñuelos de nuez 6 Piezas','20.50','12','6','Binbunuelos.png','0');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 5, 'Lavadora LG','Lavadora y secadora de 5 ciclos','1650.99','5','1','LavadoraLG.png','1');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 1, 'Fideos','Pasta de fideos de LAMODERNA','9.5','100','6','FMODERNA.png','4');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 4, 'Lapicero','Lapicero de punta fina','10','40','5','Lapicero.png','6');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 1, 'Cocacola','Refresco de Cocacola','18','80','6','Cocacola.png','5');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 2, 'Shampoo','Shampoo de savila','30','25','5','Shampoo.png','3');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 2, 'Crema de coco','Crema corporal olor a coco','20','30','5','Cremacoco.png','3');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 3, 'Cotonetes','Cotonetes para limpiar oidos','30','10','8','Cotonetes.png','2');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 1, 'Ciel','Agua mineral Ciel','18','60','9','Ciel.png','5');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 5, 'Refrigerador','Refrigerador LG','2600','4','1','Refrigerador.png','1');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 4, 'Lapiz #2B','Lapiz de grafito','2.50','60','8','Lapiz.png','6');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 3, 'Trapeador','Trapeador de ebra','45','8','4','trapeador.png','2');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 3, 'Clorox','Cloro para uso de baños','15','30','2','Cloro.png','2');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 1, 'Gatorade','Bebida Energita sabor a uva','25','10','6','Gatorade.png','0');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 2, 'Mascarilla facial','Mascarilla de noche','6','15','7','Mascarilla.png','3');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 3, 'Salvo','Jabon liquido para los platos de 1L','9','50','8','Salvo.png','2');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 1, 'Fanta','Bebida sabor a naranja','18','5','1','Fanta.png','5');
INSERT INTO producto(idp, idcat, nombre, descripcion, precio, existencia, promedio, imagen, idprov) VALUES (lpad(to_char(sec_producto.nextval), 4, '0'), 4, 'Escuadra','Utencilio para medir las cosas','22','6','4','Escuadra.png','6');

-- -----------------------------------------------------------
-- Comentario
-- De 2 a 5 comentarios por producto, dejando 5 productos si comentar
-- (De 30 a 100 registros en total) 
-- -----------------------------------------------------------

INSERT INTO comentar(idu, idp, comentario, fecha_hora) VALUES ('0','0000','es muy barato',to_date('01/02/1998', 'dd/mm/yyyy'));
INSERT INTO comentar(idu, idp, comentario, fecha_hora) VALUES ('5','0000','lo estaba buscando',to_date('01/02/1998', 'dd/mm/yyyy'));
INSERT INTO comentar(idu, idp, comentario, fecha_hora) VALUES ('6','0000','siempre esta disponible',to_date('01/02/1998', 'dd/mm/yyyy'));
INSERT INTO comentar(idu, idp, comentario, fecha_hora) VALUES ('1','0015','Sabe muy rico',to_date('01/02/1998', 'dd/mm/yyyy'));
INSERT INTO comentar(idu, idp, comentario, fecha_hora) VALUES ('0','0014','Tiene un olor muy fuerte',to_date('01/02/1998', 'dd/mm/yyyy'));
INSERT INTO comentar(idu, idp, comentario, fecha_hora) VALUES ('9','0013','Es un buen trapeador',to_date('01/02/1998', 'dd/mm/yyyy'));
INSERT INTO comentar(idu, idp, comentario, fecha_hora) VALUES ('10','0013','Es pesado',to_date('01/02/1998', 'dd/mm/yyyy'));
INSERT INTO comentar(idu, idp, comentario, fecha_hora) VALUES ('15','0013','Es muy colorido',to_date('01/02/1998', 'dd/mm/yyyy'));
INSERT INTO comentar(idu, idp, comentario, fecha_hora) VALUES ('2','0010','Es muy fresca',to_date('01/02/1998', 'dd/mm/yyyy'));

-- -----------------------------------------------------------
-- Mensaje
-- De 3 a 5 mensajes por usuario, dejanda a 10 usuarios sin mensajes.
-- Recuerde intercalar mensaje de usuario y mensaje de tienda (cambiando el valor de  campo estado)
-- -----------------------------------------------------------

INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 0 , 'Buenas noches, me interesa saber el precio, gracias', to_date('16/11/2021', 'dd/mm/yyyy'), 0); 
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 0 , 'Buenas noches, claro que si, son 100 euros', to_date('17/11/2021', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 0 , 'Muy bien, mañana hago el deposito', to_date('17/11/2021', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 0 , 'Perfecto', to_date('18/11/2021', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 3 , 'Tienen este en morado?', to_date('01/01/2019', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 3 , 'O lo tienen en azul?', to_date('01/01/2019', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 3 , 'Hola?', to_date('01/01/2019', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 3 , 'No vuelvo a comprar aqui', to_date('01/01/2019', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 4 , 'Gracias por su compra', to_date('15/10/2020', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 4 , 'Gracias a ustedes, me gusto mucho', to_date('20/11/2020', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 4 , 'Comprare mas', to_date('20/11/2020', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 5 , 'Tienen envios a domicilio?', to_date('14/03/2018', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 5 , 'Solo envios dentro de Aguascalientes', to_date('17/03/2018', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 5 , 'Oh, muy bien, gracias', to_date('14/03/2018', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 5 , 'Para servirle', to_date('17/03/2018', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 5 , ':)', to_date('20/03/2018', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 6 , 'De que material es?', to_date('05/07/2021', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 6 , 'Es plastico', to_date('09/07/2021', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 6 , 'Gracias', to_date('09/07/2021', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 12 , 'Gracias por su compra', to_date('11/02/2015', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 12 , 'Esperamos que vuelva pronto', to_date('12/02/2015', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 12 , 'Muchas gracias', to_date('13/02/2015', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 14 , 'Quiero hacer una devolucion', to_date('30/04/2021', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 14 , 'Por favor siga los pasos siguientes', to_date('30/04/2021', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 14 , 'Olvidelo, si me lo voy a quedar', to_date('02/05/2021', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 14 , 'Ta bien', to_date('03/05/2021', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 14 , 'Bonito dia', to_date('03/05/2021', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 16 , 'Buen dia, en que puedo servirle?', to_date('18/07/1999', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 16 , 'Cuanto cuesta?', to_date('18/07/1999', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 16 , 'jaja, apenas le conteste, perdon, cuesta 10 pesos', to_date('18/07/2017', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 16 , 'No ps ya pa que?', to_date('20/07/2017', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 18 , 'Hola', to_date('28/09/2019', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 18 , 'Bienvenido, en que le puedo ayudar?', to_date('28/09/2019', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 18 , 'Es marca buena?', to_date('28/09/2019', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 19 , 'En otro lado esta mas barato', to_date('13/12/2021', 'dd/mm/yyyy'), 0);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 19 , 'No le pregunte señor jajaja', to_date('13/12/2021', 'dd/mm/yyyy'), 1);
INSERT INTO mensaje (idm, idu, mensaje, fecha_hora,estado) VALUES (sec_mensaje.nextval, 19 , 'Tiste :(', to_date('15/12/2021', 'dd/mm/yyyy'), 0);

-- ----------------------------------------------------------- 
-- Carrito
-- De 1 a 5 productos por usuario, dejando a 10 usuarios sin productos.
-- De 10 a 75 registros en total.
-- -----------------------------------------------------------

INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0000','0',2); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0001','0',4); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0002','0',1); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0004','0',1);
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0006','1',7); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0005','1',2); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0010','2',5); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0012','2',1);
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0013','2',3); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0016','2',3);
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0014','4',9);
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0000','6',20); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0017','6',3);
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0019','7',10); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0017','7',4);   
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0009','11',60); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0008','11',12); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0011','11',2); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0012','11',4); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0007','13',1); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0005','13',2); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0011','15',6); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0004','15',4); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0017','15',2); 
INSERT INTO Carrito (idp, idu, cantidad) VALUES ('0014','15',14); 

-- -----------------------------------------------------------
-- Compra
-- De 1 a 3 compras por usuario, dejando 5 usuarios sin comprar.
-- De 15 a 60 registros en total.
-- -----------------------------------------------------------

INSERT INTO compra VALUES (sec_compra.nextval, '5', 38.5, 2, '12/11/2013 12:25:54');
INSERT INTO compra VALUES (sec_compra.nextval, '12', 69, 3, '08/05/2017 08:32:23');
INSERT INTO compra VALUES (sec_compra.nextval, '8', 59.5, 4, '21/08/2019 15:06:17');
INSERT INTO compra VALUES (sec_compra.nextval, '15', 7800, 3, '23/03/2007 21:56:11');
INSERT INTO compra VALUES (sec_compra.nextval, '19', 78, 5, '14/12/2020 16:44:13');
INSERT INTO compra VALUES (sec_compra.nextval, '3', 115, 6, '12/11/2015 11:37:42');

-- -----------------------------------------------------------
-- Contener
-- En base a las compras, llenar esta tabla.
-- -----------------------------------------------------------

insert into contener values('0','0002',1);
insert into contener values('0','0006',1);
insert into contener values('1','0013',1);
insert into contener values('1','0014',1);
insert into contener values('1','0017',1);
insert into contener values('2','0004',1);
insert into contener values('2','0005',1);
insert into contener values('2','0010',1);
insert into contener values('2','0019',3);
insert into contener values('3','0011',3);
insert into contener values('4','0018',1);
insert into contener values('4','0007',1);
insert into contener values('4','0012',2);
insert into contener values('4','0015',1);
insert into contener values('5','0016',1);
insert into contener values('5','0008',1);
insert into contener values('5','0009',1);
insert into contener values('5','0002',2);
insert into contener values('5','0010',1);

-- -----------------------------------------------------------
-- Nota:
-- Las tablas Producto, Compra y Contener deben tener coherencia en cuanto a precios, 
-- en caso de evitar batallar con estos detalles favor de proponer cambios en las tablas 
-- Compra y Contener previo a su llenado.

-- -----------------------------------------------------------
-- TRIGGERS
-- -----------------------------------------------------------
CREATE OR REPLACE TRIGGER genera_gustos
BEFORE INSERT ON usuario
FOR EACH ROW
DECLARE
numeroCat INTEGER;
idAleatorio INTEGER;
gustoGen VARCHAR2(250);
BEGIN
IF (:NEW.GUSTOS IS NULL) THEN
SELECT count(*) INTO numeroCat FROM categoria;
SELECT Round(dbms_random.value(1,numeroCat),0) INTO idAleatorio FROM dual;
SELECT categoria INTO gustoGen FROM categoria WHERE idcat=idAleatorio;
:NEW.GUSTOS:= gustoGen;
END IF;
END genera_gustos;

CREATE OR REPLACE TRIGGER restar_stock
AFTER INSERT ON contener FOR EACH ROW
BEGIN
UPDATE producto
SET existencia = existencia - :new.cantidad
WHERE idp = :new.idp;
END restar_stock;

--CREATE OR REPLACE TRIGGER BORRAR_PROVEEDOR
--AFTER DELETE ON PROVEEDOR FOR EACH ROW
--BEGIN
--DELETE FROM PRODUCTO WHERE IDPROV = :OLD.IDPROV;
--END;

-- -----------------------------------------------------------
-- FUNCIONES
-- -----------------------------------------------------------
create or replace function nombreUs (idus number)
return VARCHAR2
is
nomus VARCHAR2(50);
begin
select Nombre||' '|| APE_PAT || ' '|| APE_MAT into nomus
from usuario
where IDU=idus;
return nomus;
end;

-- select nombreUs(65) from dual

create or replace function nombreProv (idprod number)
    return VARCHAR2
    is
    nomprov VARCHAR2(50);
    nom VARCHAR2(50);
    begin
    select idprov into nomprov
    from producto
    where idp=idprod;
    select nombre into nom
    from proveedor
    where idprov=nomprov;
    return nom;
    end;
    
--    select nombreProv(026) from dual

-- -----------------------------------------------------------
-- VISTAS
-- -----------------------------------------------------------

CREATE OR REPLACE VIEW lista_usuarios AS SELECT IDU, NOMBRE, APE_PAT, APE_MAT, EMAIL, GUSTOS FROM usuario;

CREATE OR REPLACE VIEW lista_categorias AS SELECT * FROM CATEGORIA;

CREATE OR REPLACE VIEW lista_productos AS SELECT producto.idp, categoria.categoria, producto.nombre, producto.descripcion, producto.precio, producto.existencia, producto.promedio, producto.imagen  FROM producto LEFT JOIN categoria ON producto.idcat = categoria.idcat;


-- -----------------------------------------------------------
-- PROCEDIMIENTOS
-- -----------------------------------------------------------

CREATE OR REPLACE PROCEDURE vaciar_carrito(USER_ID usuario.IDU%type)
AS
BEGIN
DELETE FROM CARRITO WHERE CARRITO.IDU = USER_ID;
END vaciar_carrito;

CREATE OR REPLACE PROCEDURE vaciar_comentario(PROD_ID producto.IDP%type)
AS
BEGIN
DELETE FROM COMENTAR WHERE COMENTAR.IDP = PROD_ID;
END vaciar_carrito;

-- -----------------------------------------------------------
-- FUNCIONES DE ORACLE
-- -----------------------------------------------------------

SELECT sum(existencia) as total FROM lista_productos;
SELECT avg(precio) as promedio FROM lista_productos;
SELECT max(idc) from compra;

-- -----------------------------------------------------------
-- USO DE MINUS
-- -----------------------------------------------------------

SELECT * from lista_usuarios MINUS SELECT * from lista_usuarios WHERE idu=5;

-- -----------------------------------------------------------
-- USO DE Group By
-- -----------------------------------------------------------

select  nombreprov(idp), nombre, sum(existencia) from producto group by rollup (nombreprov(idp), nombre);

-- -----------------------------------------------------------
-- USO DE Rollup
-- -----------------------------------------------------------
select  nombreprov(idp), nombre, sum(existencia) from producto group by rollup (nombreprov(idp), nombre);

-- -----------------------------------------------------------
-- PROCEDIMIENTO CON CURSORES
-- -----------------------------------------------------------


CREATE OR REPLACE PROCEDURE VACIAR_PRODUCTO_CARRITO 
(
    PROD_ID producto.idp%type
)
AS 
BEGIN
    DECLARE
        CURSOR PROD_RETIRADO IS
        SELECT * FROM CARRITO WHERE idp = PROD_ID;
        v_prod_row CARRITO%ROWTYPE;
    BEGIN
      OPEN PROD_RETIRADO;
      LOOP
        FETCH PROD_RETIRADO INTO v_prod_row;
        EXIT WHEN(PROD_RETIRADO%notfound);
        DELETE FROM CARRITO
        WHERE idp = v_prod_row.idp 
            AND idu = v_prod_row.idu
            AND cantidad = v_prod_row.cantidad;
      END LOOP;
      CLOSE PROD_RETIRADO;
      COMMIT;
    END;
END VACIAR_PRODUCTO_CARRITO;