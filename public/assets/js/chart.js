function sliceSize(dataNum, dataTotal) {
  return (dataNum / dataTotal) * 360;
}
function addSlice(sliceSize, pieElement, offset, sliceID, color) {
  var res = sliceID.split("-");
  $(pieElement).append("<div class='slice "+sliceID+" "+res[0]+"'><span></span></div>");
  var offset = offset - 1;
  var sizeRotation = -179 + sliceSize;
  $(pieElement+" ."+sliceID).css({
    "transform": "rotate("+offset+"deg) translate3d(0,0,0)"
  });
  $(pieElement+" ."+sliceID+" span").css({
    "transform"       : "rotate("+sizeRotation+"deg) translate3d(0,0,0)",
    "background-color": color
  });
}
// function iterateSlices(sliceSize, pieElement, offset, dataCount, sliceCount, color) {
//   var sliceID = "s"+dataCount+"-"+sliceCount;
//   var maxSize = 179;
//   if(sliceSize<=maxSize) {
//     addSlice(sliceSize, pieElement, offset, sliceID, color);
//   } else {
//     addSlice(maxSize, pieElement, offset, sliceID, color);
//     iterateSlices(sliceSize-maxSize, pieElement, offset+maxSize, dataCount, sliceCount+1, color);
//   }
// }

function iterateSlices(sliceSize, pieElement, offset, dataCount, sliceCount, color) {
  var sliceID = "s"+dataCount+"-"+sliceCount;
  var maxSize = 179;
  if(sliceSize<=maxSize) {
    addSlice(sliceSize, pieElement, offset, sliceID, color);
  } else {
    addSlice(maxSize, pieElement, offset, sliceID, color);
    iterateSlices(sliceSize-maxSize, pieElement, offset+maxSize, dataCount, sliceCount+1, color);
  }
}

function createPie(dataElement, pieElement) {
  var listData = [];
  $(dataElement+" span").each(function() {
    listData.push(Number($(this).html()));
  });

  var listTotal = 0;
  for(var i=0; i<listData.length; i++) {
    listTotal += listData[i];
    
  }
  
  var offset = 0;
  var color = [
    "cornflowerblue", 
    "olivedrab", 
    "orange", 
    "tomato", 
    "crimson", 
    "purple", 
    "turquoise", 
    "forestgreen", 
    "navy", 
    "gray"
  ];
  for(var i=0; i<listData.length; i++) {
    var size = sliceSize(listData[i], listTotal);
    iterateSlices(size, pieElement, offset, i, 0, color[i]);
    $(dataElement+" li:nth-child("+(i+1)+")").css("border-color", color[i]);
    offset += size;
  }
  
  function getPorcent(){
  var mTotal = 0;
  for(var j=0; j < $(dataElement+" span").length; j++) {
    mTotal += $(dataElement+" span").eq(j).html()*1;
  }
  //console.log(mTotal);
  window.setTimeout(function(){
    $(dataElement +" span").each(function() {
        //console.log((($(this).html()*1)/mTotal)*100);
        rt = Math.ceil((($(this).html()*1)/mTotal)*100);
        result = ''+$(this).html()+'  <span class="porcent"> % </span>';
        
        $(this).html(result);
    });
  },1000);
  
}
getPorcent();


$(dataElement+' li').each(function(i) {
    $(this).mouseover(function(){
     $(dataElement+' li').addClass('it-off');
     var abc = $(this).attr("data-name");
     $(this).removeClass('it-off');
     // $(pieElement+' .s'+i+"-0 span").addClass('opac10');
      $(pieElement+' .s'+i+" span").addClass('opac10');
    });
    $(this).mouseout(function(){
       //$(pieElement+' .s'+i+"-0 span").removeClass('opac10');
       $(pieElement+' .s'+i+" span").removeClass('opac10');
       $(dataElement+' li').removeClass('it-off');
    })
});
  
// $(pieElement+' .slice').each(function(i) {
//     var classes = $(this).attr('class');
//     var lstclass = classes.split(" ");
//     $(this).mouseover(function(){
      
//       console.log(lstclass[2]);
//       $("."+lstclass[2]+" span").addClass('mouse');
//     });
//     $(this).mouseout(function(){
//       $("."+lstclass[2]+" span").removeClass('mouse');
       
//     })
// });

}

createPie(".pieID.legend", ".pieID.pie");
createPie(".pieID2.legend", ".pieID2.pie");
createPie(".pieID3.legend", ".pieID3.pie");