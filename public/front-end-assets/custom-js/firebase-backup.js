$(document).ready(function(){

	var baseUrl = 'http://webencoder.space/demo/demo61/public/';

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
	* Show active offers in waiting page
	*/
	var avatarImage = baseUrl + 'front-end-assets/images/avater.png';
	if ($("#hidden-waiting-page").val() == "yes") {
		alert();
		var activeOfferHtml = '';
		var restuarent_customer_order_id = $("#hidden-restaurant-offer-customer").val();
		console.log(restuarent_customer_order_id);
		// get old offer
		firebase.database().ref('chat_list').child(restuarent_customer_order_id).on('value', function(snapshot) {
			if (!snapshot.exists()){
				var allMsg = '';
				$.each(snapshot.val(), function( index, value ) {
					var driverName = '';
					var offer_price_by_driver = '';
					var chatUrl = baseUrl+'message/'+value.unique_chat_id;
					firebase.database().ref('chat_detail').child(value.unique_chat_id).on('value', function(single_snapshot) {
						console.log(single_snapshot.val().driver_name);
						driverName = single_snapshot.val().driver_name;
						offer_price_by_driver = single_snapshot.val().offer_price_by_driver;
						activeOfferHtml = '<tr class="table_row"><td width="10%" class="img"><a href="#"><img src="'+avatarImage+'" alt=""> '+driverName+' </a></td><td width="20%"><a class="offer-code" href="">$'+offer_price_by_driver+'</a></td><td><a href="'+chatUrl+'">Chat</a></td></tr>';
						$("#active-offers").append(activeOfferHtml);
					});
				});
			}
		});
		// get new offer
		firebase.database().ref('chat_list').child(restuarent_customer_order_id).on('child_added', function(snapshot) {
			if (!snapshot.exists()){
				var allMsg = '';
				$.each(snapshot.val(), function( index, value ) {
					var driverName = '';
					var offer_price_by_driver = '';
					var chatUrl = baseUrl+'message/'+value.unique_chat_id;
					firebase.database().ref('chat_detail').child(value.unique_chat_id).on('value', function(single_snapshot) {
						console.log(single_snapshot.val().driver_name);
						driverName = single_snapshot.val().driver_name;
						offer_price_by_driver = single_snapshot.val().offer_price_by_driver;
						activeOfferHtml = '<tr class="table_row"><td width="10%" class="img"><a href="#"><img src="'+avatarImage+'" alt=""> '+driverName+' </a></td><td width="20%"><a class="offer-code" href="">$'+offer_price_by_driver+'</a></td><td><a href="'+chatUrl+'">Chat</a></td></tr>';
						$("#active-offers").append(activeOfferHtml);
					});
				});
			}
		});
		
	}





	/**
	* Driver pop 
	*/
	// read data on change

	var starCountRef = firebase.database().ref('driver-pop-up');
	starCountRef.on('child_changed', function(snapshot) {
		var isDriver = $(".hidden-is-driver").val();
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
			'msg': offer_price_by_driver,
			'is_driver': 1
		});

		window.location.href = baseUrl+"message/"+unique_chat_id;

	});	


	/** 
	* live chat windown
	*/
	// read previous chat
	var live_chat_window = $("#live-chat-window").val();
	if (live_chat_window == 'yes') {
		var message_uid      = $("#message_uid").val();

		var starCountRef = firebase.database().ref('message').child(message_uid);
		starCountRef.on('value', function(snapshot) {
			var allMsg = '';

			$.each(snapshot.val(), function( index, value ) {
				if (value.is_driver == 1) {
					allMsg = allMsg+'<div c4lass="incoming_msg"><div class="received_msg"><div class="received_withd_msg"><p>'+value.msg+'</p></div></div></div>';
				}else{
					allMsg = allMsg+'<div class="outgoing_msg"><div class="sent_msg"><p>'+value.msg+'</p></div></div>';
				}
			});
			$('.msg_history').html(allMsg);
		});

		// insert new chat
		$(".msg_send_btn").click(function(){
			var message_uid = $("#message_uid").val();
			var isDriver    = $(".hidden-is-driver").val();
			// alert(isDriver);
			if (isDriver != 1) {
				isDriver = 0;
			}
			var newMsg = $(".write_msg").val();
			if(newMsg != ''){
				var database = firebase.database().ref('message').child(message_uid).push({
					'msg': newMsg,
					'is_driver': isDriver
				});
			}
			$(".write_msg").val('');
		});
		// show new message
		firebase.database().ref('message').child(message_uid).on("child_added", function(snapshot) {
			var newMsg = '';
			$.each(snapshot.val(), function( index, value ) {
				if (value.is_driver == 1) {
					newMsg = newMsg+'<div c4lass="incoming_msg"><div class="received_msg"><div class="received_withd_msg"><p>'+value.msg+'</p></div></div></div>';
				}else{
					newMsg = newMsg+'<div class="outgoing_msg"><div class="sent_msg"><p>'+value.msg+'</p></div></div>';
				}
			});
			$('.msg_history').append(newMsg);
		});
		
	}

	




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