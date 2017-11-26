var mongoose = require('mongoose');
var moment = require('moment');

var Schema = mongoose.Schema;

var AuthorSchema = Schema(
  {
    first_name: {type: String, required: true, max: 100},
    family_name: {type: String, required: true, max: 100},
    date_of_birth: {type: Date},
    date_of_death: {type: Date},
  }
);

// Virtual for author's full name
AuthorSchema
.virtual('name')
.get(function () {
  return this.family_name + ', ' + this.first_name;
});

// Virtual for author's URL
AuthorSchema
.virtual('url')
.get(function () {
  return '/catalog/author/' + this._id;
});

AuthorSchema
.virtual('lifespan')
.get(function () {
	var dateOfBirth = this.date_of_birth ? moment(this.date_of_birth).format('DD-MMM-YYYY').toUpperCase() : '';
	var dateOfDeath = this.date_of_death ? moment(this.date_of_death).format('DD-MMM-YYYY').toUpperCase() : '';
	return dateOfBirth + ' - ' + dateOfDeath;
});

//Export model
module.exports = mongoose.model('Author', AuthorSchema);