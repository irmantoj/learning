const express = require('express');
const app = express();
const genres = require('./routes/genres');
const customers = require('./routes/customers');
const movies = require('./routes/movies');
const rentals = require('./routes/rentals');
const mongoose = require("mongoose");

mongoose.connect("mongodb://localhost:27017/vibly", {useNewUrlParser: true})
  .then(() => console.log("Connected to mongodb"))
  .catch((err) => console.log("Not connected to mongodb"))
app.use(express.json());

app.use('/api/genres', genres)
app.use('/api/customers', customers)
app.use('/api/movies', movies)
app.use("/api/rentals", rentals)
app.listen(3000);
