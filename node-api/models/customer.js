const Joi = require('joi');
const mongoose = require('mongoose');

const customerSchema = new mongoose.Schema({
  name : {
    type : String,
    required : true,
    minlength : 3,
    maxlength : 50
  },
  isGold : {
    type : Boolean,
    default : false
  },
  phone : {
     type : Number,
     required : true
   }
});

const Customer = mongoose.model("Customer", customerSchema);

function validateCustomer(customer) {
  const schema = {
    name : Joi.string().min(3).max(50).required(),
    isGold : Joi.boolean(),
    phone : Joi.number()
  }
  return Joi.validate(customer, schema)
}

exports.Customer = Customer;
exports.customerSchema = customerSchema;
exports.validate = validateCustomer;
