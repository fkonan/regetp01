/*
* Consultas del backlog 1.6.3
*/
-- Estructuras no utilizadas
select * from estructura_planes ep
where
ep.id NOT IN (select estructura_plan_id from planes);

-- Cantidad de Estructuras utilizadas por jurisdiccion
SELECT p.estructura_plan_id, count(p.estructura_plan_id), ep.name, j.name
FROM planes p
LEFT JOIN estructura_planes ep ON ep.id = p.estructura_plan_id
LEFT JOIN jurisdicciones_estructura_planes jep ON jep.estructura_plan_id = p.estructura_plan_id
LEFT JOIN jurisdicciones j ON j.id = jep.jurisdiccion_id
WHERE
p.estructura_plan_id > 0
GROUP BY p.estructura_plan_id, ep.name, j.name
ORDER BY j.name
