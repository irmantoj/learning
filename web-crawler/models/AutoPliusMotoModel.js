const mongoose = require("mongoose");

const autopliusMotoModelSchema = new mongoose.Schema({
  autoplius_id : String,
  title : String,

});

const AutopliusMotoModel = mongoose.model("AutopliusMotoModel", autopliusMotoModelSchema);

exports.AutopliusMotoModel = AutopliusMotoModel;
