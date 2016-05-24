CREATE TABLE USUARIO
(
	USUARIO_NO varchar(9),
	USUARIO_HSP char(10),
	USUARIO_TIPO varchar(13),
	PRIMARY KEY (USUARIO_NO)
);

CREATE TABLE PROFESOR
(
	USUARIO_NO varchar(9),
	PROFESOR_NOMBRE varchar(25),
	PROFESOR_FECHA varchar(8),
	PRIMARY KEY (USUARIO_NO)
);

CREATE TABLE ASIGNACION
(
	USUARIO_NO varchar(9),
	MATERIA_NO char(4),
	PRIMARY KEY (USUARIO_NO,MATERIA_NO)
);

CREATE TABLE MATERIAS
(
	MATERIA_NO char(4),
	GRADO varchar(3),
	COLEGIO_NO int,
	MATERIA_NOMBRE varchar(25),
	PRIMARY KEY (MATERIA_NO)
);

CREATE TABLE UNIDAD
(
	MATERIA_NO char(4),
	UNIDAD_NO int,
	UNIDAD_NOMBRE varchar(100),
	PRIMARY KEY (MATERIA_NO,UNIDAD_NO)
);

CREATE TABLE PREGUNTAS
(
	MATERIA_NO char(4),
	UNIDAD_NO int,
	PREGUNTA_NOMBRE varchar(200),
	PREGUNTA_MEDIA varchar(200),
	PREGUNTA_OPCION1 varchar(200),
	PREGUNTA_OPCION2 varchar(200),
	PREGUNTA_OPCION3 varchar(200),
	PREGUNTA_OPCION4 varchar(200),
	PREGUNTA_RESPUESTA tinyint
);

CREATE TABLE XCONFIRMAR
(
	MATERIA_NO char(4),
	XCONFIRMAR_NOMBRE varchar(200),
	XCONFIRMAR_MEDIA varchar(200),
	XCONFIRMAR_OPCION1 varchar(200),
	XCONFIRMAR_OPCION2 varchar(200),
	XCONFIRMAR_OPCION3 varchar(200),
	XCONFIRMAR_OPCION4 varchar(200),
	XCONFIRMAR_RESPUESTA tinyint
);

CREATE TABLE ALUMNO
(
	USUARIO_NO varchar(9),
	GRADO varchar(3),
	ALUMNO_NOMBRE varchar(25),
	ALUMNO_PUNT int,
	ALUMNO_STYLE char(7),
	ALUMNO_FECHA varchar(8),
	PRIMARY KEY (USUARIO_NO)
);

CREATE TABLE COLEGIO
(
	COLEGIO_NO int,
	USUARIO_NO varchar(9),
	COLEGIO_NOMBRE varchar(25),
	PRIMARY KEY (COLEGIO_NO)
);

SELECT USUARIO_NO USUARIO_NO FROM USUARIO NATURAL JOIN PROFESOR;
SELECT USUARIO_NO USUARIO_NO FROM USUARIO NATURAL JOIN ALUMNO;
SELECT USUARIO_NO USUARIO_NO FROM PROFESOR NATURAL JOIN ASIGNACION;
SELECT MATERIA_NO MATERIA_NO FROM ASIGNACION NATURAL JOIN MATERIAS;
SELECT COLEGIO_NO COLEGIO_NO FROM COLEGIO NATURAL JOIN MATERIAS;
SELECT USUARIO_NO USUARIO_NO FROM USUARIO NATURAL JOIN COLEGIO;
SELECT GRADO GRADO FROM ALUMNO NATURAL JOIN MATERIAS;
SELECT MATERIA_NO MATERIA_NO FROM MATERIAS NATURAL JOIN UNIDAD;
SELECT MATERIA_NO MATERIA_NO FROM PREGUNTAS NATURAL JOIN UNIDAD;
SELECT UNIDAD_NO UNIDAD_NO FROM PREGUNTAS NATURAL JOIN UNIDAD;
