$('#form').submit(function(evt) {
    evt.preventDefault();
    $("#loading").show();
    $("#form input[type=submit]").attr("disabled",true);
    var formData = new FormData(this);
    $.ajax({
          type: 'POST',
          url: $(this).attr('action'),
          data:formData,
          cache:false,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(data) {
            $("#loading").hide();
            $("#form input[type=submit]").attr("disabled",false);
            openModal({title:'Status',content:data.message});
            if(document.getElementById("showselected")!==null){
                $("#showselected").html("");
            }
            if(typeof refreshData == 'function'){
              refreshData();
            }
          }
   });
});