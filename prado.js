const myModule = require('./protocol.js');
const { createServer } = require(myModule.protocol());
const { Server } = require("socket.io");

const httpServerOptions = myModule.protocol() !== 'http' ? {
  key: readFileSync('/etc/letsencrypt/live/api.jlpradosc.online/privkey.pem', 'utf8'),
  cert: readFileSync('/etc/letsencrypt/live/api.jlpradosc.online/cert.pem', 'utf8')
} : null;

const httpServer = createServer(httpServerOptions);

const options = {
  cors: '*',
  ...(myModule.protocol() !== 'http' && {
    key: httpServerOptions.key,
    cert: httpServerOptions.cert,
    ca: [readFileSync('/etc/letsencrypt/live/api.jlpradosc.online/chain.pem', 'utf8')]
  })
};

const io = new Server(httpServer, options);


io.on('connection', (socket) => {
    console.log('??');
    socket.on("user_connected", function (user_id) { // user conected works
        console.log("user_id", user_id);
        var ip_address = protocol;
        console.log(ip_address)
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
        console.log('calendar')
        socket.broadcast.emit('eventCalendarRefetchToClient');
    });

    socket.on("sendNewStaffToServer", function(data) { // assing new staff works
        socket.emit('sendNewStaffToClient', data);
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

    socket.on('sendChangeAppProcedureAndPackageToServer', function(data){
        socket.broadcast.emit('sendChangeAppProcedureAndPackageToClient', data) //works
    })

    socket.on('testTo', function(){
        socket.broadcast.emit('testToClient') //works
    })
});


httpServer.listen(3000, () => {
});