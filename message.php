<?php
    include 'crawler.php';

    $data = json_decode(file_get_contents('php://input'), true);
    $content = $data["content"];
 
    switch($content)
    {
        case "중식":
            
        
            echo '
                {
                    "message":
                    {
                        "text": "중식을 선택하셨습니다."
                    },
                    "keyboard":
                    {
                        "type": "buttons",
                        "buttons": ["메뉴1", "메뉴2", "메뉴3"]
                    }
                }';
            break;
 
        case "석식":
            echo '
                {
                    "message":
                    {
                        "text": "석식을 선택하셨습니다."
                    },
                    "keyboard":
                    {
                        "type": "buttons",
                        "buttons": ["메뉴1", "메뉴2", "메뉴3"]
                    }
                }';
            break;
 
        default:
            echo '
                {
                    "message":
                    {
                        "text": "잘못된 벨류입니다."
                    },
                    "keyboard":
                    {
                        "type": "buttons",
                        "buttons": ["메뉴1", "메뉴2", "메뉴3"]
                    }
                }';
            break;
    }
?>