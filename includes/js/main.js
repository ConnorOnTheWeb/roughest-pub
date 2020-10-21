/* RoughEst - Instant Estimate Calculator / Built By Inland Applications */

document.addEventListener('DOMContentLoaded', () => {
  //
  //
  // RoughEst SQFT
  //
  //
  //
  //
  //

  var runWidgets = Array.from(
    document.getElementsByClassName('roughest-unique-run')
  );
  console.log(runWidgets);

  if (runWidgets) {
    for (i = 0; i < runWidgets.length; i++) {
      console.log(runWidgets[i].value);

      var str = runWidgets[i].value;

      // RoughEst Run

      document.getElementById('calculate-' + str).onclick = function () {
        // Get the current button's unique id
        var current = this.id.replace(/^\D+/g, '');

        //create a string to match the instance
        var currentWidget = 'roughest_widget_run-' + current;
        console.log('this is:' + currentWidget);

        /* collect variables */
        var roughestVal1 = document.getElementById('val-1-' + currentWidget)
          .value;

        var roughestMult = document.getElementById('mult-' + currentWidget)
          .value;

        var roughestLow = document.getElementById('range-low-' + currentWidget)
          .value;

        var roughestHigh = document.getElementById(
          'range-high-' + currentWidget
        ).value;

        /* validate inputs */
        if (!roughestVal1) {
          document
            .getElementById('validation-' + currentWidget)
            .classList.remove('roughest-display-none');
          document
            .getElementById('disclaimer-' + currentWidget)
            .classList.add('roughest-display-none');
          document.getElementById('range-' + currentWidget).innerHTML = '';
          throw new Error('No value!');
        } else {
          document
            .getElementById('validation-' + currentWidget)
            .classList.add('roughest-display-none');
          document
            .getElementById('disclaimer-' + currentWidget)
            .classList.remove('roughest-display-none');
        }

        /* generate cost */
        var totalCost = roughestVal1 * roughestMult;

        /* find low range value */
        var rangeLow = totalCost * roughestLow;
        rangeLow = rangeLow.toFixed(0);

        /* find high range value */
        var rangeHigh = totalCost * roughestHigh;
        rangeHigh = rangeHigh.toFixed(0);

        /* super fancy comma time */
        function numberWithCommas(x) {
          return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        /* create a string for the range */
        var theRange =
          '$' +
          numberWithCommas(rangeLow) +
          ' - $' +
          numberWithCommas(rangeHigh);

        console.log(theRange);

        /* render that range */
        var rangeContain = document.getElementById('range-' + currentWidget);
        rangeContain.innerHTML = theRange;
      };
    }
  }

  //
  //
  // RoughEst SQFT
  //
  //
  //
  //
  //

  var sqftWidgets = Array.from(
    document.getElementsByClassName('roughest-unique-sqft')
  );

  if (sqftWidgets.length) {
    console.log(sqftWidgets);
  } else {
    console.log('no sqft widgets');
  }

  if (sqftWidgets) {
    for (i = 0; i < sqftWidgets.length; i++) {
      console.log(sqftWidgets[i].value);

      var str = sqftWidgets[i].value;

      // RoughEst Run

      document.getElementById('calculate-' + str).onclick = function () {
        // Get the current button's unique id
        var current = this.id.replace(/^\D+/g, '');

        //create a string to match the instance
        var currentWidget = 'roughest_widget_sqft-' + current;
        console.log('this is:' + currentWidget);

        /* collect variables */
        var roughestVal1 = document.getElementById('val-1-' + currentWidget)
          .value;
        var roughestVal2 = document.getElementById('val-2-' + currentWidget)
          .value;

        var roughestMult = document.getElementById('mult-' + currentWidget)
          .value;

        var roughestLow = document.getElementById('range-low-' + currentWidget)
          .value;

        var roughestHigh = document.getElementById(
          'range-high-' + currentWidget
        ).value;

        /* validate inputs */
        if (
          (!roughestVal1 && !roughestVal2) ||
          (roughestVal1 > 0 && !roughestVal2) ||
          (roughestVal2 > 0 && !roughestVal1)
        ) {
          document
            .getElementById('validation-' + currentWidget)
            .classList.remove('roughest-display-none');
          document
            .getElementById('disclaimer-' + currentWidget)
            .classList.add('roughest-display-none');
          document.getElementById('range-' + currentWidget).innerHTML = '';
          throw new Error('No value!');
        } else {
          document
            .getElementById('validation-' + currentWidget)
            .classList.add('roughest-display-none');
          document
            .getElementById('disclaimer-' + currentWidget)
            .classList.remove('roughest-display-none');
        }

        /* total squarefoot */
        var totalSqft = roughestVal1 * roughestVal2;

        /* generate cost */
        var totalCost = totalSqft * roughestMult;

        /* find low range value */
        var rangeLow = totalCost * roughestLow;
        rangeLow = rangeLow.toFixed(0);

        /* find high range value */
        var rangeHigh = totalCost * roughestHigh;
        rangeHigh = rangeHigh.toFixed(0);

        /* super fancy comma time */
        function numberWithCommas(x) {
          return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        /* create a string for the range */
        var theRange =
          '$' +
          numberWithCommas(rangeLow) +
          ' - $' +
          numberWithCommas(rangeHigh);

        console.log(theRange);

        /* render that range */
        var rangeContain = document.getElementById('range-' + currentWidget);
        rangeContain.innerHTML = theRange;
      };
    }
  }
}); // later
