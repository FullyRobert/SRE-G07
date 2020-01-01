CREATE TABLE teacher(
tid bigint PRIMARY KEY,
password varchar(32),
tname varchar(16)
);

CREATE TABLE student(
sid bigint PRIMARY KEY,
password varchar(32),
sname varchar(16)
);

CREATE TABLE TA(
aid bigint PRIMARY KEY,
password varchar(32),
aname varchar(16)
);

-- CREATE TABLE course_basic(
-- course_id bigint,
-- tid bigint,
-- taid bigint,
-- course_name varchar(16),
-- CONSTRAINT course_basic_id UNIQUE (course_id,tid)
-- );

create table teacher_introduction(
tid bigint,
content varchar(256)
);

create table ta_introduction(
taid bigint,
content varchar(256)
);

CREATE TABLE course_basic(
course_id bigint,
tid bigint,
taid bigint,
course_name varchar(16),
introduction varchar(256),
invitation varchar(16),

CONSTRAINT course_basic_id UNIQUE (course_id,tid)
);


CREATE TABLE course(
course_id bigint,
sid bigint,
CONSTRAINT course_selection_id UNIQUE (course_id,sid)
);

CREATE TABLE comment_list(
id int PRIMARY KEY AUTO_INCREMENT,
course_id bigint,
name varchar(16),
email varchar(64),
comment varchar(128),
comment_date date,
foreign key(course_id) references course_basic(course_id),
CONSTRAINT comment_id UNIQUE (name,email,comment,comment_date)
);
INSERT INTO comment_list(name,comment,comment_date) VALUES('Tom','Hello','2017-3-3');


CREATE TABLE article(
id bigint PRIMARY KEY AUTO_INCREMENT,
course_id bigint,
title varchar(128),
html varchar(10240),
content varchar(128),
article_date date,
foreign key(course_id) references course_basic(course_id),
CONSTRAINT article_id UNIQUE (title,article_date)
);

CREATE TABLE notice(
id bigint PRIMARY KEY AUTO_INCREMENT,
course_id bigint,
user_type int, -- 0->administrator, 1->teacher, 2->TA
content varchar(256),
time date
);

-- CREATE TABLE forum_topic(
-- id int primary key auto_increment,
-- user_id int,
-- title varchar(128),
-- content varchar(128)
-- );

create table forum_topic_back (
id int primary key auto_increment,
topic_id int,
course_id bigint,
user_id int,
title varchar(128),
content varchar(128),
post_date date,
foreign key(course_id) references course_basic(course_id)
);


-- Create table homework(
-- 	hw_id bigint not null primary key,
-- 	tid bigint,
-- 	course_id bigint,
-- 	hw_name varchar(20),
-- 	summary char(200),
-- 	deadline datetime,
-- 	foreign key(tid) references teacher(tid),
-- 	foreign key(course_id) references course(course_id)
-- );
Create table homework(
	hw_id bigint not null primary key,
	tid bigint,
    taid bigint,
	course_id bigint,
	path varchar(128),
	hw_name varchar(20),
	summary char(200),
	deadline datetime,
	foreign key(tid) references teacher(tid),
    foreign key(taid) references TA(aid),
	foreign key(course_id) references course_basic(course_id)
);


-- Create table student_homework(
-- 	handintime datetime,
-- 	grade int,
-- 	sid bigint,
-- 	hw_id bigint,
-- 	hw_Index char(50),
-- 	comment char(200),
-- 	foreign key(hw_id) references homework(hw_id),
-- 	foreign key(sid) references student(sid), 
--         primary key(hw_id,sid)
-- ); 

Create table student_homework(
	handintime datetime,
	grade int,
	sid bigint,
	hw_id bigint,
	hw_Index char(50),
	comment char(200),
	course_id bigint,
	path varchar(128) unique,
	foreign key(hw_id) references homework(hw_id),
	foreign key(sid) references student(sid), 
	foreign key(course_id) references course_basic(course_id),
	primary key(hw_id,sid)
);

