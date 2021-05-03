//initialize the textbox
var getsessionId = document.getElementById('session');
var getqrCode = document.getElementById('qrcode');
// var getdate = document.getElementById('Date');
// var gettime = document.getElementById('Time');
var getdeptId = document.getElementById('department');
//var getstatus = document.getElementById('Status');
// var getlatitude = document.getElementById('latitude');
// var getlongitude = document.getElementById('longitude');

//var getsubjectId = document.getElementById('subjectid');

//get Date
var d = new Date();
date = d.toISOString().slice(0, 10);

//get time in format HH:MM:SS
time = d.toTimeString().slice(0,8);
// var today = new Date();
// var dd = today.getDate();

// var mm = today.getMonth()+1; 

// var yyyy = today.getFullYear();
// if(dd<10) 
// {
//     dd='0'+dd;
// } 

// if(mm<10) 
// {
//     mm='0'+mm;
// } 
// var date =yyyy+'-'+mm+'-'+dd;
// h = today.getHours(),
// m = today.getMinutes();
// s = today.getSeconds();
// var time =h+':'+m+':'+s; 
//        var for_expire_m = m + 5;
//        var for_expire_h = h;
//        if(for_expire>59){
//          for_expire_m=0;
//          for_expire_h=h+1;
//        }
//        var end_time=h+':'+for_expire;



var qrcode = new QRCode(document.getElementById('qr_display'));


function add_to_count(count,Session,subject) {
  var data2= 'Session='+Session +'&count='+count+'&subject='+subject;
  console.log(data2);
  $.ajax({
    type: "POST",
    url: "addtodb.php",
    data: data2,
    cache: false,
    success: function (html) {
      console.log(html);
    }
  });
  // console.log(c);
  // console.log(session);
}


function generateQR() {
    //get the actual content in textbox
    var sessionId = getsessionId.value;
    var qrCode = getqrCode.value;
    // var date = getdate.value; 
    // var time = gettime.value;

    var deptId = getdeptId.value;
    //var status = getstatus.value; 
    // var latitude = getlatitude.value;
    // var longitude = getlongitude.value;
    var e = document.getElementById("subj_options");
    var getsubjectId = e.options[e.selectedIndex].value;
    var subjectId = getsubjectId; 
    var dataString= 'SessionID='+sessionId +'&qrcode='+qrCode+'&qrdate='+date+'&DepartrQID='+deptId+'&SubjectQID='+subjectId;
    var countString= 'SessionID='+sessionId +'&qrcode='+qrCode+'&DepartrQID='+deptId+'&SubjectQID='+subjectId;
    

    if(sessionId=='' || qrCode=='' || deptId=='' || subjectId==''){
      alert('Enter every detail');
    }

    else
    {
      //convert the data to a JSON string 
      var pdffun = function () {

        console.log('pdf..');
var session = document.getElementById('session').value;
    var str = 'session=' + session;
  // console.log(str);
    $.ajax({
        type: "POST",
        url: "pdflist.php",
        data: str,
        cache: false,
        success: function (html) {
          console.log(html);
          var a = $.parseJSON(html);
          // console.log(a[a.length]);
          // console.log(a[(a.length)-1]);
          var l = a.length;
          var c = 0;
          var sub = a[l - 2];
          
          document.getElementById('subject').innerHTML = sub;
          document.getElementById('lectNumber').innerHTML = a[l -1];
          for (var i = 0; i < (l-2)/2; i++) {
              var sr = document.createElement("p");
            var srnode = document.createTextNode(i+1);
            sr.appendChild(srnode);

            // p.innerHTML = "komal";
            document.getElementById("sr").appendChild(sr);
            c = c+1;
           }
          for (var i = 0; i< l-2; i++) {
            // console.log(a);
           
           
          if (i % 2 == 0){
            var mid = document.createElement("p");
            var node = document.createTextNode(a[i]);
            mid.appendChild(node);

            // p.innerHTML = "komal";
              document.getElementById("moodleid").appendChild(mid);
            }
            else if(i % 2 != 0) {
               var name = document.createElement("p");
            var node2 = document.createTextNode(a[i]);
            name.appendChild(node2);

            // p.innerHTML = "komal";
              document.getElementById("pdfname").appendChild(name);
            }
          }
         var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=300,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
          popupWin.document.close();
          
          add_to_count(c,session,sub);
      }
        
    });

       }




        var ajaxFn = function () {
    $.ajax({
      type: "POST",
      url: "count.php",
      data: countString,
      cache: false,
      success: function (html) {
        // if (html == 'sucess') {
           

          //create the actual QR code (this function ia already defined in the qrcode.min.js)
          document.getElementById('count').innerHTML = html;
          alert(html);
        // console.log("komal");
        pdffun();
        // }
        // else {
        //   alert(html);
        // }
      }
    });
      }
      // timeOutId = setTimeout(ajaxFn, 10000);
      //         console.log(timeOutId);
      $.ajax({
        type: "POST",
        url: "qrinsert.php",
        data: dataString,
        cache: false,
        success: function(html) {
            if(html=='Inserted'){
            var obj = {sessionId : sessionId, qrCode : qrCode, date : date,
            time : time, deptId : deptId, subjectId : subjectId};
            var myJSON = JSON.stringify(obj);

            //create the actual QR code (this function ia already defined in the qrcode.min.js)
            qrcode.makeCode(myJSON); 
            alert(html);
              timeOutId = setTimeout(ajaxFn, 10000);
              console.log(timeOutId);
          }
          else{
            alert(html);
          }
        }
      });
    
  }
  

  
  }

  // }








