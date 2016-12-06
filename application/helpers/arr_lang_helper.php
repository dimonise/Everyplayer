<?php
function arr_lang($lang=null){
    if($lang == 'ru'){
 $data['month_array_rus'] = array("01" => "Января",
            "02" => "Февраля",
            "03" => "Марта",
            "04" => "Апреля",
            "05" => "Мая",
            "06" => "Июня",
            "07" => "Июля",
            "08" => "Августа",
            "09" => "Сентября",
            "10" => "Октября",
            "11" => "Ноября",
            "12" => "Декабря");
    }
    else{
        $data['month_array_en'] = array("01" => "January",
            "02" => "February",
            "03" => "March",
            "04" => "April",
            "05" => "May",
            "06" => "June",
            "07" => "Jule",
            "08" => "August",
            "09" => "September",
            "10" => "October",
            "11" => "November",
            "12" => "December");
    }
        return $data;
}