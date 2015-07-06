CREATE DATABASE `luomor_o2o` DEFAULT CHARACTER SET utf8;

use luomor_o2o;

create table card_pack_shop(
    id int(11) not null auto_increment,
    shop_name varchar(60) not null default '' comment '商铺名称',
    shop_city varchar(60) not null default '' comment '所在城市',
    shop_address varchar(255) not null default '' comment '商铺地址',
    shop_latitude double not null default 0 comment '商铺纬度',
    shop_longitude double not null default 0 comment '商铺经度',
    shop_phone varchar(32) not null default '' comment '商铺电话',
    create_time int(11) not null default 0 comment '创建时间',
    update_time int(11) not null default 0 comment '更新时间',
    status int(11) not null default 0 comment '1-待审核 2-审核中 3-审核通过 4-冻结',
    operator_name varchar(60) not null default '' comment '',
    operator_time int(11) not null default 0 comment '',
    primary key(id)
);

create table card_pack_shop_passes(
    id int(11) not null auto_increment,
    shop_id int(11) not null default 0 comment 'shop ID',
    passes_type int(11) not null default 0 comment '1-coupons 2-member cards 3-air tickets 4-move tickets',
    passes_name varchar(64) not null default '' comment '名称',
    passes_subname varchar(64) not null default '' comment '副标题',
    passes_num int(11) not null default 0 comment '卡券数量',
    passes_preferential_type int(11) not null default 0 comment '优惠类型,1-金额 2-折扣',
    passes_value int(11) not null default 0 comment '卡券金额',
    passes_source int(11) not null default 0 comment '1-official accounts 2-apps 3-offline stores',
    `coupon_type` int(11) not null default 0 comment '1-团购券 2-赠券',
    start_time int(11) not null default 0 comment '开始时间',
    end_time int(11) not null default 0 comment '结束时间',
    available_days int(11) not null default 0 comment '有效天数',
    status int(11) not null default 0 comment '1-有效 2-无效 3-过期',
    create_time int(11) not null default 0 comment '创建时间',
    update_time int(11) not null default 0 comment '更新时间',
    operator_name varchar(60) not null default '' comment '',
    operator_time int(11) not null default 0 comment '',
    primary key(id)
);

create table card_pack_user_passes(
    id int(11) not null auto_increment,
    passes_id int(11) not null default 0 comment 'passes ID',
    passes_code varchar(64) not null default '' comment '优惠码',
    user_id varchar(64) not null default '' comment '用户ID',
    device_id varchar(64) not null default '' comment '设备ID',
    start_time int(11) not null default 0 comment '开始时间',
    end_time int(11) not null default 0 comment '结束时间',
    status int(11) not null default 0 comment '1-未兑换 2-已兑换 3-已过期',
    create_time int(11) not null default 0 comment '创建时间',
    update_time int(11) not null default 0 comment '更新时间',
    primary key(id)
);