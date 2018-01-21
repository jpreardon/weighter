// Enter today's date in date field
var today = new Date()
var dd = today.getDate()
var mm = today.getMonth()+1 //January is 0!
var yyyy = today.getFullYear()

// Add leading zero if needed to day and month
if(dd<10) {
    dd = '0'+dd
} 
if(mm<10) {
    mm = '0'+mm
} 

// Populate the field
today = yyyy + '-' + mm + '-' + dd
document.getElementById("date").value = today

// Get the last weight
var xhr = new XMLHttpRequest()

xhr.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var weights = JSON.parse(this.responseText)
    getLastWeight(weights)
  }
}

xhr.open("GET", "http://api.jpreardon.com/weights", true)
xhr.send()

// TODO: Replace this function with one in the API
function getLastWeight(weightsArray) {
  var lastRecord = weightsArray.length - 1
  var lastWeighDate = weightsArray[lastRecord].date
  var lastWeight = weightsArray[lastRecord].weight

  document.getElementById("lastWeighDate").innerHTML = lastWeighDate
  document.getElementById("lastWeight").innerHTML = lastWeight
  document.getElementById("lastWeighInfo").style.display = 'block'
}

// This was lifted (mostely) from MDN
function sendData() {
  var xhr2 = new XMLHttpRequest();
  var urlEncodedData = "";
  var urlEncodedDataPairs = [];
  var name;
  var date = document.getElementById("date")
  var weight = document.getElementById("weight")

  // Turn the data object into an array of URL-encoded key/value pairs.
  urlEncodedDataPairs.push(encodeURIComponent(date.name) + '=' + encodeURIComponent(date.value))
  urlEncodedDataPairs.push(encodeURIComponent(weight.name) + '=' + encodeURIComponent(weight.value))

  // Combine the pairs into a single string and replace all %-encoded spaces to 
  // the '+' character; matches the behaviour of browser form submissions.
  urlEncodedData = urlEncodedDataPairs.join('&').replace(/%20/g, '+');

  // Define what happens on successful data submission
  xhr2.addEventListener('load', function(event) {
    successfulSend(xhr2.responseText)
  });

  // Define what happens in case of error
  xhr2.addEventListener('error', function(event) {
    failSend()
  });

  // Set up our request
  xhr2.open('POST', 'http://api.jpreardon.com/weights');

  // Add the required HTTP header for form data POST requests
  xhr2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  // Finally, send our data.
  xhr2.send(urlEncodedData);
}

// XHR success function
function successfulSend(responseText) {
  // Hide the form and other information
  document.getElementById("weightEntryForm").style.display = "none"
  document.getElementById("lastWeighInfo").style.display = "none"

  var reponseMessage

  // Inspect the response and craft the message accordingly
  if (responseText == "1") {
     // Find out how much was gained or lost, round to 2 decimal places
    var lost = round(Number(document.getElementById("lastWeight").innerHTML) - Number(document.getElementById("weight").value), 2)


    if (lost > 0) {
      // Weight lost!
      responseMessage = "Congrats! You lost " + lost.toString() + " pounds!"
    } else if (lost == 0) {
      // Flat
      responseMessage = "You lost nothing, call it a success."
    } else {
      // Weight gain, this is a negative number, so chop off the "-" before displaying
      responseMessage = "You gained <strong>" + lost.toString().substring(1) + " pounds</strong>! Get motivated!!!"
    }
  } else if (responseText  == "0") {
    // No rows affected, mystery!
    responseMessage = "Your entry may not have been recorded, try again."
  } else {
      var response = JSON.parse(responseText)

      if (response.code == "ER_DUP_ENTRY") {
        // We don't allow updates at the moment
        responseMessage = "A weight already exists for that date, enter a different date, or brush up on your SQL skilz..."
      } else {
        responseMessage = response
      }
  }

  // Set the response message and display it
  document.getElementById("responseMessage").innerHTML = responseMessage + addAnotherButton()
  document.getElementById("responseMessage").style.display = "block"
}

// XHR failure function
function failSend() {
  document.getElementById("weightEntryForm").style.display = "none"
  document.getElementById("lastWeighInfo").style.display = "none"

  var reponseMessage = "Something went horribly wrong, maybe try again."

  document.getElementById("responseMessage").innerHTML = responseMessage
  document.getElementById("responseMessage").style.display = "block"
}

// Round function
function round(value, decimals) {
  return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
}

// Add another button
function addAnotherButton() {
  return "<button class='stand-alone-button' onclick='addAnother()'>Add Another Weight</button>"
}

function addAnother() {
  document.getElementById("weight").value = ""
  document.getElementById("weightEntryForm").style.display = "block"
  document.getElementById("responseMessage").style.display = "none"
}