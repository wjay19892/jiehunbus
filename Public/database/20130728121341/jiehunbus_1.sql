DROP TABLE IF EXISTS jh_access;
CREATE TABLE `jh_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `pid` smallint(6) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_accessory;
CREATE TABLE `jh_accessory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path_width` int(11) NOT NULL,
  `path_height` int(11) NOT NULL,
  `origin_width` int(11) NOT NULL,
  `origin_height` int(11) NOT NULL,
  `thumbnail_width` int(11) NOT NULL,
  `thumbnail_height` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `uploadtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO jh_accessory VALUES ('1','0','0','0','0','0','0','img','','/Public/upload/img/avatar/51dccbb0dd27e.png','/Public/upload/img/avatar/m_51dccbb0dd27e.png','/Public/upload/img/avatar/s_51dccbb0dd27e.png','203273','1373424560');
INSERT INTO jh_accessory VALUES ('2','334','334','500','500','213','213','img','','/Public/upload/img/Goods/51dccc3ce2685.png','/Public/upload/img/Goods/m_51dccc3ce2685.png','/Public/upload/img/Goods/s_51dccc3ce2685.png','28789','1373424701');
INSERT INTO jh_accessory VALUES ('3','334','223','460','308','213','142','img','','/Public/upload/img/Goods/51dccd2ae9cc6.png','/Public/upload/img/Goods/m_51dccd2ae9cc6.png','/Public/upload/img/Goods/s_51dccd2ae9cc6.png','304336','1373424938');
INSERT INTO jh_accessory VALUES ('4','334','223','460','308','213','142','img','','/Public/upload/img/attachment/51dce2ff8300c.png','/Public/upload/img/attachment/m_51dce2ff8300c.png','/Public/upload/img/attachment/s_51dce2ff8300c.png','304336','1373430527');
INSERT INTO jh_accessory VALUES ('5','190','60','190','60','190','60','img','','/Public/upload/img/site/51dcece1bc29c.png','/Public/upload/img/site/m_51dcece1bc29c.png','/Public/upload/img/site/s_51dcece1bc29c.png','12122','1373433057');
INSERT INTO jh_accessory VALUES ('6','190','60','190','60','190','60','img','','/Public/upload/img/site/51dcef631bca1.png','/Public/upload/img/site/m_51dcef631bca1.png','/Public/upload/img/site/s_51dcef631bca1.png','12122','1373433699');
INSERT INTO jh_accessory VALUES ('7','0','0','0','0','0','0','img','','/Public/upload/img/avatar/51de59bb4f3a5.jpg','/Public/upload/img/avatar/m_51de59bb4f3a5.jpg','/Public/upload/img/avatar/s_51de59bb4f3a5.jpg','115467','1373526459');
INSERT INTO jh_accessory VALUES ('8','0','0','0','0','0','0','img','','/Public/upload/img/avatar/51df491ebe7e7.jpg','/Public/upload/img/avatar/m_51df491ebe7e7.jpg','/Public/upload/img/avatar/s_51df491ebe7e7.jpg','97469','1373587742');
INSERT INTO jh_accessory VALUES ('9','113','50','113','50','113','50','img','','/Public/upload/img/site/51e0158f6ae4b.png','/Public/upload/img/site/m_51e0158f6ae4b.png','/Public/upload/img/site/s_51e0158f6ae4b.png','5752','1373640079');
INSERT INTO jh_accessory VALUES ('10','190','50','190','50','190','50','img','','/Public/upload/img/site/51f3f17a5330e.png','/Public/upload/img/site/m_51f3f17a5330e.png','/Public/upload/img/site/s_51f3f17a5330e.png','14268','1374941562');
INSERT INTO jh_accessory VALUES ('11','280','50','280','50','213','38','img','','/Public/upload/img/site/51f480d73b232.png','/Public/upload/img/site/m_51f480d73b232.png','/Public/upload/img/site/s_51f480d73b232.png','16490','1374978263');

