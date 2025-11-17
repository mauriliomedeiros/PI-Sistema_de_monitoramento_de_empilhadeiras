DROP INDEX uniq_eaf3fbdce7927c74;
ALTER TABLE empsys_core.usuario ADD role VARCHAR(50) NOT NULL;
ALTER TABLE empsys_core.usuario DROP roles;
ALTER TABLE empsys_core.usuario ALTER nome SET NOT NULL;
ALTER TABLE empsys_core.usuario ALTER sobrenome SET NOT NULL;
ALTER TABLE empsys_core.usuario ALTER ativo SET NOT NULL;
