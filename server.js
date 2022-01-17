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


io.on('connection', (socket) => {
    socket.on("user_connected", function (user_id) { // user conected
        users[user_id] = socket.id; //user id como key
        io.emit('updateUserStatus', users);
    });

    socket.on('disconnect', function() { // user disconected
        var i = users.indexOf(socket.id);
        users.splice(i, 1, 0); //buscamos la key asociada al socket.id y lo eliminamos
        io.emit('updateUserStatus', users);
    });

    socket.on('sendDebateToServer', (data) => { // Debate messages
        socket.broadcast.emit('sendDebateToClient', data);
    });

    socket.on("eventCalendarRefetchToServer", function() { //Calendar Events
        socket.broadcast.emit('eventCalendarRefetchToClient');
    });

});

server.listen(3000, () => {
});