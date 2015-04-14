/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $("#a_table").hide();
    $("#b_table").hide();
    $("#c_table").hide();

    $("#a").click(function () {
        $("#a_table").show();
        $("#b_table").hide();
        $("#c_table").hide();
    });

    $("#b").click(function () {
        $("#b_table").show();
        $("#a_table").hide();
        $("#c_table").hide();
    });

    $("#c").click(function () {
        $("#c_table").show();
        $("#a_table").hide();
        $("#b_table").hide();
    });
});


