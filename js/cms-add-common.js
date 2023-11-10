$('#form').submit(function(evt) {
                evt.preventDefault();
                $("#loading").show();
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
                 if(data.status=="ok"){
                	$("#form").trigger("reset");
                  	showselected.innerHTML="";
                  }
                   Dialog(data.message);
                   refreshData();
                },
                error: function(data) {
                	
                }
               });
  });

function toggle(section){
$.post({url:baseurl+'cms/togglesections',data:{"section":section}});
}