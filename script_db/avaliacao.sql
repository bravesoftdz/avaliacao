CREATE SEQUENCE N_Cli ;						-- Clientes
CREATE SEQUENCE N_Cto ;						-- Contatos

-- Table: public.t070_clientes

-- DROP TABLE public.t070_clientes;

CREATE TABLE public.t070_clientes
(
    codcli character varying(5) COLLATE pg_catalog."default" NOT NULL DEFAULT nextval('n_cli'::regclass),
    nomecli character varying(80) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    nomefant character varying(35) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    datacad date,
    enderc character varying(80) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    numeroc character varying(10) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    complc character varying(20) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    bairroc character varying(60) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    cidadec character varying(60) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    estadoc character varying(2) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    cepc character varying(8) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    cnpj character varying(14) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    CONSTRAINT ix_t070_clientes_pkey PRIMARY KEY (codcli)
)
WITH (
    OIDS = TRUE
)
TABLESPACE pg_default;

ALTER TABLE public.t070_clientes
    OWNER to postgres;

-- Index: t070_clientes_1

-- DROP INDEX public.t070_clientes_1;

CREATE INDEX t070_clientes_1
    ON public.t070_clientes USING btree
    (codcli COLLATE pg_catalog."default")
    TABLESPACE pg_default;

-- FUNCTION: public."CodigoCliente"()

-- DROP FUNCTION public."CodigoCliente"();

CREATE FUNCTION public."CodigoCliente"()
    RETURNS trigger
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE NOT LEAKPROOF 
AS $BODY$BEGIN
	NEW.codcli = LPAD(NEW.codcli,5,'0');
	RETURN NEW;
END;$BODY$;

ALTER FUNCTION public."CodigoCliente"()
    OWNER TO postgres;

-- FUNCTION: public."CodigoContatoComposto"()

-- DROP FUNCTION public."CodigoContatoComposto"();

CREATE FUNCTION public."CodigoContatoComposto"()
    RETURNS trigger
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE NOT LEAKPROOF 
AS $BODY$BEGIN
	NEW.codclicto = new.codcli || new.nrocto;
	RETURN NEW;
END;$BODY$;

ALTER FUNCTION public."CodigoContatoComposto"()
    OWNER TO postgres;

-- FUNCTION: public."IncDataAtual"()

-- DROP FUNCTION public."IncDataAtual"();

CREATE FUNCTION public."IncDataAtual"()
    RETURNS trigger
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE NOT LEAKPROOF 
AS $BODY$
BEGIN
	NEW.datacad = Now();
	RETURN NEW;
END;
$BODY$;

ALTER FUNCTION public."IncDataAtual"()
    OWNER TO postgres;

-- FUNCTION: public."NumeroContato"()

-- DROP FUNCTION public."NumeroContato"();

CREATE FUNCTION public."NumeroContato"()
    RETURNS trigger
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE NOT LEAKPROOF 
AS $BODY$BEGIN
	NEW.nrocto = lpad(NEW.nrocto, 2, '0');
	RETURN NEW;
END;$BODY$;

ALTER FUNCTION public."NumeroContato"()
    OWNER TO postgres;

-- Trigger: CodigoCliente

-- DROP TRIGGER "CodigoCliente" ON public.t070_clientes;

CREATE TRIGGER "CodigoCliente"
    BEFORE INSERT
    ON public.t070_clientes
    FOR EACH ROW
    EXECUTE PROCEDURE public."CodigoCliente"();

-- Trigger: IncDataAtual

-- DROP TRIGGER "IncDataAtual" ON public.t070_clientes;

CREATE TRIGGER "IncDataAtual"
    BEFORE INSERT
    ON public.t070_clientes
    FOR EACH ROW
    EXECUTE PROCEDURE public."IncDataAtual"();
	
	
------------------------------- SCRIPT PARA TABELA DE CONTATOS -----------------------------------------------
-- Table: public.t071_clientes_contatos

-- DROP TABLE public.t071_clientes_contatos;

CREATE TABLE public.t071_clientes_contatos
(
    codclicto character varying(7) COLLATE pg_catalog."default" NOT NULL,
    codcli character varying(5) COLLATE pg_catalog."default" NOT NULL,
    nrocto character varying(2) COLLATE pg_catalog."default" NOT NULL DEFAULT nextval('n_cto'::regclass),
    nomecont character varying(40) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    telefone1 character varying(20) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    telefone2 character varying(20) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    email character varying(70) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    email2 character varying(70) COLLATE pg_catalog."default" DEFAULT ''::character varying,
    observacoes text COLLATE pg_catalog."default" DEFAULT ''::text,
    CONSTRAINT ix_t071_clientes_contatos_pkey PRIMARY KEY (codclicto),
    CONSTRAINT "FkeyExclueContatos" FOREIGN KEY (codcli)
        REFERENCES public.t070_clientes (codcli) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE
)
WITH (
    OIDS = TRUE
)
TABLESPACE pg_default;

ALTER TABLE public.t071_clientes_contatos
    OWNER to postgres;

-- Index: fki_FkeyExclueContatos

-- DROP INDEX public."fki_FkeyExclueContatos";

CREATE INDEX "fki_FkeyExclueContatos"
    ON public.t071_clientes_contatos USING btree
    (codcli COLLATE pg_catalog."default")
    TABLESPACE pg_default;

-- Index: t071_clientes_contatos_1

-- DROP INDEX public.t071_clientes_contatos_1;

CREATE INDEX t071_clientes_contatos_1
    ON public.t071_clientes_contatos USING btree
    (codclicto COLLATE pg_catalog."default")
    TABLESPACE pg_default;

-- Index: t071_clientes_contatos_2

-- DROP INDEX public.t071_clientes_contatos_2;

CREATE INDEX t071_clientes_contatos_2
    ON public.t071_clientes_contatos USING btree
    (codcli COLLATE pg_catalog."default", nrocto COLLATE pg_catalog."default")
    TABLESPACE pg_default;

-- Trigger: CodigoContatoComposto

-- DROP TRIGGER "CodigoContatoComposto" ON public.t071_clientes_contatos;

CREATE TRIGGER "CodigoContatoComposto"
    BEFORE INSERT
    ON public.t071_clientes_contatos
    FOR EACH ROW
    EXECUTE PROCEDURE public."CodigoContatoComposto"();

-- Trigger: NumeroContato

-- DROP TRIGGER "NumeroContato" ON public.t071_clientes_contatos;

CREATE TRIGGER "NumeroContato"
    BEFORE INSERT
    ON public.t071_clientes_contatos
    FOR EACH ROW
    EXECUTE PROCEDURE public."NumeroContato"();