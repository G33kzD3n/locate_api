var server = require('http').Server();
var io = require('socket.io')(server);
server.listen(4000);

// http.listen(4000, function () {
//    console.log('listening on *:3000');
// });
io.on('connection', (socket) => {
   console.log("connection made");
   socket.on('location', (bus) => {
      console.log("From Client" + bus);
      setInterval(() => {
         io.emit('location', "{ lat: 34.45, lng: 56.900 }");
      }, 4000);
      // io.emit('location', "{ lat: 34.45, lng: 56.900 }");
      // io.emit('location', "{ lat: 34.45, lng: 56e2e32}");
      // io.emit('location', "{ lat: 34.45, lng: 56e2e32}");
      // io.emit('location', "{ lat: 34.45, lng: 56e2e32}");
      // io.emit('location', "{ lat: 34.45, lng: 56e2e32}");
      // io.emit('location', "{ lat: 34.45, lng: 56e2e32}");
      // }
   });
});