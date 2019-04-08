/* 职务表 */
CREATE TABLE `duty` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(63) NOT NULL COMMENT '职务头衔',
    `permission` TEXT NOT NULL COMMENT '权限',
    `remark` TEXT DEFAULT NULL COMMENT '职务备注',
    `createtime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    PRIMARY KEY (`id`),
    UNIQUE KEY `UNIQUE_TITLE` (`title`),
    INDEX KEY `CREATETIME_INDEX` (`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='职务表';
