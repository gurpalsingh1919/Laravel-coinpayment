$('#submit').on('click', function() {
    valid = true;   
    if ($('#billingfirstname').val() == '') {
        alert ("Please Enter Your FirstName");
        valid = false;
    }

    valid = true;   
    if ($('#billinglastname').val() == '') {
        alert ("Please Enter Your LastName");
        valid = false;
    }

     valid = true;   
    if ($('#billingpremise').val() == '') {
        alert ("Please Enter Your Premise");
        valid = false;
    }

     valid = true;   
    if ($('#billingstreet').val() == '') {
        alert ("Please Enter Your Street");
        valid = false;
    }

      valid = true;   
    if ($('#billingtown').val() == '') {
        alert ("Please Enter Your Town");
        valid = false;
    }

      valid = true;   
    if ($('#billingcountryiso2a').val() == '') {
        alert ("Please Enter Your Country");
        valid = false;
    }

      valid = true;   
    if ($('#billingpostcode').val() == '') {
        alert ("Please Enter Your ZipCode");
        valid = false;
    }

      valid = true;   
    if ($('#billingtelephonetype').val() == '') {
        alert ("Please Enter Your Phone");
        valid = false;
    }

     valid = true;   
    if ($('#billingemail').val() == '') {
        alert ("Please Enter Your Email");
        valid = false;
    }
   
});