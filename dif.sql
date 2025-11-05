ALTER TABLE empsys_local.local ADD estado_id INT NOT NULL;
ALTER TABLE empsys_local.local DROP estado;
ALTER TABLE empsys_local.local ADD CONSTRAINT FK_FF17737C9F5A440B FOREIGN KEY (estado_id) REFERENCES empsys_local.estado (id) NOT DEFERRABLE INITIALLY IMMEDIATE;
CREATE INDEX IDX_FF17737C9F5A440B ON empsys_local.local (estado_id);