// //initialize the textbox
// var getsessionId = document.getElementById('session');
// var getqrCode = document.getElementById('qrcode');
// // var getdate = document.getElementById('Date');
// // var gettime = document.getElementById('Time');
// var getdeptId = document.getElementById('department');
// //var getstatus = document.getElementById('Status');
// //var getlatitude = document.getElementById('latitude');
// //var getlongitude = document.getElementById('longitude');
// var getsubjectId = document.getElementById('subjectid');

// //get Date
// // var d = new Date();
// // getdate.value = d.toISOString().slice(0, 10);

// //get time in format HH:MM:SS
// // gettime.value = d.toTimeString().slice(0,8);

// var today = new Date();
// var dd = today.getDate();

// var mm = today.getMonth()+1; 

// var yyyy = today.getFullYear();
// if(dd<10) 
// {
//     dd='0'+dd;
// } 

// if(mm<10) 
// {
//     mm='0'+mm;
// } 
// var date =yyyy+'-'+mm+'-'+dd;
//     h = today.getHours(),
//     m = today.getMinutes();
//     s = today.getSeconds();
//        var time =h+':'+m+':'+s; 
//       //  var for_expire_m = m + 5;
//       //  var for_expire_h = h;
//       //  if(for_expire>59){
//       //    for_expire_m=0;
//       //    for_expire_h=h+1;
//       //  }
//       //  var end_time=h+':'+for_expire;
// //initialize the div where you are going to display the QR(using the api)
// var qrcode = new QRCode(document.getElementById('qr_display'));

// //onClick() of button
// function generateQR() {
//     //get the actual content in textbox
//     var sessionId = getsessionId.value;
//     var qrCode = getqrCode.value;
//     // var date = getdate.value; 
//     // var time = gettime.value;

//     var deptId = getdeptId.value;
//     //var status = getstatus.value; 
//     // var latitude = getlatitude.value;
//     // var longitude = getlongitude.value;
//   var subjectId = getsubjectId.value;
//   console.log(subjectId);
//     var dataString= 'SessionID='+sessionId +'&qrcode='+qrCode+'&qrdate='+date+'&timestamp='+time+'&DepartrQID='+deptId+'&SubjectQID='+subjectId;
    
    
//     if(sessionId==''|| qrCode=='' || deptId=='' || subjectId==''){

//       alert('Enter every detail');

//     }

//     else{
     
//     //convert the data to a JSON string
      
//     $.ajax({
//       type: "POST",
//       url: "qrinsert.php",
//       data: dataString,
//       cache: false,
//       success: function(html) {
//          if(html=='Inserted'){
//           var obj = {sessionId : sessionId, qrCode : qrCode, date : date,
//             time : time, deptId : deptId, subjectId : subjectId};
//  var myJSON = JSON.stringify(obj);

//  //create the actual QR code (this function ia already defined in the qrcode.min.js)
//         qrcode.makeCode(myJSON); 
//         alert(html);
      
//          }
     
//       else{
//         alert(html);
//       }
      
//       }
//       });

   
//     }
//   }



