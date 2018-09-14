<?php
/**
 * Created by PhpStorm.
 * User: STALKER
 * Date: 10.09.2018
 * Time: 13:13
 */

require_once('../model/db.php');

/*
 * для создания таблицы необходимо перейти в консоли в каталог migration
 * и запустить команду php createDB.php
 */

$db = new db();

// Создание таблицы
$sql = "
CREATE TABLE IF NOT EXISTS post (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name text NOT NULL,
    created_at INT(6) NOT NULL
)
";

$db->execSQL($sql);
