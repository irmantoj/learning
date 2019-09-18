const Joi = require('joi');
const mongoose = require('mongoose');
const { customerSchema } = require("../models/customer");
const { movieSchema } = require("../models/movie");

const rentalSchema = new mongoose.Schema({
  customer : {
    type : customerSchema,
    required : true
  },
  movie : {
    type : movieSchema,
    required : true
  },
  dateOut: {
    type: Date,
    required: true,
    default: Date.now
  },
  dateReturned: {
    type: Date
  },
  rentalFee: {
    type: Number,
    min: 0
  }
})

const Rental = mongoose.model("Rental", rentalSchema);

// function validateMovie(movie) {
//   const schema = {
//     name : Joi.string().min(3).max(255).required(),
//     numberAtStock : Joi.number(),
//     dailyRentalRate : Joi.number()
//   }
// }

// exports.validate = validateMovie;
exports.Rental = Rental;
