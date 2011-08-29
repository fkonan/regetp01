begin transaction;

/*borro toda la tabla "fondos"*/
truncate fondos;

/*borro el sector "Otros" y "tecnico" */
delete from subsectores where sector_id = 39 or sector_id = 39;
delete from sectores where id = 39 or id = 5;
delete from titulos where id in (select titulo_id from sectores_titulos where sector_id = 39 or sector_id = 5);
delete from planes where titulo_id in (select titulo_id from sectores_titulos where sector_id = 39 or sector_id = 5);
delete from sectores_titulos where sector_id = 39 or sector_id = 5;


/*eliminar las ofertas no tecnicas*/
delete from ofertas where id in(2,5,6);
delete from titulos where oferta_id in(2,5,6);
delete from planes where oferta_id in(2,5,6);
delete from planes where titulo_id in(select id from titulos where oferta_id in(2,5,6)); /*deberia ser igual al anterior*/


/*eliminar instituciones inactivas*/
delete from planes where instit_id in (select id from instits where activo = 0);
delete from instits where activo = 0;


/*eliminar instituciones con programa de ETP*/
delete from instits where etp_estado_id = 1;

/*eliminar instituciones en especial (pedido de UI)*/
delete from instits where id IN (470,719,748,920,926,1005,808);

/* eliminar instituciones con programa de ETP*/
delete from planes where instit_id in (select id from instits where etp_estado_id = 1);
delete from instits where etp_estado_id = 1;


/*borro planes residuales*/
delete from planes where lower(nombre) like '%residual%';

/*Borro EGB3*/
delete from planes where estructura_plan_id in(select id from estructura_planes where etapa_id = 1);
delete from estructura_planes where etapa_id = 1;
delete from etapas where id = 1;


/*Borro CB*/
delete from planes where estructura_plan_id in(select id from estructura_planes where etapa_id = 4);
delete from estructura_planes where etapa_id = 4;
delete from etapas where id = 4;

/*Borro PC*/
delete from planes where estructura_plan_id in(select id from estructura_planes where etapa_id = 102);
delete from estructura_planes where etapa_id = 102;
delete from etapas where id = 102;


/*
    Borrar Planes Huerfanos. 

¡¡ Debe estar ultima esta query !! 
*/
delete from planes where instit_id not in (select id from instits);


/*borro todos los usuarios*/
delete from users;
/*creo el usuario "invitado":"catalogo2011"*/
insert into users(username, nombre, apellido, "password", mail, oficina, interno, 
		  "role", jurisdiccion_id, created, modified)
            values('invitado', 'invitado', 'invitado','0154538b07449bae7673573bda20011340894a2e', 
		   'invitado@test.com', '','','invitados',0,now(), now());

/* Tabla de matriculados harcodeados */
CREATE TABLE matriculados
(
   id serial, 
   jurisdiccion_id integer NOT NULL, 
   oferta_id integer NOT NULL, 
   cantidad bigint DEFAULT 0, 
    PRIMARY KEY (id)
) 
WITH (
  OIDS = FALSE
)
;

