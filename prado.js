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
    socket.on("user_connected", function (user_id) { // user conected works
    console.log("user_id", user_id);
        users[user_id] = socket.id; //user id como key
        io.emit('updateUserStatus', users);
    });

    socket.on('disconnect', function() { // user disconected
        var i = users.indexOf(socket.id);
        users.splice(i, 1, 0); //buscamos la key asociada al socket.id y lo eliminamos works
        io.emit('updateUserStatus', users);
    });

    socket.on('sendDebateToServer', (data) => { // Debate messages works
        socket.broadcast.emit('sendDebateToClient', data);
        socket.broadcast.emit('sendMesageDebateToClient', data);
    });

    socket.on("eventCalendarRefetchToServer", function() { //Calendar Events works
        socket.broadcast.emit('eventCalendarRefetchToClient');
    });

    socket.on("sendNewStaffToServer", function(data) { // assing new staff works
        socket.broadcast.emit('sendNewStaffToClient', data);
    });

    socket.on("sendChangeAppProcedureToServer", function(response) { // change procedure app works 
        socket.broadcast.emit('sendChangeAppProcedureToClient', response);
    });

    socket.on("sendChangeAppPackageToServer", function(response) { // change package app works
        socket.broadcast.emit('sendChangeAppPackageToClient', response);
    });

    socket.on('sendNewNotificationToServer', function(data) { //notifications works
        socket.broadcast.emit('sendNewNotificationToClient', data);
    });

    socket.on('updateDataTablesToServer', function() { //update datatables works
        socket.broadcast.emit('updateDataTablesToClient');
    });

    socket.on('sendChangeAppStatusToServer', function(data){
        socket.broadcast.emit('sendChangeAppStatusToclient', data) //works
    })
});

server.listen(3000, () => {
});