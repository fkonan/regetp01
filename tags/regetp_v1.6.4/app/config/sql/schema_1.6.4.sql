--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'LATIN1';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: www
--

CREATE PROCEDURAL LANGUAGE plpgsql;


ALTER PROCEDURAL LANGUAGE plpgsql OWNER TO www;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: acos; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE acos (
    id integer NOT NULL,
    parent_id integer,
    model character varying(255) DEFAULT ''::character varying,
    foreign_key integer,
    alias character varying(255) DEFAULT ''::character varying,
    lft integer,
    rght integer
);


ALTER TABLE public.acos OWNER TO www;

--
-- Name: acos_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE acos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.acos_id_seq OWNER TO www;

--
-- Name: acos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE acos_id_seq OWNED BY acos.id;


--
-- Name: anios_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE anios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.anios_id_seq OWNER TO www;

--
-- Name: anios; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE anios (
    id integer DEFAULT nextval('anios_id_seq'::regclass) NOT NULL,
    plan_id integer NOT NULL,
    ciclo_id integer NOT NULL,
    old_item integer DEFAULT 0 NOT NULL,
    anio integer DEFAULT 0 NOT NULL,
    etapa_id integer NOT NULL,
    matricula integer DEFAULT 0 NOT NULL,
    secciones integer DEFAULT 0 NOT NULL,
    hs_taller integer DEFAULT 0 NOT NULL,
    created timestamp without time zone,
    modified timestamp without time zone,
    estructura_planes_anio_id integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.anios OWNER TO www;

--
-- Name: aros; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE aros (
    id integer NOT NULL,
    parent_id integer,
    model character varying(255) DEFAULT ''::character varying,
    foreign_key integer,
    alias character varying(255) DEFAULT ''::character varying,
    lft integer,
    rght integer
);


ALTER TABLE public.aros OWNER TO www;

--
-- Name: aros_acos; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE aros_acos (
    id integer NOT NULL,
    aro_id integer NOT NULL,
    aco_id integer NOT NULL,
    _create character(2) DEFAULT 0 NOT NULL,
    _read character(2) DEFAULT 0 NOT NULL,
    _update character(2) DEFAULT 0 NOT NULL,
    _delete character(2) DEFAULT 0 NOT NULL
);


ALTER TABLE public.aros_acos OWNER TO www;

--
-- Name: aros_acos_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE aros_acos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.aros_acos_id_seq OWNER TO www;

--
-- Name: aros_acos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE aros_acos_id_seq OWNED BY aros_acos.id;


--
-- Name: aros_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE aros_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.aros_id_seq OWNER TO www;

--
-- Name: aros_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE aros_id_seq OWNED BY aros.id;


--
-- Name: ciclos_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE ciclos_id_seq
    START WITH 2011
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ciclos_id_seq OWNER TO www;

--
-- Name: ciclos; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE ciclos (
    id integer DEFAULT nextval('ciclos_id_seq'::regclass) NOT NULL,
    name character varying(10) NOT NULL
);


ALTER TABLE public.ciclos OWNER TO www;

--
-- Name: claseinstits; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE claseinstits (
    id integer NOT NULL,
    name character varying(60) DEFAULT ''::character varying NOT NULL
);


ALTER TABLE public.claseinstits OWNER TO www;

--
-- Name: claseinstits_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE claseinstits_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.claseinstits_id_seq OWNER TO www;

--
-- Name: claseinstits_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE claseinstits_id_seq OWNED BY claseinstits.id;


--
-- Name: departamento_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE departamento_id_seq
    START WITH 508
    INCREMENT BY 1
    NO MAXVALUE
    MINVALUE 508
    CACHE 1;


ALTER TABLE public.departamento_id_seq OWNER TO www;

--
-- Name: departamentos; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE departamentos (
    id integer DEFAULT nextval('departamento_id_seq'::regclass) NOT NULL,
    jurisdiccion_id integer,
    name character varying(64)
);


ALTER TABLE public.departamentos OWNER TO www;

--
-- Name: dependencias_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE dependencias_id_seq
    START WITH 10
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.dependencias_id_seq OWNER TO www;

--
-- Name: dependencias; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE dependencias (
    id integer DEFAULT nextval('dependencias_id_seq'::regclass) NOT NULL,
    name character varying(40) NOT NULL
);


ALTER TABLE public.dependencias OWNER TO www;

--
-- Name: estructura_planes; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE estructura_planes (
    id integer NOT NULL,
    name character varying(130) DEFAULT ''::character varying,
    etapa_id integer DEFAULT 0,
    created timestamp without time zone,
    modified timestamp without time zone
);


ALTER TABLE public.estructura_planes OWNER TO www;

--
-- Name: estructura_planes_anios; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE estructura_planes_anios (
    id integer NOT NULL,
    estructura_plan_id integer DEFAULT 0,
    nro_anio integer DEFAULT 0,
    edad_teorica integer DEFAULT 0,
    anio_escolaridad integer DEFAULT 0,
    alias character varying(20) DEFAULT ''::character varying
);


ALTER TABLE public.estructura_planes_anios OWNER TO www;

--
-- Name: estructura_planes_anios_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE estructura_planes_anios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.estructura_planes_anios_id_seq OWNER TO www;

--
-- Name: estructura_planes_anios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE estructura_planes_anios_id_seq OWNED BY estructura_planes_anios.id;


--
-- Name: estructura_planes_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE estructura_planes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.estructura_planes_id_seq OWNER TO www;

--
-- Name: estructura_planes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE estructura_planes_id_seq OWNED BY estructura_planes.id;


--
-- Name: etapas_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE etapas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.etapas_id_seq OWNER TO www;

--
-- Name: etapas; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE etapas (
    id integer DEFAULT nextval('etapas_id_seq'::regclass) NOT NULL,
    name character varying(40) NOT NULL,
    abrev character varying(20) DEFAULT ''::character varying,
    orden integer DEFAULT 0
);


ALTER TABLE public.etapas OWNER TO www;

--
-- Name: etp_estados; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE etp_estados (
    id integer NOT NULL,
    name character varying(60) DEFAULT ''::character varying NOT NULL
);


ALTER TABLE public.etp_estados OWNER TO www;

--
-- Name: etp_estados_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE etp_estados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.etp_estados_id_seq OWNER TO www;

--
-- Name: etp_estados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE etp_estados_id_seq OWNED BY etp_estados.id;


--
-- Name: fondos; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE fondos (
    id integer NOT NULL,
    instit_id integer DEFAULT 0 NOT NULL,
    jurisdiccion_id integer DEFAULT 0 NOT NULL,
    total double precision DEFAULT 0 NOT NULL,
    anio integer NOT NULL,
    trimestre integer NOT NULL,
    memo character varying(20) DEFAULT ''::character varying NOT NULL,
    resolucion character varying(20) DEFAULT ''::character varying NOT NULL,
    description text DEFAULT ''::character varying NOT NULL,
    created timestamp without time zone,
    modified timestamp without time zone
);


ALTER TABLE public.fondos OWNER TO www;

--
-- Name: fondos_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE fondos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.fondos_id_seq OWNER TO www;

--
-- Name: fondos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE fondos_id_seq OWNED BY fondos.id;


--
-- Name: fondos_lineas_de_acciones; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE fondos_lineas_de_acciones (
    id integer NOT NULL,
    fondo_id integer NOT NULL,
    lineas_de_accion_id integer NOT NULL,
    monto double precision DEFAULT 0 NOT NULL,
    created timestamp without time zone,
    modified timestamp without time zone
);


ALTER TABLE public.fondos_lineas_de_acciones OWNER TO www;

--
-- Name: fondos_lineas_de_acciones_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE fondos_lineas_de_acciones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.fondos_lineas_de_acciones_id_seq OWNER TO www;

--
-- Name: fondos_lineas_de_acciones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE fondos_lineas_de_acciones_id_seq OWNED BY fondos_lineas_de_acciones.id;


--
-- Name: gestiones_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE gestiones_id_seq
    START WITH 4
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.gestiones_id_seq OWNER TO www;

--
-- Name: gestiones; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE gestiones (
    id integer DEFAULT nextval('gestiones_id_seq'::regclass) NOT NULL,
    name character varying(20) NOT NULL
);


ALTER TABLE public.gestiones OWNER TO www;

--
-- Name: historial_cues; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE historial_cues (
    id integer NOT NULL,
    instit_id integer NOT NULL,
    cue integer DEFAULT 0,
    anexo integer DEFAULT 0,
    created timestamp without time zone,
    observaciones text
);


ALTER TABLE public.historial_cues OWNER TO www;

--
-- Name: historial_cues_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE historial_cues_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.historial_cues_id_seq OWNER TO www;

--
-- Name: historial_cues_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE historial_cues_id_seq OWNED BY historial_cues.id;


--
-- Name: instits_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE instits_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.instits_id_seq OWNER TO www;

--
-- Name: instits; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE instits (
    id integer DEFAULT nextval('instits_id_seq'::regclass) NOT NULL,
    gestion_id integer NOT NULL,
    dependencia_id integer NOT NULL,
    nombre_dep character varying(100) NOT NULL,
    tipoinstit_id integer NOT NULL,
    jurisdiccion_id integer NOT NULL,
    cue integer DEFAULT 0 NOT NULL,
    anexo integer DEFAULT 0 NOT NULL,
    esanexo integer DEFAULT 0 NOT NULL,
    nombre character varying(150) NOT NULL,
    nroinstit character varying(20) NOT NULL,
    anio_creacion integer DEFAULT 0 NOT NULL,
    direccion character varying(100) NOT NULL,
    depto character varying(50) NOT NULL,
    localidad character varying(50) NOT NULL,
    cp character varying(8) NOT NULL,
    telefono character varying(60) NOT NULL,
    mail character varying(60) NOT NULL,
    web character varying(100) NOT NULL,
    dir_nombre character varying(60) NOT NULL,
    dir_tipodoc_id integer DEFAULT 0 NOT NULL,
    dir_nrodoc integer DEFAULT 0 NOT NULL,
    dir_telefono character varying(60) NOT NULL,
    dir_mail character varying(60) NOT NULL,
    vice_nombre character varying(60) NOT NULL,
    vice_tipodoc_id integer DEFAULT 0 NOT NULL,
    vice_nrodoc integer DEFAULT 0 NOT NULL,
    actualizacion character varying(30) NOT NULL,
    observacion text NOT NULL,
    fecha_mod date,
    activo integer DEFAULT 0 NOT NULL,
    ciclo_alta integer DEFAULT 0 NOT NULL,
    ciclo_mod integer DEFAULT 0 NOT NULL,
    created timestamp without time zone,
    modified timestamp without time zone,
    localidad_id integer DEFAULT 0 NOT NULL,
    departamento_id integer DEFAULT 0 NOT NULL,
    lugar character varying(110) DEFAULT ''::character varying NOT NULL,
    mail_alternativo character varying(60) DEFAULT ''::character varying NOT NULL,
    telefono_alternativo character varying(60) DEFAULT ''::character varying NOT NULL,
    etp_estado_id integer DEFAULT 0 NOT NULL,
    claseinstit_id integer DEFAULT 0 NOT NULL,
    orientacion_id integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.instits OWNER TO www;

--
-- Name: jurisdicciones_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE jurisdicciones_id_seq
    START WITH 100
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.jurisdicciones_id_seq OWNER TO www;

--
-- Name: jurisdicciones; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE jurisdicciones (
    id integer DEFAULT nextval('jurisdicciones_id_seq'::regclass) NOT NULL,
    name character varying(40) NOT NULL,
    autoridad_cargo character varying(60) DEFAULT ''::character varying,
    autoridad_nombre character varying(60) DEFAULT ''::character varying,
    autoridad_fecha_asuncion date,
    ministerio_nombre character varying(60) DEFAULT ''::character varying,
    ministerio_direccion character varying(200) DEFAULT ''::character varying,
    ministerio_codigo_postal character varying(60) DEFAULT ''::character varying,
    ministerio_telefono character varying(60) DEFAULT ''::character varying,
    ministerio_mail character varying(150) DEFAULT ''::character varying,
    ministerio_localidad_id integer DEFAULT 0 NOT NULL,
    modified timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE public.jurisdicciones OWNER TO www;

--
-- Name: jurisdicciones_estructura_planes; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE jurisdicciones_estructura_planes (
    id integer NOT NULL,
    jurisdiccion_id integer DEFAULT 0,
    estructura_plan_id integer DEFAULT 0,
    created timestamp without time zone,
    modified timestamp without time zone
);


ALTER TABLE public.jurisdicciones_estructura_planes OWNER TO www;

--
-- Name: jurisdicciones_estructura_planes_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE jurisdicciones_estructura_planes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.jurisdicciones_estructura_planes_id_seq OWNER TO www;

--
-- Name: jurisdicciones_estructura_planes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE jurisdicciones_estructura_planes_id_seq OWNED BY jurisdicciones_estructura_planes.id;


--
-- Name: lineas_de_acciones; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE lineas_de_acciones (
    id integer NOT NULL,
    name character varying(20) NOT NULL,
    description text DEFAULT ''::character varying NOT NULL,
    created timestamp without time zone,
    modified timestamp without time zone,
    formulario character varying(20) DEFAULT ''::character varying,
    referencia character varying(60) DEFAULT ''::character varying,
    orden integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.lineas_de_acciones OWNER TO www;

--
-- Name: lineas_de_acciones_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE lineas_de_acciones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.lineas_de_acciones_id_seq OWNER TO www;

--
-- Name: lineas_de_acciones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE lineas_de_acciones_id_seq OWNED BY lineas_de_acciones.id;


--
-- Name: localidades_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE localidades_id_seq
    START WITH 1300
    INCREMENT BY 1
    NO MAXVALUE
    MINVALUE 1300
    CACHE 1;


ALTER TABLE public.localidades_id_seq OWNER TO www;

--
-- Name: localidades; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE localidades (
    id integer DEFAULT nextval('localidades_id_seq'::regclass) NOT NULL,
    departamento_id integer,
    name character varying(64)
);


ALTER TABLE public.localidades OWNER TO www;

--
-- Name: logs_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE logs_id_seq
    START WITH 16368
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.logs_id_seq OWNER TO www;

--
-- Name: logs; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE logs (
    id integer DEFAULT nextval('logs_id_seq'::regclass) NOT NULL,
    username character varying(20) NOT NULL,
    fecha_in date NOT NULL,
    hora_in integer NOT NULL,
    fecha_out date NOT NULL,
    hora_out integer NOT NULL
);


ALTER TABLE public.logs OWNER TO www;

--
-- Name: ofertas_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE ofertas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ofertas_id_seq OWNER TO www;

--
-- Name: ofertas; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE ofertas (
    id integer DEFAULT nextval('ofertas_id_seq'::regclass) NOT NULL,
    abrev character varying(10) NOT NULL,
    name character varying(30) NOT NULL
);


ALTER TABLE public.ofertas OWNER TO www;

--
-- Name: orientaciones; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE orientaciones (
    id integer NOT NULL,
    name character varying(100) DEFAULT ''::character varying NOT NULL
);


ALTER TABLE public.orientaciones OWNER TO www;

--
-- Name: orientaciones_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE orientaciones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.orientaciones_id_seq OWNER TO www;

--
-- Name: orientaciones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE orientaciones_id_seq OWNED BY orientaciones.id;


--
-- Name: planes_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE planes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.planes_id_seq OWNER TO www;

--
-- Name: planes; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE planes (
    id integer DEFAULT nextval('planes_id_seq'::regclass) NOT NULL,
    instit_id integer NOT NULL,
    oferta_id integer NOT NULL,
    old_item integer DEFAULT 0 NOT NULL,
    norma character varying(300) NOT NULL,
    nombre character varying(200) NOT NULL,
    perfil character varying(200) NOT NULL,
    sector character varying(200) NOT NULL,
    duracion_hs integer DEFAULT 0 NOT NULL,
    duracion_semanas integer DEFAULT 0 NOT NULL,
    duracion_anios integer DEFAULT 0 NOT NULL,
    matricula integer DEFAULT 0 NOT NULL,
    observacion text NOT NULL,
    ciclo_alta integer DEFAULT 0 NOT NULL,
    ciclo_mod integer DEFAULT 0 NOT NULL,
    created timestamp without time zone,
    modified timestamp without time zone,
    sector_id integer DEFAULT 0 NOT NULL,
    subsector_id integer DEFAULT 0 NOT NULL,
    titulo_id integer DEFAULT 0 NOT NULL,
    estructura_plan_id integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.planes OWNER TO www;

--
-- Name: queries_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE queries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.queries_id_seq OWNER TO www;

--
-- Name: queries; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE queries (
    id integer DEFAULT nextval('queries_id_seq'::regclass) NOT NULL,
    name character varying(70) DEFAULT (NOT NULL::boolean),
    description text,
    query text,
    created timestamp with time zone,
    modified timestamp with time zone,
    categoria character varying(64) DEFAULT (NOT NULL::boolean),
    ver_online boolean DEFAULT (NOT NULL::boolean)
);


ALTER TABLE public.queries OWNER TO www;

--
-- Name: referentes_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE referentes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.referentes_id_seq OWNER TO www;

--
-- Name: referentes; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE referentes (
    id integer DEFAULT nextval('referentes_id_seq'::regclass) NOT NULL,
    jurisdiccion_id integer NOT NULL,
    name character varying(60) NOT NULL,
    tipodoc_id integer NOT NULL,
    nrodoc integer NOT NULL,
    telefono character varying(60) NOT NULL,
    mail character varying(60) NOT NULL
);


ALTER TABLE public.referentes OWNER TO www;

--
-- Name: sectores_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE sectores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sectores_id_seq OWNER TO www;

--
-- Name: sectores; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE sectores (
    id integer DEFAULT nextval('sectores_id_seq'::regclass) NOT NULL,
    name character varying(64),
    orientacion_id integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.sectores OWNER TO www;

--
-- Name: sectores_titulos; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE sectores_titulos (
    id integer NOT NULL,
    titulo_id integer DEFAULT 0 NOT NULL,
    sector_id integer DEFAULT 0 NOT NULL,
    subsector_id integer DEFAULT 0 NOT NULL,
    prioridad integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.sectores_titulos OWNER TO www;

--
-- Name: sectores_titulos_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE sectores_titulos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sectores_titulos_id_seq OWNER TO www;

--
-- Name: sectores_titulos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE sectores_titulos_id_seq OWNED BY sectores_titulos.id;


--
-- Name: subsectores; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE subsectores (
    id integer NOT NULL,
    name character varying(64),
    sector_id integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.subsectores OWNER TO www;

--
-- Name: subsectores_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE subsectores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.subsectores_id_seq OWNER TO www;

--
-- Name: subsectores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE subsectores_id_seq OWNED BY subsectores.id;


--
-- Name: sugerencias; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE sugerencias (
    id integer NOT NULL,
    asunto character varying(100),
    mensaje text,
    user_id integer,
    "IP" character varying(15),
    created timestamp without time zone,
    leido integer DEFAULT 0
);


ALTER TABLE public.sugerencias OWNER TO www;

--
-- Name: sugerencias_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE sugerencias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sugerencias_id_seq OWNER TO www;

--
-- Name: sugerencias_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE sugerencias_id_seq OWNED BY sugerencias.id;


--
-- Name: tickets; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE tickets (
    id integer NOT NULL,
    instit_id integer NOT NULL,
    user_id integer NOT NULL,
    observacion text NOT NULL,
    estado integer DEFAULT 0 NOT NULL,
    created timestamp without time zone,
    modified timestamp without time zone
);


ALTER TABLE public.tickets OWNER TO www;

--
-- Name: tickets_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE tickets_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tickets_id_seq OWNER TO www;

--
-- Name: tickets_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE tickets_id_seq OWNED BY tickets.id;


--
-- Name: tipodocs_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE tipodocs_id_seq
    START WITH 6
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tipodocs_id_seq OWNER TO www;

--
-- Name: tipodocs; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE tipodocs (
    id integer DEFAULT nextval('tipodocs_id_seq'::regclass) NOT NULL,
    abrev character varying(5) NOT NULL,
    name character varying(40) NOT NULL
);


ALTER TABLE public.tipodocs OWNER TO www;

--
-- Name: tipoinstits_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE tipoinstits_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tipoinstits_id_seq OWNER TO www;

--
-- Name: tipoinstits; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE tipoinstits (
    id integer DEFAULT nextval('tipoinstits_id_seq'::regclass) NOT NULL,
    jurisdiccion_id integer NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE public.tipoinstits OWNER TO www;

--
-- Name: titulos; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE titulos (
    id integer NOT NULL,
    name character varying(200) NOT NULL,
    marco_ref boolean DEFAULT false NOT NULL,
    oferta_id integer NOT NULL
);


ALTER TABLE public.titulos OWNER TO www;

--
-- Name: titulos_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE titulos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.titulos_id_seq OWNER TO www;

--
-- Name: titulos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE titulos_id_seq OWNED BY titulos.id;


--
-- Name: user_logins; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE user_logins (
    id integer NOT NULL,
    user_id integer NOT NULL,
    created timestamp without time zone
);


ALTER TABLE public.user_logins OWNER TO www;

--
-- Name: user_logins_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE user_logins_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.user_logins_id_seq OWNER TO www;

--
-- Name: user_logins_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE user_logins_id_seq OWNED BY user_logins.id;


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO www;

--
-- Name: users; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE users (
    id integer DEFAULT nextval('users_id_seq'::regclass) NOT NULL,
    username character varying(20) NOT NULL,
    nombre character varying(50) NOT NULL,
    apellido character varying(50) NOT NULL,
    password character varying(50) NOT NULL,
    mail character varying(60) NOT NULL,
    oficina character varying(10) NOT NULL,
    interno character varying(10) NOT NULL,
    role character varying(20) NOT NULL,
    jurisdiccion_id integer DEFAULT 0 NOT NULL,
    created timestamp without time zone,
    modified timestamp without time zone
);


ALTER TABLE public.users OWNER TO www;

--
-- Name: z_fondo_original; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE z_fondo_original (
    id integer NOT NULL,
    linea integer,
    tipo character varying(2),
    anio integer,
    trimestre integer,
    jurisdiccion_id integer,
    jurisdiccion_name character varying(40),
    memo character varying(100),
    cuecompleto character varying(100),
    instit character varying(200),
    instit_name character varying(200),
    departamento character varying(100),
    localidad character varying(100),
    f01 double precision,
    f02a double precision,
    f02b double precision,
    f02c double precision,
    f03a double precision,
    f03b double precision,
    f04 double precision,
    f05 double precision,
    f06a double precision,
    f06b double precision,
    f06c double precision,
    f07a double precision,
    f07b double precision,
    f07c double precision,
    f08 double precision,
    f09 double precision,
    f10 double precision,
    total double precision,
    equipinf double precision,
    refaccion double precision
);


ALTER TABLE public.z_fondo_original OWNER TO www;

--
-- Name: z_fondo_original_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE z_fondo_original_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.z_fondo_original_id_seq OWNER TO www;

--
-- Name: z_fondo_original_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE z_fondo_original_id_seq OWNED BY z_fondo_original.id;


--
-- Name: z_fondo_work; Type: TABLE; Schema: public; Owner: www; Tablespace: 
--

CREATE TABLE z_fondo_work (
    id integer NOT NULL,
    linea integer DEFAULT 0,
    tipo character varying(2) DEFAULT ''::character varying,
    anio integer DEFAULT 0,
    trimestre integer DEFAULT 0,
    jurisdiccion_id integer DEFAULT 0,
    jurisdiccion_name character varying(40) DEFAULT ''::character varying,
    memo character varying(100) DEFAULT ''::character varying,
    cuecompleto character varying(100) DEFAULT ''::character varying,
    instit character varying(200) DEFAULT ''::character varying,
    instit_name character varying(200) DEFAULT ''::character varying,
    departamento character varying(100) DEFAULT ''::character varying,
    localidad character varying(100) DEFAULT ''::character varying,
    f01 double precision DEFAULT 0,
    f02a double precision DEFAULT 0,
    f02b double precision DEFAULT 0,
    f02c double precision DEFAULT 0,
    f03a double precision DEFAULT 0,
    f03b double precision DEFAULT 0,
    f04 double precision DEFAULT 0,
    f05 double precision DEFAULT 0,
    f06a double precision DEFAULT 0,
    f06b double precision DEFAULT 0,
    f06c double precision DEFAULT 0,
    f07a double precision DEFAULT 0,
    f07b double precision DEFAULT 0,
    f07c double precision DEFAULT 0,
    f08 double precision DEFAULT 0,
    f09 double precision DEFAULT 0,
    f10 double precision DEFAULT 0,
    total double precision DEFAULT 0,
    equipinf double precision DEFAULT 0,
    refaccion double precision DEFAULT 0,
    instit_id integer DEFAULT 0,
    observacion text DEFAULT ''::character varying,
    totales_checked integer DEFAULT 0,
    cue_checked integer DEFAULT 0,
    instit_2009 integer DEFAULT 0,
    obs_problema text DEFAULT ''::character varying,
    obs_protocolo text DEFAULT ''::character varying,
    obs_resolucion text DEFAULT ''::character varying,
    obs_dictamen text DEFAULT ''::character varying,
    obs_solucion text DEFAULT ''::character varying
);


ALTER TABLE public.z_fondo_work OWNER TO www;

--
-- Name: z_fondo_work_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE z_fondo_work_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.z_fondo_work_id_seq OWNER TO www;

--
-- Name: z_fondo_work_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE z_fondo_work_id_seq OWNED BY z_fondo_work.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE acos ALTER COLUMN id SET DEFAULT nextval('acos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE aros ALTER COLUMN id SET DEFAULT nextval('aros_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE aros_acos ALTER COLUMN id SET DEFAULT nextval('aros_acos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE claseinstits ALTER COLUMN id SET DEFAULT nextval('claseinstits_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE estructura_planes ALTER COLUMN id SET DEFAULT nextval('estructura_planes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE estructura_planes_anios ALTER COLUMN id SET DEFAULT nextval('estructura_planes_anios_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE etp_estados ALTER COLUMN id SET DEFAULT nextval('etp_estados_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE fondos ALTER COLUMN id SET DEFAULT nextval('fondos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE fondos_lineas_de_acciones ALTER COLUMN id SET DEFAULT nextval('fondos_lineas_de_acciones_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE historial_cues ALTER COLUMN id SET DEFAULT nextval('historial_cues_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE jurisdicciones_estructura_planes ALTER COLUMN id SET DEFAULT nextval('jurisdicciones_estructura_planes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE lineas_de_acciones ALTER COLUMN id SET DEFAULT nextval('lineas_de_acciones_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE orientaciones ALTER COLUMN id SET DEFAULT nextval('orientaciones_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE sectores_titulos ALTER COLUMN id SET DEFAULT nextval('sectores_titulos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE subsectores ALTER COLUMN id SET DEFAULT nextval('subsectores_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE sugerencias ALTER COLUMN id SET DEFAULT nextval('sugerencias_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE tickets ALTER COLUMN id SET DEFAULT nextval('tickets_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE titulos ALTER COLUMN id SET DEFAULT nextval('titulos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE user_logins ALTER COLUMN id SET DEFAULT nextval('user_logins_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE z_fondo_original ALTER COLUMN id SET DEFAULT nextval('z_fondo_original_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE z_fondo_work ALTER COLUMN id SET DEFAULT nextval('z_fondo_work_id_seq'::regclass);


--
-- Name: acos_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY acos
    ADD CONSTRAINT acos_pkey PRIMARY KEY (id);


--
-- Name: anios_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY anios
    ADD CONSTRAINT anios_pkey PRIMARY KEY (id);


--
-- Name: aros_acos_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY aros_acos
    ADD CONSTRAINT aros_acos_pkey PRIMARY KEY (id);


--
-- Name: aros_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY aros
    ADD CONSTRAINT aros_pkey PRIMARY KEY (id);


--
-- Name: ciclos_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY ciclos
    ADD CONSTRAINT ciclos_pkey PRIMARY KEY (id);


--
-- Name: claseinstits_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY claseinstits
    ADD CONSTRAINT claseinstits_pkey PRIMARY KEY (id);


--
-- Name: departamento_id; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY departamentos
    ADD CONSTRAINT departamento_id PRIMARY KEY (id);


--
-- Name: dependencias_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY dependencias
    ADD CONSTRAINT dependencias_pkey PRIMARY KEY (id);


--
-- Name: estructura_planes_anios_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY estructura_planes_anios
    ADD CONSTRAINT estructura_planes_anios_pkey PRIMARY KEY (id);


--
-- Name: estructura_planes_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY estructura_planes
    ADD CONSTRAINT estructura_planes_pkey PRIMARY KEY (id);


--
-- Name: etapas_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY etapas
    ADD CONSTRAINT etapas_pkey PRIMARY KEY (id);


--
-- Name: etp_estados_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY etp_estados
    ADD CONSTRAINT etp_estados_pkey PRIMARY KEY (id);


--
-- Name: fondos_lineas_de_acciones_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY fondos_lineas_de_acciones
    ADD CONSTRAINT fondos_lineas_de_acciones_pkey PRIMARY KEY (id);


--
-- Name: fondos_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY fondos
    ADD CONSTRAINT fondos_pkey PRIMARY KEY (id);


--
-- Name: gestiones_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY gestiones
    ADD CONSTRAINT gestiones_pkey PRIMARY KEY (id);


--
-- Name: historial_cues_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY historial_cues
    ADD CONSTRAINT historial_cues_pkey PRIMARY KEY (id);


--
-- Name: id; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY sectores
    ADD CONSTRAINT id PRIMARY KEY (id);


--
-- Name: instits_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY instits
    ADD CONSTRAINT instits_pkey PRIMARY KEY (id);


--
-- Name: jurisdiccion_estructura_planes_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY jurisdicciones_estructura_planes
    ADD CONSTRAINT jurisdiccion_estructura_planes_pkey PRIMARY KEY (id);


--
-- Name: jurisdicciones_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY jurisdicciones
    ADD CONSTRAINT jurisdicciones_pkey PRIMARY KEY (id);


--
-- Name: lineas_de_acciones_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY lineas_de_acciones
    ADD CONSTRAINT lineas_de_acciones_pkey PRIMARY KEY (id);


--
-- Name: localidades_id; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY localidades
    ADD CONSTRAINT localidades_id PRIMARY KEY (id);


--
-- Name: logs_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY logs
    ADD CONSTRAINT logs_pkey PRIMARY KEY (id);


--
-- Name: ofertas_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY ofertas
    ADD CONSTRAINT ofertas_pkey PRIMARY KEY (id);


--
-- Name: orientaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY orientaciones
    ADD CONSTRAINT orientaciones_pkey PRIMARY KEY (id);


--
-- Name: planes_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY planes
    ADD CONSTRAINT planes_pkey PRIMARY KEY (id);


--
-- Name: queries_id; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY queries
    ADD CONSTRAINT queries_id PRIMARY KEY (id);


--
-- Name: referentes_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY referentes
    ADD CONSTRAINT referentes_pkey PRIMARY KEY (id);


--
-- Name: subsectores_id; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY subsectores
    ADD CONSTRAINT subsectores_id PRIMARY KEY (id);


--
-- Name: sugerencias_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY sugerencias
    ADD CONSTRAINT sugerencias_pkey PRIMARY KEY (id);


--
-- Name: tickets_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY tickets
    ADD CONSTRAINT tickets_pkey PRIMARY KEY (id);


--
-- Name: tipodocs_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY tipodocs
    ADD CONSTRAINT tipodocs_pkey PRIMARY KEY (id);


--
-- Name: tipoinstits_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY tipoinstits
    ADD CONSTRAINT tipoinstits_pkey PRIMARY KEY (id);


--
-- Name: titulos_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY titulos
    ADD CONSTRAINT titulos_pkey PRIMARY KEY (id);


--
-- Name: user_logins_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY user_logins
    ADD CONSTRAINT user_logins_pkey PRIMARY KEY (id);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: z_fondo_original_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY z_fondo_original
    ADD CONSTRAINT z_fondo_original_pkey PRIMARY KEY (id);


--
-- Name: z_fondo_work_pkey; Type: CONSTRAINT; Schema: public; Owner: www; Tablespace: 
--

ALTER TABLE ONLY z_fondo_work
    ADD CONSTRAINT z_fondo_work_pkey PRIMARY KEY (id);


--
-- Name: plan_ciclo_pkey; Type: INDEX; Schema: public; Owner: www; Tablespace: 
--

CREATE INDEX plan_ciclo_pkey ON anios USING btree (plan_id, ciclo_id);


--
-- Name: plan_instit_pkey; Type: INDEX; Schema: public; Owner: www; Tablespace: 
--

CREATE INDEX plan_instit_pkey ON planes USING btree (instit_id, id, oferta_id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

