<?php
    /*$inservices = [
        'staging.wclarke.dev'
    ];
    $arr_inservices = array();
    foreach($inservices as $inservice){
        $cht = curl_init($inservice);
        curl_setopt($cht, CURLOPT_HEADER, true);
        curl_setopt($cht, CURLOPT_NOBODY, true);
        curl_setopt($cht, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($cht, CURLOPT_TIMEOUT,10);
        $output = curl_exec($cht);
        $httpcode = curl_getinfo($cht, CURLINFO_HTTP_CODE);
        curl_close($cht);
        $status = "offline";
        if ($httpcode == 200 || $httpcode == 301) $status = "online";
        #echo json_encode(array('url' => $url,'status' => $status, 'code' => $httpcode));
        array_push($arr_inservices, array($inservice,$status,$httpcode));
    }*/

    $urls = [
        'www.wclarke.me',
        #'cdn.wclarke.me',
        'blog.wclarke.me'#,
        #'view.wclarke.me',
        #'staging.wclarke.dev'
    ];
    $arr_urls = array();
    foreach ($urls as $url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $status = "offline";
        if ($httpcode == 200 || $httpcode == 301) $status = "online";
        #echo json_encode(array('url' => $url,'status' => $status, 'code' => $httpcode));
        array_push($arr_urls, array($url,$status,$httpcode));
    }
    $i = 0;
    $arrurls_len = count($arr_urls);
?>
<!doctype html><html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Status page - status.wclarke.dev</title>
        <meta name="title" content="Status page - status.wclarke.dev">
        <meta name="description" content="View the status of my websites, internal systems and servers all from the same place!">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://status.wclarke.dev">
        <meta property="og:title" content="Status page - status.wclarke.dev">
        <meta property="og:description" content="View the status of my websites, internal systems and servers all from the same place!">
        <!--<meta property="og:image" content="https://metatags.io/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png">-->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="https://status.wclarke.dev">
        <meta property="twitter:title" content="Status page - status.wclarke.dev">
        <meta property="twitter:description" content="View the status of my websites, internal systems and servers all from the same place!">
        <!--<meta property="twitter:image" content="https://metatags.io/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png">-->
        <script src="https://kit.fontawesome.com/505b8db572.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme :{
                    extend:{
                        colors:{
                            'deep-space':'#171819',
                            'space':'#272728',
                            'el-blue':'#C1EEFD'
                        }
                    }
                }
            }
        </script>
    </head>
    <body>
        <nav class="bg-deep-space">
        </nav>
        <main class="bg-deep-space">

            <section class="container mx-auto text-el-blue" id="">
                <h1>test</h1>
                <?php while ($i < $arrurls_len){
                    ?><div class="bg-space flex flex-row" id="<?php echo $i."-Sec";?>"><?php
                        $url = $arr_urls[$i][0];
                        $status = $arr_urls[$i][1];
                        if($status == 'online'){
                            ?>
                            <span class="bg-green-500 py-2 px-3 rounded-full m-2"><i class="fa-solid fa-angle-up"></i></span>
                            <?php
                        } elseif($status == 'offline'){
                            ?>
                            <span class="bg-red-500 py-2 px-3 rounded-full"><i class="fa-solid fa-angle-down"></i></span>
                            <?php
                        }
                        ?>
                        <h3 class="text-el-blue font-semibold text-lg"><a href="<?php echo 'http://'.$url;?>" class="hover:underline" target="_blank"><?php echo $url;?></a><h3>
                        <?php
                        /*for ($x = 1; $x < 3; $x++){
                            ?>
                            <span><?php echo $res[$i][$x];?></span>
                            <?php
                        }*/
                    ?></div><?php
                    ?><br><?php
                    $i++;
                }?>
            </section>

        </main>
        <footer class="bg-deep-space"></footer>
    </body>

    <script>
        window.setInterval('refresh()', 30000); 	
        function refresh() {
            window .location.reload();
        }
    </script>
</html>