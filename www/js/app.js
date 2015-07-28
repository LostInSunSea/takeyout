(function() {
    'use strict';

    var app = angular.module('app', ['irontec.simpleChat']);

    angular.module('app').controller('Shell', Shell);

  function Shell() {

    var vm = this;

      $.get(
          "http://kawaiikrew.net/www/php/retrieve_message.php",
          {conversationID : 123},
          function(data) {
              var parsed = JSON.parse(data);
              for(var i = 0; i < parsed.length; i++) {
                  var obj = parsed[i];

                  vm.messages.push({
                      'username': obj.username,
                      'content': obj.content
                  });

              }

          }
      );

    vm.messages = [{
        username: "Elise",
        content: "Hello"
    },{
        username: "Yue Zhao",
        content: "Hi nice to meet you"
    },{
        username: "Elise",
        content: "These are some preloaded messages"
    },{
        username: "Yue Zhao",
        content: "Click 'send' to send a new message"
    }
    ];

    vm.username = 'Yue Zhao';

    vm.sendMessage = function(message, username) {
      if(message && message !== '' && username) {

          $.post( "http://kawaiikrew.net/www/php/add_message.php", { message: message} );

          vm.messages.push({
          'username': username,
          'content': message
        });
      }
    };

  }

})();
