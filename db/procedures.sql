use taskmanager;

DELIMITER $$

create procedure add_user(
    in p_username varchar(50),
    in p_email varchar(50),
    in p_password varchar(256)
)begin
    insert into users(username, email, password, role_id) values(p_username, p_email, p_password, 2);

end;


DELIMITER ;

DELIMITER $$


create procedure add_task(
    in p_description text,
    in p_created_at datetime,
    in p_updated_at datetime,
    in p_end_at datetime,
    in p_status_id int,
    in p_user_id int
)begin
    insert into tasks(description, created_at, updated_at, end_at, status_id, user_id) values(p_description, p_created_at, p_updated_at, p_end_at, p_status_id, p_user_id);

end;
