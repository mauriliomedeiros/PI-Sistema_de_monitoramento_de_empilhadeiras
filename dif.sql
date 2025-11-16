ALTER TABLE empsys_checklist.checklist ADD ativo BOOLEAN DEFAULT true NOT NULL;
ALTER TABLE empsys_local.local ALTER ativo SET DEFAULT true;
ALTER TABLE empsys_maquina.maquina ALTER ativo SET DEFAULT true;
ALTER TABLE empsys_maquina.modelo ALTER ativo SET DEFAULT true;
ALTER TABLE empsys_maquina.fabricante ALTER ativo SET DEFAULT true;
ALTER TABLE empsys_cliente.cliente ALTER ativo SET DEFAULT true;
