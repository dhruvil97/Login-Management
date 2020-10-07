jQuery(function($) {
	
  $(document).on('click','.rem-post',function(){ 	
		  var pid = $(this).attr('data-id');
		    currentRow = $(this).closest('.card');
        currentRow.slideUp("slow",function(){	
        });
        
        $.ajax({
        	type:'post',
        	url:"functions.php",
        	data:{'action':'deleteEntry','post': pid},
        })
	})

  $(document).on('click','.password_control',function(){
        $(this).toggleClass('fa-eye');
        $(this).toggleClass('fa-eye-slash');
        if($(this).hasClass('fa-eye')){
          $(this).siblings('input').attr('type','password');
        }else{
          $(this).siblings('input').attr('type','text');
        }
  });

	$(document).on('click','.up-post',function(){
		  pid = $(this).attr('data-id');
      var cont = $(this).siblings('p').text();
      var hd = $(this).siblings('h5').text();
      $('textarea').text(cont);
      $('#u_t').attr('value',hd);
		    $.ajax({
			     type: 'post',
			     url: "functions.php",
			     data:{'action':'updatepost','page':pid},
		      })
	})
 	

  $(document).on('click','.rem',function(){
      var uid = $(this).attr('d-name');
      var uname = $(this).attr('n-name'); 
		if(uid == 'Admin'){
        var id = $(this).attr('data-id');
        var currentRow = $(this).closest('tr');
        currentRow.slideUp();
           alert('User "' + uname + '" is Removed Successfully.');
		
      $.ajax({
			   type : 'post',
			   url:"functions.php", // sending the request to the same page we're on right now
          data:{'action':'deleteEntry','uid':id},
          success:function(response){
            if (response == 'ok') {
                // Hide the row nicely and remove it from the DOM once the animation is finished.
                currentRow.slideUp(500,function(){
                    currentRow.remove();
                })
              }
		}
	})
    }
    else{
        alert("You are not admin");
    }

    })

	$(document).on('click','.up-post',function(){
		var postid = $(this).attr('data-id');
		$('.hid-n').val(function() {
			return  postid;
		})

	})

$('#new_blog').validate({

  rules: {
            b_title: {
                required: true,
                maxlength: 50  
            },
            
            b_content: {
                required: true,
                minlength: 10
            },
            
        },
        submitHandler: function(form){
          var title = $('#b_title').val();
          var content = $('#b_content').val();
          debugger;
          $.ajax({

          url: "functions.php",
         type: 'POST',
          data: {
        'save': 1,
        'name': title,
        'comment': content,
      },
       
    });
          window.location="add-blogs.php";
        }

});
  

	$(document).on('click', '.upda', function(){
    var u_title = $('#u_t').val();
    var u_content = $('#u_c').val();
    var u_id =$('.hid-n').val();
    debugger;
    $.ajax({
      url: "functions.php",
      type: 'POST',
      data: {
        'up': 1,
        'u_title': u_title,
        'u_content': u_content,
        'u_id': u_id,
      },
      
    });
  });

	$(document).on('click', '.btn_user', function(){
    var u_mail = $('#upd_mail').val();
    var u_pwd = $('#upd_pwd').val();
    debugger;
    $.ajax({
      url: "functions.php",
      type: 'POST',
      data: {
        'user': 1,
        'u_mail': u_mail,
        'u_pwd': u_pwd,
      },
      
    });
  });

    $('#myform').validate({
      rules: {
            u_name: {
                required: true,
                maxlength: 10,
                minlength: 3  
            },
            u_pass: {
              required: true,
              minlength: 8,
              maxlength: 15,
            },
            u_pass2:{
              equalTo : "#pwd",
              required : true,

            },
            u_mail: {
                required: true,
                email: true
            },
            user_role: {
                required: true,
            }
          },
      messages : {
            u_pass2:{
              equalTo : "Enter the same password as above"
            },
          },
    submitHandler: function (form) {
    var newus = $('#u_name').val();
    var newmail = $('#u_mail').val();
    var passwd = $('#pwd').val();
    var role =  $("#role option:selected").text(); // for demo
      $.ajax({
      url: "registration.php",
      type: 'POST',
      data: {
        'nes': 1,
        'newus': newus,
        'newmail': newmail,
        'passwd' : passwd,
        'role' : role,
      },
      
    });            
           window.location="registration.php";
        }  
  });


    $(document).on('click','.prof',function(){
      $('.profileform').css('display','block');
    })
      var x = $('.usii').val();
      $('.ifg').attr('src',x);

    $(document).on('click','.fa',function(){
          var getSortHeading = $('.sort-heading');
          var getNextSortOrder = getSortHeading.attr('id');
          var splitID = getNextSortOrder.split('-');
          var splitIDName = splitID[0];
          var sort = $('#ord').val();
          var splitOrder = splitID[1];
          var qu = $('#pag_r').attr('data-id');
          //get current td value
          if(sort == 'ASC'){
            $(this).attr('class','fa fa-caret-down');
          }
          else{
            $(this).attr('class','fa fa-caret-up');
          }
          var getColumnName = splitIDName;
              $.ajax({
                url : 'sort.php',
                type: 'post',
                dataType: 'JSON',
                data:{'sorting' : getColumnName, 'sortt' : sort,'qu': qu},
                success: function(response){
                 $("#userTable tbody").html('');
                  
                  if(splitOrder == 'ASC')
                  {
                  $(getSortHeading).attr('id',splitIDName+'-DESC');
                  $('#ord').val('ASC');
                  $('#ord').attr('data-id',splitIDName);
                  }
                  else
                  {
                  $(getSortHeading).attr('id',splitIDName+'-ASC');
                  $('#ord').val('DESC');
                  $('#ord').attr('data-id',splitIDName);
                  }
                  var len = response.length;
                  for(var i=0; i<len; i++){
                var username = response[i].username;
                $("#userTable tbody").append(username);
              }
              var pag = response[len-1].uname;
                        $('.pag').html(pag);

                }

              })
            })

  $(document).ready(function(){
    var sort = $('#ord').val();
        var colm = $('#ord').attr('data-id');
        var qu = $('#pag_r').attr('data-id');
      $.ajax({
        url: 'sort.php',
        type: 'get',
        dataType: 'JSON',
        data : {'def':sort,'qu' : qu},
        success: function(response){
            var len = response.length;
            
            for(var i=0; i<len; i++){
                var username = response[i].username;
                $("#userTable tbody").append(username);
              }
            var pag = response[len-1].uname;
            $('.pag').html(pag);
          }
      });
  });

  $(document).on('click','.pagi li.active',function(){
       
        var page = $(this).attr('p');
        var sort = $('#ord').val();
        var colm = $('#ord').attr('data-id');
        var qu = $('#pag_r').attr('data-id');
        $('#pag_r').attr('value',page);
                $.ajax({
                    url : 'sort.php',
                    type : 'post',
                    dataType: 'JSON',
                    data : {'page' : page, 'sort':colm, 'ord': sort,'qu':qu},
                    success:function(response){
                        $("#userTable tbody").html('');
                        len = response.length;
                        for(var i=0; i<len; i++){
                            var username = response[i].username;                   
                            $("#userTable tbody").append(username);
                          }
                        var pag = response[len-1].uname;
                        $('.pag').html(pag);
                      }
                  })                
    });

  $(document).ready(function(){
    $('.ad-srch').focus();
    $('.ad-srch').keyup(function(){
      var query = $(this).val();
      var l = query.length;
      var pgi = $('#pag_r').attr('value');
      $('#pag_r').attr('data-id',query)
      $.ajax({
        url : 'sort.php',
        type : 'post',
        dataType : 'JSON',
        data : {'query' : query,'pgi': pgi},
        success:function(response){
          $("#userTable tbody").html('');
                        len = response.length;
                        
                        for(var i=0; i<len; i++){
                            var username = response[i].username;                   
                            $("#userTable tbody").append(username);
                          }
                        if(l >= 1){
                          var pag = response[len-1].uname;
                        $('.pag').html(pag);}
                        else{
                          var pag = response[len-1].uname;
                        $('.pag').html(pag);
                        }
                        
                        if(l >=1){
                          $('#userTable th').attr('class','sort-heading');
                        }
                        else{
                          $('#userTable th').attr('class','sort-heading');
                        }
        }
      })

    })
  })

  $(document).ready(function(){
    $(document).on('click','.edit-b',function(){
      var bid = $(this).attr('data-id');
      alert(bid);
    })
  })

  $(document).ready(function(){
    $(document).on('keydown','#email',function(){
    x =  $('#email').val();
      $('#testr').html(x);
    })
  })


  $(document).on('click','.pdfe',function(){
    var doc = new jsPDF();
    

doc.setFontSize(40);
doc.text("Octonyan loves jsPDF", 35, 25);

doc.save('a4.pdf')
  })


var doc = new jsPDF();

$('#cmd').click(function () {   
    var g = $('.fg').val();
    doc.fromHTML($('#content').html(), 30, 5, {
        'width': 170,
    });
    doc.text(30,30 ,g);
    doc.save('sample-file.pdf');
});
})