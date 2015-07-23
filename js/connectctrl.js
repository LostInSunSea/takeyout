var app = angular.module('connect', []);
app.controller('connectCtrl', function($scope, $interval) {
    $scope.users = [];

    var myID;

    $.get(
        "get_users.php",
        {},
        function(data) {
            var parsed = JSON.parse(data);
            for(var i = 0; i < parsed.length; i++) {
                var obj = parsed[i];
                $scope.users.push(
                    {
                        id:obj.id,
                        job:obj.job,
                        name:obj.name,
                        location:obj.location,
                        pictureurl:obj.pictureurl,
                        industry:obj.industry,
                        tagline:obj.tagline,
                        bio:obj.bio
                    }
                );
            }

            $scope.$digest();
        });

    /*$scope.users.push({
            id:"thisistheid",
            job:"Code Tester",
            name:"Tester McTester",
            location:"Palo Alto",
            pictureurl:"http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg",
            industry:"Testing",
            tagline:"I am a user intended for testing purposes",
            bio:"This is my testing bio"
        }
    );*/
});
