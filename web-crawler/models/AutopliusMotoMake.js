const mongoose = require("mongoose");

const autopliusMotoMakeSchema = new mongoose.Schema({
  autoplius_id : String,
  title : String
});

const AutopliusMotoMake = mongoose.model("AutopliusMotoMake", autopliusMotoMakeSchema);

exports.AutopliusMotoMake = AutopliusMotoMake;
