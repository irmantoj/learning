const mongoose = require("mongoose");
const Joi = require('joi');
const { genreSchema } = require("../models/genre");

const movieSchema = new mongoose.Schema({
  title : {
    type : String,
    minlength : 3,
    maxlength : 255,
    required : true
  },
  genre : {
    type : genreSchema,
    required : true
  },
  numberAtStock : {
    type : Number,
    default : 0
  },
  dailyRentalRate : {
    type : Number,
    default : 0
  }
});

const Movie = mongoose.model("Movie", movieSchema);

function validateMovie(movie) {
  const schema = {
    name : Joi.string().min(3).max(255).required(),
    genreId : Joi.required(),
    numberAtStock : Joi.number(),
    dailyRentalRate : Joi.number()
  }
}

exports.Movie = Movie;
exports.movieSchema = movieSchema;
exports.validate = validateMovie;
