create schema esgi;
set search_path to esgi;
    create table users (
        id serial primary key,
        email varchar(255) not null,
        password varchar(255) not null,
        firstname varchar(255) not null,
        lastname varchar(255) not null,
        role varchar(255) not null,
        created_at timestamp not null default now(),
        updated_at timestamp not null default now()
    );