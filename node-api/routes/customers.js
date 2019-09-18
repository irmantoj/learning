const express = require('express');
const router = express.Router();
const { Customer, validate } = require("../models/customer");

router.get('/', async (req, res) => {
  const customer = await Customer.find()
  res.send(customer)
});

router.get('/:id', async (req, res) => {
  try {
    const customer = await Customer.findById(req.params.id)
    res.send(customer)
  }
  catch (ex) {
    res.status(404).send(ex.message)
  }
});

router.post('/', async (req, res) => {
  try {
    let { error } = validate(req.body)
    if (error) return res.status(400).send(error);
    let customer = new Customer({
      name : req.body.name,
      phone : req.body.phone,
      isGold : req.body.isGold
    })
    customer = await customer.save()
    res.send(customer)
  }
  catch (ex) {
    res.status(400).send(ex.message)
  }
});

router.put('/:id', async (req, res) => {
  try {
    let { error } = validate(req.body)
    if (error) return res.status(400).send(error);
    let customer = await Customer.findByIdAndUpdate(req.params.id, {
      name : req.body.name,
      phone : req.body.phone,
      isGold : req.body.isGold
    }, {new : true})
    res.send(customer)
  }
  catch (ex) {
    res.status(404).send(ex.message)
  }
});

router.delete('/:id', async (req, res) => {
  try {
    let customer = await Customer.findByIdAndDelete(req.params.id)
    res.send(customer)
  }
  catch (ex) {
    res.status(404).send(ex.message)
  }
});

module.exports = router
