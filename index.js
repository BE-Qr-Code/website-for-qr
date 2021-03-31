//initialize the textbox
var getsessionId = document.getElementById('session');
var getqrCode = document.getElementById('qrcode');
// var getdate = document.getElementById('Date');
// var gettime = document.getElementById('Time');
var getdeptId = document.getElementById('department');
//var getstatus = document.getElementById('Status');
//var getlatitude = document.getElementById('latitude');
//var getlongitude = document.getElementById('longitude');
var getsubjectId = document.getElementById('subjectid');

//get Date
// var d = new Date();
// getdate.value = d.toISOString().slice(0, 10);

//get time in format HH:MM:SS
// gettime.value = d.toTimeString().slice(0,8);

var today = new Date();
var dd = today.getDate();

var mm = today.getMonth()+1; 

var yyyy = today.getFullYear();
if(dd<10) 
{
    dd='0'+dd;
} 

if(mm<10) 
{
    mm='0'+mm;
} 
var date =yyyy+'-'+mm+'-'+dd;
    h = today.getHours(),
    m = today.getMinutes();
    s = today.getSeconds();
       var time =h+':'+m+':'+s; 
      //  var for_expire_m = m + 5;
      //  var for_expire_h = h;
      //  if(for_expire>59){
      //    for_expire_m=0;
      //    for_expire_h=h+1;
      //  }
      //  var end_time=h+':'+for_expire;
//initialize the div where you are going to display the QR(using the api)
var qrcode = new QRCode(document.getElementById('qr_display'));

//onClick() of button
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
    var subjectId = getsubjectId.value; 
    var dataString= 'SessionID='+sessionId +'&qrcode='+qrCode+'&qrdate='+date+'&timestamp='+time+'&DepartrQID='+deptId+'&SubjectQID='+subjectId;
    
    
    if(sessionId==''|| qrCode=='' || deptId=='' || subjectId==''){

      alert('Enter every detail');

    }

    else{
     
    //convert the data to a JSON string
      
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
      
         }
     
      else{
        alert(html);
      }
      
      }
      });

   
    }
  }


