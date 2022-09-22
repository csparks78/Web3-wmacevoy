function calculateWeight() {
    var thrust = document.getElementById("thrustt").value;
    var motors = document.getElementById("motorss").value;
    var weight = document.getElementById("weightt").value;

    var result = (parseInt(thrust) * parseFloat(motors)) - parseFloat(weight);

    if (!isNaN(result)) {
      document.getElementById("answer").innerHTML = "Your craft will lift " + result + "g";
    }
  }

  function calculateThrust() {
    var field1 = document.getElementById("num1").value;
    var field2 = document.getElementById("num2").value;
    var field3 = document.getElementById("num3").value;
    var field4 = document.getElementById("num4").value;
    var one = 1;

    var result = ((parseInt(one) / parseInt(field1)) * (parseInt(field2) + parseInt(field4))) / (parseInt(field3));
    //var fixed = result.toFixed(2);
    if (!isNaN(result)) {
      document.getElementById("answer2").innerHTML = "Thrust per motor = " + result + "g";
    }
  }

  function calculateTime() {
    var batt = document.getElementById("batt").value;
    var amps = document.getElementById("amps").value;
    var result = (parseInt(batt) / 1000) * (.8 / parseInt(amps)) * 60;

    if (!isNaN(result)) {
      document.getElementById("answer3").innerHTML = "The flight time is approx " + result + "min";
    }
  }