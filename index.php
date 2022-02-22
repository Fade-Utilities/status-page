<?php
    function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }   
    $sites = [
        'www.wclarke.me',
        'cdn.wclarke.me',
        'blog.wclarke.me',
        'view.wclarke.dev',
        'staging.wclarke.dev'
    ];
    $arr_sites = array();
    foreach ($sites as $site) {
        $ch = curl_init($site);
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
        array_push($arr_sites, array($site,$status,$httpcode));
    }
    $i = 0;
    $sitearr_len = count($arr_sites);
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
    <body class="bg-deep-space">
        <nav class="bg-deep-space">
        </nav>
        <main class="bg-deep-space mt-5">
            <h1 class="text-4xl mb-16 text-center mx-auto text-el-blue font-bold">Will's Uptime</h1>
            <section class="container mx-auto text-el-blue" id="personal-sites-sevices">
                <?php
                //Temporary browser blocking
                function browserdata(){
                    if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)
                        return 'Internet explorer';
                    elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false)
                            return 'Internet explorer';
                    elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false)
                        return 'Mozilla Firefox';
                    elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false)
                        return 'Google Chrome';
                    elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false)
                        return "Opera Mini";
                    elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== false)
                        return "Opera";
                    elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false)
                        return "Safari";
                    else
                        return 'Other';
                }
                $browser = browserdata();
                if ($browser == 'Mozilla Firefox'){
                    ?>
                    <div class="flex flex-row mb-5 justify-between w-full">
                        <h1 class="text-2xl mb-5 place-self-start font-bold mx-auto my-auto">Personal Sites & Services</h1>
                        <div class="object-right place-self-end justify-center mx-auto">
                                <span class="text-el-blue font-semibold">Change refresh interval: </span><br>
                                <select id="interval" class="mt-2 hover:cursor-pointer text-el-blue rounded bg-transparent focus:text-black focus:bg-el-blue font-semibold border-el-blue border px-2 py-2 hover:text-black hover:bg-el-blue">
                                    <option class="text-el-blue bg-space" value="10000">10 Seconds</option>
                                    <option class="text-el-blue bg-space" value="20000">20 Seconds</option>
                                    <option class="text-el-blue bg-space"  value="30000">30 Seconds</option>
                                    <option class="text-el-blue bg-space" value="45000">45 Seconds</option>
                                    <option class="text-el-blue bg-space" value="60000">1 Minute</option>
                                </select>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <h1 class="text-2xl mb-5 font-bold">Personal Sites & Services</h1>
                    <?php
                }
                while ($i < $sitearr_len){
                    ?><div class="bg-space rounded flex flex-row" id="<?php echo $i."-Sec";?>"><?php
                        $url = $arr_sites[$i][0];
                        $status = $arr_sites[$i][1];
                        if($status == 'online'){
                            ?>
                            <span class="flex justify-center place-self-start m-5 bg-green-600 rounded-full text-center h-5 w-5"><i class="place-self-center fa-solid fa-angle-up"></i></span>
                            <?php
                        } elseif($status == 'offline'){
                            ?>
                            <span class="flex justify-center place-self-start m-5 bg-red-600 rounded-full text-center h-5 w-5"><i class="place-self-center  fa-solid fa-angle-down"></i></span>
                            <?php
                        } elseif($status == 'unknown'){
                            ?>
                            <span class="bg-zinc-400 flex justify-center place-self-start m-5 rounded-full text-center h-5 w-5"><i class="fa-solid fa-question"></i></span>
                            <?php
                        }
                        ?>
                        <h3 class="my-auto text-el-blue font-semibold text-lg"><a href="<?php echo 'http://'.$url;?>" class="hover:underline" target="_blank"><?php echo $url;?></a><h3>
                    </div>
                    <br><?php
                    $i++;
                }?>
                
                <?php if (!isMobile()) echo '<span>Site refreshes every 30 seconds by default to get latest status.</span><br>';
                else echo '<span>Site refreshes every minute by default to get latest status.</span><br>';?>
                <button class="mt-2 border-el-blue border px-3 py-2 rounded hover:bg-el-blue hover:text-black font-semibold" onclick="refresh()">Force Refresh</button>
            </section>

        </main>
        <footer class="bg-deep-space"></footer>
    </body>

    <script>
        <?php
        //Temp browser blocking
        if($browser == 'Mozilla Firefox'){
            ?>
            var getInterval = document.getElementById("interval")
            var interval = getInterval.options[getInterval.selectedIndex].value
            if (interval != 30000){time = interval}
            console.log(interval)
            <?php
        }?>
        var time = 30000
        <?php if (isMobile()) echo 'time = 10000' ?>
        console.log(time)
        window.setInterval('refresh()', time); 	
        function refresh() {
            window .location.reload();
        }
    </script>
</html>