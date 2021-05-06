function print() {
  
   
          
}
function getmonth(id) {
    var monthar = {
         "1":"January",
        2:"February",
         3:"March",
         "4":"April",
        "5": "May",
         6:"June",
         7:"July",
         8:"August",
         9:"September",
       10: "October",
         11:"November",
         12:"December"
        
    };
    // console.log(id);
    var key = monthar[id];
    // var z = '0';
    // if (key < 10)
    //     key = z.concat(key);
    // console.log(key);
    return key;

}

function createvalues(a) {
   
  //   var mid = document.createElement("p");
  // var node = document.createTextNode(a[0]);
  // mid.appendChild(node);
  // div.appendChild(mid);

  // document.getElementById("next-div").appendChild(div);
   

}


function createElements(a) {
 

  var div = document.createElement("div");
  var table = document.createElement("table");
  table.style.border = "1px";
  var row = document.createElement("tr");
  var head = document.createElement("th");
  var h1txt = document.createTextNode("Month");
  head.appendChild(h1txt);
  row.appendChild(head);
  var head2 = document.createElement("th");
  var h2txt = document.createTextNode("No.of lect.");
  head2.appendChild(h2txt);
  row.appendChild(head2);


  var h2 = document.createElement("th");
  var h2txt = document.createTextNode("Average %");
  h2.appendChild(h2txt);
  row.appendChild(h2);


  
  table.appendChild(row);
  document.getElementById('next-div').appendChild(table);





var l=a.length;
  var numval = l / 3;
  var next = 0;
    var month = a.slice(next, numval);
    next=next+numval;
    var per = a.slice(next, next + numval);
    next = next + numval;
   var count = a.slice(next, next + numval);
    
    console.log(month);
    console.log(per);
  console.log(count);
  

  for (var i = 0; i < numval; i++) {
    // var m =;


  var row = document.createElement("tr");
  // document.getElementById("next-div").appendChild(div);
  // div.style.background = "lightgrey";
  //   // div.style.color = "black";
  // div.style.width = "100%";
  // div.style.height = "40px";
  //   div.style.display = "flex";
  //   div.style.justifyContent = "center";
  //   div.style.justifyContent = "space-evenly";

 var td = document.createElement("td");
  var node = document.createTextNode( getmonth(month[i]));
td.appendChild(node);
  row.appendChild(td);
 var td3 = document.createElement("td");
  var node3 = document.createTextNode(count[i]);
td3.appendChild(node3);
  row.appendChild(td3);
 var td2 = document.createElement("td");
  var node2 = document.createTextNode(per[i]);
    td2.appendChild(node2);
    row.appendChild(td2);



  // mid.style.color = "black";
  // mid2.style.color="black";
  // // mid.style.background = "pink";
  // // mid2.style.background="pink";
  // mid.style.width = "100px";
  // mid2.style.width="100px";
  
    table.appendChild(row);
    table.style.width = "300px";
 
    
  }

 
    var divToPrint = document.getElementById('hiddenDIV');
       var popupWin = window.open('', '_blank', 'width=500,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><link rel="stylesheet" href="./css/checkatt.css" class="css" >  <body onload="window.print()">' + divToPrint.innerHTML + '</html>');
          popupWin.document.close();
 









  // ------------uncomment of table doesnt work------------------
//   var mid = document.createElement("p");
//   var node = document.createTextNode("Month");
//   mid.appendChild(node);
//   div.appendChild(mid);

//   document.getElementById("next-div").appendChild(div);
//   mid.style.color = "black";
//   var mid2 = document.createElement("p");
//   var node2 = document.createTextNode("Average %");
//   mid2.appendChild(node2);
//   div.appendChild(mid2);

//     document.getElementById("next-div").appendChild(div);
    
//         mid.style.color = "black";
//         mid2.style.color = "black";
//     div.style.width = "100%";
//     div.style.height = "30px%";
//     div.style.display = "flex";
//   div.style.justifyContent = "center";
//   div.style.justifyContent = "column";
//   div.style.justifyContent = "space-evenly";
//   div.style.alignItems = "center";
//   // div.style.background = "blue";
//     // mid.style.padding = "15px";
// var line = document.createElement("hr");
//   line.className = "solid";
//   line.style.color = "black";
//     div.appendChild(line);
//     createvalues(a);
    
    
    
}

function callme() {
  document.getElementById("subj_options");

  var e = document.getElementById("subj_options");
  var getsubjectId = e.options[e.selectedIndex].value;
  var subjectId = getsubjectId;
  var dataString = "subjectId=" + subjectId;
  $.ajax({
    type: "POST",
    url: "monthavg.php",
    data: dataString,
    cache: false,
    success: function (html) {
      console.log(html);
      var a = $.parseJSON(html);
      console.log(a);
    
      createElements(a);
    },
  });
}

function reset() {
  div.parentNode.removeChild(div);
}
