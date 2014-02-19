var app = require('http').createServer(handler),
  io = require('socket.io').listen(app),
  fs = require('fs'),
  mysql = require('mysql'),
  connectionsArray = [],
  connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'mysqladmin',
    database: 'online_delivery',
    port: 3306
  });

connection.connect(function(err) {
  console.log(err);
});

app.listen(8000);

function handler(req, res) {
  if(req.url=='/graph'){
  fs.readFile(__dirname + '/graph.html', function(err, data) {
    if (err) {
      console.log(err);
      res.writeHead(500);
      return res.end('Error loading client.html');
    }
    res.writeHead(200);
    res.end(data);
  });
  }
  if(req.url=='/monitor'){
  fs.readFile(__dirname + '/monitor.html', function(err, data) {
    if (err) {
      console.log(err);
      res.writeHead(500);
      return res.end('Error loading client.html');
    }
    res.writeHead(200);
    res.end(data);
  });
  }
}


var updatedOrders = function() {

  var query = connection.query('SELECT o.id id,c.name cname,c.phone_1 tel,o.branch_name branch_name,status,DATE_FORMAT(date_ordered,"%d-%m-%Y %H:%i:%s") date_ordered,DATE_FORMAT(date_updated,"%d-%m-%Y %H:%i:%s") date_updated,DATE_FORMAT(delivery_date,"%d-%m-%Y %H:%i:%s") delivery_date,o.is_advance FROM orders o,customers c  WHERE o.customer_id=c.id AND status IN (0,1,2,3) ORDER by o.is_advance ,date_ordered ASC'),
    orders = []; // this array will contain the result of our db query

  query
    .on('error', function(err) {
      console.log(err);
    })
    .on('result', function(order) {
      orders.push(order);
    })
    .on('end', function() {
      updateSockets('notification',{orders:orders});
    });

}
var updateGraph = function(socket){
  var query2 = connection.query('SELECT b.id id,b.name,o.date_ordered dt,HOUR(o.date_ordered) as hr,count(o.id) cnt,IFNULL(SUM(o.total_amt ),0) amt '+
                                'FROM branches b LEFT JOIN orders o '+
                                'ON b.id = o.branch_id AND b.is_active=1 AND DATE(o.date_ordered) = CURDATE()'+
                                'GROUP BY b.id,hr'),
    chartdata = []; // this array will contain the result of our db query

  query2
    .on('error', function(err) {
      console.log(err);
    })
    .on('result', function(data) {
      chartdata.push(data);
    })
    .on('end', function() {
      socket.emit('graph',{chartdata:chartdata});
    });

};



io.sockets.on('connection', function(socket) {
  console.log('A new socket is connected!');
  socket.on('join',function(room){
    socket.join(room);
    updatedOrders();
    updateGraph(socket);
  });
  socket.on('updateOrders',function(){
    updatedOrders();
  });
  socket.on('updateSeries',function(data){
     updateSockets('seriesUpdate',{chart:data});
  });
});
var updateSockets = function(name,data){
  data.time = new Date();
  io.sockets.in('test').emit(name,data);
}
