/*
ELIMINAR CAMPOS EN DESUSO
*/

ALTER TABLE planes DROP COLUMN sector;
ALTER TABLE planes DROP COLUMN sector_id;
ALTER TABLE planes DROP COLUMN subsector_id;
ALTER TABLE instits DROP COLUMN depto;
ALTER TABLE instits DROP COLUMN localidad;
ALTER TABLE instits DROP COLUMN fecha_mod;
ALTER TABLE instits DROP COLUMN actualizacion;
ALTER TABLE planes DROP COLUMN old_item;
ALTER TABLE anios DROP COLUMN old_item;
ALTER TABLE planes DROP COLUMN ciclo_mod;
DROP TABLE logs;

/*
MODIFICACIONES EN DESCARGAS (QUERIES)
*/
ALTER TABLE "public"."queries" DROP COLUMN "ver_online";
ALTER TABLE "public"."queries" DROP COLUMN "categoria";
ALTER TABLE "public"."queries" ADD COLUMN "vigencia" timestamp without time zone;
ALTER TABLE "public"."queries" ADD COLUMN "categoria" character varying(1) DEFAULT 't';

/*
AUTORIDADES
*/

CREATE TABLE autoridades (
    id serial NOT NULL PRIMARY KEY,
    jurisdiccion_id integer,
    nombre character varying(100) DEFAULT ''::character varying NOT NULL,
    apellido character varying(100) DEFAULT ''::character varying NOT NULL,
    fecha_asuncion date,
    titulo character varying(50) DEFAULT '',
    telefono_personal character varying(50) DEFAULT '',
    telefono_institucional character varying(50) DEFAULT '',
    email_personal character varying(100) DEFAULT '',
    email_institucional character varying(100) DEFAULT '',
    direccion character varying(100) DEFAULT '',
    localidad_id integer,
    departamento_id integer
);

CREATE TABLE cargos (
    id serial NOT NULL PRIMARY KEY,
    nombre character varying(100) DEFAULT ''::character varying NOT NULL,
    rango integer
);

CREATE TABLE autoridades_cargos (
    id serial NOT NULL PRIMARY KEY,
    autoridad_id integer,
    cargo_id integer
);

/*
CARGOS
*/
INSERT INTO cargos (nombre, rango)
VALUES ('Ministro de Educación', 1);
INSERT INTO cargos (nombre, rango)
VALUES ('Ministro de Educación, Ciencia y Tecnología', 1);
INSERT INTO cargos (nombre, rango)
VALUES ('Presidente del Consejo General de Educación', 1);
INSERT INTO cargos (nombre, rango)
VALUES ('Secretario de Estado de Educación, Cultura y Deporte', 1);
INSERT INTO cargos (nombre, rango)
VALUES ('Director General de Cultura y Educación', 1);
INSERT INTO cargos (nombre, rango)
VALUES ('Ministro de Educación y Cultura', 1);
INSERT INTO cargos (nombre, rango)
VALUES ('Ministro de Educación, Cultura, Ciencia y Tecnología', 1);
INSERT INTO cargos (nombre, rango)
VALUES ('Director General de Escuelas', 1);
INSERT INTO cargos (nombre, rango)
VALUES ('Ministro de Cultura y Educación', 1);
INSERT INTO cargos (nombre, rango)
VALUES ('Presidente del Consejo Provincial de Educación', 1);
INSERT INTO cargos (nombre, rango)
VALUES ('Referente Jurisdiccional (Titular)', 2);
INSERT INTO cargos (nombre, rango)
VALUES ('Referente Jurisdiccional (Suplente)', 3);
INSERT INTO cargos (nombre, rango)
VALUES ('Referente de Educación Secundaria', 4);
INSERT INTO cargos (nombre, rango)
VALUES ('Referente de Educación Superior', 4);
INSERT INTO cargos (nombre, rango)
VALUES ('Referente de Formación Profesional', 4);
INSERT INTO cargos (nombre, rango)
VALUES ('Unidad Ejecutora Jurisdiccional', 4);