//Load HTTP module
var express = require('express')
var app = express()
var messageOfLove = 'Hello World!'

app.get('/', function (req, res) {
  res.send(messageOfLove)
  console.log('Sent ' + messageOfLove)
})

app.listen(8000, function () {
  console.log('Example app listening on port 8000!')
})