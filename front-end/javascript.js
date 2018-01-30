// API Endpoint
var endPoint = "http://api.jpreardon.com/weights"

// Put today's date in date field
document.getElementById("date").value = getTodaysDate()

// Get the last weight
getData(endPoint + "?datefilter=max", function(response) {
  if(response != 0) {
    var weights = JSON.parse(response)
    document.getElementById("lastWeighDate").innerHTML = dateOnly(weights[0].date)
    document.getElementById("lastWeight").innerHTML = weights[0].weight
    document.getElementById("lastWeighInfo").style.display = 'block'
  }
})

// Get the date history
getData(endPoint + "?datefilter=last7", function(response) {
  if(response != 0) {
    var historyTable = "<h4>History</h4><table>"
    var weightHistory = JSON.parse(response)
    weightHistory.forEach(function(reading) {
      historyTable = historyTable + "<tr><td>" + dateOnly(reading.date) + "</td><td>" + reading.weight + "</td></tr>"
    })

    historyTable = historyTable + "</table>"
    document.getElementById("history").innerHTML = historyTable
  }
})

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
  xhr2.open('POST', endPoint);

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

// getData Function
function getData(url, callback) {
  var xhr = new XMLHttpRequest()

  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      callback(this.responseText)
    } 
  }

  xhr.open("GET", url, true)
  xhr.send()
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

// This function returns a short date, in a particular format because the API is inserting time zone
// TODO: There are some time zone issues here
function dateOnly(dateString) {
  var longDate = new Date(dateString)
  var dd = zeroPad(longDate.getUTCDate(), 2)
  var mm = zeroPad(longDate.getUTCMonth()+1, 2) //January is 0!
  var yyyy = longDate.getUTCFullYear()

  return yyyy + '-' + mm + '-' + dd
}

function getTodaysDate() {
  var today = new Date()
  var dd = zeroPad(today.getDate(), 2)
  var mm = zeroPad(today.getMonth()+1, 2) //January is 0!
  var yyyy = today.getFullYear()

  return yyyy + '-' + mm + '-' + dd
}

function zeroPad(number, length) {
  if(number.toString().length < length) {
    number = Array(length - number.toString().length + 1).join("0") + number
  }
  return number
}