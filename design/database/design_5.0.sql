CREATE TABLE `user` (

`user_id` varchar(32) NOT NULL,

`user_name` varchar(100) NOT NULL,

`password` varchar(500) NOT NULL,

`desc` text NULL COMMENT '用户介绍',

`medal` varchar(32) NOT NULL DEFAULT 0 COMMENT '金牌数',

`img` text NULL COMMENT '头像',

`champion` varchar(32) NOT NULL DEFAULT 0 COMMENT '冠军币',

`rank` varchar(32) NOT NULL DEFAULT 0 COMMENT '等级',

`role` varchar(32) NULL COMMENT '身份认证',

`sex` varchar(32) NULL,

`birthday` varchar(32) NULL,

`location` varchar(32) NULL,

`mobile` varchar(32) NULL,

PRIMARY KEY (`user_id`) 

);



CREATE TABLE `role` (

`role_id` varchar(32) NOT NULL,

`role_name` varchar(100) NULL,

`remark` varchar(100) NULL,

PRIMARY KEY (`role_id`) 

)

COMMENT = '两种身份

0 普通会员

1 俱乐部会员

2 俱乐部专家';



CREATE TABLE `video` (

`id` varchar(32) NOT NULL,

`name` varchar(500) NULL,

`user_id` varchar(100) NULL,

`detail` text NULL,

`play_count` varchar(32) NOT NULL DEFAULT 0 COMMENT '播放次数',

`praise_count` varchar(32) NOT NULL DEFAULT 0,

`add_time` varchar(32) NULL,

`last_time` varchar(32) NULL,

`desc` varchar(100) NULL COMMENT '视频简介',

PRIMARY KEY (`id`) 

);



CREATE TABLE `favorite` (

`favo_id` varchar(32) NOT NULL,

`user_id` varchar(32) NULL COMMENT '关注用户的id',

`atten_id` varchar(32) NULL COMMENT '被关注用户的id',

`remark` varchar(100) NULL,

PRIMARY KEY (`favo_id`) 

);



CREATE TABLE `game` (

`game_id` varchar(32) NOT NULL,

`game_name` varchar(500) NULL,

`user_id` varchar(32) NULL COMMENT '发起人',

`wiki_id` varchar(32) NULL,

PRIMARY KEY (`game_id`) 

);



CREATE TABLE `message` (

`message_id` varchar(32) NOT NULL,

`msg_content` text NULL,

`user_id` varchar(32) NULL,

`add_time` varchar(100) NULL,

`update_time` varchar(100) NULL,

`remark` varchar(500) NULL,

PRIMARY KEY (`message_id`) 

);



CREATE TABLE `follow` (

`follow_id` varchar(32) NOT NULL,

`user_id` varchar(32) NULL COMMENT '被follow的id',

`follow_user` varchar(32) NULL COMMENT 'follow的id',

`remark` varchar(100) NULL,

PRIMARY KEY (`follow_id`) 

);



CREATE TABLE `wiki` (

`wiki_id` varchar(32) NOT NULL,

`wiki_name` varchar(100) NULL,

`remark` varchar(100) NULL,

PRIMARY KEY (`wiki_id`) 

);



CREATE TABLE `joined_game` (

`joined_id` varchar(32) NOT NULL,

`user_id` varchar(32) NULL COMMENT '参加用户的id',

`game_id` varchar(32) NULL COMMENT '参加比赛的id',

`remark` varchar(100) NULL,

PRIMARY KEY (`joined_id`) 

);



CREATE TABLE `club` (

`club_id` varchar(32) NOT NULL,

`club_name` varchar(100) NULL,

`img` text NULL COMMENT '头像',

`rank` varchar(32) NOT NULL DEFAULT 0,

`remark` varchar(255) NULL,

PRIMARY KEY (`club_id`) 

);



CREATE TABLE `ad` (

`ad_id` varchar(32) NOT NULL,

`ad_title` varchar(100) NULL,

`ad_content` text NULL,

`ad_url` text NULL,

`remark` varchar(100) NULL,

PRIMARY KEY (`ad_id`) 

);



CREATE TABLE `join_club` (

`join_id` varchar(32) NOT NULL,

`user_id` varchar(32) NULL,

`club_id` varchar(32) NULL,

`remark` varchar(100) NULL,

PRIMARY KEY (`join_id`) 

);



CREATE TABLE `game_video` (

`id` varchar(32) NOT NULL,

`video_id` varchar(32) NULL,

`game_id` varchar(32) NULL,

`video_type` varchar(32) NULL,

PRIMARY KEY (`id`) 

);



CREATE TABLE `game_rank` (

`id` varchar(32) NOT NULL,

`game_id` varchar(32) NULL,

`rank` varchar(32) NULL COMMENT '比赛名次',

`user_id` varchar(32) NULL,

PRIMARY KEY (`id`) 

);


CREATE TABLE `video_type` (

`type_id` varchar(32) NOT NULL,

`type_name` varchar(100) NULL DEFAULT 训练视频,

PRIMARY KEY (`type_id`) 

)

COMMENT = '比赛视频类型

0 训练视频

1 比赛视频';



CREATE TABLE `item` (

`item_id` varchar(32) NOT NULL,

`item_name` varchar(32) NULL,

`user_id` varchar(32) NULL,

PRIMARY KEY (`item_id`) 

);



CREATE TABLE `comment` (

`comment_id` varchar(32) NOT NULL,

`user_id` varchar(32) NULL,

`video_id` varchar(32) NULL,

`content` text NULL,

PRIMARY KEY (`comment_id`) 

);





ALTER TABLE `user` ADD CONSTRAINT `fk_user_user_1` FOREIGN KEY (`role`) REFERENCES `role` (`role_id`);

ALTER TABLE `video` ADD CONSTRAINT `fk_video_video_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `favorite` ADD CONSTRAINT `fk_favorite_favorite_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `favorite` ADD CONSTRAINT `fk_favorite_favorite_2` FOREIGN KEY (`atten_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `game` ADD CONSTRAINT `fk_game_game_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `message` ADD CONSTRAINT `fk_message_message_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `follow` ADD CONSTRAINT `fk_follow_follow_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `follow` ADD CONSTRAINT `fk_follow_follow_2` FOREIGN KEY (`follow_user`) REFERENCES `user` (`user_id`);

ALTER TABLE `game` ADD CONSTRAINT `fk_game_game_2` FOREIGN KEY (`wiki_id`) REFERENCES `wiki` (`wiki_id`);

ALTER TABLE `joined_game` ADD CONSTRAINT `fk_joined_game_joined_game_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `joined_game` ADD CONSTRAINT `fk_joined_game_joined_game_2` FOREIGN KEY (`game_id`) REFERENCES `game` (`game_id`);

ALTER TABLE `comment` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `comment` ADD FOREIGN KEY (`video_id`) REFERENCES `video` (`id`);

ALTER TABLE `join_club` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `join_club` ADD FOREIGN KEY (`club_id`) REFERENCES `club` (`club_id`);

ALTER TABLE `item` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `game_video` ADD FOREIGN KEY (`video_id`) REFERENCES `video` (`id`);

ALTER TABLE `game_video` ADD FOREIGN KEY (`game_id`) REFERENCES `game` (`game_id`);

ALTER TABLE `game_video` ADD FOREIGN KEY (`video_type`) REFERENCES `video_type` (`type_id`);

ALTER TABLE `game_rank` ADD FOREIGN KEY (`game_id`) REFERENCES `game` (`game_id`);

ALTER TABLE `game_rank` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);



