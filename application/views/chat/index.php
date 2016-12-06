<div class="container">
    <div class="row">
        <div class="news">
            <div class="col-md-3 col-sm-3 col-xs-12 menu_klan">
                <div class="row">
                    <div class="nav_chat_uzor"></div>
                    <div class="nav_chat">
                        <div class="scroll-pane">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                Личные сообщения
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse ">
                                        <div class="panel-body">
                                            <ul>
                                                <?php
                                                foreach ($chatUser as $value) {
                                                    if ($value->type == 4) {
                                                        echo '<li><a href="#" data-type="4"  data-idchat="' . $value->room_id . '">' . $value->username . '</a></li>';
                                                    }
                                                }
                                                ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                Кланы
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul>
                                                <?php
                                                if($chatClan){
                                                    foreach ($chatClan as $value) {
                                                        if ($value->type == 3) {
                                                            echo '<li><a href="#" data-type="3" data-idchat="' . $value->room_id . '" >' . $value->name_clan . '</a></li>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                Группы
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <input class="button_chat1 add_group" name="" value="Создать группу"
                                                   type="button">
                                            <ul class="group_name">
                                                <?php
                                                if($chatGroup){
                                                    foreach ($chatGroup as $value) {
                                                        echo '<li><a class="group_choice" href="#" data-type="5" data-idchat="' . $value->room_id . '" data-groupaddid="' . $value->user_id . '">' . $value->name . '</a></li>';
                                                    }
                                                }

                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFourth">
                                                Друзья
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFourth" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul>
                                                <?php
                                                $friends=[];
                                                $fSend=[];
                                                foreach ($chatUser as $value) {
                                                    if ($value->type == 1) {
                                                        echo '<li><a href="#" data-type="1" data-idchat="' . $value->room_id . '">' . $value->username . '</a></li>';
                                                        $friends[] = $value->username;
                                                        $fSend[$value->username]=$value->user_id;

                                                    }
                                                }
                                                $friends = json_encode($friends);
                                                $fSend = json_encode($fSend);
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="nav_chat_uzor2"></div>
                </div>
            </div>
            <div class="otstyp_klan other_chat">
                <div class="col-md-9 col-sm-9 col-xs-12 chat_right">
                    <div class="row" style="display: none">
                        <div class="chat_vivod_nazvanie">
                            <h3>Группа “Говорилка”</h3>
                        </div>
                        <div class="chat_vivod_uchasniki" >
                            <div class="chat_uchasnik chat-group-user" style="display: none;">
                                <p><span>Вишко (Николай)</span></p>
                                <div class="close_uchasnik"><p>X</p></div>
                            </div>
                        </div>

                        <div class="chat_add_g">
                            <input name="" class="chat_add_people" placeholder="+ Добавить собеседника" type="text">
                            <input name="" class="chat_add_people_id"  type="hidden">
                            <input class="button_chat2 button-add-user-to-group" name="" value="Добавить" type="button">
                        </div>

                        <div class="chat_message_all">
                            <div class="scroll-pane">

                                <div class="chat_message1 mess-view" style="display: none">
                                    <div class="chat_message_close">
                                        <p>X</p>
                                    </div>
                                    <div class="chat_message_avatar"></div>
                                    <div class="chat_message_people">
                                        <h4>$ALLIKA (Саша) <span>Вчера 22:43</span></h4>
                                        <p>Привет, когда будешь стабильно играть? Привет, когда будешь
                                            стабильно играть? Привет, когда будешь стабильно играть? Привет, когда
                                            будешь стабильно играть? Привет, когда будешь стабильно играть? Привет,
                                            когда будешь стабильно играть?</p>
                                    </div>
                                </div>
                                <div class="chat_message1 mess-not-view" style="display: none">
                                    <div class="chat_message_close">
                                        <p>X</p>
                                    </div>
                                    <div class="chat_message_avatar"></div>
                                    <div class="chat_message_people">
                                        <h4 class="chat_message_neproch">Вишко (Николай) <span>Вчера 22:43</span></h4>
                                        <p>Привет, когда будешь стабильно играть? Привет, когда будешь стабильно
                                            играть?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="chat_message_napisanie">
                                <form class="form-mess">
                                    <input name="id_user" class="id-user-mess" type="hidden">
                                    <input name="id_chat" class="id-chat-mess" type="hidden">
                                    <textarea class="text_mess" placeholder="Сообщение" name="mess"></textarea>
                                    <input name="" value="отправить" class="button_chat3 send_chat_mess" type="submit">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div id="popup_add_group" style="display: none; position: absolute; z-index: 10002; left: 100px">
    <div class="container">
        <div class="row">
            <button class="close" title="Закрыть">
                <img alt="" src="/images/close.png">
            </button>
            <div class="popup_podlogka">
                <form id="mail" method="post">
                    <h4>Добавить группу</h4>
                    <input type="text" class="popup_input" placeholder="Название группы" value="" name="name" required>
                    <input class="popup_button" type="button" value="Создать">
                </form>
            </div>

        </div>
    </div>
</div>
<div class="cover" style="display: none"></div>
<script type="application/javascript">
    window.addEventListener('load', function () {

        var idchat =0;
        var idgroup =0;
        var timeUpdate = 7000;
        var name ="<?=$this->session->userdata('username')?>";
        var userId ="<?=$this->session->userdata('id')?>";
        var availableTags = $.parseJSON('<?=$friends?>');
        var friendArr = $.parseJSON('<?=$fSend?>');

        /*Автокомплит для подгрузки друзей что бы была возможность добавить в группу */
        $( ".chat_add_people" ).autocomplete({
            source: availableTags
        });
        $( ".chat_add_people" ).on( "autocompleteclose", function( event, ui ) {
            var n = $(this).val();
            var id = 0;
            if(friendArr[n]){
                id = friendArr[n];
            }
            $('.chat_add_people_id').val(id);
        } );

        /*Добавления пользователей в группу */
        $(".button-add-user-to-group").on("click", function () {
            var id = $(".chat_add_people_id").val();
            if(id>0){
                $.ajax({
                    url: '/chat/ajax_add_user_group',
                    method: 'POST',
                    data: {user_id: id, room_id:idchat},
                    success: function (response) {
                        var id = JSON.parse(response);
                        id = parseInt(id);
                        var n = $(".chat_add_people").val();
                        $(".chat_add_people").val('');
                        if(!id){
                            alert('Пользователь не существует или уже добавлен в эту группу!');
                            return false;
                        }
                        var el = $('.chat-group-user').clone();
                        el.attr('class', 'chat_uchasnik add-group-user');
                        el.find("p span").text(n);
                        if(idgroup == userId){
                            el.find(".close_uchasnik").data('userid',id);
                        }else{
                            el.find(".close_uchasnik").remove();
                        }
                        el.show();
                        $(".chat_vivod_uchasniki").append(el);
                     }
                });
            }else{
                alert('Пользователь не существует или уже добавлен в эту группу!');
            }
        });

        /*Добавления группы */
        $('.close').on('click', function () {
            $("#popup_add_group").css('display', 'none');
            $(".cover").css('display', 'none');
        })
        $(".add_group").click(function () {
            var topp = ($(this).offset().top);
            var lef = ($(this).offset().left) - 100;
            $("#popup_add_group").css("top", topp);
            $("#popup_add_group").css("left", lef);
            $("#popup_add_group").css('display', 'block');
            $(".cover").css('display', 'block');
            $("#popup_add_group").css('x')
        })
        $('.popup_button').click(function () {
            $.ajax({
                url: '/chat/ajax_add_group',
                method: 'POST',
                data: $('#mail').serialize(),
                success: function (response) {
                    var arr = JSON.parse(response);
                    if(arr['room_id']==0){
                        alert('Имя группы существует!');
                    }else{
                        $('.group_name').append('<li><a class="group_choice" href="#" data-idchat="' + arr['room_id'] + '" data-groupaddid="' + userId + '">' + arr['name'] + '</a></li>');
                        $(".cover").css('display', 'none');
                        $("#popup_add_group").css('display', 'none');
                        clickName();
                        removeMess();
                    }


                }
            });
            return false;
        });

        /*Удаление группы*/
        function removeGroup() {
            $(".remove-group").on("click", function () {
                if(idchat>0){
                    $.ajax({
                        url: '/chat/ajax_remove_group',
                        method: 'POST',
                        data: { room_id:idchat},
                        success: function (response) {
                            location.reload()
                        }
                    });
                }

            })
        }

        /*Удаление участника группы*/
        function removeGroupUser() {
            $(".close_uchasnik").on("click", function () {
                var id = $(this).data('userid');
                var el = $(this).parent();
                if(idchat>0 && id>0){
                    $.ajax({
                        url: '/chat/ajax_remove_user_group',
                        method: 'POST',
                        data: {room_id:idchat, user_id:id},
                        success: function (response) {
                            el.remove();
                        }
                    });
                }

            })
        }

        /*Загрузка сообщений пол клику на пользоватетелей, группы, кланы*/
        function clickName() {
            $('.panel-body a').on('click', function () {

                /*Если выбрана группа то загружаем список участников группы*/
                if(idchat == $(this).data('idchat'))
                {
                    return false;
                }
                $(".chat_right .row").show();
                idchat = $(this).data('idchat');

                if ($(this).attr('class') == 'group_choice') {

                    idgroup = $(this).data('groupaddid');
                    $('.chat_vivod_uchasniki').show();
                    if(idgroup == userId){
                        $('.chat_add_g').show();
                        $('.chat_vivod_nazvanie h3').html($(this).text() + '<span class="remove-group">Удалить группу</span>');
                    }else{
                        $('.chat_vivod_nazvanie h3').html($(this).text());
                    }
                    removeGroup();
                    $.ajax({
                        url: '/chat/ajax_get_user_group',
                        method: 'POST',
                        data: {room_id:idchat},
                        success: function (response) {
                            var arr = JSON.parse(response);
                            if(arr == false){
                                location.reload();
                            }
                            $('.add-group-user').remove();
                            for(var i = 0; i<arr.length; i++){
                                var n = arr[i]['username'];
                                var id = arr[i]['user_id'];
                                var el = $('.chat-group-user').clone();
                                el.attr('class', 'chat_uchasnik add-group-user');
                                el.find("p span").text(n);
                                if(idgroup == userId && userId!=id){
                                    el.find(".close_uchasnik").data('userid',id);
                                }else{
                                    el.find(".close_uchasnik").remove();
                                }
                                el.show();
                                $(".chat_vivod_uchasniki").append(el);
                            }
                            removeGroupUser();

                        }
                    });

                } else {
                    $('.chat_vivod_uchasniki').hide();
                    $('.chat_add_g').hide();
                    $('.chat_vivod_nazvanie h3').text($(this).text());
                    idgroup = 0;
                }

                $(".id-chat-mess").val(idchat);
                getMessage(idchat, "all");
                return false;

            });

        }

        /*Обновления сообщений если выбран пользователь*/
        var timerId = setTimeout(function tick() {
            if(idchat){
                getMessage(idchat, "update");
            }
            timerId = setTimeout(tick, timeUpdate);
        }, timeUpdate);

        /*Отправка сообщения*/
        $(".form-mess").on("submit", function () {
            var messSend = $(this).serialize();
            var mess = $(".text_mess").val();
            $(".text_mess").val("");
            var d = new Date();
            $.ajax({
                url: '/chat/ajax_send_message',
                method: 'POST',
                data: messSend,
                success: function (response) {
                    var id = JSON.parse(response);
                    id = parseInt(id);
                    if(!id){
                        location.reload();
                        return false;
                    }
                    var el = $(".mess-view").clone();
                    var update = el.find(".chat_message_people");
                    el.attr("class","chat_message1 add-chat-mess");
                    el.data('messid',id );
                    update.find("h4").html(name+" <span>"+d.getDate()+"."+(d.getMonth()+1)+"."+d.getFullYear()+" "+d.getHours()+":"+(d.getMinutes()<10?("0"+d.getMinutes()):d.getMinutes())+"</span>");
                    update.find("p").text(mess);
                    el.show();
                    $(".chat_message_all .scroll-pane").append(el);


                }
            });
            return false;

        });

        clickName();

        /*Метод для получения или обновления сообщений*/
        function getMessage(id, type) {
            var lastId = 0;
            if(type=="all"){
                $(".chat_message_all .scroll-pane").find('.add-chat-mess').remove();
            }else{
                var lastId = $(".chat_message_all .scroll-pane").find('.add-chat-mess').last().data('messid');
                if(!lastId){
                    lastId = 0;
                }
            }

            $.ajax({
                url: '/chat/ajax_get_message',
                method: 'POST',
                data: {room_id: id, last_id: lastId},
                success: function (response) {
                    var arr = JSON.parse(response);
                    for(var i = 0; i<arr.length; i++){
                        var d = new Date((arr[i]["create_date"]*1000));
                        var name= arr[i]["username"];
                        var uId= arr[i]["user_id"];
                        var mess = arr[i]["mess"];
                        var el = $(".mess-view").clone();
                        var update = el.find(".chat_message_people");
                        el.attr("class","chat_message1 add-chat-mess");
                        el.data('messid',arr[i]["chat_mess_id"] );
                        if(uId!=userId){
                            el.find(".chat_message_close").remove();
                        }
                        update.find("h4").html(name+" <span>"+d.getDate()+"."+(d.getMonth()+1)+"."+d.getFullYear()+" "+d.getHours()+":"+(d.getMinutes()<10?("0"+d.getMinutes()):d.getMinutes())+"</span>");
                        update.find("p").text(mess);
                        el.show();
                        $(".chat_message_all .scroll-pane").append(el);
                    }
                    removeMess();

                }
            });
        }



        /*Удаление сообщений*/
        function removeMess() {
            $('.chat_message_close').on('click', function () {
                var el = $(this).parent();
                var id =el.data('messid');
                if(id>0){
                    $.ajax({
                        url: '/chat/ajax_remove_message',
                        method: 'POST',
                        data: {mess_id: id},
                        success: function (response) {
                            el.remove();
                        }
                    });
                }

            });
        }
    }, false);
</script>