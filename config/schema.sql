DROP TABLE IF EXISTS `category_post`;
#---
DROP TABLE IF EXISTS `statistics`;
#---
DROP TABLE IF EXISTS `post`;
#---
DROP TABLE IF EXISTS `category`;
#---
DROP TABLE IF EXISTS `author`;
#---
CREATE TABLE `author` (
    `author_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Author ID',
    `name`      varchar(127) NOT NULL COMMENT 'Name',
    `url`       varchar(127) NOT NULL COMMENT 'URL',
    PRIMARY KEY (`author_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='Author Entity';
#---
INSERT INTO `author` (`name`, `url`)
VALUES ('Anna Mort', 'anna-mort'),
       ('Den Smith', 'den-smith'),
       ('Margo', 'margo'),
       ('Alex Fil', 'alex-fil'),
       ('Mr. Bin', 'mr-bin');
#---
CREATE TABLE `post` (
    `post_id`     int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Post ID',
    `name`        varchar(127) NOT NULL COMMENT 'Name',
    `url`         varchar(127) NOT NULL COMMENT 'URL',
    `description` varchar(4095) DEFAULT NULL COMMENT 'Description',
    `author_id`   int unsigned NOT NULL COMMENT 'Author ID',
    PRIMARY KEY (`post_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='Post Entity';
#---
ALTER TABLE `post`
    ADD COLUMN `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        COMMENT 'Created At' AFTER `author_id`,
    ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
        COMMENT 'Updated At' AFTER `created_at`,
    ADD CONSTRAINT `FK_POST_AUTHOR_ID` FOREIGN KEY (`author_id`)
        REFERENCES `author` (`author_id`) ON DELETE CASCADE;
#---
INSERT INTO `post` (`name`, `url`, `description`, `author_id`)
VALUES ('Post 1', 'post-1', 'Post 1 Description', 1),
       ('Post 2', 'post-2', 'Post 2 Description', 2),
       ('Post 3', 'post-3', 'Post 3 Description', 3),
       ('Post 4', 'post-4', 'Post 4 Description', 1),
       ('Post 5', 'post-5', 'Post 5 Description', 2),
       ('Post 6', 'post-6', 'Post 6 Description', 4),
       ('Post 7', 'post-7', 'Post 7 Description', 5),
       ('Post 8', 'post-8', 'Post 8 Description', 5),
       ('Post 9', 'post-9', 'Post 9 Description', 2),
       ('Post 10', 'post-10', 'Post 10 Description', 4),
       ('Post 11', 'post-11', 'Post 11 Description', 2),
       ('Post 12', 'post-12', 'Post 12 Description', 3),
       ('Post 13', 'post-13', 'Post 13 Description', 3),
       ('Post 14', 'post-14', 'Post 14 Description', 5),
       ('Post 15', 'post-15', 'Post 15 Description', 1);
#---
CREATE TABLE `category` (
    `category_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Category ID',
    `name`        varchar(127) NOT NULL COMMENT 'Name',
    `url`         varchar(127) NOT NULL COMMENT 'URL',
    PRIMARY KEY (`category_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='Category Entity';
#---
INSERT INTO `category` (`name`, `url`)
VALUES ('Science', 'science'),
       ('Sport', 'sport'),
       ('Economy', 'economy'),
       ('Politics', 'politics'),
       ('Culture', 'culture');
#---
CREATE TABLE `category_post` (
    `category_post_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `post_id`          int unsigned NOT NULL COMMENT 'Post ID',
    `category_id`      int unsigned NOT NULL COMMENT 'Category ID',
    PRIMARY KEY (`category_post_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='Category Post';
#---
ALTER TABLE `category_post`
    ADD CONSTRAINT `FK_CATEGORY_POST_CATEGORY_ID` FOREIGN KEY (`category_id`)
        REFERENCES `category` (`category_id`) ON DELETE CASCADE,
    ADD CONSTRAINT `FK_CATEGORY_POST_POST_ID` FOREIGN KEY (`post_id`)
        REFERENCES `post` (`post_id`) ON DELETE CASCADE;
#---
INSERT INTO `category_post` (`category_id`, `post_id`)
VALUES (1, 2), (1, 10), (1, 8),
       (2, 1), (2, 12), (2, 9),
       (3, 3), (3, 13), (3, 6),
       (4, 5), (4, 11), (4, 7),
       (5, 4), (5, 14), (5, 15);
#---
CREATE TABLE `statistics` (
    `statistics_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Statistics ID',
    `number_views`  smallint DEFAULT NULL COMMENT 'Number Views',
    `date`          date     DEFAULT NULL COMMENT 'Date',
    `post_id`       int unsigned NOT NULL COMMENT 'Post ID',
    PRIMARY KEY (`statistics_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='Statistics Entity';
#--
ALTER TABLE `statistics`
    ADD CONSTRAINT `FK_STATISTICS_POST_ID` FOREIGN KEY (`post_id`)
        REFERENCES `post` (`post_id`) ON DELETE CASCADE;
#---
INSERT INTO `statistics` (`number_views`, `date`, `post_id`)
VALUES (20, '2021-11-14', 1),
       (11, '2021-11-15', 1),
       (18, '2021-11-14', 2),
       (5, '2021-11-15', 2),
       (5, '2021-11-14', 3),
       (32, '2021-11-15', 3),
       (80, '2021-11-14', 4),
       (1, '2021-11-15', 4),
       (45, '2021-11-14', 5),
       (8, '2021-11-15', 5),
       (7, '2021-11-14', 6),
       (54, '2021-11-15', 6),
       (22, '2021-11-14', 7),
       (8, '2021-11-15', 7),
       (0, '2021-11-14', 8),
       (89, '2021-11-15', 8),
       (55, '2021-11-14', 9),
       (7, '2021-11-15', 9),
       (44, '2021-11-14', 10),
       (33, '2021-11-15', 10),
       (20, '2021-11-14', 11),
       (10, '2021-11-15', 11),
       (54, '2021-11-14', 12),
       (3, '2021-11-15', 12),
       (0, '2021-11-14', 13),
       (85, '2021-11-15', 13),
       (96, '2021-11-14', 14),
       (2, '2021-11-15', 14),
       (18, '2021-11-14', 15),
       (78, '2021-11-15', 15);
