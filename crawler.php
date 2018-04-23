<?php
//2018-04-20 youngjun Min
    include 'simple_html_dom.php';

    class Crawler{
        protected $url;
        protected $domObject;

        public function Crawler($url){
           $this->url = $url;
           $this->domObject = $this->getPage();
        }

        public function getLunch(){
            $lunch = $this->domObject->find('#listContent #lunch .menuName p');
            return $this->messageCreator($lunch, "중식");
        }

        public function getDinner(){
            $dinner = $this->domObject->find('#listContent #dinner .menuName p');
            return $this->messageCreator($dinner, "석식");
        }

        protected function getPage(){
            $curl = curl_init(); 
            curl_setopt($curl, CURLOPT_URL, $this->url);  
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);  
            $str = curl_exec($curl);  
            curl_close($curl);  
             
            $html= str_get_html($str); 
            
            return $html;
        }

        protected function messageCreator($data, $time){
            foreach ($data as $menu) {
                $menu = $this->replacer($menu);
                $message = "";
                if($menu == "" || $menu == null){
                    $message .= "오늘은 급식이 없습니다."
                }else{
                    $message .= date("Y-m-d")." 오늘의 ".$time."은 \\n\\n";
                    $message .= $menu;
                    $message .= "\\n\\n입니다. 맛있게 드세요!";  
                }
                return $message;
            }
        }

        protected function replacer($text){
            $text = str_replace("<br />","\\n", $text);
            $text = str_replace(array("!","@","#","$",".",",","1","2","3","4","5","6","7","8","9","0","<p>","</p>"," ","*"), "", $text);
            return $text;
        }
    }
?>
