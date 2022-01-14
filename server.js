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
        console.log("user_id", user_id);
        users[user_id] = socket.id; //user id como key
        io.emit('updateUserStatus', users);
    });

    socket.on('sendNotification', function(event) {
        console.log("event", event);
        io.emit('reciverNotification', event);
    });

    socket.on('sendChatToServer', (data) => {
        socket.broadcast.emit('sendChatToClient', data);
    });

    socket.on('sendChatNotification', (data) => {
        console.log("dataNot", data);
        socket.broadcast.emit('reciveChatNotification', data);
    });

    socket.on('disconnect', function() {
        var i = users.indexOf(socket.id);
        users.splice(i, 1, 0); //buscamos la key asociada al socket.id y lo eliminamos
        io.emit('updateUserStatus', users);
    });

});

server.listen(3000, () => {
    console.log("3000", 3000);
});