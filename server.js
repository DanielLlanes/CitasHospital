const express = require('express');
const app = express();
const server = require('http').createServer(app);
// var Redis = require('ioredis');
// var redis = new Redis();
var users = [];
var groups = [];

const io = require('socket.io')(server, {
    cors: { origin: "*"}
});
// redis.subscribe('debate-chanel', function() {
// });

// redis.on('message', function(channel, message) {
//     message = JSON.parse(message);
//     console.log("channel", channel);
//     console.log("message", message);
// });


io.on('connection', (socket) => {
    socket.on("user_connected", function (user_id) {
        users[user_id] = socket.id; //user id como key
        io.emit('updateUserStatus', users);
    });

    // socket.on("joinDebate", function (data) {
    //     data['socket_id'] = socket.id;
    //     if (groups[data.group_id]) {
    //         console.log("group already exist");
    //         var userExist = checkIfUserExistInGroup(data.user_id, data.group_id);

    //         if (!userExist) {
    //             groups[data.group_id].push(data);
    //             socket.join(data.room);
    //         } else {
    //             var index = groups[data.group_id].map(function(o) {
    //                 return o.user_id;
    //             }).indexOf(data.user_id);

    //             groups[data.group_id].splice(index,1);
    //             groups[data.group_id].push(data);
    //             socket.join(data.room);
    //         }
    //     } else {
    //     console.log("nwe group");
    //         groups[data.group_id] = [data];
    //         socket.join(data.room);
    //     }
    // });
    // 
    socket.on('sendChatToServer', (data) => {
        console.log("data", data);
        
        socket.broadcast.emit('sendChatToClient', data);
    });

    socket.on('disconnect', function() {
        var i = users.indexOf(socket.id);
        users.splice(i, 1, 0); //buscamos la key asociada al socket.id y lo eliminamos
        io.emit('updateUserStatus', users);
    });
    
});

server.listen(3000, () => {
});
function checkIfUserExistInGroup(user_id, group_id) {
    var group = groups[group_id];
    var exist = false;
    if (groups.length > 0) {
        for (var i = 0; i < group.length; i++) {
            if (group[i]['user_id'] == user_id) {
                exist = true;
                break;
            }
        }
    }

    return exist;
}
