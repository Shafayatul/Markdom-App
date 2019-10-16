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
	* See detail by client
	*/
	$(document).on('click', '#see-order-detail-by-driver', function(){
		var newHref = baseUrl+'see-order-detail-by-driver/'+$(this).attr("restuarent_customer_order_id");
		window.location.href = newHref;
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