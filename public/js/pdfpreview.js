$(document).ready(function() {
 var fileArr = [];
  $("#file_upload").change(function(){
     // check if fileArr length is greater than 0
      if (fileArr.length > 0) fileArr = [];
    
       $('#image_preview').html("");
       var total_file = document.getElementById("file_upload").files;
       if (!total_file.length) return;
       for (var i = 0; i < total_file.length; i++) {
         if (total_file[i].size > 20 * 1024 * 1024) {
           alert('Upload File size Less then 2 Mb');
           total_file[i].pop();
           return false;
         } else { 
           var fileName=event.target.files[i].name;
         var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
           var array = ['pdf', 'jpg', 'jpeg', 'png']; 
           var image=['jpg','jpeg','png'] ;
           if(array.indexOf(ext) <= -1) 
           {
            alert("Only jpg, jpeg, png and pdf files are supported");  
               return false;
           }
           else
           {
            if(image.indexOf(ext) <= -1) 
            {
                $('#image_preview').append("<div class='img-div' id='img-div"+i+"'><div class='pull-right'><button id='action-icon' value='img-div"+i+"' class='btn btn-danger btn-sm ' role='"+total_file[i].name+"'><i class='fa fa-close'></i></button>&nbsp;&nbsp;</div><embed src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive' title='"+total_file[i].name+"'  style='height:140px; width:140px;pointer-events: none;'></div>");
            }
            else
            {
              
                $('#image_preview').append("<div class='img-div' id='img-div"+i+"'><div class='pull-right'><button id='action-icon' value='img-div"+i+"' class='btn btn-danger btn-sm' role='"+total_file[i].name+"'><i class='fa fa-close'></i></button>&nbsp;&nbsp;</div><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive' title='"+total_file[i].name+"'  style='height:140px; width:140px; object-fit: cover'></div>");
            } 
           }
          
         }
       }
  });
 
 $('body').on('click', '#action-icon', function(evt){
     var divName = this.value;
     var fileName = $(this).attr('role');
     $(`#${divName}`).remove();
   
     for (var i = 0; i < fileArr.length; i++) {
       if (fileArr[i].name === fileName) {
         fileArr.splice(i, 1);
       }
     }
   document.getElementById('safeguard_file').files = FileListItem(fileArr);
     evt.preventDefault();
 });
 
  function FileListItem(file) {
           file = [].slice.call(Array.isArray(file) ? file : arguments)
           for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
           if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
           for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
           return b.files
       }
});