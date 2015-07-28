var app = angular.module('chat', []);
app.controller('chatCtrl', function($scope, $interval) {
    $scope.chatName = "myChat";

    var myID = "Jerry";
    var convoID = 123
    var toID = "Justin";
    var myPicURL = "http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg";
    var toPicURL = "http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg";
    var lastMessageIndex = 0;
    var newMsgCount = 0;
    var totalMessageCount;

    //By default, start with by retrieving the last 10 messages
    var messageLimit = 10;

    //TODO: Query id, toID, convoID, and both pictures from convo instead of using session data

    $.get(
        "./php/get_user_data.php",
        {},
        function(data){
            var userParsed = JSON.parse(data);
            //TODO: myID = userParsed.ID;
            myPicURL = userParsed.PicURL;
            console.log("Retrieving initial " + messageLimit + " messages");
            $.get(
                "http://kawaiikrew.net/www/php/retrieve_message.php",
                {conversationID : convoID, limit:messageLimit},
                function(data) {
                    var parsed = JSON.parse(data);
                    for(var i = 0; i < parsed.length; i++) {
                        var obj = parsed[i];
                        lastMessageIndex = obj.id;

                        if (obj.from == myID)
                        {
                            $scope.messages.push({
                                message: obj.message,
                                leftPic:"https://upload.wikimedia.org/wikipedia/en/4/45/One_black_Pixel.png",
                                rightPic:myPicURL,
                                leftClass:"",
                                rightClass:"col-md-2 col-xs-2 avatar",
                                dateTime:"Timothy • 51 min",
                                base:"row msg_container base_sent"
                            });
                        }
                        else
                        {
                            $scope.messages.push({
                                message:obj.message,
                                leftPic:toPicURL,
                                rightPic:"https://upload.wikimedia.org/wikipedia/en/4/45/One_black_Pixel.png",
                                leftClass:"col-md-2 col-xs-2 avatar",
                                rightClass:"",
                                dateTime:"Robb • 32 min",
                                base:"row msg_container base_receive"
                            });
                        }
                    }

                    $scope.$digest();
                }
            );
        }
    );

    $interval(function(){
        console.log("Refreshing chat with last message index of " + lastMessageIndex);
        $.get(
            "http://kawaiikrew.net/www/php/update_message.php",
            {conversationID : convoID, index:lastMessageIndex},
            function(data) {
                var parsed = JSON.parse(data);
                for(var i = 0; i < parsed.length; i++) {
                    var obj = parsed[i];
                    lastMessageIndex = obj.id;
                    newMsgCount += 1;
                    if (obj.from == myID)
                    {
                        $scope.messages.push({
                            message: obj.message,
                            leftPic:"https://upload.wikimedia.org/wikipedia/en/4/45/One_black_Pixel.png",
                            rightPic:myPicURL,
                            leftClass:"",
                            rightClass:"col-md-2 col-xs-2 avatar",
                            dateTime:"Timothy • 51 min",
                            base:"row msg_container base_sent"
                        });
                    }
                    else
                    {
                        $scope.messages.push({
                            message:obj.message,
                            leftPic:toPicURL,
                            rightPic:"https://upload.wikimedia.org/wikipedia/en/4/45/One_black_Pixel.png",
                            leftClass:"col-md-2 col-xs-2 avatar",
                            rightClass:"",
                            dateTime:"Robb • 32 min",
                            base:"row msg_container base_receive"
                        });
                    }
                }

                $scope.$digest();
            }
        );
    },5000);

    $scope.messages=[];

    $scope.sendChat = function(){
        var message = document.getElementById("btn-input").value;
        if (message == "")
        {
            return;
        }
        else {
            $scope.messages.push({
                message: message,
                leftPic: "https://upload.wikimedia.org/wikipedia/en/4/45/One_black_Pixel.png",
                rightPic: myPicURL,
                leftClass: "",
                rightClass: "col-md-2 col-xs-2 avatar",
                dateTime: "Timothy • 51 min",
                base: "row msg_container base_sent"
            })

            $.post( "./php/add_message.php", { message: message, from:myID, to:toID, convoID:convoID}, function(data, status){
                lastMessageIndex = data;
            });
        };

        document.getElementById("btn-input").value = "";


        $scope.$digest();
    }

    $scope.loadMore = function(){
        messageLimit += 10;
        console.log("Retrieving " + (messageLimit + newMsgCount) + " messages");
        $scope.messages = [];
        totalMessageCount = messageLimit + newMsgCount;
        $.get(
            "http://kawaiikrew.net/www/php/retrieve_message.php",
            {conversationID : convoID, limit:totalMessageCount},
            function(data) {
                var parsed = JSON.parse(data);
                for(var i = 0; i < parsed.length; i++) {
                    var obj = parsed[i];
                    lastMessageIndex = obj.id;

                    if (obj.from == myID)
                    {
                        $scope.messages.push({
                            message: obj.message,
                            leftPic:"https://upload.wikimedia.org/wikipedia/en/4/45/One_black_Pixel.png",
                            rightPic:myPicURL,
                            leftClass:"",
                            rightClass:"col-md-2 col-xs-2 avatar",
                            dateTime:"Timothy • 51 min",
                            base:"row msg_container base_sent"
                        });
                    }
                    else
                    {
                        $scope.messages.push({
                            message:obj.message,
                            leftPic:toPicURL,
                            rightPic:"https://upload.wikimedia.org/wikipedia/en/4/45/One_black_Pixel.png",
                            leftClass:"col-md-2 col-xs-2 avatar",
                            rightClass:"",
                            dateTime:"Robb • 32 min",
                            base:"row msg_container base_receive"
                        });
                    }
                }

                $scope.$digest();
            }
        );
    }
});