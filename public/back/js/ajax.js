$(document).ready(function(){
	$('#buy-item').click(function()
	{
		
		var coin_names = $('select[name=select-currency]').val();
		var kwatt=$(".kwatt_amount").val();
		//console.log(coin_names);
		//alert(kwatt);
		if(coin_names=='')
		{
			var msg="Oops Something went wrong. Please try again !";
		 	swal(msg);
		 	return false;
		}
		else
		{
			var coinAmount = '';
			if(coin_names=='ETH')
			{
				coinAmount =$('#eth_amount').val();
			}
			else if(coin_names=='BTC')
			{
				coinAmount =$('#btc_amount').val();
			}
			else if(coin_names=='BCH')
			{
				coinAmount =$('#bhc_amount').val();
			}
			else if(coin_names=='LTC')
			{
				coinAmount =$('#ltc_amount').val();
			}
			else if(coin_names=='credit_card')
			{
				coinAmount =$('#usd_amount').val();
			}
			else if(coin_names=='master_card')
			{
				coinAmount =$('#usd_amount').val();
			}
			else if(coin_names=='visa_card')
			{
				coinAmount =$('#usd_amount').val();
			}
			// else if(coin_names=='USD')
			// {
			// 	coinAmount =$('#usd_amount').val();
			// }
			
		}
		console.log(coin_names);
		if(kwatt=='' || kwatt==0)
		{
			var msg="Amount not acceptable";
		 	swal(msg);
		 	return false;
		}
		/*else
		{
			swal({title: 'Please wait',allowOutsideClick: false,onOpen: () => {swal.showLoading()}});
		}*/
		if(coin_names=='credit_card')
		{
			//console.log("if");
			$("#kwatt_amounts").val(kwatt);
			$("#coin_amounts").val(coinAmount);
			$('#usd-form-user').submit();
			//var result=termAndCondition();
			
		}
		else if(coin_names=='master_card')
		{
			//alert("master_card");
			$("#master_kwatt_amounts").val(kwatt);
			$("#master_coin_amounts").val(coinAmount);
			$("#card_type").val('master');
			$('#master-card-payment').submit();
			//var result=termAndCondition();
			
		}
		else if(coin_names=='visa_card')
		{
			//alert("visa");
			$("#master_kwatt_amounts").val(kwatt);
			$("#master_coin_amounts").val(coinAmount);
			$("#card_type").val('visa');
			$('#master-card-payment').submit();
			//var result=termAndCondition();
			
		}
		else
		{
			console.log("else");
			swal({title: 'Please wait',allowOutsideClick: false,onOpen: () => {swal.showLoading()}});

			var csrftoken= $('input[name=_token]').val();
		var url = "kwattbuywithcrypto";
		$.ajax({
              type: 'POST',
              url: url,
              data: { kwatt_amount:kwatt,coin_name:coin_names,coin_amount:coinAmount,_token:csrftoken },
              success:  function(data)
              {
              	//console.log(data);
              	var payment_status=data.status;
              	if(payment_status==0)
              	{
              		var message=data.message;
              		swal(message);
              	}
              	else if(payment_status==1)
              	{
              		window.location.href = "My-Order";
              		
              	}
              	
			   },
			   error: function(data){
                var errors = data.responseJSON;
                if(errors.kwatt_amount[0])
                {
                	swal(errors.kwatt_amount[0]);
                }
            }

			});
	}


	



});
function termAndCondition()
{
	(async function acceptTermsAndConditions () {
					const {value: accept} = await swal({
					  title: 'Terms and conditions',
					  //title: 'What is your name?',
					  width: 700,
					  input: 'checkbox',
					  inputValue: 0,
					  html: '<div class="text-left"><small>You will NOT be able to purchase KWATT coins UNTIL you agree to the NO refund policy below.</br></br>'+

'If you are in agreement with the NO refund policy, Please click the checkbox and type your name in the box, which will be acknowledged as your digital signature.<br/></br>'+

'By agreeing to this No Refund Policy, you understand this statement can and will be used against you should you decide to break this agreement and pursue a refund of your product purchase.<br/></br>'+

'PLEASE DO NOT Proceed with the purchase of this product if you DO NOT agree with this No Refund policy.<br/></br>'+

'I accept I am purchasing The KWATT Coin. I understand that the product will be made available to me immediately in my KWATT account.<br/></br>' +

'I understand that the withdrawal of the KWATT from the 4NEW ecosystem will occur at the end of the crowdsale.<br/></br>'+

'I accept I have read the No Refund Policy and I agree my purchase is final.<br/></br>'+

'I agree that I will not pursue a refund of my product purchase, I will not initiate a credit card chargeback or enter into a paypal dispute or chargeback.</small></div>',


					  inputPlaceholder:
					    'I agree all terms and conditions above.',
					  showCancelButton: true,
					  inputClass: 'checkeboxchecked',
					  inputValidator: (result) => {
					    return !result && 'You need to agree with T&C'
					  }
					});

					if (accept) {
					  swal({title: 'Please wait',allowOutsideClick: false,onOpen: () => {swal.showLoading()}});
					  	$('#usd-form-user').submit();
					}

					})();

}
function updateUserWalletAddress(trans_id,walletaddress)
{
	var url='updateWalletAddresses';
	var csrftoken= $('input[name=_token]').val();
	$.ajax({
              type: 'POST',
              url: url,
              data: { transaction_id:trans_id,wallet_address:walletaddress,_token:csrftoken },
              success:  function(data)
              {
              	var mess=data.message;
              	
               	swal({
                            title: data.message,
                            showConfirmButton: 'OK'
                        }). then(function(result){
					      	window.location.href = "dashboard";

			             });
				

              }
          });
}

	$('#paypal-item').click(function()
	{
		//alert("i am usd");
			var coin_names = $(this).val();
			var coin_names = $(this).val();
			var kwatt=$(".kwatt_amount").val();
			var csrftoken= $('input[name=_token]').val();
			var url = "postpaypal";
			//document.getElementById('usd-form-user').submit();
			if(kwatt==0 || kwatt =='')
			{
				var msg='Amount is not acceptable';
				swal(msg);
				return false;
			}
			else
			{
				$('#usd-form-user').submit();
			}
			
			
	});

$('#show_trans_info').click(function()
  {
    var message="<ul class='small-text-info' align='left'><li>As soon as the transmitted funds post to the wallet address indicated, your KWATT balance will update in your account.</li><li>Due to network speeds, please allow up to 2 to 4 hours for the transaction to clear when sending from exchanges.</li><li>Withdrawal of your KWATTs to your myetherwallet address will be activated starting June 1, 2018.</li></ul>";
     swal({
     	title: 'Thank you for your order!',
			html:message,
			//color: #61534e,
			customClass:'mymodel',					       
	      	showCancelButton: false,	
	      	confirmButtonText: 'OK',
	      	confirmButtonClass: 'btn btn-primary',
	      	confirmButtonColor: '#7dc242',
	      	allowOutsideClick: false,
		});
					      

  });

	$('#withdrawlkwatt').click(function()
	{
		var withdrawl_address= $("#withaddress").val();
		//alert(withdrawl_address);
		var url = "withdraw-post";
		var csrftoken= $('input[name=_token]').val();
		var msg='Please Enter Valid Address';
		if(withdrawl_address==0 || withdrawl_address =='')
		{
			
			swal(msg);
			//window.location.href  = "withdraw";
			return false;
		}
		$.ajax({
	              type: 'POST',
	              url: url,
	              data: {address:withdrawl_address,_token:csrftoken },
	              success:  function(data)
	              {
	              		//console.log(data);
	              		var message=data.message;
	              		//swal(message);
	              		if(data.status==1)
	              		{
	              			swal(" ", message, "success");
	              		}
	              		else
	              		{
	              			swal(" ", message, "error");
	              		}
	              		
	              	
	              },
				   error: function(data){
				   	//console.log(data);
	                var errors = data.responseJSON;
        			if(typeof errors.address[0] !== 'undefined')
        			{
        				swal(errors.address[0]);
        			}
        			
	              
	            }

				});



	});



 });

 


/********* tooltip ******/
$('.tip').each(function () {
  $(this).tooltip(
  {
    html: true,
    title: $('#' + $(this).data('tip')).html()
  });
});
/********* tooltip ******/
