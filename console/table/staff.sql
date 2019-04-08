/* 管理员表 */
CREATE TABLE `staff` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `dutyid` INT(10) UNSIGNED NOT NULL COMMENT '职务ID',
    `account` VARCHAR(31) NOT NULL COMMENT '账户',
    `nickname` VARCHAR(31) NOT NULL COMMENT '昵称',
    `password` BINARY(32) NOT NULL COMMENT '密码',
    `createtime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    PRIMARY KEY (`id`),
    UNIQUE KEY `UNIQUE_ACCOUNT` (`account`),
    INDEX KEY `CREATETIME_INDEX` (`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';
