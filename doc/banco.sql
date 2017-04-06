# mysql -u root -p

show databases;
create database mithrandir;
use mithrandir;
create table access_policy(
  id int not null auto_increment,
  address varchar(16) not null,
  s_port varchar(16) not null,
  d_port varchar(16) not null,
  protocol varchar(3) not null,
  filter varchar(8) not null,
  action varchar(10) not null,
  command varchar(100) not null,
  primary key ( id )
);

insert into access_policy (address, s_port, d_port, protocol, filter, action, command)
    values ('8.8.8.8', '-', '-', 'tcp', 'input', 'accept', 'iptables -A INPUT -s 8.8.8.8 -p tcp -j ACCEPT');

select * from access_policy;
select address, s_port from access_policy;

delete from access_policy
  where id = 1;


create table userlist(
    id int not null auto_increment,
    username varchar(50) not null,
    password varchar(50) not null,
    primary key ( id )
)

insert into userlist (username, password)
    values ('admin', 'admin');
