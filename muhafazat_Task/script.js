$(document).ready(function () {
  // Load countries on page load
  $.ajax({
    url: "fetch.php?action=getCountries",
    type: "GET",
    success: function (data) {
      let response = JSON.parse(data); // Parse the entire response
      if (response.error) {
        alert("Error fetching countries");
        return;
      }

      // Append each country to the dropdown
      response.geonames.forEach((country) => {
        if (country.geonameId && country.countryName) {
          // Ensure country has required fields
          $("#country").append(
            `<option value="${country.geonameId}">${country.countryName}</option>`
          );
        }
      });
    },
    error: function () {
      alert("An error occurred while loading countries.");
    },
  });

  // When the user selects a country
  $("#country").on("change", function () {
    let countryId = $(this).val();

    if (countryId) {
      // Enable the governorate dropdown and clear previous values
      $("#governorate")
        .prop("disabled", false)
        .html('<option value="">Select Governorate</option>');
      $("#judiciary")
        .prop("disabled", true)
        .html('<option value="">Select Judiciary</option>');

      // Fetch governorates based on country ID
      $.ajax({
        url: `fetch.php?action=getGovernorates&countryId=${countryId}`,
        type: "GET",
        success: function (data) {
          let governorates = JSON.parse(data);
          console.log(governorates); // Log the response for debugging
          if (governorates.error) {
            alert("Error fetching governorates");
            return;
          }

          // Append each governorate to the dropdown
          governorates.geonames.forEach((governorate) => {
            $("#governorate").append(
              `<option value="${governorate.geonameId}">${governorate.name}</option>`
            );
          });
        },
        error: function () {
          alert("An error occurred while loading governorates.");
        },
      });
    } else {
      $("#governorate")
        .prop("disabled", true)
        .html('<option value="">Select Governorate</option>');
      $("#judiciary")
        .prop("disabled", true)
        .html('<option value="">Select Judiciary</option>');
    }
  });

  // When the user selects a governorate
  $("#governorate").on("change", function () {
    let regionId = $(this).val();

    if (regionId) {
      // Enable the judiciary dropdown and clear previous values
      $("#judiciary")
        .prop("disabled", false)
        .html('<option value="">Select Judiciary</option>');

      // Fetch judiciaries based on governorate ID
      $.ajax({
        url: `fetch.php?action=getJudiciaries&regionId=${regionId}`, // Ensure the parameter matches your PHP script
        type: "GET",
        success: function (data) {
          let judiciaries = JSON.parse(data);

          // Check if judiciaries have results
          if (judiciaries.geonames && judiciaries.geonames.length > 0) {
            // Append each judiciary to the dropdown
            judiciaries.geonames.forEach((judiciary) => {
              $("#judiciary").append(
                `<option value="${judiciary.geonameId}">${judiciary.toponymName}</option>`
              );
            });
          } else {
            alert("No judiciaries available for the selected governorate.");
          }
        },
        error: function () {
          alert("An error occurred while fetching judiciaries.");
        },
      });
    } else {
      $("#judiciary")
        .prop("disabled", true)
        .html('<option value="">Select Judiciary</option>');
    }
  });
});
