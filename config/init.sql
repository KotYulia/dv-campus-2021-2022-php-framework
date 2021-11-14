DROP DATABASE IF EXISTS yuliiak_blog;

DROP USER IF EXISTS 'yuliiak_blog_user'@'%';

CREATE DATABASE yuliiak_blog;

CREATE USER 'yuliiak_blog_user'@'%' IDENTIFIED BY 'lg%hW3RR6468fvfdgv;jd@';

GRANT ALL ON yuliiak_blog.* TO 'yuliiak_blog_user'@'%';
