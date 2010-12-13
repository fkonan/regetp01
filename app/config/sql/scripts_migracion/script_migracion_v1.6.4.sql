CREATE TABLE sectores_titulos (
id serial ,
titulo_id integer not null default 0,
sector_id integer not null default 0,
subsector_id integer not null default 0,
prioridad integer not null default 0
) with oids;

INSERT INTO sectores_titulos
(titulo_id, sector_id, subsector_id, prioridad)
SELECT
titulo_id ,
sector_id ,
subsector_id,
0 prioridad
FROM planes
-- Where titulo_id != 0
GROUP BY
titulo_id,
sector_id ,
subsector_id
order by titulo_id
;

UPDATE planes SET
titulo_id =
(SELECT id
FROM sectores_titulos
WHERE
titulo_id = planes.titulo_id AND
sector_id = planes.sector_id AND
subsector_id = planes.subsector_id
);

ALTER TABLE planes DROP COLUMN sector_id ;
ALTER TABLE planes DROP COLUMN subsector_id ;
ALTER TABLE planes DROP COLUMN sector ;
