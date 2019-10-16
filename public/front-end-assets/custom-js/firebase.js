$(document).ready(function(){

	var baseUrl = 'http://localhost:8000/';

	// Your web app's Firebase configuration
	var firebaseConfig = {
	apiKey: "AIzaSyBspTIy_ytS0tTtDMrRC9qc70_BTV8oNx0",
	authDomain: "test-22be0.firebaseapp.com",
	databaseURL: "https://test-22be0.firebaseio.com",
	projectId: "test-22be0",
	storageBucket: "test-22be0.appspot.com",
	messagingSenderId: "33253274226",
	appId: "1:33253274226:web:faf000c88608c61c5a88eb",
	measurementId: "G-EJPVW4XW3F"
	};
	// Initialize Firebase
	firebase.initializeApp(firebaseConfig);
	firebase.analytics();






	/**
	* Driver pop 
	*/
	// read data on change

	var starCountRef = firebase.database().ref('driver-pop-up');
	starCountRef.on('child_changed', function(snapshot) {
		var isDriver = $(".hidden-is-driver").val();
		console.log(snapshot.val());
		if (isDriver == 1) {
			$('#see-order-detail-by-driver').attr('restuarent_customer_order_id', snapshot.val().restuarent_customer_order_id)
			$('.driver-new-order-popup').show();
		}

		$('.driver-new-order-popup').click(function(){
			$('.driver-new-order-popup').hide();
		});
		$('.button').click(function(){
			$('.driver-new-order-popup').hide();
		});

		// here we need to calculate the distance and show pop up
		// var changedLat = '';
		// changedLat = changedLat+'<li>'+snapshot.val().lat+'</li>';
		// $('#all-msg').html(changedLat);
	});

	/**
	* See detail by driver 
	*/
	$(document).on('click', '#see-order-detail-by-driver', function(){
		var newHref = baseUrl+'see-order-detail-by-driver/'+$(this).attr("restuarent_customer_order_id");
		window.location.href = newHref;
	});

	/**
	* send-offer-by-driver to customer
	*/
	$(document).on('click', '#send-offer-by-driver', function(){
		var driver_id = $("#driver_id").val();
		var driver_name = $("#driver_name").val();
		var customer_id = $("#customer_id").val();
		var customer_name = $("#customer_name").val();
		var restuarent_customer_order_id = $("#restuarent_customer_order_id").val();
		var offer_price_by_driver = $("#offer_price_by_driver").val();

		var unique_chat_id = 'rco'+restuarent_customer_order_id+'d'+driver_id;

		// chat list according to restuarent offer customer id
		// only insert if it is not there
		firebase.database().ref('chat_list').child(restuarent_customer_order_id).orderByChild("unique_chat_id").equalTo(unique_chat_id).once("value",snapshot => {
		    if (!snapshot.exists()){
				firebase.database().ref('chat_list').child(restuarent_customer_order_id).push({
					unique_chat_id: unique_chat_id
				});
		    }
		});
		// chat detail
		firebase.database().ref('chat_detail').child(unique_chat_id).set({
			driver_id: driver_id,
			driver_name: driver_name,
			customer_id: customer_id,
			customer_name: customer_name,
			restuarent_customer_order_id: restuarent_customer_order_id,
			offer_price_by_driver: offer_price_by_driver
		});	

		// message
		firebase.database().ref('message').child(unique_chat_id).push({
			'msg': offer_price_by_driver
		});
	});	


	/**
	* Order placed by customer
	*/

	var newOfferId = $("#hidden-restaurant-offer-customer").val();
	var isAccepted = $("#hidden-is-accepted").val();
	if (isAccepted == 0) {
		var database = firebase.database().ref('driver-pop-up').child(newOfferId).set({
			attempt: 0,
			restuarent_customer_order_id: $("#hidden-restaurant-offer-customer").val(),
			anyResponse: false,
			customer_log: $("#hidden-lon").val(),
			customer_lat: $("#hidden-lat").val()
		});

		firebase.database().ref('driver-pop-up').child(newOfferId).update({
			attempt: 1
		});	
	}



});