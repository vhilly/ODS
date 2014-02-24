var
  io = require('socket.io').listen(app),
  fs = require('fs'),
  http=require('http');
  express = require('express'),
  mysql = require('mysql'),
  connectionsArray = [],
  connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'mysqladmin',
    database: 'online_delivery',
    port: 3306
  });

var app=express();
var server= http.createServer(app).listen(8081,function(){
    console.log('listening on http:/localhost:8080');
});
app.configure(function(){
   app.use('/assets',express.static(__dirname+'/assets'));
});
app.use(express.errorHandler());

connection.connect(function(err) {
  console.log(err);
});


app.get('/',function(req, res) {
  fs.readFile(__dirname + '/client.html', function(err, data) {
    if (err) {
      console.log(err);
      res.writeHead(500);
      return res.end('Error loading client.html');
    }
    res.writeHead(200);
    res.end(data);
  });
});


var updatedOrders = function() {

  var query = connection.query('SELECT o.id id,c.name cname,c.phone_1 tel,o.branch_name branch_name,status,DATE_FORMAT(date_ordered,"%d-%m-%Y %H:%i:%s") date_ordered,DATE_FORMAT(date_updated,"%d-%m-%Y %H:%i:%s") date_updated,DATE_FORMAT(delivery_date,"%d-%m-%Y %H:%i:%s") delivery_date,o.is_advance FROM orders o,customers c  WHERE o.customer_id=c.id AND status IN (0,1,2,3) ORDER by o.is_advance ,date_ordered ASC'),
    orders = []; // this array will contain the result of our db query

  query
    .on('error', function(err) {
      console.log(err);
      updateSockets(err);
    })
    .on('result', function(order) {
      orders.push(order);
    })
    .on('end', function() {
      updateSockets({orders:orders});
    });

};




io.sockets.on('connection', function(socket) {
  console.log('A new socket is connected!');
  socket.on('join',function(room){
    socket.join(room);
    updatedOrders();
  });
  socket.on('updateOrders',function(){
    updatedOrders();
  });
});
var updateSockets = function(data){
  data.time = new Date();
  io.sockets.in('test').emit('notification',data);
}
