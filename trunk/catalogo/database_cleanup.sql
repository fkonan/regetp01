begin transaction;

/*borro toda la tabla "fondos"*/
truncate fondos;

/*borro el sector "Otros"*/
delete from subsectores where sector_id = 39;
delete from sectores where id = 39; 
delete from titulos where id in (select titulo_id from sectores_titulos where sector_id = 39);
delete from planes where titulo_id in (select titulo_id from sectores_titulos where sector_id = 39);
delete from sectores_titulos where sector_id = 39;


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
delete from planes where nombre like '%residual%';

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
/*rollback;*/
commit;