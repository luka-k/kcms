// For image change
function showImage(large, xlarge){
    var aLargeLink = document.getElementById('highslidelarge');

    if (aLargeLink != null) {    
        aLargeLink.href = xlarge;
        var imgs = aLargeLink.getElementsByTagName('img');
        imgs[0].src = large;
    }   
}

function textFocus(inputElement,val){
	var ele = document.getElementById(inputElement);
	if (ele.value == val) {
		ele.value = '';
	}	
}

function textBlur(inputElement,val){
	var ele = document.getElementById(inputElement);
	if (ele.value == '') {
		ele.value = val;
	}	
}

function filter_product(refSelect, filterName){
    //get the value of selected item of select box
    var filterValue = refSelect.options[refSelect.selectedIndex].value;
    var queryString;
    
    //if the value of option is -1 then remove the selected filter from condition else add it.
    if (filterValue == '-1')
        queryString = '?filter_action=1&filter_name=' + encodeURI(filterName) + '&filter_value=' + filterValue + '&filter_type=1';
    else
        queryString = '?filter_action=0&filter_name=' + encodeURI(filterName) + '&filter_value=' + filterValue + '&filter_type=1';
    window.location = queryString;
}

function OpenWindow(URLStr, left, top, width, height){
    var popUpWin=0;
    if(popUpWin){
        if(!popUpWin.closed) popUpWin.close();
    }
    popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
} 

function checkQuantity(stocklevel,quantity){

    var stock = stocklevel;
    var vrquantity = document.getElementById(quantity).value;

    if(vrquantity > stock){
        alert('The quantity you requested is not available for this item.');
    } else {
        document.basket.submit();
    }
}

function CountLeft(field, count, max) {
    var len=document.getElementById (field).value.length

    if (len > max) {
        document.getElementById (field).value = document.getElementById (field).value.substring(0, max);
    } else {
        document.getElementById(count).innerHTML = "";
        document.getElementById(count).innerHTML = max - len;
    }
}

function submitForm(formId) {
  var formObj = document.getElementById(formId);
  formObj.submit();
}