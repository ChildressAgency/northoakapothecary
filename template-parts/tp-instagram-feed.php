
<div class="instagram">
    <div class="instagram__controls">
        <a class="instagram__link" target="blank" href="<?php echo get_field( 'instagram', 'option' ); ?>"><i class="fab fa-instagram"></i></a>
        <div class="instagram__next"><div class="instagram__triangle"></div></div>
        <div class="instagram__prev"><div class="instagram__triangle"></div></div>
    </div>

    <div class="instagram__feed">
        <?php
        function fetchData($url){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }
        
        $url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . get_sub_field( 'access_token' );
        $result = fetchData( $url );
        
        $result = json_decode($result);
        foreach ($result->data as $post) { ?>
            <a target="blank" href="<?php echo $post->link; ?>"><img src="<?php echo $post->images->low_resolution->url; ?>" /></a>
        <?php }
        
        ?>
    </div>

</div>