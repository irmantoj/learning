const express = require('express');
const router = express.Router();
const { Movie, validate } = require("../models/movie");
const {Genre} = require('../models/genre');

router.get("/", async (req, res) => {
  const movies = await Movie.find();
  res.send(movies);
});

router.get("/:id", async (req, res) => {
  try {
    const movies = await Movie.findById(req.params.id);
    res.send(movies)
  }
  catch (ex) {
    console.log(ex.message)
    res.status(404).send(ex.message)
  }
});

router.post("/", async (req, res) => {
  let genre = await Genre.findById(req.body.genreId);
  let movie = await new Movie({
    title : req.body.title,
    genre : {
      _id: genre._id,
      name: genre.name
    },
    numberAtStock : req.body.numberAtStock,
    dailyRentalRate : req.body.dailyRentalRate
  });
  movie = await movie.save();
  res.send(movie);
});

router.put("/:id", async (req, res) => {
  let genre = await Genre.findById(req.body.genreId);
  let movie = await Movie.findByIdAndUpdate(req.params.id, {
    title : req.body.title,
    genre : {
      _id: genre._id,
      name: genre.name
    },
    numberAtStock :  req.body.numberAtStock || 0,
    dailyRentalRate : req.body.dailyRentalRate || 0
  }, {new : true})
  res.send(movie)
});

router.delete("/:id", async (req, res) => {
  let movie = await Movie.findByIdAndDelete(req.params.id);
  res.send(movie);
});

module.exports = router
