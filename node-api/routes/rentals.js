const express = require('express');
const router = express.Router();
const {Rental, validate} = require('../models/rental');
const {Movie} = require('../models/movie');
const {Customer} = require('../models/customer');

router.get("/", async (req, res) => {
  const rentals = await Rental.find()
  res.send(rentals)
})

router.get("/:id", async (req, res) => {
  const rental = await Rental.findById(req.params.id)
  res.send(rental)
})

router.post("/", async (req, res) => {
  try {
    let customer = await Customer.findById(req.body.customerId)
    let movie = await Movie.findById(req.body.movieId)
    const rental = new Rental({
      customer : {
        _id : customer._id,
        name : customer.name,
        phone : customer.phone,
      },
      movie: {
        _id: movie._id,
        title: movie.title,
        dailyRentalRate: movie.dailyRentalRate
      }

    })
    rental = await rental.save();

    movie.numberInStock--;
    await movie.save();

    res.send(rental);
  }
  catch (ex) {
    res.send(ex.message)
  }
})


module.exports = router;
