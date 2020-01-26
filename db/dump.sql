use task_manager;

create table user
(
    id    int auto_increment
        primary key,
    name  varchar(255) not null,
    email varchar(255) not null,
    constraint UNIQ_8D93D649E7927C74
        unique (email)
)
    collate = utf8_unicode_ci;

INSERT INTO task_manager.user (id, name, email) VALUES (19, 'Michael', 'michael@mail.ru');
INSERT INTO task_manager.user (id, name, email) VALUES (20, 'John', 'john@mail.ru');
INSERT INTO task_manager.user (id, name, email) VALUES (21, 'Ringo', 'ringo@mail.ru');

create table task
(
    id          int auto_increment
        primary key,
    user_id     int                   null,
    title       varchar(255)          not null,
    description longtext              null,
    due_date    datetime              null comment '(DC2Type:datetime_immutable)',
    status      smallint(2) default 1 not null,
    constraint FK_527EDB25A76ED395
        foreign key (user_id) references user (id)
            on delete cascade
)
    collate = utf8_unicode_ci;

create index IDX_527EDB25A76ED395
    on task (user_id);

INSERT INTO task_manager.task (id, user_id, title, description, due_date, status) VALUES (12, null, 'task without user and due date', null, null, 1);
INSERT INTO task_manager.task (id, user_id, title, description, due_date, status) VALUES (13, 19, 'task for Michael', 'description for Michael', '2020-03-01 13:00:00', 2);
INSERT INTO task_manager.task (id, user_id, title, description, due_date, status) VALUES (15, 20, 'task for John', 'description for John', '2020-03-01 13:00:00', 1);
INSERT INTO task_manager.task (id, user_id, title, description, due_date, status) VALUES (16, 21, 'task for Ringo', 'description for Ringo', '2020-03-01 13:00:00', 1);