/* FP */
INSERT INTO matriculados VALUES (5, 6, 1, 95137);
INSERT INTO matriculados VALUES (6, 10, 1, 4965);
INSERT INTO matriculados VALUES (7, 22, 1, 9706);
INSERT INTO matriculados VALUES (8, 26, 1, 3047);
INSERT INTO matriculados VALUES (9, 2, 1, 17811);
INSERT INTO matriculados VALUES (10, 14, 1, 6224);
INSERT INTO matriculados VALUES (11, 18, 1, 4992);
INSERT INTO matriculados VALUES (12, 30, 1, 7364);
INSERT INTO matriculados VALUES (13, 34, 1, 6924);
INSERT INTO matriculados VALUES (14, 38, 1, 5320);
INSERT INTO matriculados VALUES (15, 42, 1, 1681);
INSERT INTO matriculados VALUES (16, 46, 1, 1841);
INSERT INTO matriculados VALUES (17, 50, 1, 14294);
INSERT INTO matriculados VALUES (18, 54, 1, 2330);
INSERT INTO matriculados VALUES (19, 58, 1, 10464);
INSERT INTO matriculados VALUES (20, 62, 1, 1822);
INSERT INTO matriculados VALUES (21, 66, 1, 4140);
INSERT INTO matriculados VALUES (22, 70, 1, 12907);
INSERT INTO matriculados VALUES (23, 74, 1, 0);
INSERT INTO matriculados VALUES (24, 78, 1, 593);
INSERT INTO matriculados VALUES (25, 82, 1, 6018);
INSERT INTO matriculados VALUES (26, 86, 1, 7271);
INSERT INTO matriculados VALUES (27, 94, 1, 399);
INSERT INTO matriculados VALUES (28, 90, 1, 10406);
/* SEC */
INSERT INTO matriculados VALUES (29, 6, 3, 173540);
INSERT INTO matriculados VALUES (30, 10, 3, 4799);
INSERT INTO matriculados VALUES (31, 22, 3, 11883);
INSERT INTO matriculados VALUES (32, 26, 3, 14471);
INSERT INTO matriculados VALUES (33, 2, 3, 45014);
INSERT INTO matriculados VALUES (34, 14, 3, 80339);
INSERT INTO matriculados VALUES (35, 18, 3, 12109);
INSERT INTO matriculados VALUES (36, 30, 3, 21449);
INSERT INTO matriculados VALUES (37, 34, 3, 7455);
INSERT INTO matriculados VALUES (38, 38, 3, 9381);
INSERT INTO matriculados VALUES (39, 42, 3, 2726);
INSERT INTO matriculados VALUES (40, 46, 3, 7341);
INSERT INTO matriculados VALUES (41, 50, 3, 32370);
INSERT INTO matriculados VALUES (42, 54, 3, 15184);
INSERT INTO matriculados VALUES (43, 58, 3, 13002);
INSERT INTO matriculados VALUES (44, 62, 3, 9767);
INSERT INTO matriculados VALUES (45, 66, 3, 24040);
INSERT INTO matriculados VALUES (46, 70, 3, 13126);
INSERT INTO matriculados VALUES (47, 74, 3, 8823);
INSERT INTO matriculados VALUES (48, 78, 3, 2351);
INSERT INTO matriculados VALUES (49, 82, 3, 60808);
INSERT INTO matriculados VALUES (50, 86, 3, 14353);
INSERT INTO matriculados VALUES (51, 94, 3, 4019);
INSERT INTO matriculados VALUES (52, 90, 3, 22549);
/* SUP */
INSERT INTO matriculados VALUES (53, 6, 4, 23929);
INSERT INTO matriculados VALUES (54, 10, 4, 1951);
INSERT INTO matriculados VALUES (55, 22, 4, 2703);
INSERT INTO matriculados VALUES (56, 26, 4, 947);
INSERT INTO matriculados VALUES (57, 2, 4, 46951);
INSERT INTO matriculados VALUES (58, 14, 4, 26125);
INSERT INTO matriculados VALUES (59, 18, 4, 4118);
INSERT INTO matriculados VALUES (60, 30, 4, 1984);
INSERT INTO matriculados VALUES (61, 34, 4, 1878);
INSERT INTO matriculados VALUES (62, 38, 4, 3777);
INSERT INTO matriculados VALUES (63, 42, 4, 1068);
INSERT INTO matriculados VALUES (64, 46, 4, 572);
INSERT INTO matriculados VALUES (65, 50, 4, 5633);
INSERT INTO matriculados VALUES (66, 54, 4, 6557);
INSERT INTO matriculados VALUES (67, 58, 4, 2255);
INSERT INTO matriculados VALUES (68, 62, 4, 1318);
INSERT INTO matriculados VALUES (69, 66, 4, 4242);
INSERT INTO matriculados VALUES (70, 70, 4, 2442);
INSERT INTO matriculados VALUES (71, 74, 4, 0);
INSERT INTO matriculados VALUES (72, 78, 4, 0);
INSERT INTO matriculados VALUES (73, 82, 4, 26424);
INSERT INTO matriculados VALUES (74, 86, 4, 628);
INSERT INTO matriculados VALUES (75, 94, 4, 1602);
INSERT INTO matriculados VALUES (76, 90, 4, 9713);


/*rollback;*/
commit;