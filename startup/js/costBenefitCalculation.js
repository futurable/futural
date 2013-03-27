$(document).ready(function(){
    // Turnover
    $("#CostbenefitItem_turnover_value").keyup(function(){
        var monthly = $("#CostbenefitItem_turnover_value").val();
        var yearly = monthly * 12;
        
        $("#turnover").val(yearly);
    });
    $("#turnover").keyup(function(){
       var yearly = $("#turnover").val();
       var monthly = yearly / 12;
       monthly = Math.round(monthly*100) / 100;
       
       $("#CostbenefitItem_turnover_value").val(monthly);
    });

});