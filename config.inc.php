<?php
/**
 * Typecho Blog Platform
 *
 * @copyright  Copyright (c) 2008 Typecho team (http://www.typecho.org)
 * @license    GNU General Public License 2.0
 * @version    $Id$
 */

/** 开启数据库错误日志 */
# define('__TYPECHO_DEBUG__', true);

/** 开启https */ 
define('__TYPECHO_SECURE__',true);

/** 定义根目录 */
define('__TYPECHO_ROOT_DIR__', dirname(__FILE__));

/** 定义插件目录(相对路径) */
define('__TYPECHO_PLUGIN_DIR__', '/usr/plugins');

/** 定义模板目录(相对路径) */
define('__TYPECHO_THEME_DIR__', '/usr/themes');

/** 后台路径(相对路径) */
define('__TYPECHO_ADMIN_DIR__', '/admin/');

/** 设置包含路径 */
@set_include_path(get_include_path() . PATH_SEPARATOR .
__TYPECHO_ROOT_DIR__ . '/var' . PATH_SEPARATOR .
__TYPECHO_ROOT_DIR__ . __TYPECHO_PLUGIN_DIR__);

/** 载入API支持 */
require_once 'Typecho/Common.php';

/** 程序初始化 */
Typecho_Common::init();

/** 定义数据库参数 */
$db = new Typecho_Db("Pdo_Pgsql", 'typecho_');

// 按优先级获取数据库连接 URL
$database_url = getenv('DATABASE_URL') ?: getenv('POSTGRES_URL') ?: getenv('PRISMA_DATABASE_URL');

if ($database_url) {
    $parts = parse_url($database_url);
    
    // 提取基础连接信息
    $host   = $parts['host'] ?? 'localhost';
    $port   = $parts['port'] ?? 5432;
    $user   = $parts['user'] ?? '';
    $pass   = $parts['pass'] ?? '';
    $dbname = isset($parts['path']) ? ltrim($parts['path'], '/') : 'postgres';
    
    // 解析查询参数（如 sslmode）
    $query = [];
    if (isset($parts['query'])) {
        parse_str($parts['query'], $query);
    }
    $sslmode = $query['sslmode'] ?? null;
    
    // 构建配置数组
    $config = [
        'host'     => $host,
        'port'     => (int)$port,
        'user'     => $user,
        'password' => $pass,
        'database' => $dbname,
        'charset'  => 'utf8',
    ];
    
    // 如果 URL 中指定了 sslmode，则添加到配置中（适配器会自动拼接到 DSN）
    if ($sslmode) {
        $config['sslmode'] = $sslmode;
    }
    
    $db->addServer($config, Typecho_Db::READ | Typecho_Db::WRITE);
} else {
    // 后备：如果未设置新变量，仍使用旧的环境变量（可选）
    $db->addServer([
        'host'     => getenv('PGHOST') ?: 'localhost',
        'port'     => 5432,
        'user'     => getenv('PGUSER') ?: '',
        'password' => getenv('PGPASSWORD') ?: '',
        'database' => getenv('PGDATABASE') ?: 'postgres',
        'charset'  => 'utf8',
    ], Typecho_Db::READ | Typecho_Db::WRITE);
}

Typecho_Db::set($db);
