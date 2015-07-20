var app = angular.module('chat', []);
app.controller('chatCtrl', function($scope) {
    $scope.chatName = "myChat";

    var myID = "Jerry";
    var convoID = 123
    var toID = "Justin";
    var myPicURL = "http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg";
    var toPicURL = "http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg";

    //TODO: Query id, toID, convoID, and both pictures from convo

    $scope.messages=[];

    $.get(
        "retrieve_message.php",
        {conversationID : convoID},
        function(data) {
            var parsed = JSON.parse(data);
            for(var i = 0; i < parsed.length; i++) {
                var obj = parsed[i];

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

    $scope.sendChat = function(){
        var message = document.getElementById("btn-input").value;
        $scope.messages.push({
            message: message,
            leftPic:"https://upload.wikimedia.org/wikipedia/en/4/45/One_black_Pixel.png",
            rightPic:"http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg",
            leftClass:"",
            rightClass:"col-md-2 col-xs-2 avatar",
            dateTime:"Timothy • 51 min",
            base:"row msg_container base_sent"
        });

        document.getElementById("btn-input").value = "";

        $.post( "add_message.php", { message: message, from:myID, to:toID, convoID:convoID}, function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
        });

        $scope.$digest();
    }
});