function putValues(ar) {
    var a = $.parseJSON(ar);
    document.getElementById('AT').innerHTML = a[0];
    document.getElementById('AB').innerHTML = a[1];
    document.getElementById('T').innerHTML = a[2];
    per = a[3] + '%';
    document.getElementById('P').innerHTML = per;
    console.log(a);
}

function callajax(dataReport) {
    console.log(dataReport);
     $.ajax({
        type: "POST",
      url: "query.php",
      data: dataReport,
      cache: false,
         success: function (html) {
            //  alert(html[3]);
         putValues(html)

        }
    });
}

function getmonth(id){
    var monthar = {
        January: 01,
        February: 02,
        March: 03,
        April: 04,
        May: 05,
        June: 06,
        July: 07,
        August: 08,
        September: 09,
        October: 10,
        November: 11,
        December: 12,
        
    };
    // console.log(id);
    var key = monthar[id];
    var z = '0';
    if (key < 10)
        key = z.concat(key);
    // console.log(key);
    return key;

}
function rep(id) {
     subject = document.getElementById('sub').textContent;
    department = document.getElementById('dep').textContent;
    moodleid = document.getElementById('id').textContent;
    month = getmonth(id);
    var dataReport= 'subject='+subject +'&department='+department+'&moodleid='+moodleid+'&month='+month;
    // console.log(subject+""+department+""+moodleid);
    callajax(dataReport);
  
   
}
