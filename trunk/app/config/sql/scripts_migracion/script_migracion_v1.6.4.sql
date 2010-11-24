CREATE TABLE sectores_titulos (
id serial ,
titulo_id integer not null default 0,
sector_id integer not null default 0,
subsector_id integer not null default 0,
prioridad integer not null default 0
) with oids;

INSERT INTO sectores_titulos
SELECT nextval('sectores_titulos_id_seq'::regclass) as id,
titulo_id ,
sector_id ,
subsector_id
FROM planes
GROUP BY
sector_id ,
subsector_id ,
titulo_id
;