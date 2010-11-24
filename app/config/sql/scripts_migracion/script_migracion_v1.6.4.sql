CREATE TABLE titulos_sectores (
id serial ,
titulo_id integer not null default 0,
sector_id integer not null default 0,
subsector_id integer not null default 0,
prioridad integer not null default 0
) with oids;