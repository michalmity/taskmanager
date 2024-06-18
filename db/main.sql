#drop database if exists taskmanager;
create database if not exists taskmanager;

use taskmanager;

create table users (
    user_id int primary key auto_increment,
    username varchar(255) not null,
    password varchar(255) not null,
    email varchar(255) not null unique ,
    role_id int not null
);

create table roles (
    role_id int primary key auto_increment,
    name varchar(255) not null
);

create table tasks (
    task_id int primary key auto_increment,
    title varchar(255) not null,
    description text not null,
    created_at datetime not null,
    updated_at datetime not null,
    end_at datetime not null,
    status_id int not null,
    user_id int not null
);

create table statuses (
    status_id int primary key auto_increment,
    name varchar(255) not null
);

alter table users add constraint fk_users_roles foreign key (role_id) references roles(role_id);
alter table tasks add constraint fk_tasks_statuses foreign key (status_id) references statuses(status_id);
alter table tasks add constraint fk_tasks_users foreign key (user_id) references users(user_id);

insert into roles (name) values ('admin');
insert into roles (name) values ('user');

