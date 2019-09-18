const express = require('express');
const router = express.Router();
const {Genre, validate} = require("../models/genre");

router.get('/', async (req, res) => {
  const genres = await Genre.find()
  res.send(genres)
});

router.get('/:id', async (req, res) => {
  try {
    const genre = await Genre.findById(req.params.id)
    res.send(genre)
  }
  catch (ex) {
    res.status(404).send(ex.message)
  }
});

router.post('/', async (req, res) => {
  try {
    let { error } = validate(req.body)
    if (error) return res.status(400).send(error);
    let genre = new Genre({
      name : req.body.name
    })
    genre = await genre.save()
    res.send(genre)
  }
  catch (ex) {
    res.status(400).send(ex.message)
  }
});

router.put('/:id', async (req, res) => {
  try {
    let { error } = validate(req.body)
    if (error) return res.status(400).send(error);
    let genre = await Genre.findByIdAndUpdate(req.params.id, {
      name : req.body.name
    }, {new : true})
    res.send(genre)
  }
  catch (ex) {
    res.status(404).send(ex.message)
  }
});

router.delete('/:id', async (req, res) => {
  try {
    let genre = await Genre.findByIdAndDelete(req.params.id)
    res.send(genre)
  }
  catch (ex) {
    res.status(404).send(ex.message)
  }
});

module.exports = router
