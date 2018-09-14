<?php
/**
 * Created by PhpStorm.
 * User: STALKER
 * Date: 11.09.2018
 * Time: 15:58
 */

require_once('../model/db.php');

if(isset($_POST['parser']) && $_POST['parser'] == 'parser_site') {
    
    $array_select = [];
    
    $db = new db();

    $sql = "SELECT * FROM post LIMIT 100";
    
    $result = $db->select($sql);
    
    if(!$result == null) {
        while($row = $result->fetch_assoc()) {
            $array_select[] = $row['name'];
        }
    }
    
    $end_result = file_get_contents('https://pikabu.ru');
    $end_result = iconv('CP1251', 'UTF-8', $end_result);
    preg_match_all('|<a.* class="story__title-link">(.*)</a>|U', $end_result, $count);

    $return = '';
    
    foreach ($count[1] as $item) {

        if(!in_array($item, $array_select)) {
            $db->insert('post', ['name' => $item, 'created_at' => time()]);
            $return .= "<div>$item</div>";
        }
    }
    
    if(!empty($return)) {
        echo $return;
        return;
    }
}

echo 'NO_NEW_POST';