create database if not exists dbapi;
use dbapi;
drop table if exists client;
create table client (
id int primary key,
clientcode int(5),
clientname varchar(255),
address varchar(255),
zipcode varchar(6),
revenue varchar(10),
clienttier varchar(1)
);
insert into client 
(id, clientcode,clientname,address,zipcode,revenue,clienttier)
values
(1, 11, 'client one', 'address one', '73132', '99999', '1'),
(2, 22, 'client two', 'address two', '73111', '88888', '2'),
(3, 33, 'client three', 'address three', '73117', '77777', '3');
select * from client;


drop table if exists employee;
create table employee(
id int primary key,
eecode char(4),
eename char(255),
age int(3),
birthdate date,
phone varchar(20),
gender tinyint(1),
status char(1),
ssn int(10)
);
insert into employee
(id,eecode, eename, age, birthdate, phone, gender, status, ssn)
values
(1,'E1', 'Employee One', '5', '2000-10-10', '1234567899', 1, 'A', '123456789'),
(2,'E2', 'Employee Two', '10', '1999-08-18', '2315648977', 0, 'T', '123446789'),
(3,'E3', 'Empoyee Three', '15', '1990-05-02', '3316649977', 1, 'I', '132456798'),
(4,'E4', 'Empoyee Four', '20', '1980-06-01', '4316649977', 0, 'A', '232456798');
select * from employee;