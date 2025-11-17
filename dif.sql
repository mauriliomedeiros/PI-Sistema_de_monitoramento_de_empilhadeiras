ALTER TABLE empsys_checklist.checklist ALTER operador_id SET NOT NULL;
DROP INDEX uniq_eaf3fbdce7927c74;
ALTER TABLE empsys_core.usuario ALTER sobrenome SET NOT NULL;
ALTER TABLE empsys_core.usuario ALTER role SET NOT NULL;
ALTER TABLE empsys_maquina.maquina ALTER serial_number SET NOT NULL;