create table posts(
id int primary key auto_increment,
course_id bigint,
owner varchar(16) not null,
title varchar(128) not null,
content varchar(10240) not null,
is_public int,
post_date date,
foreign key(course_id) references course_basic(course_id)
);


create table replys(

id int primary key auto_increment,
course_id bigint,
post_id int not null,

owner varchar(16) not null,

content varchar(256) not null,

reply_date date,
foreign key(course_id) references course_basic(course_id)
);


create table groupz(
id int,
name varchar(16),
gid int,
course_id bigint,
foreign key(course_id) references course_basic(course_id)
);


create table groupz_code(
gid int,
invitation varchar(32)
);


create table video(
vid bigint primary key auto_increment,
course_id bigint,
name varchar(64),
size bigint,
path varchar(128) unique,
upload_time date,
valid boolean
);


create table file(
fid bigint primary key auto_increment,
course_id bigint,
name varchar(64),
size bigint,
path varchar(128) unique,
upload_time date,
valid boolean,
foreign key(course_id) references course_basic(course_id)
);


create table user_signup(
id bigint PRIMARY KEY ,
password varchar(32),
name varchar(16),
mail varchar(64),
question varchar(256),
answer varchar(16),
usertype int
);

create table ta_right(
taid bigint,
course_id bigint,
modify_course_info boolean,
delete_course boolean,
delete_post boolean,
delete_replay boolean,
post_hw boolean,
post_notice boolean,
download_hw boolean,
correct_hw boolean,
post_grade boolean,
upload_answer boolean,
delete_hw boolean,
upload_material boolean,
delete_material boolean
);

insert into teacher(tid, password, tname) values(10001,'root','root');
insert into user_signup(id, password, name, mail,question, answer,usertype) values (10001,'root','root','root@mail.cn','我是谁','管理员',1);
insert into teacher(tid, password, tname) values(10003,'lys','lys');
insert into user_signup(id, password, name, mail,question, answer,usertype) values (10003,'lys','lys','lys@mail.cn','我是谁','lys',1);
insert into student(sid, password, sname) values(30001,'stu','stu');
insert into user_signup(id, password, name, mail,question, answer,usertype) values (30001,'stu','stu','stu@mail.cn','我是谁','学生1',2);
insert into student(sid, password, sname) values(30002, 'stu', 'stu2');
insert into user_signup(id,password, name, mail,question, answer,usertype) values (30002,'stu','stu2','stu@mail.cn','我是谁','学生2',2);
insert into TA(aid, password, aname) values(20001, 'ta', 'ta');
insert into user_signup(id,password, name, mail,question, answer,usertype) values (20001,'ta','ta','ta@mail.cn','我是谁','助教',3);

insert into course_basic(course_id, tid, taid, course_name,invitation) values(100, 10003, 20001, 'test1','abc');
insert into course_basic(course_id, tid, taid, course_name,invitation) values(101, 10003, 20001, 'test2','def');
insert into course_basic(course_id, tid, taid, course_name,invitation) values(102, 10003, 20001, 'test3','ghi');

insert into ta_right(taid, course_id, modify_course_info, delete_course, delete_post, delete_replay,
                post_hw, post_notice, download_hw, correct_hw, post_grade, upload_answer, delete_hw,
                upload_material, delete_material) values
                (20001, 100, true, true, true, true, true, true, true, true, true, true, true, true, true);

insert into course(course_id, sid) values(100, 30001);
insert into course(course_id, sid) values(100, 30002);
insert into course(course_id, sid) values(101, 30001);
insert into course(course_id, sid) values(102, 30002);

insert into groupz(id, name, course_id, gid) values (30001, 'stu', 100, 1);
insert into groupz(id, name, course_id, gid) values (30001, 'stu', 101, 3);
insert into groupz(id, name, course_id, gid) values (30002, 'stu2', 100, 2);

