<?php
    include 'crawler.php';
    $crawler = new Crawler("http://imae.hs.kr/?act=lunch.main2&month=".date("Y.m.d")."&mcode=");

    $data = json_decode(file_get_contents('php://input'), true);
    $content = $data["content"];

    switch($content)
    {
        case "중식":
            $lunch = $crawler->getLunch();
            // $lunch = "왜 안되냐... \\n 왜...";
            echo '
                {
                    "message":
                    {
                        "text": "'.$lunch.'"
                    },
                    "keyboard":
                    {    
                        "type": "buttons",
                        "buttons": ["중식", "석식"]
                    }
                }';
            break;
 
        case "석식":
            $dinner = $crawler->getDinner();
            echo '
                {
                    "message":
                    {
                        "text": "'.$dinner.'"
                    },
                    "keyboard":
                    {    
                        "type": "buttons",
                        "buttons": ["중식", "석식"]
                    }
                }';
            break;
 
        default:
            echo '
                {
                    "message":
                    {
                        "text": "잘못된 값입니다."
                    },
                    "keyboard":
                    {    
                        "type": "buttons",
                        "buttons": ["중식", "석식"]
                    }
                }';
            break;
    }
?>