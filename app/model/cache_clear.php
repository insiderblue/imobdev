<?php 

$cache_clear = $pdo->prepare('UPDATE real_estates SET real_estate_clear_cache = :real_estate_clear_cache WHERE real_estate_id = :real_estate_id');

if (isset($_REQUEST["cache_cleared"])) : 

    $cache_clear->execute(
        array(
            'real_estate_clear_cache'   => 0,
            'real_estate_id'            => $_REQUEST["real_estate_id"]
        )
    );

else : 

    $cache_clear->execute(
        array(
            'real_estate_clear_cache'   => 1,
            'real_estate_id'            => $_REQUEST["real_estate_id"]
        )
    );

endif; 