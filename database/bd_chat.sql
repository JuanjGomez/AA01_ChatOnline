create database bd_mensajeria;
use bd_mensajeria;

-- Creacion de la tabla para la tabla usuarios
create table tbl_usuarios (
    u_id int auto_increment not null primary key,
    u_username varchar(50) not null,
    u_name_real varchar(100) not null,
    u_email varchar(100) not null,
    u_contrasena varchar(255) not null,
    u_alta timestamp default CURRENT_TIMESTAMP
);

-- Creacion de la tabla solicitudes de amistad
create table tbl_solicitud_amistad (
    sa_id int auto_increment not null primary key,
    u_usuario_envia int not null,
    u_usuario_recibe int not null,
    sa_estado enum('Pendiente', 'Aceptada', 'Rechazada') not null default 'Pendiente',
    sa_fecha timestamp default CURRENT_TIMESTAMP
);

-- Creacion de la tabla para la tabla de amistades
-- Esta tabla relaciona a los usuarios para establecer la amistad
create table tbl_amistad (
    a_id int auto_increment not null primary key,
    u_usuario_uno int not null,
    u_usuario_dos int not null,
    a_fecha timestamp default CURRENT_TIMESTAMP
);

-- Creacion de la tabla para la tabla de chats
-- Esta tabla relaciona a los usuarios para establecer un chat
create table tbl_chats (
    c_id int auto_increment not null primary key,
    a_amistad int not null,
    c_fecha timestamp default CURRENT_TIMESTAMP
);

-- Creacion de la tabla para la tabla de mensajes
-- Esta tabla relaciona a los chats para establecer los mensajes del chat
create table tbl_mensajes (
    m_id int auto_increment not null primary key,
    c_chat int not null,
    u_envio int not null,
    m_contenido varchar(250) not null,
    m_fecha timestamp default CURRENT_TIMESTAMP
);

-- Relación entre tbl_solicitud_amistad y tbl_usuarios (solicitudes enviadas y recibidas)
alter table  tbl_solicitud_amistad
    add constraint fk_solicitud_amistad_usuario_envia
    foreign key (u_usuario_envia) references tbl_usuarios(u_id);

alter table  tbl_solicitud_amistad
    add constraint fk_solicitud_amistad_usuario_recibe
    foreign key (u_usuario_recibe) references tbl_usuarios(u_id);
    
-- Relación entre tbl_amistad y tbl_usuarios (amistades establecidas)
alter table  tbl_amistad
    add constraint fk_amistad_usuario_uno
    foreign key (u_usuario_uno) references tbl_usuarios(u_id);
    
alter table  tbl_amistad
    add constraint fk_amistad_usuario_dos
    foreign key (u_usuario_dos) references tbl_usuarios(u_id);
    
-- Relación entre tbl_chats y tbl_amistad (solo se puede crear un chat para una amistad)
alter table tbl_chats
    ADD CONSTRAINT fk_chat_amistad
    FOREIGN KEY (a_amistad) REFERENCES tbl_amistad(a_id);
    
-- Relación entre tbl_mensajes y tbl_chats (mensajes del chat)
alter table  tbl_mensajes
    add constraint fk_mensajes_chat
    foreign key (c_chat) references tbl_chats(c_id);
    
alter table  tbl_mensajes
    add constraint fk_mensajes_envio
    foreign key (u_envio) references tbl_usuarios(u_id);