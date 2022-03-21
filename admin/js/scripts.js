 $('#summernote').summernote({
     name: 'post_content',
     placeholder: 'Content',
     tabsize: 2,
     height: 200
});


$(document).ready(function (){
   $('#SelectAll').click(function (event){
        if (this.checked){
          $('.CheckBox').each(function (){
               this.checked = true;
          })
        }
        else {
             $('.CheckBox').each(function (){
                  this.checked = false;
             })
        }
   });
});
