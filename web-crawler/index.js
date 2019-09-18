const express = require('express');
const app = express();
const mongoose = require("mongoose");

mongoose.connect("mongodb://localhost:27017/moto-scrape", {useNewUrlParser: true})
  .then(() => console.log("Connected to mongodb"))
  .catch((err) => console.log("Not connected to mongodb"))

app.use(express.json());

//routes-------------------------------------------------------------------------------------------------------------
const moto = require('./routes/moto');


app.use('/api/moto', moto);

app.listen(3000)
