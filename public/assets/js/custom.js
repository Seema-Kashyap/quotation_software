/*------------------------------------------------------------------
    File Name: custom.js
    Template Name: Pluto - Responsive HTML5 Template
    Created By: html.design
    Envato Profile: https://themeforest.net/user/htmldotdesign
    Website: https://html.design
    Version: 1.0
-------------------------------------------------------------------*/

/*--------------------------------------
	sidebar
--------------------------------------*/

"use strict";


/*--------------------------------------
    chart js
--------------------------------------*/

$(function () {
    // Fetch data from the Laravel API using AJAX
    $.ajax({
      url: 'http://127.0.0.1:8000/get-graph-data',
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        // Extract the relevant data from the API response
        var datasetData = [data.create, data.open, data.won, data.lost];

        // Create a new chart with dynamic data
        var ctx = document.getElementById("bar_chart").getContext("2d");
        var chartConfig = getChartJs(datasetData);
        new Chart(ctx, chartConfig);
      },
      error: function (error) {
        console.error("Error fetching data: " + error);
      }
    });
  });

  function getChartJs(datasetData) {
    var config = {
      type: 'bar',
      data: {
        labels: ["Create", "Open", "Won", "Lost"],
        datasets: [{
        //   label: "Current Month Data",
          data: datasetData, // Use dynamic dataset data
          backgroundColor: ['#ffffff', '#ffffff', '#ffffff', '#ffffff'], // Customize colors as needed
          borderWidth: 1,
          borderRadius: 10,
          borderSkipped: false,
          color: '#ffffff'
        }]
      },
      options: {
        responsive: true,
        legend: {
          display: false
        },
        scales: {
          x: {
            ticks: {
              color: '#ffffff' // Change 'fontColor' to 'color'
            }
          },
          y: {
            ticks: {
              color: '#ffffff' // Change 'fontColor' to 'color'
            }
          }
        }
      }

    };
    return config;
  }

