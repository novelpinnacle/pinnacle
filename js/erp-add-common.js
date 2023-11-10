$('#form').submit(function(evt) {
                evt.preventDefault();
                $("#loading").css("display","block");
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
                     $("#loading").css("display","none");
                     if(data.status=="ok" || data.status==true){
                      	$("#form").trigger("reset");
                        if(document.getElementById("showselected")!==null){
                          $("#showselected").html("");
                        }
                        if(document.getElementById("setvideolecture")!==null){
                          $("#setvideolecture").append(data.data);
                        }
                        if(typeof refreshData =='function'){
                          refreshData();
                        }
                     }
                     $("#form input[type=submit]").attr("disabled",false);
                      openModal({title:'Status',content:data.message});
                }
               });
  });

function showDelete(delid,ele){
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      modal:true,
      buttons: {
        "Delete": function() {
        deleteData(delid,ele);
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
 }