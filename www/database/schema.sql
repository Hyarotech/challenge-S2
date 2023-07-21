create schema esgi;
set search_path to esgi;

CREATE TABLE IF NOT EXISTS "category"
(
    id integer NOT NULL,
    name character varying(45),
    CONSTRAINT category_pkey PRIMARY KEY (id)
    );




CREATE TABLE IF NOT EXISTS "user"
(
    id integer NOT NULL,
    firstname character varying(120),
    lastname character varying(120),
    email character varying(120),
    password character varying(255),
    verified boolean DEFAULT false,
    date_inserted timestamp ,
    date_updated timestamp,
    verif_token character varying(255),
    user_description text,
    role character varying(32),
    access_token character varying,
    reset_token character varying,
    CONSTRAINT user_pkey PRIMARY KEY (id),
    CONSTRAINT user_constraint_unique_access_token UNIQUE (access_token),
    CONSTRAINT user_constraint_unique_verif_token UNIQUE (verif_token)
    );



CREATE TABLE IF NOT EXISTS page
(
    id integer NOT NULL,
    title character varying(200),
    created_at date NOT NULL DEFAULT now(),
    slug character varying(200),
    user_id integer NOT NULL,
    description character varying(200),
    is_no_follow boolean NOT NULL,
    visibility smallint NOT NULL,
    updated_at date NOT NULL,
    CONSTRAINT page_pkey PRIMARY KEY (id),
    CONSTRAINT fk_page_user FOREIGN KEY (user_id)
    REFERENCES "user"
    );




CREATE TABLE IF NOT EXISTS pagebuilder
(
    id integer NOT NULL,
    page_id integer NOT NULL,
    state json NOT NULL,
    created_at timestamp,
    CONSTRAINT pagebuilder_pkey PRIMARY KEY (id)
    );



CREATE TABLE IF NOT EXISTS comment
(
    id integer NOT NULL,
    content character varying(120),
    created_at date,
    user_id integer NOT NULL,
    CONSTRAINT comment_pkey PRIMARY KEY (id),
    CONSTRAINT fk_comment_user1 FOREIGN KEY (user_id)
    REFERENCES "user" (id)
    );


CREATE TABLE IF NOT EXISTS cat_page
(
    id integer,
    page_id integer,
    category_id integer,
    CONSTRAINT cat_page_category_id_fk FOREIGN KEY (category_id)
    REFERENCES category (id),
    CONSTRAINT cat_page_page_id_fk FOREIGN KEY (page_id)
    REFERENCES page (id)
    );