DROP TABLE IF EXISTS jh_accessory_relation;
CREATE TABLE `jh_accessory_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accessoryid` int(11) NOT NULL,
  `relationid` int(11) NOT NULL,
  `table` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `accessoryid` (`accessoryid`),
  KEY `relationid` (`table`,`relationid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO jh_accessory_relation VALUES ('3','3','1','Goods');
INSERT INTO jh_accessory_relation VALUES ('4','4','6','Talk_about');

DROP TABLE IF EXISTS jh_advertising;
CREATE TABLE `jh_advertising` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position_id` mediumint(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `code` text NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1: 图片 2:flash 3:自定义代码',
  `status` tinyint(4) NOT NULL,
  `url` varchar(255) NOT NULL,
  `click_count` int(11) NOT NULL,
  `desc` text NOT NULL,
  `sort` int(11) DEFAULT '0',
  `adv_start_time` int(11) DEFAULT '0',
  `adv_end_time` int(11) DEFAULT '0',
  `is_vote` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `position_id` (`position_id`),
  KEY `inx_adv_001` (`status`,`position_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO jh_advertising VALUES ('5','2','秒杀','','2','1','','0','','0','0','0','0');

DROP TABLE IF EXISTS jh_advertising_position;
CREATE TABLE `jh_advertising_position` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tagname` varchar(30) NOT NULL,
  `name` varchar(60) NOT NULL,
  `width` smallint(5) unsigned NOT NULL DEFAULT '0',
  `height` int(10) unsigned NOT NULL DEFAULT '0',
  `is_flash` tinyint(1) NOT NULL DEFAULT '0',
  `flash_style` varchar(60) NOT NULL,
  `style` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO jh_advertising_position VALUES ('2','index_slides','首页幻灯片','570','270','0','redfocus','<table cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<foreach name=\"adv_list\" item=\"adv\" >\r\n<td>{$adv.html}</td>\r\n</foreach>\r\n</tr>\r\n</table>');

DROP TABLE IF EXISTS jh_apply;
CREATE TABLE `jh_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fz_name` varchar(255) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `opening` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `characteristic` varchar(255) NOT NULL,
  `services` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `zoom` int(11) NOT NULL,
  `addtime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO jh_apply VALUES ('1','1','测试商家','测试人员','0','/Public/upload/img/Goods/51dccc3ce2685.png','13455555432','早九点到万六点','婚纱摄影o2o','年轻 时尚','苏州市区','苏州园区生物纳米园','120.736484','31.265311','13','2013','1');

DROP TABLE IF EXISTS jh_article;
CREATE TABLE `jh_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '文章标题',
  `sort` int(11) DEFAULT NULL COMMENT '文章排序',
  `content` mediumtext COMMENT '文章内容',
  `keywords` varchar(255) DEFAULT NULL COMMENT 'seo关键字',
  `description` text COMMENT '文章描述',
  `link` varchar(255) DEFAULT NULL COMMENT '外部链接',
  `type` tinyint(1) NOT NULL,
  `addtime` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '文章状态0禁用不可读1可读2仅会员可读',
  PRIMARY KEY (`id`),
  KEY `FK_Reference_37` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

INSERT INTO jh_article VALUES ('1','0','服务条款','0','																				服务条款 内容								','','','http://www.baidu.com','1','0','1');
INSERT INTO jh_article VALUES ('48','11','关于我们','0','','','','','0','1338863944','1');
INSERT INTO jh_article VALUES ('49','14','帮助中心','0','','','','','0','1338863958','1');
INSERT INTO jh_article VALUES ('50','15','服务条款','0','','','','','0','1338863964','1');
INSERT INTO jh_article VALUES ('51','2','公告测试','0','','','','','0','1373638358','1');
INSERT INTO jh_article VALUES ('53','17','联系我们','0','','','','','0','1373715951','1');
INSERT INTO jh_article VALUES ('54','16','法律声明','0','','','','','0','1373715969','1');

DROP TABLE IF EXISTS jh_articles_category;
CREATE TABLE `jh_articles_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `pid` int(11) DEFAULT NULL COMMENT '父类的ID',
  `level` int(11) NOT NULL COMMENT '等级',
  `path` varchar(255) DEFAULT NULL COMMENT '级别路径 例子 0,1,2,3',
  `type` tinyint(1) NOT NULL COMMENT '系统类型',
  `sort` int(11) DEFAULT NULL COMMENT '统计排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO jh_articles_category VALUES ('1','底部信息','0','0','0,1','1','0');
INSERT INTO jh_articles_category VALUES ('14','帮助中心','1','1','0,1,14','0','1');
INSERT INTO jh_articles_category VALUES ('15','服务条款','1','1','0,1,15','0','3');
INSERT INTO jh_articles_category VALUES ('11','关于我们','1','1','0,1,11','0','5');
INSERT INTO jh_articles_category VALUES ('2','公告','0','0','0,2','1','0');
INSERT INTO jh_articles_category VALUES ('16','法律声明','1','1','0,1,16','0','2');
INSERT INTO jh_articles_category VALUES ('17','联系我们','1','1','0,1,17','0','4');

DROP TABLE IF EXISTS jh_attachment;
CREATE TABLE `jh_attachment` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '附属表的ID',
  `key` varchar(255) DEFAULT NULL COMMENT '用于后台添加的用户附属属性的说明',
  `default` varchar(255) DEFAULT NULL COMMENT '附属说明的默认值',
  `type` tinyint(1) DEFAULT NULL COMMENT '附属属性的 类型\r\n            0手动输入 1单选 2下拉 3文本域 4图像',
  `enum` text COMMENT '枚举值 序列化存放 勇于多选下拉等',
  `explain` text COMMENT '字段说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_attention;
CREATE TABLE `jh_attention` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main` int(11) DEFAULT NULL,
  `was` int(11) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_21` (`main`),
  KEY `FK_Reference_22` (`was`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO jh_attention VALUES ('1','1','2','1373430421');

DROP TABLE IF EXISTS jh_cache;
CREATE TABLE `jh_cache` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cachekey` varchar(255) NOT NULL,
  `expire` int(11) NOT NULL,
  `data` blob,
  `datasize` int(11) DEFAULT NULL,
  `datacrc` int(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

INSERT INTO jh_cache VALUES ('1','online_check','-1','i:1374984755;','13','0');
INSERT INTO jh_cache VALUES ('2','User_index','-1','a:2:{s:2:\"id\";a:2:{i:0;s:3:\"egt\";i:1;i:2;}s:7:\"account\";a:2:{i:0;s:4:\"like\";i:1;s:2:\"%%\";}}','91','0');
INSERT INTO jh_cache VALUES ('3','Role_index','-1','a:1:{s:4:\"name\";a:2:{i:0;s:4:\"like\";i:1;s:2:\"%%\";}}','51','0');
INSERT INTO jh_cache VALUES ('4','currentNodeId','-1','i:0;','4','0');
INSERT INTO jh_cache VALUES ('5','Node_index','-1','a:1:{s:3:\"pid\";i:0;}','20','0');
INSERT INTO jh_cache VALUES ('6','Groups_navList','-1','a:5:{i:4;s:12:\"权限管理\";i:2;s:12:\"前台设置\";i:3;s:12:\"系统设置\";i:5;s:12:\"会员管理\";i:6;s:12:\"商品管理\";}','126','0');
INSERT INTO jh_cache VALUES ('7','Member_1','-1','a:9:{s:5:\"login\";N;s:32:\"9445546f70300f569b84ab18dd77aa5e\";a:0:{}s:32:\"eef7d5f8da79307b22961dedf4d01f57\";a:0:{}s:32:\"4ee3508c4df4146b70bdcdae61ae4d3c\";a:0:{}s:32:\"770030d5160c6812a76aa75fcfbc0405\";a:0:{}s:32:\"35b1da4ca99f1ef78aadd0d0c5dbe3b9\";a:0:{}s:32:\"2a0cd124c5bc1beac21090ea39dc32e0\";a:0:{}s:32:\"d77d79aedfa7c62627be08054535ec25\";a:0:{}s:32:\"d45231cdb8fd4abbd201e2ed139e4d54\";a:0:{}}','388','0');
INSERT INTO jh_cache VALUES ('8','online','-1','a:1:{i:1;i:1374984816;}','23','0');
INSERT INTO jh_cache VALUES ('9','onLineStatus','-1','a:2:{i:1;s:1:\"0\";i:2;s:1:\"0\";}','30','0');
INSERT INTO jh_cache VALUES ('11','Release_index','-1','a:1:{s:5:\"audit\";s:1:\"1\";}','26','0');
INSERT INTO jh_cache VALUES ('12','Goods_index','-1','a:1:{s:5:\"audit\";a:2:{i:0;s:2:\"eq\";i:1;i:0;}}','45','0');
INSERT INTO jh_cache VALUES ('13','Goods_lookUp','-1','a:1:{s:5:\"audit\";a:2:{i:0;s:2:\"eq\";i:1;i:0;}}','45','0');
INSERT INTO jh_cache VALUES ('14','Member_2','-1','a:2:{s:32:\"e121629f89fd4ad3e7b8754be2d29ff5\";a:0:{}s:32:\"6b248f62b66e6488e6964ab1bd33a946\";a:0:{}}','98','0');
INSERT INTO jh_cache VALUES ('30','backup_table','-1','a:77:{i:0;s:9:\"jh_access\";i:1;s:12:\"jh_accessory\";i:2;s:21:\"jh_accessory_relation\";i:3;s:14:\"jh_advertising\";i:4;s:23:\"jh_advertising_position\";i:5;s:8:\"jh_apply\";i:6;s:10:\"jh_article\";i:7;s:20:\"jh_articles_category\";i:8;s:13:\"jh_attachment\";i:9;s:12:\"jh_attention\";i:10;s:8:\"jh_cache\";i:11;s:11:\"jh_cash_log\";i:12;s:11:\"jh_chat_log\";i:13;s:9:\"jh_circle\";i:14;s:13:\"jh_collection\";i:15;s:10:\"jh_comment\";i:16;s:16:\"jh_comment_reply\";i:17;s:13:\"jh_commission\";i:18;s:17:\"jh_commission_log\";i:19;s:12:\"jh_complaint\";i:20;s:17:\"jh_complaint_item\";i:21;s:9:\"jh_coupon\";i:22;s:17:\"jh_distance_range\";i:23;s:11:\"jh_evaluate\";i:24;s:17:\"jh_evaluate_items\";i:25;s:9:\"jh_expand\";i:26;s:15:\"jh_expand_group\";i:27;s:10:\"jh_friends\";i:28;s:16:\"jh_friends_group\";i:29;s:18:\"jh_friends_request\";i:30;s:8:\"jh_goods\";i:31;s:17:\"jh_goods_category\";i:32;s:15:\"jh_goods_expand\";i:33;s:18:\"jh_goods_recommend\";i:34;s:8:\"jh_group\";i:35;s:13:\"jh_groups_nav\";i:36;s:8:\"jh_label\";i:37;s:17:\"jh_label_relation\";i:38;s:8:\"jh_level\";i:39;s:7:\"jh_link\";i:40;s:12:\"jh_login_log\";i:41;s:13:\"jh_login_port\";i:42;s:11:\"jh_mail_log\";i:43;s:9:\"jh_member\";i:44;s:20:\"jh_member_attachment\";i:45;s:17:\"jh_member_comment\";i:46;s:14:\"jh_member_feed\";i:47;s:14:\"jh_member_info\";i:48;s:15:\"jh_member_label\";i:49;s:18:\"jh_member_location\";i:50;s:10:\"jh_message\";i:51;s:14:\"jh_message_tpl\";i:52;s:13:\"jh_navigation\";i:53;s:7:\"jh_node\";i:54;s:8:\"jh_order\";i:55;s:16:\"jh_order_details\";i:56;s:10:\"jh_payment\";i:57;s:15:\"jh_prepaid_card\";i:58;s:14:\"jh_price_range\";i:59;s:11:\"jh_recharge\";i:60;s:12:\"jh_recommend\";i:61;s:9:\"jh_region\";i:62;s:10:\"jh_release\";i:63;s:9:\"jh_remind\";i:64;s:7:\"jh_role\";i:65;s:12:\"jh_role_user\";i:66;s:10:\"jh_sms_log\";i:67;s:10:\"jh_sysconf\";i:68;s:16:\"jh_sysconf_group\";i:69;s:13:\"jh_talk_about\";i:70;s:21:\"jh_talk_about_comment\";i:71;s:18:\"jh_talk_about_like\";i:72;s:22:\"jh_talk_about_relation\";i:73;s:7:\"jh_user\";i:74;s:12:\"jh_value_log\";i:75;s:15:\"jh_verification\";i:76;s:11:\"jh_withdraw\";}','1975','0');
INSERT INTO jh_cache VALUES ('23','currentGoods_categoryId','-1','i:0;','4','0');
INSERT INTO jh_cache VALUES ('24','Goods_category_index','-1','a:1:{s:3:\"pid\";i:0;}','20','0');
INSERT INTO jh_cache VALUES ('19','currentArticles_categoryId','-1','s:1:\"1\";','8','0');
INSERT INTO jh_cache VALUES ('20','Articles_category_index','-1','a:1:{s:3:\"pid\";s:1:\"1\";}','24','0');
INSERT INTO jh_cache VALUES ('17','currentRegionId','-1','s:1:\"2\";','8','0');
INSERT INTO jh_cache VALUES ('18','Region_index','-1','a:1:{s:3:\"pid\";s:1:\"2\";}','24','0');
INSERT INTO jh_cache VALUES ('21','Adv_posList','-1','a:1:{i:2;s:15:\"首页幻灯片\";}','33','0');
INSERT INTO jh_cache VALUES ('22','Sysconf_groupList','-1','a:9:{i:1;s:12:\"基本配置\";i:2;s:12:\"邮件设置\";i:3;s:6:\"其他\";i:4;s:12:\"上传设置\";i:5;s:18:\"会员相关配置\";i:6;s:12:\"短信设置\";i:7;s:12:\"程序设置\";i:8;s:12:\"利润分配\";i:9;s:12:\"发布设置\";}','221','0');

DROP TABLE IF EXISTS jh_cash_log;
CREATE TABLE `jh_cash_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `val` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_module` varchar(255) NOT NULL,
  `addtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_chat_log;
CREATE TABLE `jh_chat_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send` int(11) DEFAULT NULL,
  `receive` int(11) DEFAULT NULL,
  `content` text,
  `mark` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未读1已读',
  `delid` int(11) NOT NULL,
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO jh_chat_log VALUES ('1','1','1','看看','1','0','1373425204');
INSERT INTO jh_chat_log VALUES ('2','1','1','什么情况的','1','0','1373425208');
INSERT INTO jh_chat_log VALUES ('3','1','1','嗯 不错哦','1','0','1373425212');
INSERT INTO jh_chat_log VALUES ('4','2','1','你好～～～','1','0','1373430063');
INSERT INTO jh_chat_log VALUES ('5','2','1','[微笑]','1','0','1373430405');
INSERT INTO jh_chat_log VALUES ('6','1','2','[微笑] 有事情吗？','1','0','1373430465');
INSERT INTO jh_chat_log VALUES ('7','2','1','没啊 ～～～','1','0','1373430473');
INSERT INTO jh_chat_log VALUES ('8','1','2','哦','1','0','1373430486');
INSERT INTO jh_chat_log VALUES ('9','2','1','[拥抱]','1','0','1373430638');
INSERT INTO jh_chat_log VALUES ('10','2','1','你好,最近有优惠吗？','1','0','1373526505');
INSERT INTO jh_chat_log VALUES ('11','2','1','[色]','1','0','1373526513');
INSERT INTO jh_chat_log VALUES ('12','1','2','[微笑]','1','0','1373587812');

DROP TABLE IF EXISTS jh_circle;
CREATE TABLE `jh_circle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `label` text NOT NULL,
  `sort` int(11) NOT NULL,
  `lids` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO jh_circle VALUES ('1','商家点评','这个商家怎么样,这个商家在哪里 ','0','14,15');
INSERT INTO jh_circle VALUES ('2','推荐商家','推荐商家','0','16');
INSERT INTO jh_circle VALUES ('3','折扣信息','商家活动,折扣信息','0','17,18');
INSERT INTO jh_circle VALUES ('4','婚纱摄影内幕','提防的地方,潜规则','0','19,20');
INSERT INTO jh_circle VALUES ('5','咨询留言','求帮助,意见建议','0','21,22');

DROP TABLE IF EXISTS jh_collection;
CREATE TABLE `jh_collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `remark` text,
  `ispublic` tinyint(1) DEFAULT NULL COMMENT '0不公开1公开',
  `isfail` tinyint(1) DEFAULT '0' COMMENT '0未失效1失效',
  PRIMARY KEY (`id`),
  KEY `FK_Reference_19` (`gid`),
  KEY `FK_Reference_20` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

INSERT INTO jh_collection VALUES ('28','1','1','1374970596','','0','0');
INSERT INTO jh_collection VALUES ('6','1','2','1373430372','','0','0');
INSERT INTO jh_collection VALUES ('27','2','1','1373807657','','0','0');
INSERT INTO jh_collection VALUES ('25','3','1','1373799633','','0','0');

DROP TABLE IF EXISTS jh_comment;
CREATE TABLE `jh_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `gid` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `content` text,
  `type` tinyint(1) DEFAULT NULL COMMENT '0普通文章 1视频 2图片',
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_11` (`gid`),
  KEY `FK_Reference_12` (`reviewer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_comment_reply;
CREATE TABLE `jh_comment_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '回复ID',
  `cid` int(11) DEFAULT NULL COMMENT '评论ID',
  `uid` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `content` text,
  `type` tinyint(1) DEFAULT NULL COMMENT '0普通文章 1视频 2图片',
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_10` (`cid`),
  KEY `FK_Reference_11` (`uid`),
  KEY `FK_Reference_12` (`reviewer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_commission;
CREATE TABLE `jh_commission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO jh_commission VALUES ('1','1','0','100');
INSERT INTO jh_commission VALUES ('2','2','0','500');
INSERT INTO jh_commission VALUES ('3','3','0','5000');
INSERT INTO jh_commission VALUES ('4','4','0','10000');
INSERT INTO jh_commission VALUES ('5','3','0','5000');

DROP TABLE IF EXISTS jh_commission_log;
CREATE TABLE `jh_commission_log` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_complaint;
CREATE TABLE `jh_complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `other` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO jh_complaint VALUES ('1','1','3','0','不好看,骗子','1');

DROP TABLE IF EXISTS jh_complaint_item;
CREATE TABLE `jh_complaint_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_coupon;
CREATE TABLE `jh_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '优惠券ID',
  `gid` int(11) NOT NULL DEFAULT '0',
  `promulgator` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL DEFAULT '0',
  `oid` int(11) NOT NULL DEFAULT '0',
  `sn` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `bout` int(11) NOT NULL DEFAULT '0',
  `consume_time` int(11) NOT NULL,
  `addtime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未使用 1 已使用 2 已冻结',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_distance_range;
CREATE TABLE `jh_distance_range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO jh_distance_range VALUES ('1','10公里以内','0','10000','2','1');
INSERT INTO jh_distance_range VALUES ('2','20公里以内','0','20000','3','1');
INSERT INTO jh_distance_range VALUES ('3','40公里以内','0','40000','4','1');
INSERT INTO jh_distance_range VALUES ('4','60公里以内','0','60000','5','1');
INSERT INTO jh_distance_range VALUES ('5','80公里以内','0','80000','6','1');
INSERT INTO jh_distance_range VALUES ('7','100公里以上','100000','999999999','7','1');

DROP TABLE IF EXISTS jh_evaluate;
CREATE TABLE `jh_evaluate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `odid` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_evaluate_items;
CREATE TABLE `jh_evaluate_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '等级结构id',
  `name` varchar(255) DEFAULT NULL COMMENT '评价的项 中文即可',
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO jh_evaluate_items VALUES ('1','服务态度','4');
INSERT INTO jh_evaluate_items VALUES ('2','装修环境','3');
INSERT INTO jh_evaluate_items VALUES ('3','交通便利','1');
INSERT INTO jh_evaluate_items VALUES ('4','拍摄技术','2');

DROP TABLE IF EXISTS jh_expand;
CREATE TABLE `jh_expand` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '附属表的ID',
  `key` varchar(255) DEFAULT NULL COMMENT '用于后台添加的用户附属属性的说明',
  `default` varchar(255) DEFAULT NULL COMMENT '附属说明的默认值',
  `type` tinyint(1) DEFAULT NULL COMMENT '附属属性的 类型\r\n            0手动输入 1单选 2下拉 3文本域 4图像',
  `enum` text COMMENT '枚举值 序列化存放 勇于多选下拉等',
  `explain` text COMMENT '字段说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_expand_group;
CREATE TABLE `jh_expand_group` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `expand_ids` text NOT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_friends;
CREATE TABLE `jh_friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL DEFAULT '0',
  `main` int(11) NOT NULL DEFAULT '0' COMMENT '主人',
  `friend` int(11) NOT NULL DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `addtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_friends_group;
CREATE TABLE `jh_friends_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO jh_friends_group VALUES ('1','1','朋友');
INSERT INTO jh_friends_group VALUES ('2','1','同事');

DROP TABLE IF EXISTS jh_friends_request;
CREATE TABLE `jh_friends_request` (
  `main` int(11) NOT NULL DEFAULT '0',
  `friend` int(11) NOT NULL DEFAULT '0',
  `gid` int(11) NOT NULL DEFAULT '0',
  `note` varchar(100) NOT NULL,
  `addtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`main`,`friend`),
  KEY `friend` (`friend`),
  KEY `dateline` (`main`,`addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO jh_friends_request VALUES ('2','1','0','加个朋友吧！！！','1374984226');

DROP TABLE IF EXISTS jh_goods;
CREATE TABLE `jh_goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) DEFAULT NULL,
  `rid` int(11) DEFAULT NULL COMMENT '地区的ID',
  `egid` int(11) NOT NULL COMMENT '商品扩展分组ID',
  `promulgator` int(11) DEFAULT NULL,
  `commission_type` tinyint(1) NOT NULL,
  `commission` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL COMMENT '排序',
  `title` varchar(255) DEFAULT NULL,
  `short_title` varchar(50) NOT NULL,
  `detail` mediumtext,
  `keywords` varchar(255) DEFAULT NULL,
  `description` text,
  `tel` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `longitude` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `zoom` smallint(6) DEFAULT NULL,
  `original` varchar(255) DEFAULT '0.00',
  `price` varchar(255) DEFAULT '0.00' COMMENT '商品总价',
  `deposit` varchar(255) DEFAULT '0.00' COMMENT '商品定金',
  `payment` tinyint(1) DEFAULT NULL COMMENT '0全额 1 定金',
  `num` int(11) DEFAULT NULL,
  `onenum` int(11) DEFAULT NULL,
  `crrnum` int(11) NOT NULL COMMENT '已够数量',
  `pre` varchar(255) DEFAULT NULL,
  `starttime` int(11) DEFAULT NULL,
  `endtime` int(11) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `audit` tinyint(1) NOT NULL COMMENT '审核0通过1未通过',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未上架 1上架',
  PRIMARY KEY (`id`),
  KEY `FK_Reference_13` (`promulgator`),
  KEY `FK_Reference_7` (`rid`),
  KEY `price` (`price`),
  KEY `deposit` (`deposit`),
  KEY `longitude` (`longitude`,`latitude`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO jh_goods VALUES ('1','0','0','0','1','0','','0','【大美堂】爱你一生一世套系3980元','【大美堂】','<p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>2012.12.12.（两人要爱要爱要爱）2012.12.21（玛雅预言世界末日）2012.12.25（圣诞节）2013.1.4（爱你一生一世）2012年精彩的12月，如果真的有世界末日那么我们赶紧结婚，如果没有时间末日，那么我们相爱一生一世！</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>在线支付3980元，即可享受价值19999元大美堂婚纱摄影</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>仅3980元享受原价19999元大美堂婚纱摄影套餐，全程您可以穿着古装、婚纱、旗袍逛古街、游园林、看湖景、享受着小桥流水人家的别样风情…让您流连忘返！</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>【大美堂婚纱摄影拍摄景点选择】</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>苏州独家拍摄外景共三处：</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>线路1：广济公园/太湖湿地风景区/天池山/运河公园/太湖马场/独家别墅区（选1处）</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>线路2：摩天轮/金鸡湖风景区/月光码头/李公堤/北疆枫叶园/独墅湖教堂（选1处）</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※大美堂特色外景2处：古园林玉涵堂/七里山塘/大美堂本部/阊门古城墙</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※&nbsp;拍摄内景实景地点：5000平米大美堂自然景观实景基地拍摄</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※&nbsp;拍摄方式：室内实景摄影+电影手法拍摄棚+自然景观摄影基地+外景拍摄</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※本套系外景和内景实景随意搭配，有您做主</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>【大美堂婚纱摄影尊贵相册制作】</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※ 18寸韩式内页PVC纤薄内页高级水晶相册一本10P</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※ 12寸韩式内页PVC纤薄内页高级水晶相册一本10P</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※ 8寸韩式内页PVC纤薄内页娘家相册一本8P</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※&nbsp;三本婚纱相册不同设计共入册58组，提供入册前看小样服务</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※&nbsp;拍摄底片180组以上，原始档底片+精选58组精修底片刻盘赠送</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>（含高品质彩色照片，亮灯钨丝灯照片，变色龙黑白照片，高彩度正片照片等）</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>【大美堂婚纱摄影尊贵婚纱礼服】</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※提供新娘新郎彩妆设计造型设计</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※提供新娘6套拍照服装</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;&nbsp;<strong>豪华白纱、古装、晚礼服、特色服饰（专属饰品、造型配饰、头纱等免费使用）</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;&nbsp;<strong>提供新郎6套拍照服装</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;&nbsp;<strong>各款式燕尾服、西服、特色服、古装、多款造型领结（领结、领巾、腰封、背心等免费更换搭配）</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;&nbsp;<strong>免费提供各式道具拍摄</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※古装，婚纱礼服不分区，专业礼服师辅助指导挑选。</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>【大美堂婚纱摄影时尚放大产品】</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※&nbsp;60英寸无纺布精品巨幅海报一幅（含设计及照片）</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※ 120cmX60cm高级时尚象牙水晶一幅（含设计及照片）</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※&nbsp;40英寸时尚复古流金/流银边油画框一副（含设计及照片）</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※&nbsp;30英寸韩式时尚复古拉米娜版画一副&nbsp;（含设计及照片）</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※ &nbsp;20英寸高级时尚象牙水晶框一副（含设计及照片）</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※ &nbsp;18英寸高级时尚象牙水晶框一副（含设计及照片）</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※ 10英寸韩式高级象牙水晶摆台一幅（含设计及照片）</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※ 7英寸韩式高级象牙水晶摆台一幅（含设计及照片）</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※ 7英寸韩式高级象牙水晶摆台一幅（含设计及照片）</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※&nbsp;水晶中国结车挂一只（含设计及照片）</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※ 3寸钱包照6张</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※ 美好回忆影像档DVD光碟一套</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※&nbsp;终身免费服务大美堂VIP贵宾金卡一张</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>【大美堂婚纱摄影尊贵拍摄服务】</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※世界专业级尼康D70数码单反相机精致拍摄</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※世界专业级尼康D70数码特定24-70，50,85,135,17-40镜头拍摄</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※全程资深摄影团队、资深造型团队、资深后期团队为您服务拍摄一天</strong></p><p align=\"left\" style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>【大美堂婚纱摄影配套特色服务】</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※免费提供午餐两份</strong></p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※</strong>免费赠送资深美容师推荐专业动感美睫一套</p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※</strong>免费提供绅士礼服、服饰搭配，拍摄所需假发套、饰品、鲜花、等</p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\"><strong>※此套餐属于一次性消费，套餐外内容属于自愿消费</strong></p>','【大美堂】','【大美堂】爱你一生一世套系3980元','13813535307','苏州园区生物纳米园','120.736484','31.265311','12','','3980.00','0.00','0','100','1','0','','1373385600','1373472000','1373424945','0','1');
INSERT INTO jh_goods VALUES ('2','4','3','0','1','0','','0','5588套餐双枪摄影','洛斯视觉','<p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">1、首席单反摄像师：佳能5D MAK2</p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">2、高级摄像师配备：专业大型摄像机</p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">3、洛斯本人配设备：佳能5D MAK2</p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">4、全天全程跟随拍摄</p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">5、拍摄800张以上，精修60张</p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">6、唯美爱情电影花絮制作+婚礼全程制作流程</p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">7、一天全程拍摄12小时（超出时间按200元/小时计算）</p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">8、免费赠送精美婚礼光盘一份</p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">9、拍摄所有底片加精修照片全部刻盘赠送</p><p style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">10、免费赠20寸全家福版画一张（6人合影）</p><p style=\"margin: 0px 0px 0px 15.75pt; padding: 0px; color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">11、洛斯本人和首席单反摄像师当天拍摄从新娘家新娘化妆拍起、高级摄像师是从新郎家扎花车拍起到新娘家汇合</p>','洛斯视觉工作室','洛斯视觉工作室成立于2008年,我们以婚纱摄影外景拍摄为主,打造属于我们自己的品牌特色。我们拥有最优秀的技术团队,我们的化妆师是有多年资深经历的彩妆造型师,摄影师曾获得多项摄影大奖,锻件厂办过个人影展,曾与馮小刚导演,葛优倾情合作。我们秉承最好的技术,最好的团队、最好的服务来对待我们每一位尊贵的顾客,用我们的热情和艺术特色挥洒在我们的摄影技术上；并且在以后的道路上凭着不懈的努力将走的更远！','13912333443','苏州市平江区观前街临顿路39号','120.636847','31.315677','12','6488.00','5588.00','0.00','0','1','1','0','sd','1373472000','1375200000','1373522488','0','1');
INSERT INTO jh_goods VALUES ('3','6','7','0','1','0','','0','年末贺岁套系4588元','年末贺岁套系','<span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">本次活动全程一对一拍摄，绝无二次消费。全程外景专车接送</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">◇提供拍摄当天午餐每人一份</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">◇拍摄服务时间：1天</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 新郎新娘各提供服装六套</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">◇全程金牌技术团队创意拍摄190张以上，精选60张入册送精修设计版面</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">◇拍摄底片全部简修刻盘赠送</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">◇高等级摄影师全天全程跟踪创意拍摄服务</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">◇提供专业化妆品彩妆服务（免费提供安瓶，粉扑，店内所有精美饰品免费</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">使用，免费提供韩式高仿真假睫毛，假睫毛可带走，其他免费使用）</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">◇提供新郎、新娘精致婚纱礼服共十二套（六套服装六个造型，可自带服装，包含在六套之内）</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">◇外景推荐：</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;（超大实景放送6000平米实景电影片场 360度立体影棚随意拍摄）</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;向日葵主题 .熏衣草主题.欧式宫廷.白色恋情.西斯凯尔.地中海.凡尔赛.海景.</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;户外咖啡.花海.极地冰川.坎布里亚.米兰风情街.青青河畔.竹筏.热带雨林.石库</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;门新天地.书房.威尼斯港口.威尼斯广场 . 欧式罗马柱.田园风光.西亚风情馆.</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;许愿池.阳光下的艾尔兰.樱花小木屋.转角遇到爱.</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;◇外景推荐：</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;◇平江路.历史文化古街、山塘街、金鸡湖、现代大道、香樟林、草坪、月光码头、摩天轮外景、</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 独墅湖外景区、古城墙、胥门、竹林、西山，运河公园、夜色山塘、中英皇冠，</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;◇以上外景所产生的一切交通费用由商家承担，可自选景点但门票需客户自理</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 相册成品</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 18寸韩国水晶琉璃PVC内页相册10P-20页</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 16寸韩国水晶琉璃PVC内页相册10P-20页</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 7寸数码相册一本14张照片(从60张中精选14张)</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp;</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 放大成品</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 120x60cm 精美韩国水晶一幅(从60张中精选一张)</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 127x90cm无纺布海报一幅(从60张中精选一张)</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 36寸精美水晶/拉米娜一幅(从60张中精选一张)</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 24寸精美水晶/拉米娜一幅(从60张中精选一张)</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 12寸精美水晶/拉米娜二幅(从60张中精选二张)</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 7寸精美水晶/拉米娜二幅(从60张中精选二张)</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 精美音乐盒一个（(从60张中精选三张)</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; MTV电子相册一个(从60张中精选并刻入盘)</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 水晶车前挂件一个(从60张中精选一张)</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 360度水晶魔方一个(从60张中精选三张)</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 水晶钥匙扣一个(从60张中精选一张)</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 精美皮夹照三张(从60张中精选三张)</span><br style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\" /><span style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 18px;\">&nbsp; 量身定做新娘婚纱或礼服一件(二选一)</span>','','','13401234543','苏州平江区景德路194号','120.622563','31.316897','11','9888.00','4588.00','0.00','0','100','1','0','nz','1373644800','1375200000','1373712964','0','1');

DROP TABLE IF EXISTS jh_goods_category;
CREATE TABLE `jh_goods_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `pid` int(11) DEFAULT NULL COMMENT '父类的ID',
  `path` varchar(255) DEFAULT NULL COMMENT '级别路径 例子 0,1,2,3',
  `level` int(11) NOT NULL,
  `isdefault` tinyint(1) NOT NULL COMMENT '1是0否',
  `type` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL COMMENT '统计排序',
  `label` text NOT NULL,
  `lids` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `path` (`path`,`sort`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO jh_goods_category VALUES ('2','优雅韩风','0','0,2','0','0','0','13','','');
INSERT INTO jh_goods_category VALUES ('3','欧式宫廷','0','0,3','0','0','0','12','','');
INSERT INTO jh_goods_category VALUES ('4','特色主题','0','0,4','0','0','0','11','','');
INSERT INTO jh_goods_category VALUES ('5','时尚个性','0','0,5','0','0','0','10','','');
INSERT INTO jh_goods_category VALUES ('6','蜜月摄影','0','0,6','0','0','0','9','','');
INSERT INTO jh_goods_category VALUES ('7','甜美清新','0','0,7','0','0','0','8','','');
INSERT INTO jh_goods_category VALUES ('8','复古怀旧','0','0,8','0','0','0','7','','');
INSERT INTO jh_goods_category VALUES ('9','水下摄影','0','0,9','0','0','0','6','','');
INSERT INTO jh_goods_category VALUES ('14','独家外景','0','0,14','0','0','0','0','','');

DROP TABLE IF EXISTS jh_goods_expand;
CREATE TABLE `jh_goods_expand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) DEFAULT NULL COMMENT '用户ID',
  `aid` int(11) DEFAULT NULL COMMENT '附属表ID',
  `val` mediumtext COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_goods_recommend;
CREATE TABLE `jh_goods_recommend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO jh_goods_recommend VALUES ('1','1','0');

DROP TABLE IF EXISTS jh_group;
CREATE TABLE `jh_group` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `title` varchar(50) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0',
  `show` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `groups_nav_id` mediumint(6) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

INSERT INTO jh_group VALUES ('2','Per','后台权限','1222841259','0','1','0','0','4');
INSERT INTO jh_group VALUES ('6','Nav','后台导航','1222841259','0','1','1','0','4');
INSERT INTO jh_group VALUES ('7','Config','系统配置','1320913163','0','1','0','1','3');
INSERT INTO jh_group VALUES ('8','Sql_bak','数据库操作','1320913227','0','1','1','1','3');
INSERT INTO jh_group VALUES ('10','Adv','广告管理','1321411321','0','1','1','1','2');
INSERT INTO jh_group VALUES ('11','Link','友情链接','1321411363','0','1','2','1','2');
INSERT INTO jh_group VALUES ('12','Article','文章管理','1322447254','0','1','0','1','2');
INSERT INTO jh_group VALUES ('13','Member','会员管理','1322447483','0','1','0','1','5');
INSERT INTO jh_group VALUES ('14','Level','等级管理','1322447727','0','1','1','1','5');
INSERT INTO jh_group VALUES ('15','Other','其他管理','1322475702','0','1','1','1','3');
INSERT INTO jh_group VALUES ('16','Goods_att','商品附属','1322476780','0','1','1','1','6');
INSERT INTO jh_group VALUES ('17','Goods','商品管理','1322476809','0','1','0','1','6');
INSERT INTO jh_group VALUES ('18','Goods_log','商品日志','1322548926','0','1','1','1','6');
INSERT INTO jh_group VALUES ('19','Front_nav','前台导航','1322644143','0','1','1','1','2');
INSERT INTO jh_group VALUES ('20','Member_log','会员日志','1322727493','0','1','3','1','5');
INSERT INTO jh_group VALUES ('21','Member_info','会员信息','1322734168','0','1','1','1','5');

DROP TABLE IF EXISTS jh_groups_nav;
CREATE TABLE `jh_groups_nav` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO jh_groups_nav VALUES ('4','权限管理','1','2');
INSERT INTO jh_groups_nav VALUES ('2','前台设置','1','1');
INSERT INTO jh_groups_nav VALUES ('3','系统设置','1','3');
INSERT INTO jh_groups_nav VALUES ('5','会员管理','1','0');
INSERT INTO jh_groups_nav VALUES ('6','商品管理','1','0');

DROP TABLE IF EXISTS jh_label;
CREATE TABLE `jh_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `logo` int(11) NOT NULL,
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO jh_label VALUES ('1','说说','8','0','1373258651');
INSERT INTO jh_label VALUES ('2','80后','0','0','0');
INSERT INTO jh_label VALUES ('3','平江路','0','0','0');
INSERT INTO jh_label VALUES ('4','旺山','0','0','0');
INSERT INTO jh_label VALUES ('5','太湖','0','0','0');
INSERT INTO jh_label VALUES ('6','运河公园','0','0','0');
INSERT INTO jh_label VALUES ('7','月光码头','0','0','0');
INSERT INTO jh_label VALUES ('8','穹窿山后山','0','0','0');
INSERT INTO jh_label VALUES ('9','白马涧','0','0','0');
INSERT INTO jh_label VALUES ('10','山塘街','0','0','0');
INSERT INTO jh_label VALUES ('11','李公堤','0','0','0');
INSERT INTO jh_label VALUES ('12','苏州乐园','0','0','0');
INSERT INTO jh_label VALUES ('13','这个商家怎么样 这个商家在哪里','0','0','0');
INSERT INTO jh_label VALUES ('14','这个商家怎么样','0','0','0');
INSERT INTO jh_label VALUES ('15','这个商家在哪里','1','0','0');
INSERT INTO jh_label VALUES ('16','推荐商家','0','0','0');
INSERT INTO jh_label VALUES ('17','商家活动','0','0','0');
INSERT INTO jh_label VALUES ('18','折扣信息','0','0','0');
INSERT INTO jh_label VALUES ('19','提防的地方','0','0','0');
INSERT INTO jh_label VALUES ('20','潜规则','0','0','0');
INSERT INTO jh_label VALUES ('21','求帮助','1','0','0');
INSERT INTO jh_label VALUES ('22','意见建议','0','0','0');

DROP TABLE IF EXISTS jh_label_relation;
CREATE TABLE `jh_label_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO jh_label_relation VALUES ('1','1','1');
INSERT INTO jh_label_relation VALUES ('2','1','5');
INSERT INTO jh_label_relation VALUES ('3','1','8');
INSERT INTO jh_label_relation VALUES ('4','1','9');
INSERT INTO jh_label_relation VALUES ('5','1','16');
INSERT INTO jh_label_relation VALUES ('6','1','17');
INSERT INTO jh_label_relation VALUES ('7','1','18');
INSERT INTO jh_label_relation VALUES ('8','1','19');
INSERT INTO jh_label_relation VALUES ('9','15','22');
INSERT INTO jh_label_relation VALUES ('10','21','22');

DROP TABLE IF EXISTS jh_level;
CREATE TABLE `jh_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  `min` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO jh_level VALUES ('1','星级商家','100','0','1');
INSERT INTO jh_level VALUES ('2','钻石商家','1000','500','1');
INSERT INTO jh_level VALUES ('3','蓝冠商家','10000','5000','1');
INSERT INTO jh_level VALUES ('4','皇冠商家','100000','10000','1');

DROP TABLE IF EXISTS jh_link;
CREATE TABLE `jh_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `desc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inx_link_001` (`status`),
  KEY `inx_link_002` (`sort`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO jh_link VALUES ('1','乐活家','http://www.lehojia.com','0','','0','1','');

DROP TABLE IF EXISTS jh_login_log;
CREATE TABLE `jh_login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

INSERT INTO jh_login_log VALUES ('1','1','1373258595','','北京市联通ADSL');
INSERT INTO jh_login_log VALUES ('2','1','1373419336','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('3','1','1373424514','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('4','2','1373429928','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('5','1','1373503592','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('6','2','1373503704','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('7','1','1373525758','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('8','2','1373526437','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('9','1','1373587336','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('10','1','1373633791','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('11','1','1373677839','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('12','1','1373706070','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('13','1','1373712532','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('14','1','1373719744','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('15','1','1373760948','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('16','1','1373761123','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('17','1','1373776958','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('18','1','1373797623','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('19','1','1373814983','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('20','1','1373846574','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('21','1','1373885195','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('22','1','1373885641','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('23','1','1373933292','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('24','1','1373933383','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('25','1','1373971064','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('26','1','1373971134','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('27','1','1374018029','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('28','1','1374059077','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('29','1','1374062011','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('30','1','1374102271','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('31','1','1374102355','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('32','1','1374145100','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('33','1','1374145154','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('34','1','1374190253','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('35','1','1374191436','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('36','1','1374228366','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('37','1','1374230384','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('38','1','1374291324','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('39','1','1374291524','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('40','1','','','');
INSERT INTO jh_login_log VALUES ('41','1','1374327451','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('42','1','1374330827','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('43','1','1374372497','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('44','1','1374372845','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('45','1','','','');
INSERT INTO jh_login_log VALUES ('46','1','1374408526','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('47','1','1374409442','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('48','1','1374412375','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('49','1','','','');
INSERT INTO jh_login_log VALUES ('50','1','1374449790','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('51','1','1374449790','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('52','1','1374449950','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('53','1','1374493234','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('54','1','1374493275','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('55','1','1374493351','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('56','1','1374535782','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('57','1','1374535781','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('58','1','1374537102','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('59','1','','','');
INSERT INTO jh_login_log VALUES ('60','1','1374575983','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('61','1','1374575987','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('62','1','1374576245','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('63','1','','','');
INSERT INTO jh_login_log VALUES ('64','1','1374620351','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('65','1','1374620358','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('66','1','1374620915','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('67','1','1374664067','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('68','1','1374664075','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('69','1','1374665056','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('70','1','1374760584','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('71','1','1374760584','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('72','1','1374761055','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('73','1','1374837439','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('74','1','1374837439','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('75','1','1374837480','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('76','1','1374941569','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('77','1','1374942403','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('78','1','1374977132','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('79','1','1374978213','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('80','1','1374978221','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('81','1','1374979757','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('82','2','1374984006','','IANA保留地址');
INSERT INTO jh_login_log VALUES ('83','1','1374984290','','IANA保留地址');

DROP TABLE IF EXISTS jh_login_port;
CREATE TABLE `jh_login_port` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `appkey` varchar(255) NOT NULL,
  `appsecret` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO jh_login_port VALUES ('1','新浪微博','sina','/Public/upload/img/site/4f72796e3138f.png','','','使用新浪微博帐号登录本站<br>更多功能,敬请期待','1');
INSERT INTO jh_login_port VALUES ('2','人人网','renren','/Public/upload/img/site/4f727954cb350.png','','','使用人人网登录本站<br>更多功能，敬请期待','1');
INSERT INTO jh_login_port VALUES ('3','开心网','kaixin','/Public/upload/img/site/4f7279b2bc0c8.png','','','使用开心网帐号登录本站<br>更多功能，敬请期待','0');
INSERT INTO jh_login_port VALUES ('4','淘宝网','taobao','/Public/upload/img/site/4f7279c575b45.png','','','使用淘宝帐号登录本站<br>更多功能，敬请期待','0');
INSERT INTO jh_login_port VALUES ('5','QQ空间','qq','/Public/upload/img/site/4f7279e0a244a.png','','','使用QQ帐号登录本站<br>更多功能，敬请期待','1');
INSERT INTO jh_login_port VALUES ('6','支付宝','alipay','/Public/upload/img/site/4f7279ea371c8.png','','','使用支付宝帐号登录本站<br>更多功能，敬请期待','0');

DROP TABLE IF EXISTS jh_mail_log;
CREATE TABLE `jh_mail_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receive` varchar(255) NOT NULL,
  `sendtime` int(9) NOT NULL,
  `content` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO jh_mail_log VALUES ('1','test1@qq.com','1373258596','					<p></p> <p>test1，您好！</p> <p style=\"color:#99cc00;\"> <span style=\"color:#000000;\">您已经成为中国o2o后台会员，请保留本邮件以备后用。</span><br /><br /><span style=\"color:#000000;\">账户：</span>您的邮箱：test1@qq.com<br /><span style=\"color:#000000;\">密码：</span><span style=\"color:#000000;\">您注册时输入的密码</span> </p> <p style=\"color:#99cc00;\"> <span style=\"color:#000000;\"><br /></span> </p> <p style=\"color:#99cc00;\"> <span style=\"color:#000000;\">中国o2o后台 		<a target=\"_blank\" href=\"http://127.0.0.1\">http://127.0.0.1</a> 	</span> </p>  <p> </p>																','1');
INSERT INTO jh_mail_log VALUES ('2','test2@qq.com','1373429930','					<p></p> <p>test2，您好！</p> <p style=\"color:#99cc00;\"> <span style=\"color:#000000;\">您已经成为中国o2o后台会员，请保留本邮件以备后用。</span><br /><br /><span style=\"color:#000000;\">账户：</span>您的邮箱：test2@qq.com<br /><span style=\"color:#000000;\">密码：</span><span style=\"color:#000000;\">您注册时输入的密码</span> </p> <p style=\"color:#99cc00;\"> <span style=\"color:#000000;\"><br /></span> </p> <p style=\"color:#99cc00;\"> <span style=\"color:#000000;\">中国o2o后台 		<a target=\"_blank\" href=\"http://127.0.0.1\">http://127.0.0.1</a> 	</span> </p>  <p> </p>																','1');
INSERT INTO jh_mail_log VALUES ('3','1037591982@qq.com','1373713126','										您好！&nbsp;&nbsp; &nbsp; <br />&nbsp;&nbsp; &nbsp;你的朋友 test1 邀请您来结婚巴士为他推荐他的商品！<br />&nbsp;&nbsp; &nbsp;结婚巴士 - 结婚巴士-婚纱摄影第一站.www.jiehunbus.com！<br />&nbsp;&nbsp; &nbsp;您可以通过点击以下链接进入结婚巴士，为其推荐商品：<br />&nbsp;&nbsp; &nbsp;<a href=\"http://localhost/index.php/Member/addreferences/uid/1\">http://localhost/index.php/Member/addreferences/uid/1</a>																				','1');

DROP TABLE IF EXISTS jh_member;
CREATE TABLE `jh_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '用户名',
  `mail` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `phone` varchar(255) DEFAULT NULL COMMENT '手机号码 用于手机验证',
  `address` varchar(255) NOT NULL,
  `self_introduction` text NOT NULL,
  `header` int(11) DEFAULT '0' COMMENT '头像             存放 附件关系 查询时 需要联合查询出头像的文件名',
  `sex` tinyint(1) NOT NULL,
  `inviteid` int(11) NOT NULL DEFAULT '0',
  `regip` varchar(20) DEFAULT NULL,
  `regtime` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT '0',
  `mailstatus` tinyint(1) DEFAULT '0' COMMENT '邮箱验证状态  0未验证 1已验证',
  `phonestatus` tinyint(1) DEFAULT '0' COMMENT '手机验证状态  0未验证 1已验证',
  `online` tinyint(1) NOT NULL COMMENT '0隐身离线1在线2忙碌3离开',
  `cash` varchar(255) NOT NULL DEFAULT '0.00',
  `step` tinyint(1) NOT NULL,
  `isbusiness` tinyint(1) NOT NULL DEFAULT '0',
  `aid` int(11) NOT NULL,
  `sina_id` varchar(225) NOT NULL,
  `renren_id` varchar(225) NOT NULL,
  `kaixin_id` varchar(225) NOT NULL,
  `taobao_id` varchar(225) NOT NULL,
  `qq_id` varchar(225) NOT NULL,
  `alipay_id` varchar(225) NOT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '会员状态            0禁用 1启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO jh_member VALUES ('1','test1','test1@qq.com','39c9f23a2557336e6376f62b1ff53653','','江苏天目湖旅游度假区环湖西路1号','','8','0','0','','1373258595','100','1','1','0','0.00','1','1','0','','','','','','','1');
INSERT INTO jh_member VALUES ('2','test2','test2@qq.com','39c9f23a2557336e6376f62b1ff53653','','','','7','0','0','','1373429928','100','1','1','0','0.00','1','0','0','','','','','','','1');

DROP TABLE IF EXISTS jh_member_attachment;
CREATE TABLE `jh_member_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户ID',
  `aid` int(11) DEFAULT NULL COMMENT '附属表ID',
  `val` text COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_member_comment;
CREATE TABLE `jh_member_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `uid` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `content` text,
  `type` tinyint(1) DEFAULT NULL COMMENT '0普通文章 1视频 2图片',
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_member_feed;
CREATE TABLE `jh_member_feed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `content` text,
  `type` varchar(30) NOT NULL,
  `rel_id` int(11) NOT NULL DEFAULT '0',
  `rel_module` varchar(255) NOT NULL,
  `addtime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `rel_id` (`rel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO jh_member_feed VALUES ('1','1','[actor] [text]','avatar','1','Member','1373424575','1');
INSERT INTO jh_member_feed VALUES ('2','1','[actor] [text]','info','1','Member','1373424605','1');
INSERT INTO jh_member_feed VALUES ('3','1','[actor] [text] [touser]','attention','2','Member','1373430421','1');
INSERT INTO jh_member_feed VALUES ('4','2','[actor] [text]','avatar','2','Member','1373526459','1');
INSERT INTO jh_member_feed VALUES ('5','1','[actor] [text]','avatar','1','Member','1373587743','1');
INSERT INTO jh_member_feed VALUES ('6','1','[actor] [text]','info','1','Member','1373713693','1');

DROP TABLE IF EXISTS jh_member_info;
CREATE TABLE `jh_member_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `online` tinyint(1) NOT NULL,
  `index_privacy` tinyint(3) NOT NULL DEFAULT '0',
  `info_privacy` tinyint(3) NOT NULL DEFAULT '0',
  `friend_privacy` tinyint(3) NOT NULL DEFAULT '0',
  `good_privacy` tinyint(3) NOT NULL DEFAULT '0',
  `comment_privacy` tinyint(3) NOT NULL DEFAULT '0',
  `recommend_privacy` tinyint(3) NOT NULL DEFAULT '0',
  `info_isfeed` tinyint(3) NOT NULL DEFAULT '1',
  `avatar_isfeed` tinyint(3) NOT NULL DEFAULT '1',
  `good_isfeed` tinyint(3) NOT NULL DEFAULT '1',
  `friend_isfeed` tinyint(3) NOT NULL DEFAULT '1',
  `attention_isfeed` tinyint(3) NOT NULL DEFAULT '1',
  `order_isfeed` tinyint(3) NOT NULL DEFAULT '1',
  `comment_isfeed` tinyint(3) NOT NULL DEFAULT '1',
  `recommend_isfeed` tinyint(3) NOT NULL DEFAULT '1',
  `commentreply_isfeed` tinyint(3) NOT NULL DEFAULT '1',
  `commented_isfeed` tinyint(3) NOT NULL DEFAULT '1',
  `recommended_isfeed` tinyint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO jh_member_info VALUES ('1','1','0','0','0','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1');
INSERT INTO jh_member_info VALUES ('2','2','0','0','0','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1');

DROP TABLE IF EXISTS jh_member_label;
CREATE TABLE `jh_member_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO jh_member_label VALUES ('1','1','15');
INSERT INTO jh_member_label VALUES ('2','1','19');
INSERT INTO jh_member_label VALUES ('3','1','21');

DROP TABLE IF EXISTS jh_member_location;
CREATE TABLE `jh_member_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '0非默认1默认',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO jh_member_location VALUES ('1','1','苏州园区生物纳米园','31.265311','120.736484','1');

DROP TABLE IF EXISTS jh_message;
CREATE TABLE `jh_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '消息的ID',
  `send` int(11) NOT NULL DEFAULT '0' COMMENT '发送着',
  `receive` int(11) NOT NULL DEFAULT '0' COMMENT '接收者ID',
  `content` text COMMENT '消息内容',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '消息类型            0,普通消息,1通知,',
  `mark` tinyint(1) NOT NULL DEFAULT '0' COMMENT '标记0未读1已读',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '消息添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO jh_message VALUES ('1','2','1','你哈～','0','1','1373430029');
INSERT INTO jh_message VALUES ('2','1','2','你好～～～','0','1','1373430046');
INSERT INTO jh_message VALUES ('3','1','2','你好～','0','0','1373587791');

DROP TABLE IF EXISTS jh_message_tpl;
CREATE TABLE `jh_message_tpl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(225) NOT NULL,
  `content` mediumtext,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO jh_message_tpl VALUES ('1','getpwd','取回密码邮件模板','										<p></p>您好，[user]！<br />   		 <p style=\"color:#99cc00;\"> <span style=\"color:#000000;\">您在[webname]申请了重设密码，请点击下面的链接，然后根据页面提示完成密码重设：</span> 	<br /><br /> 	<span style=\"color:#000000;\">链接:<a target=\"_blank\" href=\"[url]\">[url]</a></span> 	<br /> </p> <p style=\"color:#99cc00;\"> <span style=\"color:#000000;\">[webname] <a target=\"_blank\" href=\"[website]\">[website]</a></span> 	<br />&nbsp; <br /></p> <p></p>												','[user]：会员名  [webname]：网站名称  [website]：网站网址  [url]：重置密码的链接  ');
INSERT INTO jh_message_tpl VALUES ('2','verification','验证邮箱邮件模板','															<p></p><a target=\"_blank\" href=\"mailto:[mail]\">[user]</a>，<span style=\"color:#000000;\">您</span>好！<br /><br /><p style=\"color: rgb(153, 204, 0);\"><span style=\"color:#000000;\">感谢您注册[webname]，您的账号:</span><span style=\"color:#000000;\"><a target=\"_blank\" href=\"mailto:[mail]\">[mail]</a></span></p><p style=\"color: rgb(153, 204, 0);\"><span style=\"color:#000000;\">点击下面的链接即可验证您的电子邮件：<br /></span></p><p style=\"color: rgb(153, 204, 0);\"><a target=\"_blank\" href=\"[url]\">[url]</a></p><p style=\"color: rgb(153, 204, 0);\"><span style=\"color:#000000;\">(如果链接无法点击，请将它拷贝到浏览器的地址栏中。)</span></p><p style=\"color: rgb(153, 204, 0);\"><span style=\"color:#000000;\">[webname] <a target=\"_blank\" href=\"[website]\">[website]</a></span></p><p></p>												','[user]：会员名  [mail]：会员邮箱  [webname]：网站名称  [website]：网站网址  [url]：邮箱验证的链接  ');
INSERT INTO jh_message_tpl VALUES ('3','success','成功注册提示邮件模板','					<p></p> <p>[user]，您好！</p> <p style=\"color:#99cc00;\"> <span style=\"color:#000000;\">您已经成为[webname]会员，请保留本邮件以备后用。</span><br /><br /><span style=\"color:#000000;\">账户：</span>您的邮箱：[mail]<br /><span style=\"color:#000000;\">密码：</span><span style=\"color:#000000;\">您注册时输入的密码</span> </p> <p style=\"color:#99cc00;\"> <span style=\"color:#000000;\"><br /></span> </p> <p style=\"color:#99cc00;\"> <span style=\"color:#000000;\">[webname] 		<a target=\"_blank\" href=\"[website]\">[website]</a> 	</span> </p>  <p> </p>																','[user]：会员名  [mail]：会员邮箱  [webname]：网站名称  [website]：网站网址   ');
INSERT INTO jh_message_tpl VALUES ('4','phone','手机验证验证码发送模板','					您好！感谢你注册[webname],您的验证码为：[code]。								','[webname]：网站名称 [code]：验证码');
INSERT INTO jh_message_tpl VALUES ('5','invitemail','邀请邮件模板','										您好！&nbsp;&nbsp; &nbsp; <br />&nbsp;&nbsp; &nbsp;你的朋友 [user] 邀请您来使用[webname]！<br />&nbsp;&nbsp; &nbsp;[webname] - [webdesc]！<br />&nbsp;&nbsp; &nbsp;现在注册，验证邮箱和手机号码后即可获得[verifycredits][creditsname]。第一次完成订单即可再获得[ordercredits][creditsname]！<br />&nbsp;&nbsp; &nbsp;您可以通过点击以下链接访问[webname]：<br />&nbsp;&nbsp; &nbsp;<a href=\"[url]\">[url]</a>																				','[user]：会员名  [webname]：网站名称  [webdesc]：网站描述  [creditsname]：网站积分名称  [verifycredits]：验证后送积分数  [ordercredits]：完成订单送积分数  [url]：邀请链接  ');
INSERT INTO jh_message_tpl VALUES ('6','shareinvite','分享邀请链接文字模板','我最近在[webname]上淘了很多东西，都是高品质，大折扣。你也来试试吧！','[webname]：  网站名称');
INSERT INTO jh_message_tpl VALUES ('7','referencesemail','请求推荐邮件模板','										您好！&nbsp;&nbsp; &nbsp; <br />&nbsp;&nbsp; &nbsp;你的朋友 [user] 邀请您来[webname]为他推荐他的商品！<br />&nbsp;&nbsp; &nbsp;[webname] - [webdesc]！<br />&nbsp;&nbsp; &nbsp;您可以通过点击以下链接进入[webname]，为其推荐商品：<br />&nbsp;&nbsp; &nbsp;<a href=\"[url]\">[url]</a>																				','[user]：会员名  [webname]：网站名称  [webdesc]：网站描述  [url]：请求推荐链接  ');
INSERT INTO jh_message_tpl VALUES ('8','sharereferences','分享请求推荐链接文字模板','我最近在[webname]发布了很多商品，都是高品质，大折扣。朋友们，快来帮我推荐下吧！								','[webname]：  网站名称');
INSERT INTO jh_message_tpl VALUES ('9','smscoupon','优惠券短信通知模板','您好，感谢您购买“[goodname]”，您的[bondname]序列号为[sn]，密码是[pw]，消费时请出示此短信。','[user]：会员名  [webname]：网站名称  [goodname]：商品名称  [bondname]：优惠券名称  [sn]：序列号  [pw]：密码  [starttime]：优惠券开始  [endtime]：优惠券截止');
INSERT INTO jh_message_tpl VALUES ('10','mailcoupon','优惠券邮件通知模板','您好，感谢您购买“[goodname]”，您的[bondname]序列号为[sn]，密码是[pw]，消费时请出示此短信。','[user]：会员名  [webname]：网站名称  [goodname]：商品名称  [bondname]：优惠券名称  [sn]：序列号  [pw]：密码  [tel]：商家电话  [address]：商家地址  [starttime]：优惠券开始  [endtime]：优惠券截止');
INSERT INTO jh_message_tpl VALUES ('11','paymentmail','付款邮件通知模板','					<p>[user]，您好！</p><p>[webname]通知您，您的订单：[order_sn] 付款 [money] 成功！ <br /></p><p style=\"color:#99cc00;\"> <span style=\"color:#000000;\">[webname] 	<a target=\"_blank\" href=\"[website]\">[website]</a> </span> </p> 							','[user]：会员名  [webname]：网站名称  [website]：网站网址  [order_sn]：订单号  [money]：付款的金额 ');
INSERT INTO jh_message_tpl VALUES ('12','paymentsms','付款短信通知模板','					[webname]通知您，您的订单：[order_sn] 付款 [money] 成功！ <br />								','[user]：会员名  [webname]：网站名称  [order_sn]：订单号  [money]：付款的金额');
INSERT INTO jh_message_tpl VALUES ('13','couponuse_sms','优惠券消费提示短信模板','					<p>你好，[user]。您序列号为[sn]的[bondname]已于[time]消费了。</p><p><br /></p>								','[user]：会员名  [webname]：网站名称  [bondname]：优惠券名称  [sn]：序列号  [time]：使用时间');
INSERT INTO jh_message_tpl VALUES ('14','couponuse_mail','优惠券消费提示邮件模板','										<p>[user]，您好！</p><p>[webname]通知您，您序列号为[sn]的[bondname]已于[time]消费了！ <br /></p><p style=\"color:#99cc00;\"> <span style=\"color:#000000;\">[webname] 	<a target=\"_blank\" href=\"[website]\">[website]</a> </span> </p> 									','[user]：会员名  [webname]：网站名称  [website]：网站网址  [bondname]：优惠券名称  [sn]：序列号  [time]：使用时间');

DROP TABLE IF EXISTS jh_navigation;
CREATE TABLE `jh_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '1 主菜单 2顶部菜单 3底部菜单',
  `url` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `void` varchar(255) DEFAULT NULL,
  `rid` int(11) DEFAULT NULL,
  `isblank` tinyint(1) DEFAULT NULL COMMENT '0不新窗口打开1新窗口打开',
  `isdefault` tinyint(1) DEFAULT NULL COMMENT '0不默认1默认',
  `status` tinyint(1) DEFAULT NULL COMMENT '0禁用 1启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO jh_navigation VALUES ('4','首页','1','__ROOT__/index.php','4','','','0','0','0','1');
INSERT INTO jh_navigation VALUES ('5','全部商品','1','__ROOT__/index.php/Search/index','2','','','0','0','0','1');
INSERT INTO jh_navigation VALUES ('6','附近的','1','__ROOT__/index.php/Nearby/index','1','','','0','0','0','1');
INSERT INTO jh_navigation VALUES ('7','圈子','1','__ROOT__/index.php/Circle/index','0','','','0','0','0','1');
INSERT INTO jh_navigation VALUES ('8','找商家','1','./index.php/Business/index','3','','','0','0','0','0');

DROP TABLE IF EXISTS jh_node;
CREATE TABLE `jh_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned NOT NULL DEFAULT '0',
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `group_id` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=630 DEFAULT CHARSET=utf8;

INSERT INTO jh_node VALUES ('1','Admin','后台管理','1','','0','0','1','0','0');
INSERT INTO jh_node VALUES ('2','Node','节点管理','1','','2','1','2','0','2');
INSERT INTO jh_node VALUES ('6','Role','角色管理','1','','3','1','2','0','2');
INSERT INTO jh_node VALUES ('7','User','后台用户','1','','4','1','2','0','2');
INSERT INTO jh_node VALUES ('40','Index','默认模块','1','','1','1','2','0','0');
INSERT INTO jh_node VALUES ('50','index','默认首页','1','','0','40','3','0','0');
INSERT INTO jh_node VALUES ('84','Group','节点分组','1','','5','1','2','0','6');
INSERT INTO jh_node VALUES ('85','Groups_nav','导航菜单','1','','6','1','2','0','6');
INSERT INTO jh_node VALUES ('87','Backup','数据备份','1','数据库的备份、恢复等操作','0','1','2','0','8');
INSERT INTO jh_node VALUES ('93','Tpl','模板配置','1','','0','1','2','0','7');
INSERT INTO jh_node VALUES ('94','Sysconf_list','系统配置','1','','0','1','2','0','7');
INSERT INTO jh_node VALUES ('95','Sysconf_group','系统设置分组','1','','0','1','2','0','7');
INSERT INTO jh_node VALUES ('96','Sysconf','系统配置列表','1','','0','1','2','0','7');
INSERT INTO jh_node VALUES ('98','Advertising_position','广告位管理','1','','0','1','2','0','10');
INSERT INTO jh_node VALUES ('99','Link','友情链接','1','','0','1','2','0','11');
INSERT INTO jh_node VALUES ('100','Advertising','广告管理','1','','0','1','2','0','10');
INSERT INTO jh_node VALUES ('101','Articles_category','文章分类','1','','0','1','2','0','12');
INSERT INTO jh_node VALUES ('102','Article','文章管理','1','','0','1','2','0','12');
INSERT INTO jh_node VALUES ('103','Member','会员列表','1','','0','1','2','0','13');
INSERT INTO jh_node VALUES ('104','Attachment','会员扩展字段','1','','0','1','2','0','13');
INSERT INTO jh_node VALUES ('105','Message_tpl','消息模板','1','','0','1','2','0','15');
INSERT INTO jh_node VALUES ('106','Goods_category','商品分类','1','','0','1','2','0','16');
INSERT INTO jh_node VALUES ('107','Region','地区分类','1','','0','1','2','0','15');
INSERT INTO jh_node VALUES ('108','Goods','商品管理','1','','0','1','2','0','17');
INSERT INTO jh_node VALUES ('109','Expand','商品扩展字段','1','','0','1','2','0','17');
INSERT INTO jh_node VALUES ('110','Evaluate_items','评价项','1','','0','1','2','0','16');
INSERT INTO jh_node VALUES ('111','Evaluate','评分日志','1','','0','1','2','0','18');
INSERT INTO jh_node VALUES ('112','Comment','评论日志','1','','0','1','2','0','18');
INSERT INTO jh_node VALUES ('113','Coupon','消费凭证','1','','0','1','2','0','18');
INSERT INTO jh_node VALUES ('114','Order','订单列表','1','','0','1','2','0','18');
INSERT INTO jh_node VALUES ('115','Payment','支付方式','1','','0','1','2','0','15');
INSERT INTO jh_node VALUES ('116','Navigation','导航管理','1','','0','1','2','0','19');
INSERT INTO jh_node VALUES ('117','Level','等级列表','1','','0','1','2','0','14');
INSERT INTO jh_node VALUES ('118','Login_log','登录日志','1','','0','1','2','0','20');
INSERT INTO jh_node VALUES ('119','Value_log','积分日志','1','','0','1','2','0','20');
INSERT INTO jh_node VALUES ('121','Message','会员消息','1','','0','1','2','0','21');
INSERT INTO jh_node VALUES ('122','Friends','好友关系','1','','0','1','2','0','21');
INSERT INTO jh_node VALUES ('123','Friends_group','好友分组','1','','0','1','2','0','21');
INSERT INTO jh_node VALUES ('124','Chat_log','聊天日志','1','','0','1','2','0','20');
INSERT INTO jh_node VALUES ('125','Collection','会员收藏','1','','0','1','2','0','21');
INSERT INTO jh_node VALUES ('126','Attention','会员关注','1','','0','1','2','0','21');
INSERT INTO jh_node VALUES ('127','Remind','会员提醒','1','','0','1','2','0','21');
INSERT INTO jh_node VALUES ('128','Complaint_item','投诉项','1','','0','1','2','0','15');
INSERT INTO jh_node VALUES ('129','Complaint','投诉举报','1','','0','1','2','0','15');
INSERT INTO jh_node VALUES ('130','Recommend','推荐日志','1','','0','1','2','0','18');
INSERT INTO jh_node VALUES ('131','Comment_reply','评论回复','1','','0','1','2','0','18');
INSERT INTO jh_node VALUES ('132','Member_comment','会员评价','1','','0','1','2','0','21');
INSERT INTO jh_node VALUES ('133','Login_port','登录接口','1','','0','1','2','0','15');
INSERT INTO jh_node VALUES ('134','Cash_log','现金日志','1','','0','1','2','0','20');
INSERT INTO jh_node VALUES ('135','Account','账户管理','1','','0','1','2','0','13');
INSERT INTO jh_node VALUES ('136','Withdraw','提现记录','1','','0','1','2','0','20');
INSERT INTO jh_node VALUES ('137','Recharge','充值记录','1','','0','1','2','0','20');
INSERT INTO jh_node VALUES ('138','Order_details','订单详情','1','','0','1','2','0','18');
INSERT INTO jh_node VALUES ('139','Prepaid_card','充值卡','1','','0','1','2','0','15');
INSERT INTO jh_node VALUES ('140','Release','发布商品','1','','0','1','2','0','15');
INSERT INTO jh_node VALUES ('142','index','列表','1','','0','94','3','0','0');
INSERT INTO jh_node VALUES ('143','save','保存','1','','0','94','3','0','0');
INSERT INTO jh_node VALUES ('146','index','列表','1','','0','95','3','0','0');
INSERT INTO jh_node VALUES ('147','resume','恢复','1','','0','95','3','0','0');
INSERT INTO jh_node VALUES ('148','forbid','禁用','1','','0','95','3','0','0');
INSERT INTO jh_node VALUES ('149','foreverdelete','删除','1','','0','95','3','0','0');
INSERT INTO jh_node VALUES ('150','update','更新','1','','0','95','3','0','0');
INSERT INTO jh_node VALUES ('151','edit','编辑','1','','0','95','3','0','0');
INSERT INTO jh_node VALUES ('152','insert','写入','1','','0','95','3','0','0');
INSERT INTO jh_node VALUES ('153','add','新增','1','','0','95','3','0','0');
INSERT INTO jh_node VALUES ('154','index','列表','1','','0','96','3','0','0');
INSERT INTO jh_node VALUES ('155','resume','恢复','1','','0','96','3','0','0');
INSERT INTO jh_node VALUES ('156','forbid','禁用','1','','0','96','3','0','0');
INSERT INTO jh_node VALUES ('157','foreverdelete','删除','1','','0','96','3','0','0');
INSERT INTO jh_node VALUES ('158','update','更新','1','','0','96','3','0','0');
INSERT INTO jh_node VALUES ('159','edit','编辑','1','','0','96','3','0','0');
INSERT INTO jh_node VALUES ('160','insert','写入','1','','0','96','3','0','0');
INSERT INTO jh_node VALUES ('161','add','新增','1','','0','96','3','0','0');
INSERT INTO jh_node VALUES ('162','index','列表','1','','0','87','3','0','0');
INSERT INTO jh_node VALUES ('163','delete','删除','1','','0','87','3','0','0');
INSERT INTO jh_node VALUES ('164','backup','备份','1','','0','87','3','0','0');
INSERT INTO jh_node VALUES ('165','doBackUp','执行备份','1','','0','87','3','0','0');
INSERT INTO jh_node VALUES ('166','import','导入','1','','0','87','3','0','0');
INSERT INTO jh_node VALUES ('167','package','打包','1','','0','87','3','0','0');
INSERT INTO jh_node VALUES ('168','index','列表','1','','0','93','3','0','0');
INSERT INTO jh_node VALUES ('169','save','保存','1','','0','93','3','0','0');
INSERT INTO jh_node VALUES ('170','index','列表','1','','0','105','3','0','0');
INSERT INTO jh_node VALUES ('171','foreverdelete','删除','1','','0','105','3','0','0');
INSERT INTO jh_node VALUES ('172','update','更新','1','','0','105','3','0','0');
INSERT INTO jh_node VALUES ('173','edit','编辑','1','','0','105','3','0','0');
INSERT INTO jh_node VALUES ('174','insert','写入','1','','0','105','3','0','0');
INSERT INTO jh_node VALUES ('175','add','新增','1','','0','105','3','0','0');
INSERT INTO jh_node VALUES ('176','index','列表','1','','0','107','3','0','0');
INSERT INTO jh_node VALUES ('177','foreverdelete','删除','1','','0','107','3','0','0');
INSERT INTO jh_node VALUES ('178','update','更新','1','','0','107','3','0','0');
INSERT INTO jh_node VALUES ('179','edit','编辑','1','','0','107','3','0','0');
INSERT INTO jh_node VALUES ('180','insert','写入','1','','0','107','3','0','0');
INSERT INTO jh_node VALUES ('181','add','新增','1','','0','107','3','0','0');
INSERT INTO jh_node VALUES ('183','index','列表','1','','0','115','3','0','0');
INSERT INTO jh_node VALUES ('184','resume','恢复','1','','0','115','3','0','0');
INSERT INTO jh_node VALUES ('185','forbid','禁用','1','','0','115','3','0','0');
INSERT INTO jh_node VALUES ('186','foreverdelete','删除','1','','0','115','3','0','0');
INSERT INTO jh_node VALUES ('187','update','更新','1','','0','115','3','0','0');
INSERT INTO jh_node VALUES ('188','edit','编辑','1','','0','115','3','0','0');
INSERT INTO jh_node VALUES ('189','insert','写入','1','','0','115','3','0','0');
INSERT INTO jh_node VALUES ('190','add','新增','1','','0','115','3','0','0');
INSERT INTO jh_node VALUES ('191','index','列表','1','','0','128','3','0','0');
INSERT INTO jh_node VALUES ('192','foreverdelete','删除','1','','0','128','3','0','0');
INSERT INTO jh_node VALUES ('193','update','更新','1','','0','128','3','0','0');
INSERT INTO jh_node VALUES ('194','edit','编辑','1','','0','128','3','0','0');
INSERT INTO jh_node VALUES ('195','insert','写入','1','','0','128','3','0','0');
INSERT INTO jh_node VALUES ('196','add','新增','1','','0','128','3','0','0');
INSERT INTO jh_node VALUES ('197','index','列表','1','','0','129','3','0','0');
INSERT INTO jh_node VALUES ('198','foreverdelete','删除','1','','0','129','3','0','0');
INSERT INTO jh_node VALUES ('199','update','更新','1','','0','129','3','0','0');
INSERT INTO jh_node VALUES ('200','edit','编辑','1','','0','129','3','0','0');
INSERT INTO jh_node VALUES ('201','insert','写入','1','','0','129','3','0','0');
INSERT INTO jh_node VALUES ('202','add','新增','1','','0','129','3','0','0');
INSERT INTO jh_node VALUES ('204','index','列表','1','','0','133','3','0','0');
INSERT INTO jh_node VALUES ('205','resume','恢复','1','','0','133','3','0','0');
INSERT INTO jh_node VALUES ('206','forbid','禁用','1','','0','133','3','0','0');
INSERT INTO jh_node VALUES ('207','foreverdelete','删除','1','','0','133','3','0','0');
INSERT INTO jh_node VALUES ('208','update','更新','1','','0','133','3','0','0');
INSERT INTO jh_node VALUES ('209','edit','编辑','1','','0','133','3','0','0');
INSERT INTO jh_node VALUES ('210','insert','写入','1','','0','133','3','0','0');
INSERT INTO jh_node VALUES ('211','add','新增','1','','0','133','3','0','0');
INSERT INTO jh_node VALUES ('212','index','列表','1','','0','139','3','0','0');
INSERT INTO jh_node VALUES ('213','foreverdelete','删除','1','','0','139','3','0','0');
INSERT INTO jh_node VALUES ('214','update','更新','1','','0','139','3','0','0');
INSERT INTO jh_node VALUES ('215','edit','编辑','1','','0','139','3','0','0');
INSERT INTO jh_node VALUES ('216','insert','写入','1','','0','139','3','0','0');
INSERT INTO jh_node VALUES ('217','down','导出EXCEL','1','','0','139','3','0','0');
INSERT INTO jh_node VALUES ('218','add','新增','1','','0','139','3','0','0');
INSERT INTO jh_node VALUES ('219','index','列表','1','','0','140','3','0','0');
INSERT INTO jh_node VALUES ('220','foreverdelete','删除','1','','0','140','3','0','0');
INSERT INTO jh_node VALUES ('221','update','更新','1','','0','140','3','0','0');
INSERT INTO jh_node VALUES ('222','edit','编辑','1','','0','140','3','0','0');
INSERT INTO jh_node VALUES ('223','insert','写入','1','','0','140','3','0','0');
INSERT INTO jh_node VALUES ('224','down','导出EXCEL','1','','0','140','3','0','0');
INSERT INTO jh_node VALUES ('225','add','新增','1','','0','140','3','0','0');
INSERT INTO jh_node VALUES ('227','index','列表','1','','0','7','3','0','0');
INSERT INTO jh_node VALUES ('228','resume','恢复','1','','0','7','3','0','0');
INSERT INTO jh_node VALUES ('229','forbid','禁用','1','','0','7','3','0','0');
INSERT INTO jh_node VALUES ('230','foreverdelete','删除','1','','0','7','3','0','0');
INSERT INTO jh_node VALUES ('231','update','更新','1','','0','7','3','0','0');
INSERT INTO jh_node VALUES ('232','edit','编辑','1','','0','7','3','0','0');
INSERT INTO jh_node VALUES ('233','insert','写入','1','','0','7','3','0','0');
INSERT INTO jh_node VALUES ('234','password','修改密码','1','','0','7','3','0','0');
INSERT INTO jh_node VALUES ('235','resetPwd','重置密码','1','','0','7','3','0','0');
INSERT INTO jh_node VALUES ('236','add','新增','1','','0','7','3','0','0');
INSERT INTO jh_node VALUES ('237','index','列表','1','','0','6','3','0','0');
INSERT INTO jh_node VALUES ('238','resume','恢复','1','','0','6','3','0','0');
INSERT INTO jh_node VALUES ('239','forbid','禁用','1','','0','6','3','0','0');
INSERT INTO jh_node VALUES ('240','foreverdelete','删除','1','','0','6','3','0','0');
INSERT INTO jh_node VALUES ('241','update','更新','1','','0','6','3','0','0');
INSERT INTO jh_node VALUES ('242','edit','编辑','1','','0','6','3','0','0');
INSERT INTO jh_node VALUES ('243','insert','写入','1','','0','6','3','0','0');
INSERT INTO jh_node VALUES ('244','app','授权','1','','0','6','3','0','0');
INSERT INTO jh_node VALUES ('245','module','模块授权','1','','0','6','3','0','0');
INSERT INTO jh_node VALUES ('246','action','操作授权','1','','0','6','3','0','0');
INSERT INTO jh_node VALUES ('247','setApp','保存授权','1','','0','6','3','0','0');
INSERT INTO jh_node VALUES ('248','user','用户列表','1','','0','6','3','0','0');
INSERT INTO jh_node VALUES ('249','setUser','保存列表','1','','0','6','3','0','0');
INSERT INTO jh_node VALUES ('250','add','新增','1','','0','6','3','0','0');
INSERT INTO jh_node VALUES ('251','index','列表','1','','0','2','3','0','0');
INSERT INTO jh_node VALUES ('252','resume','恢复','1','','0','2','3','0','0');
INSERT INTO jh_node VALUES ('253','forbid','禁用','1','','0','2','3','0','0');
INSERT INTO jh_node VALUES ('254','foreverdelete','删除','1','','0','2','3','0','0');
INSERT INTO jh_node VALUES ('255','update','更新','1','','0','2','3','0','0');
INSERT INTO jh_node VALUES ('256','edit','编辑','1','','0','2','3','0','0');
INSERT INTO jh_node VALUES ('257','insert','写入','1','','0','2','3','0','0');
INSERT INTO jh_node VALUES ('258','add','新增','1','','0','2','3','0','0');
INSERT INTO jh_node VALUES ('259','index','列表','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('260','resume','恢复','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('261','forbid','禁用','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('262','foreverdelete','删除','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('263','update','更新','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('264','edit','编辑','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('265','insert','写入','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('266','add','新增','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('267','index','列表','1','','0','84','3','0','0');
INSERT INTO jh_node VALUES ('268','resume','恢复','1','','0','84','3','0','0');
INSERT INTO jh_node VALUES ('269','forbid','禁用','1','','0','84','3','0','0');
INSERT INTO jh_node VALUES ('270','foreverdelete','删除','1','','0','84','3','0','0');
INSERT INTO jh_node VALUES ('271','update','更新','1','','0','84','3','0','0');
INSERT INTO jh_node VALUES ('272','edit','编辑','1','','0','84','3','0','0');
INSERT INTO jh_node VALUES ('273','insert','写入','1','','0','84','3','0','0');
INSERT INTO jh_node VALUES ('274','add','新增','1','','0','84','3','0','0');
INSERT INTO jh_node VALUES ('275','index','列表','1','','0','101','3','0','0');
INSERT INTO jh_node VALUES ('276','foreverdelete','删除','1','','0','101','3','0','0');
INSERT INTO jh_node VALUES ('277','update','更新','1','','0','101','3','0','0');
INSERT INTO jh_node VALUES ('278','edit','编辑','1','','0','101','3','0','0');
INSERT INTO jh_node VALUES ('279','insert','写入','1','','0','101','3','0','0');
INSERT INTO jh_node VALUES ('281','add','新增','1','','0','101','3','0','0');
INSERT INTO jh_node VALUES ('282','index','列表','1','','0','102','3','0','0');
INSERT INTO jh_node VALUES ('283','resume','恢复','1','','0','102','3','0','0');
INSERT INTO jh_node VALUES ('284','forbid','禁用','1','','0','102','3','0','0');
INSERT INTO jh_node VALUES ('285','foreverdelete','删除','1','','0','102','3','0','0');
INSERT INTO jh_node VALUES ('286','update','更新','1','','0','102','3','0','0');
INSERT INTO jh_node VALUES ('287','edit','编辑','1','','0','102','3','0','0');
INSERT INTO jh_node VALUES ('288','insert','写入','1','','0','102','3','0','0');
INSERT INTO jh_node VALUES ('289','add','新增','1','','0','102','3','0','0');
INSERT INTO jh_node VALUES ('290','index','列表','1','','0','98','3','0','0');
INSERT INTO jh_node VALUES ('291','foreverdelete','删除','1','','0','98','3','0','0');
INSERT INTO jh_node VALUES ('292','update','更新','1','','0','98','3','0','0');
INSERT INTO jh_node VALUES ('293','edit','编辑','1','','0','98','3','0','0');
INSERT INTO jh_node VALUES ('294','insert','写入','1','','0','98','3','0','0');
INSERT INTO jh_node VALUES ('295','add','新增','1','','0','98','3','0','0');
INSERT INTO jh_node VALUES ('296','index','列表','1','','0','100','3','0','0');
INSERT INTO jh_node VALUES ('297','resume','恢复','1','','0','100','3','0','0');
INSERT INTO jh_node VALUES ('298','forbid','禁用','1','','0','100','3','0','0');
INSERT INTO jh_node VALUES ('299','foreverdelete','删除','1','','0','100','3','0','0');
INSERT INTO jh_node VALUES ('300','update','更新','1','','0','100','3','0','0');
INSERT INTO jh_node VALUES ('301','edit','编辑','1','','0','100','3','0','0');
INSERT INTO jh_node VALUES ('302','insert','写入','1','','0','100','3','0','0');
INSERT INTO jh_node VALUES ('303','add','新增','1','','0','100','3','0','0');
INSERT INTO jh_node VALUES ('304','index','列表','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('305','resume','恢复','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('306','forbid','禁用','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('307','foreverdelete','删除','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('308','update','更新','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('309','edit','编辑','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('310','insert','写入','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('311','add','新增','1','','0','116','3','0','0');
INSERT INTO jh_node VALUES ('312','index','列表','1','','0','99','3','0','0');
INSERT INTO jh_node VALUES ('313','resume','恢复','1','','0','99','3','0','0');
INSERT INTO jh_node VALUES ('314','forbid','禁用','1','','0','99','3','0','0');
INSERT INTO jh_node VALUES ('315','foreverdelete','删除','1','','0','99','3','0','0');
INSERT INTO jh_node VALUES ('316','update','更新','1','','0','99','3','0','0');
INSERT INTO jh_node VALUES ('317','edit','编辑','1','','0','99','3','0','0');
INSERT INTO jh_node VALUES ('318','insert','写入','1','','0','99','3','0','0');
INSERT INTO jh_node VALUES ('319','add','新增','1','','0','99','3','0','0');
INSERT INTO jh_node VALUES ('320','index','列表','1','','0','108','3','0','0');
INSERT INTO jh_node VALUES ('321','resume','恢复','1','','0','108','3','0','0');
INSERT INTO jh_node VALUES ('322','forbid','禁用','1','','0','108','3','0','0');
INSERT INTO jh_node VALUES ('323','foreverdelete','删除','1','','0','108','3','0','0');
INSERT INTO jh_node VALUES ('324','update','更新','1','','0','108','3','0','0');
INSERT INTO jh_node VALUES ('325','edit','编辑','1','','0','108','3','0','0');
INSERT INTO jh_node VALUES ('326','insert','写入','1','','0','108','3','0','0');
INSERT INTO jh_node VALUES ('327','add','新增','1','','0','108','3','0','0');
INSERT INTO jh_node VALUES ('328','index','列表','1','','0','109','3','0','0');
INSERT INTO jh_node VALUES ('329','foreverdelete','删除','1','','0','109','3','0','0');
INSERT INTO jh_node VALUES ('330','update','更新','1','','0','109','3','0','0');
INSERT INTO jh_node VALUES ('331','edit','编辑','1','','0','109','3','0','0');
INSERT INTO jh_node VALUES ('332','insert','写入','1','','0','109','3','0','0');
INSERT INTO jh_node VALUES ('333','add','新增','1','','0','109','3','0','0');
INSERT INTO jh_node VALUES ('334','index','列表','1','','0','106','3','0','0');
INSERT INTO jh_node VALUES ('335','foreverdelete','删除','1','','0','106','3','0','0');
INSERT INTO jh_node VALUES ('336','update','更新','1','','0','106','3','0','0');
INSERT INTO jh_node VALUES ('337','edit','编辑','1','','0','106','3','0','0');
INSERT INTO jh_node VALUES ('338','insert','写入','1','','0','106','3','0','0');
INSERT INTO jh_node VALUES ('339','add','新增','1','','0','106','3','0','0');
INSERT INTO jh_node VALUES ('340','index','列表','1','','0','110','3','0','0');
INSERT INTO jh_node VALUES ('341','foreverdelete','删除','1','','0','110','3','0','0');
INSERT INTO jh_node VALUES ('342','update','更新','1','','0','110','3','0','0');
INSERT INTO jh_node VALUES ('343','edit','编辑','1','','0','110','3','0','0');
INSERT INTO jh_node VALUES ('344','insert','写入','1','','0','110','3','0','0');
INSERT INTO jh_node VALUES ('345','add','新增','1','','0','110','3','0','0');
INSERT INTO jh_node VALUES ('346','index','列表','1','','0','111','3','0','0');
INSERT INTO jh_node VALUES ('347','foreverdelete','删除','1','','0','111','3','0','0');
INSERT INTO jh_node VALUES ('348','update','更新','1','','0','111','3','0','0');
INSERT INTO jh_node VALUES ('349','edit','编辑','1','','0','111','3','0','0');
INSERT INTO jh_node VALUES ('350','insert','写入','1','','0','111','3','0','0');
INSERT INTO jh_node VALUES ('351','down','导出EXCEL','1','','0','111','3','0','0');
INSERT INTO jh_node VALUES ('352','add','新增','1','','0','111','3','0','0');
INSERT INTO jh_node VALUES ('353','index','列表','1','','0','112','3','0','0');
INSERT INTO jh_node VALUES ('354','foreverdelete','删除','1','','0','112','3','0','0');
INSERT INTO jh_node VALUES ('355','update','更新','1','','0','112','3','0','0');
INSERT INTO jh_node VALUES ('356','edit','编辑','1','','0','112','3','0','0');
INSERT INTO jh_node VALUES ('357','insert','写入','1','','0','112','3','0','0');
INSERT INTO jh_node VALUES ('358','down','导出EXCEL','1','','0','112','3','0','0');
INSERT INTO jh_node VALUES ('359','add','新增','1','','0','112','3','0','0');
INSERT INTO jh_node VALUES ('360','index','列表','1','','0','113','3','0','0');
INSERT INTO jh_node VALUES ('361','foreverdelete','删除','1','','0','113','3','0','0');
INSERT INTO jh_node VALUES ('362','update','更新','1','','0','113','3','0','0');
INSERT INTO jh_node VALUES ('363','edit','编辑','1','','0','113','3','0','0');
INSERT INTO jh_node VALUES ('364','insert','写入','1','','0','113','3','0','0');
INSERT INTO jh_node VALUES ('365','down','导出EXCEL','1','','0','113','3','0','0');
INSERT INTO jh_node VALUES ('366','add','新增','1','','0','113','3','0','0');
INSERT INTO jh_node VALUES ('367','index','列表','1','','0','114','3','0','0');
INSERT INTO jh_node VALUES ('368','foreverdelete','删除','1','','0','114','3','0','0');
INSERT INTO jh_node VALUES ('369','update','更新','1','','0','114','3','0','0');
INSERT INTO jh_node VALUES ('370','edit','编辑','1','','0','114','3','0','0');
INSERT INTO jh_node VALUES ('371','insert','写入','1','','0','114','3','0','0');
INSERT INTO jh_node VALUES ('372','down','导出EXCEL','1','','0','114','3','0','0');
INSERT INTO jh_node VALUES ('373','add','新增','1','','0','114','3','0','0');
INSERT INTO jh_node VALUES ('374','index','列表','1','','0','130','3','0','0');
INSERT INTO jh_node VALUES ('375','foreverdelete','删除','1','','0','130','3','0','0');
INSERT INTO jh_node VALUES ('376','update','更新','1','','0','130','3','0','0');
INSERT INTO jh_node VALUES ('377','edit','编辑','1','','0','130','3','0','0');
INSERT INTO jh_node VALUES ('378','insert','写入','1','','0','130','3','0','0');
INSERT INTO jh_node VALUES ('379','down','导出EXCEL','1','','0','130','3','0','0');
INSERT INTO jh_node VALUES ('380','add','新增','1','','0','130','3','0','0');
INSERT INTO jh_node VALUES ('381','index','列表','1','','0','131','3','0','0');
INSERT INTO jh_node VALUES ('382','foreverdelete','删除','1','','0','131','3','0','0');
INSERT INTO jh_node VALUES ('383','update','更新','1','','0','131','3','0','0');
INSERT INTO jh_node VALUES ('384','edit','编辑','1','','0','131','3','0','0');
INSERT INTO jh_node VALUES ('385','insert','写入','1','','0','131','3','0','0');
INSERT INTO jh_node VALUES ('386','down','导出EXCEL','1','','0','131','3','0','0');
INSERT INTO jh_node VALUES ('387','add','新增','1','','0','131','3','0','0');
INSERT INTO jh_node VALUES ('388','index','列表','1','','0','138','3','0','0');
INSERT INTO jh_node VALUES ('389','foreverdelete','删除','1','','0','138','3','0','0');
INSERT INTO jh_node VALUES ('390','update','更新','1','','0','138','3','0','0');
INSERT INTO jh_node VALUES ('391','edit','编辑','1','','0','138','3','0','0');
INSERT INTO jh_node VALUES ('392','insert','写入','1','','0','138','3','0','0');
INSERT INTO jh_node VALUES ('393','down','导出EXCEL','1','','0','138','3','0','0');
INSERT INTO jh_node VALUES ('394','add','新增','1','','0','138','3','0','0');
INSERT INTO jh_node VALUES ('395','index','列表','1','','0','103','3','0','0');
INSERT INTO jh_node VALUES ('396','resume','恢复','1','','0','103','3','0','0');
INSERT INTO jh_node VALUES ('397','forbid','禁用','1','','0','103','3','0','0');
INSERT INTO jh_node VALUES ('398','foreverdelete','删除','1','','0','103','3','0','0');
INSERT INTO jh_node VALUES ('399','update','更新','1','','0','103','3','0','0');
INSERT INTO jh_node VALUES ('400','edit','编辑','1','','0','103','3','0','0');
INSERT INTO jh_node VALUES ('401','insert','写入','1','','0','103','3','0','0');
INSERT INTO jh_node VALUES ('402','add','新增','1','','0','103','3','0','0');
INSERT INTO jh_node VALUES ('403','index','列表','1','','0','104','3','0','0');
INSERT INTO jh_node VALUES ('404','foreverdelete','删除','1','','0','104','3','0','0');
INSERT INTO jh_node VALUES ('405','update','更新','1','','0','104','3','0','0');
INSERT INTO jh_node VALUES ('406','edit','编辑','1','','0','104','3','0','0');
INSERT INTO jh_node VALUES ('407','insert','写入','1','','0','104','3','0','0');
INSERT INTO jh_node VALUES ('408','add','新增','1','','0','104','3','0','0');
INSERT INTO jh_node VALUES ('409','index','列表','1','','0','135','3','0','0');
INSERT INTO jh_node VALUES ('410','update','更新','1','','0','135','3','0','0');
INSERT INTO jh_node VALUES ('411','edit','编辑','1','','0','135','3','0','0');
INSERT INTO jh_node VALUES ('412','index','列表','1','','0','117','3','0','0');
INSERT INTO jh_node VALUES ('413','resume','恢复','1','','0','117','3','0','0');
INSERT INTO jh_node VALUES ('414','forbid','禁用','1','','0','117','3','0','0');
INSERT INTO jh_node VALUES ('415','foreverdelete','删除','1','','0','117','3','0','0');
INSERT INTO jh_node VALUES ('416','update','更新','1','','0','117','3','0','0');
INSERT INTO jh_node VALUES ('417','edit','编辑','1','','0','117','3','0','0');
INSERT INTO jh_node VALUES ('418','insert','写入','1','','0','117','3','0','0');
INSERT INTO jh_node VALUES ('419','add','新增','1','','0','117','3','0','0');
INSERT INTO jh_node VALUES ('420','index','列表','1','','0','121','3','0','0');
INSERT INTO jh_node VALUES ('421','foreverdelete','删除','1','','0','121','3','0','0');
INSERT INTO jh_node VALUES ('422','update','更新','1','','0','121','3','0','0');
INSERT INTO jh_node VALUES ('423','edit','编辑','1','','0','121','3','0','0');
INSERT INTO jh_node VALUES ('424','insert','写入','1','','0','121','3','0','0');
INSERT INTO jh_node VALUES ('425','down','导出EXCEL','1','','0','121','3','0','0');
INSERT INTO jh_node VALUES ('426','add','新增','1','','0','121','3','0','0');
INSERT INTO jh_node VALUES ('427','index','列表','1','','0','122','3','0','0');
INSERT INTO jh_node VALUES ('428','foreverdelete','删除','1','','0','122','3','0','0');
INSERT INTO jh_node VALUES ('429','update','更新','1','','0','122','3','0','0');
INSERT INTO jh_node VALUES ('430','edit','编辑','1','','0','122','3','0','0');
INSERT INTO jh_node VALUES ('431','insert','写入','1','','0','122','3','0','0');
INSERT INTO jh_node VALUES ('432','down','导出EXCEL','1','','0','122','3','0','0');
INSERT INTO jh_node VALUES ('433','add','新增','1','','0','122','3','0','0');
INSERT INTO jh_node VALUES ('434','index','列表','1','','0','123','3','0','0');
INSERT INTO jh_node VALUES ('435','foreverdelete','删除','1','','0','123','3','0','0');
INSERT INTO jh_node VALUES ('436','update','更新','1','','0','123','3','0','0');
INSERT INTO jh_node VALUES ('437','edit','编辑','1','','0','123','3','0','0');
INSERT INTO jh_node VALUES ('438','insert','写入','1','','0','123','3','0','0');
INSERT INTO jh_node VALUES ('439','add','新增','1','','0','123','3','0','0');
INSERT INTO jh_node VALUES ('440','index','列表','1','','0','125','3','0','0');
INSERT INTO jh_node VALUES ('441','foreverdelete','删除','1','','0','125','3','0','0');
INSERT INTO jh_node VALUES ('442','update','更新','1','','0','125','3','0','0');
INSERT INTO jh_node VALUES ('443','edit','编辑','1','','0','125','3','0','0');
INSERT INTO jh_node VALUES ('444','insert','写入','1','','0','125','3','0','0');
INSERT INTO jh_node VALUES ('445','down','导出EXCEL','1','','0','125','3','0','0');
INSERT INTO jh_node VALUES ('446','add','新增','1','','0','125','3','0','0');
INSERT INTO jh_node VALUES ('447','index','列表','1','','0','126','3','0','0');
INSERT INTO jh_node VALUES ('448','foreverdelete','删除','1','','0','126','3','0','0');
INSERT INTO jh_node VALUES ('449','update','更新','1','','0','126','3','0','0');
INSERT INTO jh_node VALUES ('450','edit','编辑','1','','0','126','3','0','0');
INSERT INTO jh_node VALUES ('451','insert','写入','1','','0','126','3','0','0');
INSERT INTO jh_node VALUES ('452','down','导出EXCEL','1','','0','126','3','0','0');
INSERT INTO jh_node VALUES ('453','add','新增','1','','0','126','3','0','0');
INSERT INTO jh_node VALUES ('454','index','列表','1','','0','127','3','0','0');
INSERT INTO jh_node VALUES ('455','foreverdelete','删除','1','','0','127','3','0','0');
INSERT INTO jh_node VALUES ('456','update','更新','1','','0','127','3','0','0');
INSERT INTO jh_node VALUES ('457','edit','编辑','1','','0','127','3','0','0');
INSERT INTO jh_node VALUES ('458','insert','写入','1','','0','127','3','0','0');
INSERT INTO jh_node VALUES ('459','down','导出EXCEL','1','','0','127','3','0','0');
INSERT INTO jh_node VALUES ('460','add','新增','1','','0','127','3','0','0');
INSERT INTO jh_node VALUES ('461','index','列表','1','','0','132','3','0','0');
INSERT INTO jh_node VALUES ('462','foreverdelete','删除','1','','0','132','3','0','0');
INSERT INTO jh_node VALUES ('463','update','更新','1','','0','132','3','0','0');
INSERT INTO jh_node VALUES ('464','edit','编辑','1','','0','132','3','0','0');
INSERT INTO jh_node VALUES ('465','insert','写入','1','','0','132','3','0','0');
INSERT INTO jh_node VALUES ('466','down','导出EXCEL','1','','0','132','3','0','0');
INSERT INTO jh_node VALUES ('467','add','新增','1','','0','132','3','0','0');
INSERT INTO jh_node VALUES ('468','index','列表','1','','0','118','3','0','0');
INSERT INTO jh_node VALUES ('469','foreverdelete','删除','1','','0','118','3','0','0');
INSERT INTO jh_node VALUES ('470','update','更新','1','','0','118','3','0','0');
INSERT INTO jh_node VALUES ('471','edit','编辑','1','','0','118','3','0','0');
INSERT INTO jh_node VALUES ('472','insert','写入','1','','0','118','3','0','0');
INSERT INTO jh_node VALUES ('473','down','导出EXCEL','1','','0','118','3','0','0');
INSERT INTO jh_node VALUES ('474','add','新增','1','','0','118','3','0','0');
INSERT INTO jh_node VALUES ('475','index','列表','1','','0','119','3','0','0');
INSERT INTO jh_node VALUES ('476','foreverdelete','删除','1','','0','119','3','0','0');
INSERT INTO jh_node VALUES ('477','update','更新','1','','0','119','3','0','0');
INSERT INTO jh_node VALUES ('478','edit','编辑','1','','0','119','3','0','0');
INSERT INTO jh_node VALUES ('479','insert','写入','1','','0','119','3','0','0');
INSERT INTO jh_node VALUES ('480','down','导出EXCEL','1','','0','119','3','0','0');
INSERT INTO jh_node VALUES ('481','add','新增','1','','0','119','3','0','0');
INSERT INTO jh_node VALUES ('482','index','列表','1','','0','124','3','0','0');
INSERT INTO jh_node VALUES ('483','foreverdelete','删除','1','','0','124','3','0','0');
INSERT INTO jh_node VALUES ('484','update','更新','1','','0','124','3','0','0');
INSERT INTO jh_node VALUES ('485','edit','编辑','1','','0','124','3','0','0');
INSERT INTO jh_node VALUES ('486','insert','写入','1','','0','124','3','0','0');
INSERT INTO jh_node VALUES ('487','down','导出EXCEL','1','','0','124','3','0','0');
INSERT INTO jh_node VALUES ('488','add','新增','1','','0','124','3','0','0');
INSERT INTO jh_node VALUES ('489','index','列表','1','','0','134','3','0','0');
INSERT INTO jh_node VALUES ('490','foreverdelete','删除','1','','0','134','3','0','0');
INSERT INTO jh_node VALUES ('491','update','更新','1','','0','134','3','0','0');
INSERT INTO jh_node VALUES ('492','edit','编辑','1','','0','134','3','0','0');
INSERT INTO jh_node VALUES ('493','insert','写入','1','','0','134','3','0','0');
INSERT INTO jh_node VALUES ('494','down','导出EXCEL','1','','0','134','3','0','0');
INSERT INTO jh_node VALUES ('495','add','新增','1','','0','134','3','0','0');
INSERT INTO jh_node VALUES ('496','index','列表','1','','0','136','3','0','0');
INSERT INTO jh_node VALUES ('497','handle','处理','1','','0','136','3','0','0');
INSERT INTO jh_node VALUES ('498','complete','完成','1','','0','136','3','0','0');
INSERT INTO jh_node VALUES ('499','revocation','撤销','1','','0','136','3','0','0');
INSERT INTO jh_node VALUES ('500','foreverdelete','删除','1','','0','136','3','0','0');
INSERT INTO jh_node VALUES ('501','update','更新','1','','0','136','3','0','0');
INSERT INTO jh_node VALUES ('502','edit','编辑','1','','0','136','3','0','0');
INSERT INTO jh_node VALUES ('503','insert','写入','1','','0','136','3','0','0');
INSERT INTO jh_node VALUES ('504','down','导出EXCEL','1','','0','136','3','0','0');
INSERT INTO jh_node VALUES ('505','add','新增','1','','0','136','3','0','0');
INSERT INTO jh_node VALUES ('506','index','列表','1','','0','137','3','0','0');
INSERT INTO jh_node VALUES ('507','complete','成功','1','','0','137','3','0','0');
INSERT INTO jh_node VALUES ('508','foreverdelete','删除','1','','0','137','3','0','0');
INSERT INTO jh_node VALUES ('509','update','更新','1','','0','137','3','0','0');
INSERT INTO jh_node VALUES ('510','edit','编辑','1','','0','137','3','0','0');
INSERT INTO jh_node VALUES ('511','insert','写入','1','','0','137','3','0','0');
INSERT INTO jh_node VALUES ('512','down','导出EXCEL','1','','0','137','3','0','0');
INSERT INTO jh_node VALUES ('513','add','新增','1','','0','137','3','0','0');
INSERT INTO jh_node VALUES ('514','lookUp','查找带回','1','','0','108','3','0','0');
INSERT INTO jh_node VALUES ('515','lookUp','查找带回','1','','0','114','3','0','0');
INSERT INTO jh_node VALUES ('516','lookUp','查找带回','1','','0','138','3','0','0');
INSERT INTO jh_node VALUES ('517','lookUp','查找带回','1','','0','103','3','0','0');
INSERT INTO jh_node VALUES ('518','lookUp','查找带回','1','','0','123','3','0','0');
INSERT INTO jh_node VALUES ('520','Sms_log','短信日志','1','','0','1','2','0','15');
INSERT INTO jh_node VALUES ('521','Mail_log','邮件日志','1','','0','1','2','0','15');
INSERT INTO jh_node VALUES ('522','add','新增','1','','0','520','3','0','0');
INSERT INTO jh_node VALUES ('523','index','列表','1','','0','520','3','0','0');
INSERT INTO jh_node VALUES ('524','foreverdelete','删除','1','','0','520','3','0','0');
INSERT INTO jh_node VALUES ('525','update','更新','1','','0','520','3','0','0');
INSERT INTO jh_node VALUES ('526','edit','编辑','1','','0','520','3','0','0');
INSERT INTO jh_node VALUES ('527','insert','写入','1','','0','520','3','0','0');
INSERT INTO jh_node VALUES ('528','down','导出EXCEL','1','','0','520','3','0','0');
INSERT INTO jh_node VALUES ('529','add','新增','1','','0','521','3','0','0');
INSERT INTO jh_node VALUES ('530','index','列表','1','','0','521','3','0','0');
INSERT INTO jh_node VALUES ('531','foreverdelete','删除','1','','0','521','3','0','0');
INSERT INTO jh_node VALUES ('532','update','更新','1','','0','521','3','0','0');
INSERT INTO jh_node VALUES ('533','edit','编辑','1','','0','521','3','0','0');
INSERT INTO jh_node VALUES ('534','insert','写入','1','','0','521','3','0','0');
INSERT INTO jh_node VALUES ('535','down','导出EXCEL','1','','0','521','3','0','0');
INSERT INTO jh_node VALUES ('536','Refunds','退款申请','1','','0','1','2','0','18');
INSERT INTO jh_node VALUES ('537','Expand_group','扩展字段分组','1','','0','1','2','0','17');
INSERT INTO jh_node VALUES ('538','Commission_log','佣金日志','1','','0','1','2','0','15');
INSERT INTO jh_node VALUES ('539','Commission','等级佣金','1','','0','1','2','0','14');
INSERT INTO jh_node VALUES ('540','add','新增','1','','0','537','3','0','0');
INSERT INTO jh_node VALUES ('541','index','列表','1','','0','537','3','0','0');
INSERT INTO jh_node VALUES ('542','foreverdelete','删除','1','','0','537','3','0','0');
INSERT INTO jh_node VALUES ('543','update','更新','1','','0','537','3','0','0');
INSERT INTO jh_node VALUES ('544','edit','编辑','1','','0','537','3','0','0');
INSERT INTO jh_node VALUES ('545','insert','写入','1','','0','537','3','0','0');
INSERT INTO jh_node VALUES ('546','add','新增','1','','0','538','3','0','0');
INSERT INTO jh_node VALUES ('547','index','列表','1','','0','538','3','0','0');
INSERT INTO jh_node VALUES ('548','foreverdelete','删除','1','','0','538','3','0','0');
INSERT INTO jh_node VALUES ('549','update','更新','1','','0','538','3','0','0');
INSERT INTO jh_node VALUES ('550','edit','编辑','1','','0','538','3','0','0');
INSERT INTO jh_node VALUES ('551','insert','写入','1','','0','538','3','0','0');
INSERT INTO jh_node VALUES ('552','down','导出EXCEL','1','','0','538','3','0','0');
INSERT INTO jh_node VALUES ('553','add','新增','1','','0','539','3','0','0');
INSERT INTO jh_node VALUES ('554','index','列表','1','','0','539','3','0','0');
INSERT INTO jh_node VALUES ('555','foreverdelete','删除','1','','0','539','3','0','0');
INSERT INTO jh_node VALUES ('556','update','更新','1','','0','539','3','0','0');
INSERT INTO jh_node VALUES ('557','edit','编辑','1','','0','539','3','0','0');
INSERT INTO jh_node VALUES ('558','insert','写入','1','','0','539','3','0','0');
INSERT INTO jh_node VALUES ('559','index','列表','1','','0','536','3','0','0');
INSERT INTO jh_node VALUES ('560','update','保存','1','','0','536','3','0','0');
INSERT INTO jh_node VALUES ('561','edit','查看操作','1','','0','536','3','0','0');
INSERT INTO jh_node VALUES ('562','down','导出EXCEL','1','','0','536','3','0','0');
INSERT INTO jh_node VALUES ('563','forbid','禁用','1','','0','537','3','0','0');
INSERT INTO jh_node VALUES ('564','resume','恢复','1','','0','537','3','0','0');
INSERT INTO jh_node VALUES ('570','Goods_recommend','商品推荐','1','','0','1','2','0','17');
INSERT INTO jh_node VALUES ('571','index','列表','1','','0','570','3','0','0');
INSERT INTO jh_node VALUES ('572','foreverdelete','删除','1','','0','570','3','0','0');
INSERT INTO jh_node VALUES ('573','update','更新','1','','0','570','3','0','0');
INSERT INTO jh_node VALUES ('574','edit','编辑','1','','0','570','3','0','0');
INSERT INTO jh_node VALUES ('575','insert','写入','1','','0','570','3','0','0');
INSERT INTO jh_node VALUES ('586','Label','标签管理','1','','0','1','2','0','15');
INSERT INTO jh_node VALUES ('587','Circle','圈子管理','1','','0','1','2','0','15');
INSERT INTO jh_node VALUES ('588','Talk_about','说说日志','1','','0','1','2','0','20');
INSERT INTO jh_node VALUES ('589','Price_range','价格范围','1','','0','1','2','0','16');
INSERT INTO jh_node VALUES ('590','Distance_range','距离范围','1','','0','1','2','0','16');
INSERT INTO jh_node VALUES ('591','index','列表','1','','0','586','3','0','0');
INSERT INTO jh_node VALUES ('592','foreverdelete','删除','1','','0','586','3','0','0');
INSERT INTO jh_node VALUES ('593','update','更新','1','','0','586','3','0','0');
INSERT INTO jh_node VALUES ('594','edit','编辑','1','','0','586','3','0','0');
INSERT INTO jh_node VALUES ('595','insert','写入','1','','0','586','3','0','0');
INSERT INTO jh_node VALUES ('596','add','新增','1','','0','586','3','0','0');
INSERT INTO jh_node VALUES ('597','index','列表','1','','0','587','3','0','0');
INSERT INTO jh_node VALUES ('598','foreverdelete','删除','1','','0','587','3','0','0');
INSERT INTO jh_node VALUES ('599','update','更新','1','','0','587','3','0','0');
INSERT INTO jh_node VALUES ('600','edit','编辑','1','','0','587','3','0','0');
INSERT INTO jh_node VALUES ('601','insert','写入','1','','0','587','3','0','0');
INSERT INTO jh_node VALUES ('602','add','新增','1','','0','587','3','0','0');
INSERT INTO jh_node VALUES ('603','index','列表','1','','0','588','3','0','0');
INSERT INTO jh_node VALUES ('604','foreverdelete','删除','1','','0','588','3','0','0');
INSERT INTO jh_node VALUES ('605','update','更新','1','','0','588','3','0','0');
INSERT INTO jh_node VALUES ('606','edit','编辑','1','','0','588','3','0','0');
INSERT INTO jh_node VALUES ('607','insert','写入','1','','0','588','3','0','0');
INSERT INTO jh_node VALUES ('608','add','新增','1','','0','588','3','0','0');
INSERT INTO jh_node VALUES ('609','index','列表','1','','0','589','3','0','0');
INSERT INTO jh_node VALUES ('610','foreverdelete','删除','1','','0','589','3','0','0');
INSERT INTO jh_node VALUES ('611','update','更新','1','','0','589','3','0','0');
INSERT INTO jh_node VALUES ('612','edit','编辑','1','','0','589','3','0','0');
INSERT INTO jh_node VALUES ('613','insert','写入','1','','0','589','3','0','0');
INSERT INTO jh_node VALUES ('614','add','新增','1','','0','589','3','0','0');
INSERT INTO jh_node VALUES ('615','index','列表','1','','0','590','3','0','0');
INSERT INTO jh_node VALUES ('616','foreverdelete','删除','1','','0','590','3','0','0');
INSERT INTO jh_node VALUES ('617','update','更新','1','','0','590','3','0','0');
INSERT INTO jh_node VALUES ('618','edit','编辑','1','','0','590','3','0','0');
INSERT INTO jh_node VALUES ('619','insert','写入','1','','0','590','3','0','0');
INSERT INTO jh_node VALUES ('620','add','新增','1','','0','590','3','0','0');
INSERT INTO jh_node VALUES ('621','Apply','商家申请','1','','0','1','2','0','13');
INSERT INTO jh_node VALUES ('622','index','列表','1','','0','621','3','0','0');
INSERT INTO jh_node VALUES ('623','foreverdelete','删除','1','','0','621','3','0','0');
INSERT INTO jh_node VALUES ('624','update','更新','1','','0','621','3','0','0');
INSERT INTO jh_node VALUES ('625','edit','编辑','1','','0','621','3','0','0');
INSERT INTO jh_node VALUES ('626','insert','写入','1','','0','621','3','0','0');
INSERT INTO jh_node VALUES ('627','add','新增','1','','0','621','3','0','0');
INSERT INTO jh_node VALUES ('628','pass','通过','1','','0','621','3','0','0');
INSERT INTO jh_node VALUES ('629','revocation','撤销','1','','0','621','3','0','0');

DROP TABLE IF EXISTS jh_order;
CREATE TABLE `jh_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sn` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `fee` varchar(255) NOT NULL COMMENT '手续费',
  `incharge` varchar(255) NOT NULL COMMENT '已支付费用',
  `cope` varchar(255) NOT NULL COMMENT '应付金额',
  `total` varchar(255) NOT NULL COMMENT '总价',
  `money_status` tinyint(1) NOT NULL COMMENT '0:未收款;1:部分收款;2:全部收款;3:部分退款;4:全部退款',
  `addtime` int(11) DEFAULT NULL,
  `paytype` varchar(255) DEFAULT NULL,
  `remark` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '0未支付1已支付2已作废',
  PRIMARY KEY (`id`),
  KEY `FK_Reference_23` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_order_details;
CREATE TABLE `jh_order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `attr` varchar(255) NOT NULL,
  `comment_id` int(11) NOT NULL COMMENT '用户评论产品',
  `member_comment_id` int(11) NOT NULL COMMENT '商家评论用户',
  `refund_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未申请退款;1:已申请退款;2:已退款;3:退款申请未通过;',
  `refund_reason` text NOT NULL,
  `refund_applytime` int(11) NOT NULL,
  `refundamount` varchar(255) NOT NULL,
  `refundtime` int(11) NOT NULL,
  `addtime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_payment;
CREATE TABLE `jh_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `mark` varchar(255) DEFAULT NULL,
  `description` text,
  `logo` varchar(255) DEFAULT NULL,
  `fee` varchar(10) DEFAULT NULL,
  `feetype` tinyint(1) DEFAULT NULL COMMENT '0定额1比例',
  `merchant` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '0禁用1启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO jh_payment VALUES ('1','支付宝','Alipay','支付宝 知托付！','/Public/upload/img/site/4f727c600b917.png','0.00','0','','','','0','1');
INSERT INTO jh_payment VALUES ('2','财付通','Tenpay','会支付 会生活','/Public/upload/img/site/4f727c4e55451.png','0.00','0','','','','0','1');
INSERT INTO jh_payment VALUES ('3','易宝支付','Yeepay','绿色支付 快乐生活','/Public/upload/img/site/4f727c3b66e0d.png','0.00','0','','','','0','1');
INSERT INTO jh_payment VALUES ('4','网银在线','Chinabank','随时随地快捷、安全支付','/Public/upload/img/site/4f727c2ec581c.png','0.00','0','','','','0','1');
INSERT INTO jh_payment VALUES ('5','汇付天下','Chinapnr','汇付天下,金融支付专家','/Public/upload/img/site/4f727bf8c1987.png','0.00','0','','','','0','1');
INSERT INTO jh_payment VALUES ('6','Paypal','Paypal','','/Public/upload/img/site/4f86b6a978e4a.gif','0.00','0','','','','0','1');

DROP TABLE IF EXISTS jh_prepaid_card;
CREATE TABLE `jh_prepaid_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sn` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `cash` varchar(255) NOT NULL COMMENT '金额',
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0未使用1已使用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_price_range;
CREATE TABLE `jh_price_range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO jh_price_range VALUES ('1','3000以内','1','2999','0','1');
INSERT INTO jh_price_range VALUES ('2','3000-4999','3000','4999','0','1');
INSERT INTO jh_price_range VALUES ('3','5000-7999','5000','7999','0','1');
INSERT INTO jh_price_range VALUES ('4','8000以上','8000','10000','0','1');

DROP TABLE IF EXISTS jh_recharge;
CREATE TABLE `jh_recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sn` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `cope` varchar(255) NOT NULL,
  `cash` varchar(255) NOT NULL,
  `bank_id` varchar(255) NOT NULL,
  `addtime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_recommend;
CREATE TABLE `jh_recommend` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '推荐ID',
  `gid` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `content` text,
  `type` tinyint(1) DEFAULT NULL COMMENT '0普通文章 1视频 2图片',
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_region;
CREATE TABLE `jh_region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `pid` int(11) DEFAULT NULL COMMENT '父类的ID',
  `path` varchar(255) DEFAULT NULL COMMENT '级别路径 例子 0,1,2,3',
  `level` int(11) NOT NULL,
  `letter` varchar(1) NOT NULL,
  `spelling` varchar(255) NOT NULL,
  `isdefault` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL COMMENT '统计排序',
  PRIMARY KEY (`id`),
  KEY `path` (`path`,`sort`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

INSERT INTO jh_region VALUES ('3','苏州','2','0,2,3','1','S','suzhou','1','0');
INSERT INTO jh_region VALUES ('2','江苏省','0','0,2','0','J','jiangsusheng','1','0');
INSERT INTO jh_region VALUES ('4','无锡','2','0,2,4','1','W','wuxi','0','0');
INSERT INTO jh_region VALUES ('25','苏州乐园','3','0,2,3,25','2','S','suzhouleyuan','0','0');
INSERT INTO jh_region VALUES ('7','平江路','3','0,2,3,7','2','P','pingjianglu','0','0');
INSERT INTO jh_region VALUES ('23','山塘街','3','0,2,3,23','2','S','shantangjie','0','0');
INSERT INTO jh_region VALUES ('24','李公堤','3','0,2,3,24','2','L','ligongdi','0','0');
INSERT INTO jh_region VALUES ('18','太湖','3','0,2,3,18','2','T','taihu','0','0');
INSERT INTO jh_region VALUES ('19','运河公园','3','0,2,3,19','2','Y','yunhegongyuan','0','0');
INSERT INTO jh_region VALUES ('20','月光码头','3','0,2,3,20','2','Y','yueguangmatou','0','0');
INSERT INTO jh_region VALUES ('21','穹窿山后山','3','0,2,3,21','2','L','longshanhoushan','0','0');
INSERT INTO jh_region VALUES ('22','白马涧','3','0,2,3,22','2','B','baimajian','0','0');
INSERT INTO jh_region VALUES ('17','旺山','3','0,2,3,17','2','W','wangshan','0','0');
INSERT INTO jh_region VALUES ('26','其他','3','0,2,3,26','2','Q','qita','0','0');
INSERT INTO jh_region VALUES ('27','渔夫岛','4','0,2,4,27','2','Y','yufudao','0','0');
INSERT INTO jh_region VALUES ('28','鼋头渚','4','0,2,4,28','2','T','tou','0','0');
INSERT INTO jh_region VALUES ('29','渤公岛','4','0,2,4,29','2','B','bogongdao','0','0');
INSERT INTO jh_region VALUES ('30','小蠡湖','4','0,2,4,30','2','X','xiaohu','0','0');
INSERT INTO jh_region VALUES ('31','龙头渚','4','0,2,4,31','2','L','longtou','0','0');
INSERT INTO jh_region VALUES ('32','蠡湖中央公园','4','0,2,4,32','2','H','huzhongyanggongyuan','0','0');
INSERT INTO jh_region VALUES ('33','茶园','4','0,2,4,33','2','C','chayuan','0','0');
INSERT INTO jh_region VALUES ('34','锡惠公园','4','0,2,4,34','2','X','xihuigongyuan','0','0');
INSERT INTO jh_region VALUES ('35','梅园','4','0,2,4,35','2','M','meiyuan','0','0');
INSERT INTO jh_region VALUES ('36','南京','2','0,2,36','1','N','nanjing','0','0');
INSERT INTO jh_region VALUES ('37','江浦老山线','36','0,2,36,37','2','J','jiangpulaoshanxian','0','0');
INSERT INTO jh_region VALUES ('38','江宁小桂林','36','0,2,36,38','2','J','jiangningxiaoguilin','0','0');
INSERT INTO jh_region VALUES ('39','总府','36','0,2,36,39','2','Z','zongfu','0','0');
INSERT INTO jh_region VALUES ('40','将军山','36','0,2,36,40','2','J','jiangjunshan','0','0');
INSERT INTO jh_region VALUES ('41','其他','36','0,2,36,41','2','Q','qita','0','0');
INSERT INTO jh_region VALUES ('42','其他','4','0,2,4,42','2','Q','qita','0','0');

DROP TABLE IF EXISTS jh_release;
CREATE TABLE `jh_release` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promulgator` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `addtime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_remind;
CREATE TABLE `jh_remind` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `opposite` int(11) NOT NULL DEFAULT '0',
  `content` text,
  `type` varchar(30) NOT NULL,
  `new` tinyint(1) NOT NULL DEFAULT '0',
  `good_id` int(11) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_35` (`uid`),
  KEY `FK_Reference_36` (`opposite`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO jh_remind VALUES ('1','2','1','[actor] [text]','attention','0','0','1373430421');
INSERT INTO jh_remind VALUES ('2','1','2','[actor] [text][pre]：加个朋友吧！！！  [addurl]','friend_request','1','0','1374984226');

DROP TABLE IF EXISTS jh_role;
CREATE TABLE `jh_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `ename` varchar(5) DEFAULT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `ename` (`ename`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_role_user;
CREATE TABLE `jh_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_sms_log;
CREATE TABLE `jh_sms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receive` varchar(255) NOT NULL,
  `sendtime` int(9) NOT NULL,
  `content` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO jh_sms_log VALUES ('1','15895553075','1373587615','					您好！感谢你注册AT结婚网,您的验证码为：128340。								','0');

DROP TABLE IF EXISTS jh_sysconf;
CREATE TABLE `jh_sysconf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `val` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `list_type` tinyint(1) NOT NULL COMMENT '0:手动输入 1:单选 2:下拉 3:文本域 4:图像',
  `val_arr` varchar(255) NOT NULL COMMENT '可选的值的集合。序列化存放',
  `group_id` tinyint(2) NOT NULL DEFAULT '1',
  `is_show` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `inx_sys_conf_001` (`status`,`name`),
  KEY `inx_sys_conf_002` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;

INSERT INTO jh_sysconf VALUES ('1','site_name','网站名称','结婚巴士','1','0','0','','1','1');
INSERT INTO jh_sysconf VALUES ('2','site_url','网站网址','http://127.0.0.1','1','0','0','','1','1');
INSERT INTO jh_sysconf VALUES ('3','site_title','网站标题','结婚巴士','1','0','0','','1','1');
INSERT INTO jh_sysconf VALUES ('4','site_keywords','网站默认关键字','婚纱摄影','1','0','0','','1','1');
INSERT INTO jh_sysconf VALUES ('5','site_description','网站描述','结婚巴士-婚纱摄影第一站.www.jiehunbus.com','1','0','0','','1','1');
INSERT INTO jh_sysconf VALUES ('6','site_powerby','网站版权信息','Copyright © 2013 JiehunBus.com. ','1','0','0','','1','1');
INSERT INTO jh_sysconf VALUES ('7','site_beian','网站备案号','苏ICP证66688888号','1','0','0','','1','1');
INSERT INTO jh_sysconf VALUES ('8','site_closed','关闭网站','0','1','0','1','0,1','1','1');
INSERT INTO jh_sysconf VALUES ('9','site_logo','网站LOGO','/Public/upload/img/site/51f480d73b232.png','1','0','4','','1','1');
INSERT INTO jh_sysconf VALUES ('10','site_tongji','统计代码','','1','0','3','','1','1');
INSERT INTO jh_sysconf VALUES ('11','site_services_tel','客服电话','0512-66668888','1','0','0','','1','1');
INSERT INTO jh_sysconf VALUES ('12','site_services_email','客服邮箱','1037591982@qq.com','1','0','0','','1','1');
INSERT INTO jh_sysconf VALUES ('13','site_upload_allowexts','允许上传的文件类型','jpg,gif,png,jpeg','1','0','0','','4','1');
INSERT INTO jh_sysconf VALUES ('14','site_upload_maxsize','最大上传限制（字节）','102400','1','0','0','','4','1');
INSERT INTO jh_sysconf VALUES ('15','site_water_mark','开启水印','1','1','0','1','0,1','4','1');
INSERT INTO jh_sysconf VALUES ('16','site_big_width','大图宽度','334','1','0','0','','4','1');
INSERT INTO jh_sysconf VALUES ('17','site_big_heigth','大图高度','','1','0','0','','4','1');
INSERT INTO jh_sysconf VALUES ('18','site_small_width','小图宽度','213','1','0','0','','4','1');
INSERT INTO jh_sysconf VALUES ('19','site_small_heigth','小图高度','','1','0','0','','4','1');
INSERT INTO jh_sysconf VALUES ('20','site_water_image','水印图片','/Public/upload/img/site/51dcef631bca1.png','1','0','4','','4','1');
INSERT INTO jh_sysconf VALUES ('21','site_water_position','水印打印位置','4','1','0','2','1,2,3,4,5','4','1');
INSERT INTO jh_sysconf VALUES ('22','site_mail_on','邮件服务','1','1','0','1','0,1','2','1');
INSERT INTO jh_sysconf VALUES ('23','site_smtp_server','邮件服务器','smtp.163.com','1','0','0','','2','1');
INSERT INTO jh_sysconf VALUES ('24','site_smtp_port','邮件服务器端口','25','1','0','0','','2','1');
INSERT INTO jh_sysconf VALUES ('25','site_smtp_account','邮件帐号','debug003@163.com','1','0','0','','2','1');
INSERT INTO jh_sysconf VALUES ('26','site_services_password','邮件密码','1000000','1','0','0','','2','1');
INSERT INTO jh_sysconf VALUES ('27','site_reply_address','回复地址','debug003@163.com','1','0','0','','2','1');
INSERT INTO jh_sysconf VALUES ('28','site_smtp_auth','SMTP验证','1','1','0','1','0,1','2','1');
INSERT INTO jh_sysconf VALUES ('29','site_smtp_is_ssl','SSL连接加密','0','1','0','1','0,1','2','1');
INSERT INTO jh_sysconf VALUES ('31','site_water_alpha','水印透明度','80','1','0','0','','4','1');
INSERT INTO jh_sysconf VALUES ('32','site_work_times','工作时间','周一至周六 9:00-18:00','1','0','3','','1','1');
INSERT INTO jh_sysconf VALUES ('33','site_page_listrows','通用分页量','20','1','0','0','','1','1');
INSERT INTO jh_sysconf VALUES ('34','site_mb_allowreg','是否允许新会员注册','1','1','0','1','0,1','5','1');
INSERT INTO jh_sysconf VALUES ('35','site_price_decimal','价格类型小数位数','2','1','0','0','','3','1');
INSERT INTO jh_sysconf VALUES ('37','site_mb_autoreg','会员注册邮件验证','0','1','0','1','0,1','5','1');
INSERT INTO jh_sysconf VALUES ('38','site_mb_logintime','会员登录cookie有效时间（分钟）','600','1','0','0','','5','1');
INSERT INTO jh_sysconf VALUES ('94','site_mb_sellcredits','会员商品售出单个送积分','100','1','0','0','','5','1');
INSERT INTO jh_sysconf VALUES ('40','site_mb_bigavatar','会员头像默认大图','/Public/upload/img/site/4eeaad8122cf7.png','1','0','4','','5','1');
INSERT INTO jh_sysconf VALUES ('41','site_mb_smallavatar','会员头像默认小图','/Public/upload/img/site/4eeaad813263f.png','1','0','4','','5','1');
INSERT INTO jh_sysconf VALUES ('46','evaluate_total','评价总值','100','1','0','0','','3','1');
INSERT INTO jh_sysconf VALUES ('47','is_open_chat','是否开启及时聊天','1','1','0','1','0,1','3','1');
INSERT INTO jh_sysconf VALUES ('49','site_credits_name','网站用户积分名称','积分','1','0','0','','1','1');
INSERT INTO jh_sysconf VALUES ('50','site_mb_phone_verify','会员手机验证','0','1','0','1','0,1','5','1');
INSERT INTO jh_sysconf VALUES ('51','site_mb_verifycredits','会员注册验证后送积分','100','1','0','0','','5','1');
INSERT INTO jh_sysconf VALUES ('52','site_mb_invitecredits','会员邀请好友送积分','100','1','0','0','','5','1');
INSERT INTO jh_sysconf VALUES ('53','site_mb_buycredits','会员购买商品单个送积分','100','1','0','0','','5','1');
INSERT INTO jh_sysconf VALUES ('54','site_mb_invitebuycredits','会员邀请的好友首次购买成功送积分','200','1','0','0','','5','1');
INSERT INTO jh_sysconf VALUES ('55','site_mb_invitesellcredits','会员邀请的好友首次出售成功送积分','200','1','0','0','','5','1');
INSERT INTO jh_sysconf VALUES ('56','site_mb_avatarcredits','会员首次上传头像送积分','100','1','0','0','','5','1');
INSERT INTO jh_sysconf VALUES ('57','recently_num','最近联系人的数量','10','1','0','0','','3','1');
INSERT INTO jh_sysconf VALUES ('58','site_mb_invitetime','会员邀请链接有效时间（分钟）','600','1','0','0','','5','1');
INSERT INTO jh_sysconf VALUES ('59','chat_log_num','聊天记录显示条数','10','1','0','0','','3','1');
INSERT INTO jh_sysconf VALUES ('60','site_sms_open','开启短信功能','1','1','4','1','0,1','6','1');
INSERT INTO jh_sysconf VALUES ('61','site_sms_sendhttp','短信接口（[tel]手机号码,[msg]短信内容）','http://124.172.250.160/WebService.asmx/mt?Sn=jf&Pwd=888888&mobile=[tel]&content=[msg]','1','2','0','','6','1');
INSERT INTO jh_sysconf VALUES ('62','site_sms_success','短信接口发送成功返回值','.+0.+int.+','1','0','0','','6','1');
INSERT INTO jh_sysconf VALUES ('63','site_sendmail_pay','收款邮件通知','0','1','0','1','0,1','2','1');
INSERT INTO jh_sysconf VALUES ('64','site_sendmail_coupon','优惠券邮件通知','0','1','0','1','0,1','2','1');
INSERT INTO jh_sysconf VALUES ('65','site_couponname','网站优惠券名称','优惠券','1','0','0','','1','1');
INSERT INTO jh_sysconf VALUES ('66','site_sendmail_usecoupon','优惠券消费邮件通知','0','1','0','1','0,1','2','1');
INSERT INTO jh_sysconf VALUES ('69','site_sendsms_pay','收款短信通知','0','1','0','1','0,1','6','1');
INSERT INTO jh_sysconf VALUES ('70','site_sendsms_coupon_auto','发放优惠券时,自动短信通知','0','1','0','1','0,1','6','1');
INSERT INTO jh_sysconf VALUES ('71','site_sendsms_coupon','优惠券短信通知','1','1','0','1','0,1','6','1');
INSERT INTO jh_sysconf VALUES ('72','site_sendsms_coupon_num','优惠券短信通知次数','3','1','0','0','','6','1');
INSERT INTO jh_sysconf VALUES ('73','site_sendsms_usecoupon','优惠券消费短信通知','0','1','0','1','0,1','6','1');
INSERT INTO jh_sysconf VALUES ('74','site_sendsms_code_time','短信验证码有效期（分钟）','60','1','0','0','','6','1');
INSERT INTO jh_sysconf VALUES ('75','online_check','在线检测间隔（秒）','600','1','0','0','','3','1');
INSERT INTO jh_sysconf VALUES ('76','site_replacestr','替换词语（词语会被替换）用|分开,结尾不加','她妈|它妈|他妈|你妈|去死|贱人','1','0','0','','1','1');
INSERT INTO jh_sysconf VALUES ('77','site_prepaid_card_name','网站充值卡名称','充值卡','1','0','0','','1','1');
INSERT INTO jh_sysconf VALUES ('78','sys_tpl_cache','是否开启模版缓存','0','1','0','1','0,1','7','1');
INSERT INTO jh_sysconf VALUES ('79','sys_tpl_time','模版缓存有效期（秒）','-1','1','0','0','','7','1');
INSERT INTO jh_sysconf VALUES ('80','sys_data_cache','数据缓存类型','Db','1','0','2','File,Db,Apc,Memcache,Shmop,Sqlite,Xcache,Apachenote,Eaccelerator','7','1');
INSERT INTO jh_sysconf VALUES ('81','sys_default_lang','默认语言','zh-cn','1','0','2','zh-cn,zh-tw','7','1');
INSERT INTO jh_sysconf VALUES ('82','sys_url_suffix','伪静态url后缀','','1','0','0','','7','1');
INSERT INTO jh_sysconf VALUES ('83','site_refund_isallow','开放退款申请','1','1','0','2','0,1','3','1');
INSERT INTO jh_sysconf VALUES ('84','distribution_auto','是否开启利润自动分配','1','1','0','1','0,1','8','1');
INSERT INTO jh_sysconf VALUES ('85','distribution_unity_open','是否全站统一佣金','1','1','0','1','0,1','8','1');
INSERT INTO jh_sysconf VALUES ('86','distribution_unity_type','全站统一佣金收取类型','1','1','0','1','0,1','8','1');
INSERT INTO jh_sysconf VALUES ('87','distribution_unity_value','全站统一佣金','0','1','0','0','','8','1');
INSERT INTO jh_sysconf VALUES ('88','distribution_level_open','是否按用户级别设置佣金','1','1','0','1','0,1','8','1');
INSERT INTO jh_sysconf VALUES ('89','distribution_goods_open','是否按商品设置佣金','0','1','0','1','0,1','8','1');
INSERT INTO jh_sysconf VALUES ('90','site_sms_type','短信接口类型','UTF-8','1','1','0','','6','1');
INSERT INTO jh_sysconf VALUES ('91','release_open','是否开启前台自行发布','1','1','0','1','0,1','9','1');
INSERT INTO jh_sysconf VALUES ('92','release_audit','发布商品是否需要审核','1','1','0','1','0,1','9','1');
INSERT INTO jh_sysconf VALUES ('106','verify_phone_format','手机号码验证方式','0','1','0','1','0,1','3','1');
INSERT INTO jh_sysconf VALUES ('108','is_switch_region','是否开启切换城市','1','1','0','1','0,1','3','1');
INSERT INTO jh_sysconf VALUES ('109','sys_lang_auto_detect','是否自动侦测浏览器语言','0','1','0','1','0,1','7','1');

DROP TABLE IF EXISTS jh_sysconf_group;
CREATE TABLE `jh_sysconf_group` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO jh_sysconf_group VALUES ('1','基本配置','1','8');
INSERT INTO jh_sysconf_group VALUES ('2','邮件设置','1','6');
INSERT INTO jh_sysconf_group VALUES ('3','其他','1','0');
INSERT INTO jh_sysconf_group VALUES ('4','上传设置','1','7');
INSERT INTO jh_sysconf_group VALUES ('5','会员相关配置','1','5');
INSERT INTO jh_sysconf_group VALUES ('6','短信设置','1','4');
INSERT INTO jh_sysconf_group VALUES ('7','程序设置','1','3');
INSERT INTO jh_sysconf_group VALUES ('8','利润分配','1','2');
INSERT INTO jh_sysconf_group VALUES ('9','发布设置','1','2');

DROP TABLE IF EXISTS jh_talk_about;
CREATE TABLE `jh_talk_about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `comment` int(11) NOT NULL,
  `forwarding` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `addtime` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO jh_talk_about VALUES ('1','1','0','测试！','0','0','0','1373258651','0');
INSERT INTO jh_talk_about VALUES ('2','1','0','感觉真的不错呢～～～','1','1','1','1373426239','2');
INSERT INTO jh_talk_about VALUES ('3','2','0','看看还不错','0','0','1','1373430108','2');
INSERT INTO jh_talk_about VALUES ('4','2','2','嗯～','0','0','1','1373430135','2');
INSERT INTO jh_talk_about VALUES ('5','2','0','心情不错～～～','0','0','0','1373430208','0');
INSERT INTO jh_talk_about VALUES ('6','1','0','哈OK那！','0','0','1','1373430532','1');
INSERT INTO jh_talk_about VALUES ('7','1','0','不错的～～～[微笑]','2','0','2','1373522634','2');
INSERT INTO jh_talk_about VALUES ('8','1','0','[微笑]大家看看～～～','0','0','0','1373713308','0');
INSERT INTO jh_talk_about VALUES ('9','1','0','他妈的','0','0','0','1373713314','1');
INSERT INTO jh_talk_about VALUES ('10','1','0','估计不错的～～～','1','1','2','1373720449','0');
INSERT INTO jh_talk_about VALUES ('11','1','0','','0','0','1','1374590962','0');
INSERT INTO jh_talk_about VALUES ('12','1','0','','1','0','1','1374590966','0');
INSERT INTO jh_talk_about VALUES ('13','1','0','','0','0','1','1374590975','0');
INSERT INTO jh_talk_about VALUES ('14','1','0','[色]','1','1','1','1374941658','1');
INSERT INTO jh_talk_about VALUES ('15','1','14','[色]','0','0','1','1374941673','0');
INSERT INTO jh_talk_about VALUES ('16','1','0','[流泪]','0','0','0','1374941730','1');
INSERT INTO jh_talk_about VALUES ('17','1','0','来！说说你在想什么！有什么有趣的事情分享给大家！来！说说你在想什么！有什么有趣的事情分享给大家！来！说说你在想什么！有什么有趣的事情分享给大家！来！说说你在想什么！有什么有趣的事情分享给大家！来！说说你在想什么！有什么有趣的事情分享给大家！','0','0','0','1374980107','1');
INSERT INTO jh_talk_about VALUES ('18','2','0','[发呆]','0','0','0','1374984046','0');
INSERT INTO jh_talk_about VALUES ('19','2','0','他妈的！！','0','0','0','1374984065','0');
INSERT INTO jh_talk_about VALUES ('20','2','0','[色]','0','0','2','1374984136','0');
INSERT INTO jh_talk_about VALUES ('21','2','10','看看爸～～～','0','0','2','1374984167','1');
INSERT INTO jh_talk_about VALUES ('22','1','0','苏州首尔首尔怎么样？？？','0','0','0','1374984725','1');

DROP TABLE IF EXISTS jh_talk_about_comment;
CREATE TABLE `jh_talk_about_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO jh_talk_about_comment VALUES ('1','2','1','嗯 是的！','1373426263');
INSERT INTO jh_talk_about_comment VALUES ('2','7','2','[微笑]','1373531762');
INSERT INTO jh_talk_about_comment VALUES ('3','7','1','嗯!!','1373713649');
INSERT INTO jh_talk_about_comment VALUES ('4','14','1','[发呆]','1374941665');
INSERT INTO jh_talk_about_comment VALUES ('5','12','1','[色]','1374942014');
INSERT INTO jh_talk_about_comment VALUES ('6','10','2','垃圾店家～～～','1374984151');

DROP TABLE IF EXISTS jh_talk_about_like;
CREATE TABLE `jh_talk_about_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO jh_talk_about_like VALUES ('1','1','2');
INSERT INTO jh_talk_about_like VALUES ('2','2','2');
INSERT INTO jh_talk_about_like VALUES ('3','2','3');
INSERT INTO jh_talk_about_like VALUES ('4','2','4');
INSERT INTO jh_talk_about_like VALUES ('5','2','7');
INSERT INTO jh_talk_about_like VALUES ('6','1','7');
INSERT INTO jh_talk_about_like VALUES ('7','1','9');
INSERT INTO jh_talk_about_like VALUES ('8','1','4');
INSERT INTO jh_talk_about_like VALUES ('9','1','3');
INSERT INTO jh_talk_about_like VALUES ('10','1','6');
INSERT INTO jh_talk_about_like VALUES ('11','1','14');
INSERT INTO jh_talk_about_like VALUES ('12','1','16');
INSERT INTO jh_talk_about_like VALUES ('13','1','17');
INSERT INTO jh_talk_about_like VALUES ('14','2','21');
INSERT INTO jh_talk_about_like VALUES ('15','1','22');

DROP TABLE IF EXISTS jh_talk_about_relation;
CREATE TABLE `jh_talk_about_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS jh_user;
CREATE TABLE `jh_user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `bind_account` varchar(50) NOT NULL,
  `last_login_time` int(11) unsigned DEFAULT '0',
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` mediumint(8) unsigned DEFAULT '0',
  `verify` varchar(32) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `type_id` tinyint(2) unsigned DEFAULT '0',
  `info` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO jh_user VALUES ('1','admin','管理员','21232f297a57a5a743894a0e4a801fc3','','1374983343','','13','','','','0','0','1','0','');

DROP TABLE IF EXISTS jh_value_log;
CREATE TABLE `jh_value_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `val` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_module` varchar(255) NOT NULL,
  `addtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO jh_value_log VALUES ('1','1','100','[avatar]','1','avatar','1373424575');
INSERT INTO jh_value_log VALUES ('2','2','100','[avatar]','2','avatar','1373526459');

DROP TABLE IF EXISTS jh_verification;
CREATE TABLE `jh_verification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `addtime` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mail` (`mail`),
  KEY `code` (`code`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO jh_verification VALUES ('1','15895553075','128340','phonecode','1373587614','1');

DROP TABLE IF EXISTS jh_withdraw;
CREATE TABLE `jh_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cash` varchar(255) NOT NULL,
  `bank_id` varchar(255) NOT NULL,
  `bank_card` varchar(255) NOT NULL,
  `realname` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `addtime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


